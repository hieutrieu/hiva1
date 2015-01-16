<?php

Yii::import('application.models._base.BaseCommentRating');

class CommentRating extends BaseCommentRating {
    const LIMIT = 20;
    
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public function getComments($productId,$limit = 0) {
        $limit = $limit == 0 ? self::LIMIT : $limit;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        
        $queryCount = Yii::app()->db->createCommand()
	        ->select('count(*)')
	        ->from(array('shop_comment_rating'))
	        ->where("product_id = :product_id", array(':product_id' => $productId))
            ->andWhere("status = 1")
	        ->order('created_at');
        $total = $queryCount->queryScalar();
    
        $query = Yii::app()->db->createCommand()
	        ->select('a.*, b.fullname, b.date_birth, b.address')
	        ->from(array('shop_comment_rating a'))
            ->join('users b', 'b.id = a.user_id')
	        ->where("a.product_id = :product_id", array(':product_id' => $productId))
            ->andWhere("a.status = 1")
	        ->order('a.created_at DESC')
            ->limit($limit, ($page-1)*$limit);
         
        $products = $query->queryAll();
        
        // Paging
        $pages = new CPagination($total);
        $pages->pageSize = self::LIMIT;
        
        $result = array(
            'pages' => $pages,
            'products' => $products,
        );
        return $result;
    }
}