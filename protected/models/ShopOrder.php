<?php

Yii::import('application.models._base.BaseShopOrder');

class ShopOrder extends BaseShopOrder {
    const LIMIT = 20;
    
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    
    public static function getAllOrder($limit = 0) {
        $limit = $limit == 0 ? self::LIMIT : $limit;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        
        $queryCount = Yii::app()->db->createCommand()
	        ->select('count(*)')
	        ->from(array('shop_order'))
	        ->where('customer_id=:customer_id', array(':customer_id' => Yii::app()->user->id));
        $total = $queryCount->queryScalar();
    
        $queryCount = Yii::app()->db->createCommand()
	        ->select('a.*')
	        ->from(array('shop_order a'))
	        ->where('a.customer_id=:customer_id', array(':customer_id' => Yii::app()->user->id))
            ->order('a.ordering_done DESC')
            ->limit($limit, ($page-1)*$limit);
        $orders = $queryCount->queryAll();
        
        $pages = new CPagination($total);
        $pages->pageSize = self::LIMIT;
        
        $result = array(
            'pages' => $pages,
            'orders' => $orders,
        );
        return $result;
    }
}