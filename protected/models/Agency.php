<?php

Yii::import('application.models._base.BaseAgency');

class Agency extends BaseAgency
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public function getList() {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('agency'));
            
        $agencies = $query->queryAll();
        return $agencies;
    }
}