<?php

Yii::import('application.models._base.BaseShopCategory');

class ShopCategory extends BaseShopCategory {
	private static $ids = array();
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function behaviors(){
		return array(
			'nestedSetBehavior'=>array(
				'class'=>'NestedSetBehavior',
				'leftAttribute'=>'lft',
				'rightAttribute'=>'rgt',
				'levelAttribute'=>'level',
                'hasManyRoots'=>false,
			),
		);
	}


	public function getMaxRight() {
        return Yii::app()->db->createCommand()
                        ->select('MAX(rgt)')
                        ->from($this->tableName())
                        ->queryScalar();
    }
	
	public function getCategories($classify) {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('shop_category'))
	        ->where('type=:type', array(':type' => $type))
            ->andWhere('parent_id > 0')
	        ->order('id');
        $categories = $query->queryAll();
        foreach($categories as &$category) {
            $category = $this->formatCategory($category);
        }
        return $categories;
    }
    
    public function getAllById($id) {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('shop_category'))
	        ->where('id=:id or parent_id = :parent_id', array(':id' => $id, ':parent_id' => $id))
	        ->order('classify');
            
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
	        ->from(array('shop_category'))
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
                $categories['parent']->title => array('product/catalog', 'id'=>$category->parent_id),
                $category->title => array('product/catalog', 'id'=>$category->id), 
            );
        } else {
            $links = array(
                $category->title => array('product/catalog', 'id'=>$category->id), 
            );
        }
        
        return $links;
    }
    
    public function formatByLevel($categories, $level = 1) {
        $result = array( 'parent' => null, 'subs'   => array(), 'groups' => array());
        $subCategory = array();
        $groupCategory = array();
        foreach($categories as $cat) {
            self::$ids[$cat['id']] = $cat['id'];
            // Get parent 
            $cat = $this->formatCategory($cat);
            if($cat->level == $level) {
                $categoryParent = $cat;
            } else {
                $subCategory[] = $cat;
                $groupCategory[$cat->classify][] = $cat;
            }
        }
        if(isset($categoryParent)) {
            $result = array(
                'parent' => $categoryParent,
                'subs'   => $subCategory,
                'groups'   => $groupCategory,
            );
        }
        return $result;
    }
    
    public function formatAll($categories, $level = 1) {
        $result = array( 'parent' => null, 'subs'   => array());
        $categoryParent = array();
        $subCategory = array();
        $parentId = 0;
        foreach($categories as $cat) {
            $cat = $this->formatCategory($cat);
            // Get parent 
            if($cat->level == $level) {
                $categoryParent[$cat->id] = $this->getAllById($cat->id);
            } 
        }
        return $categoryParent;
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
    
    public function getChildIdsById($id) {
        $query = Yii::app()->db->createCommand()
	        ->select('id')
	        ->from(array('shop_category'))
	        ->where('parent_id = :parent_id', array(':parent_id' => $id));
        $ids = $query->queryColumn();
        return $ids;
    }
    
    public function getChildsById($id) {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('shop_category'))
	        ->where('parent_id = :parent_id', array(':parent_id' => $id));
        $ids = $query->queryAll();
        return $ids;
    }
    
    public function getAllcategories() {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('shop_category'))
	        ->order('level');
        $categories = $query->queryAll();
        return $this->formatAll($categories);
    }
}