<?php

Yii::import('application.models._base.BaseProduct');

class Product extends BaseProduct {
    const LIMIT = 20;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->created_at = new CDbExpression('NOW()');
        }
        $this->updated_at = new CDbExpression('NOW()');
     
        return parent::beforeSave();
    }
    
    public function getAllByCategoryIds($ids = array()) {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $products = array();
        if(is_array($ids)) {
            if(count($ids) > 0) {
                $ids = implode(',', $ids);
                $queryCount = Yii::app()->db->createCommand()
        	        ->select('count(*)')
        	        ->from(array('products'))
        	        ->where("category_id IN($ids)")
        	        ->order('created_at');
                $total = $queryCount->queryScalar();
            
                $query = Yii::app()->db->createCommand()
        	        ->select('*')
        	        ->from(array('products'))
        	        ->where("category_id IN($ids)")
        	        ->order('created_at')
                    ->limit(self::LIMIT, ($page-1)*self::LIMIT);
                 
                $products = $query->queryAll();
                
                // Paging
                $pages = new CPagination($total);
                $pages->pageSize = self::LIMIT;
                
                $result = array(
                    'pages' => $pages,
                    'products' => $this->formatProducts($products),
                );
                return $result;
            }
        }
        return $products;   
    }
    
    public function formatProducts($products = array()) {
        $newProducts = array();
        foreach($products as $product) {
            $newProducts[] = $this->formatProduct($product);
        }
        return $newProducts;
    }
    
    public function formatProduct($product) {
        $product = (object) $product;
        $fields = array_keys($this->attributeLabels());
        foreach($product as $key => $value) {
            if(!in_array($key, $fields)) {
                $product->$key = '';
            }
        }
        return $product;
    }
    
    public function formatProductDetail($product) {
        $product = $this->formatProduct($product);
        return $product;
    }
    
    public function getProductByParentCategory($id) {
        $catalogModel = new ShopCategory;
        $catalogChildIds = $catalogModel->getChildIdsById($id);
        $productMosts = array();
        if(count($catalogChildIds) > 0) {
            $cids = implode(',', $catalogChildIds);
            $query = Yii::app()->db->createCommand()
        	        ->select('*')
        	        ->from(array('products'))
        	        ->where("category_id IN($cids)")
        	        ->order('created_at')
                    ->limit(20, 0);
            $products = $query->queryAll();
            foreach($products as $product) {
                $product = $this->formatProduct($product);
                $productMosts[] = $product;
            }                
        }
        return $productMosts;
    }
}