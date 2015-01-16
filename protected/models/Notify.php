<?php

Yii::import('application.models._base.BaseNotify');

class Notify extends BaseNotify {
    const LIMIT = 20;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public static function totalUnread() {
        $queryCount = Yii::app()->db->createCommand()
	        ->select('count(*)')
	        ->from(array('notify'))
	        ->where('to_id=:to_id AND is_read=0', array(':to_id' => Yii::app()->user->id));
        $total = $queryCount->queryScalar();
        return $total;
    }
    
    public static function allNotify($limit = 0) {
        $limit = $limit == 0 ? self::LIMIT : $limit;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $notifies = array();
        
        $queryCount = Yii::app()->db->createCommand()
	        ->select('count(*)')
	        ->from(array('notify'))
	        ->where('to_id=:to_id', array(':to_id' => Yii::app()->user->id));
        $total = $queryCount->queryScalar();
    
        $queryCount = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('notify'))
	        ->where('to_id=:to_id', array(':to_id' => Yii::app()->user->id))
            ->order('is_read, created_at DESC')
            ->limit($limit, ($page-1)*$limit);
        $notifies = $queryCount->queryAll();
        
        $pages = new CPagination($total);
        $pages->pageSize = self::LIMIT;
        
        $result = array(
            'pages' => $pages,
            'notifies' => $notifies,
        );
        return $result;
    }
    
    public static function getNotify($id) {
        $queryCount = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('notify'))
	        ->where('id=:id', array(':id' => $id))
            ->order('is_read DESC');
        $notify = $queryCount->queryRow();
        if($notify['is_read'] == 0) {
            $notifyModel = Notify::model()->findByPk($id);
            $notifyModel->setAttribute('is_read', 1);
            $notifyModel->save();
        }
        return $notify;
    }
}