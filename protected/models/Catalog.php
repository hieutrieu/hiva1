<?php

Yii::import('application.models._base.BaseCategory');

class Category extends BaseCategory {
    private static $ids = array();
    
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function getMaxRight() {
        return Yii::app()->db->createCommand()
                        ->select('MAX(`rgt`)')
                        ->from($this->tableName())
                        ->queryScalar();
    }
    
    public function getAllById($id) {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('categories'))
	        ->where('id=:id or parent_id = :parent_id', array(':id' => $id, ':parent_id' => $id))
	        ->order('level');
            
        $categories = $query->queryAll();
        
        if(count($categories) == 1) {
            return $this->getById($id);
        }
        return $this->formatByLevel($categories);
        
    }
    
    public function getById($id) {
        self::$ids[$id] = $id;
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('categories'))
	        ->where('id=:id', array(':id' => $id))
	        ->order('level')
            ->limit(1, 0);
            
        $categorie = $query->queryRow();
        return $this->formatCategory($categorie);
        
    }
    
    public function renderBreakcrumbs($id) {
        $category = $this->getById($id);
        if($category->parent_id > 0) {
            $categories = $this->getAllById($category->parent_id);
            $links = array(
                $categories['parent']->title => array('category/index', 'id'=>$categories['parent']->id),
                $category->classify => array('category/classify', 'tag'=>$category->classify), 
                $category->title => array('category/index', 'id'=>$category->id), 
            );
        } else {
            $links = array(
                $category->classify => array('category/classify', 'tag'=>$category->classify),
                $category->title => array('category/index', 'id'=>$category->id), 
            );
        }
        
        return $links;
    }
    
    public function formatByLevel($categories, $level = 1) {
        $result = array( 'parent' => null, 'subs'   => array(), 'groups' => array());
        $subCategory = array();
        foreach($categories as $cat) {
            self::$ids[$cat['id']] = $cat['id'];
            // Get parent 
            if($cat['level'] == $level) {
                $categoryParent = $this->formatCategory($cat);
            } else {
                $classsify = $cat['classify'];
                if(!isset($subCategory[$classsify])) $subCategory[$classsify] = array();
                $subCategory[$classsify][] = $this->formatCategory($cat);
            }
        }
        if(isset($categoryParent)) {
            $result = array(
                'parent' => $categoryParent,
                'subs'   => $subCategory,
                'groups' => array_keys($subCategory),
            );
        }
        return $result;
    }
    
    public function formatCategory($category = array()) {
        $category = (object) $category;
        $languageFields = array('title');
        $fields = array_keys($this->attributeLabels());
        foreach($category as $key => $value) {
            if(!in_array($key, $fields)) {
                $category->$key = '';
            }
            /*if(Yii::app()->language == 'vi') {
                if(in_array($key, $languageFields)) {
                    $keyVi = $key.'_vi';
                    $category->$key = $category->$keyVi;
                }
            }*/
            
        }
        return $category;
    }
    
    public function getChildIds() {
        return self::$ids;
    }
}