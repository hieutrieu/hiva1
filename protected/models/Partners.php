<?php

Yii::import('application.models._base.BasePartners');

class Partners extends BasePartners
{
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
    
    public function formatItem($item) {
        $item = (object) $item;
        $fields = array_keys($this->attributeLabels());
        foreach($item as $key => $value) {
            if(!in_array($key, $fields)) {
                $item->$key = '';
            }
        }
        return $item;
    }
    
    public function formatItems($items = array()) {
        $newItems = array();
        foreach($items as $item) {
            $newItems[] = $this->formatItem($item);
        }
        return $newItems;
    }
    
    public function getPartners() {
        $query = Yii::app()->db->createCommand()
	        ->select('*')
	        ->from(array('partners'))
	        ->where("status=1")
	        ->order('created_at');
         
        $items = $query->queryAll();
        return $this->formatItems($items);
    }
}