<?php

Yii::import('application.models._base.BaseShopProduct');

class ShopProduct extends BaseShopProduct {
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
    
    public function getAllByCategoryIds($ids = array(), $limit = 0) {
        $limit = $limit == 0 ? self::LIMIT : $limit;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $products = array();
        if(is_array($ids)) {
            if(count($ids) > 0) {
                $ids = implode(',', $ids);
                $queryCount = Yii::app()->db->createCommand()
        	        ->select('count(*)')
        	        ->from(array('shop_products'))
        	        ->where("category_id IN($ids)")
        	        ->order('created_at');
                $total = $queryCount->queryScalar();
            
                $query = Yii::app()->db->createCommand()
        	        ->select('*')
        	        ->from(array('shop_products'))
        	        ->where("category_id IN($ids)")
        	        ->order('created_at')
                    ->limit($limit, ($page-1)*$limit);
                 
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
    
    public function getProductByManufactureId($id, $cid = array(), $limit = 0) {
        $limit = $limit == 0 ? self::LIMIT : $limit;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $products = array();
        if(is_array($cid) AND count($cid) > 0) {
            $cids = implode(',', $cid);
            $queryCount = Yii::app()->db->createCommand()
    	        ->select('count(*)')
    	        ->from(array('shop_products'))
    	        ->where("manufacturer_id = $id")
    	        ->andWhere("category_id IN($cids)")
    	        ->order('created_at');
            $total = $queryCount->queryScalar();
        
            $query = Yii::app()->db->createCommand()
    	        ->select('*')
    	        ->from(array('shop_products'))
    	        ->where("manufacturer_id = $id")
                ->andWhere("category_id IN($cids)")
    	        ->order('created_at')
                ->limit($limit, ($page-1)*$limit);
             
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
        return $products;
    }
    
    public function getManufacturer($cids) {
        $manufacturerIds = array();
        if(is_array($cids) && count($cids) > 0) {
            $ids = implode(',', $cids);
            $query = Yii::app()->db->createCommand()
                    ->selectDistinct('b.id, b.name')
                    ->from(array('shop_products a'))
                    ->join('shop_manufacturer b', 'a.manufacturer_id = b.id')
                    ->where("a.category_id IN($ids)")
                    ->andWhere("a.manufacturer_id != ''");
            $manufacturerIds = $query->queryAll();
        }
        return $manufacturerIds;
    }
    
    /**
     * Product relations (San pham cung bo lay the nhan hang)
     */
    public function getProductRelations($product, $limit = 0) {
        $limit = $limit == 0 ? self::LIMIT : $limit;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $mId = $product->manufacturer_id;
        $id = $product->id;
        
        $queryCount = Yii::app()->db->createCommand()
	        ->select('count(*)')
	        ->from(array('shop_products'))
	        ->where("manufacturer_id = :mid", array(':mid' => $mId))
            ->andWhere("id != :id", array(':id' => $id))
	        ->order('created_at');
        $total = $queryCount->queryScalar();
    
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('shop_products'))
	        ->where("manufacturer_id = :mid", array(':mid' => $mId))
            ->andWhere("id != :id", array(':id' => $id))
	        ->order('created_at')
            ->limit($limit, ($page-1)*$limit);
         
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
        	        ->from(array('shop_products'))
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
    
    public function getProductByIds($ids = array()) {
        $productMosts = array();
        if(count($ids) > 0) {
            $cids = implode(',', $ids);
            $query = Yii::app()->db->createCommand()
        	        ->select('*')
        	        ->from(array('shop_products'))
        	        ->where("id IN($cids)")
        	        ->order('created_at');
            $products = $query->queryAll();
            foreach($products as $product) {
                $product = $this->formatProduct($product);
                $productMosts[] = $product;
            }                
        }
        return $productMosts;
    }
    
    public function searchProducts($params = array(), $limit = 0) {
        $limit = $limit == 0 ? self::LIMIT : $limit;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $products = array();
        if(isset($params['search']) && $params['search'] != '') {
            $title = $params['search'];
            $queryCount = Yii::app()->db->createCommand()
        	        ->select('count(*)')
        	        ->from(array('shop_products'))
        	        ->where("title LIKE '%{$title}%'");
                $total = $queryCount->queryScalar();
                
            $query = Yii::app()->db->createCommand()
        	        ->select('*')
        	        ->from(array('shop_products'))
        	        ->where("title LIKE '%{$title}%'")
        	        ->order('created_at')
                    ->limit($limit, ($page-1)*$limit);
            $products = $query->queryAll();
            
            $pages = new CPagination($total);
            $pages->pageSize = self::LIMIT;
            $result = array(
                'pages' => $pages,
                'products' => $this->formatProducts($products),
            );
            foreach($products as $product) {
                $product = $this->formatProduct($product);
                $productMosts[] = $product;
            }   
        } else {
            // Paging
            $pages = new CPagination(0);
            $result = array(
                'pages' => $pages,
                'products' => array(),
            );
        }
        return $result;
    }
    
    public function insertFeatures($productId, $features) {
        $featureData = array();
        foreach($features as $featureId) {
            $featureData[] = array('feature_id' => $featureId, 'product_id' => $productId);
        }
        if(count($featureData) > 0) {
            $builder = Yii::app()->db->schema->commandBuilder;
            $command = $builder->createMultipleInsertCommand('shop_product_feature', $featureData);
            return $command->execute();
        }
        
        return false;
    }
    
    public function updateFeatures($productId, $features) {
        Yii::app()->db->createCommand()->delete('shop_product_feature', 'product_id=:id', array(':id' => $productId));
        return $this->insertFeatures($productId, $features);
    }
     
    /**
     * Get hot product by category Id (lay san pham tieu bieu theo ma danh muc san pham)
     * @id: Ma danh muc san pham 
     **/
    public function getHotProductByCatategoryId($id) {
        $catalogModel = new ShopCategory;
        $catalogChildIds = $catalogModel->getChildIdsById($id);
        $productMosts = array();
        if(count($catalogChildIds) > 0) {
            $cids = implode(',', $catalogChildIds);
            $query = Yii::app()->db->createCommand()
        	        ->select('*')
        	        ->from(array('shop_products'))
        	        ->where("category_id = {$id} OR category_id IN($cids)")
                    ->andWhere("hot = 1")
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