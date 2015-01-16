<?php

Yii::import('application.models._base.BaseNewsletter');

class Newsletter extends BaseNewsletter
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->created_at = time();
        }
     
        return parent::beforeSave();
    }
}