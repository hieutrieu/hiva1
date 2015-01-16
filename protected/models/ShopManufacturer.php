<?php

Yii::import('application.models._base.BaseShopManufacturer');

class ShopManufacturer extends BaseShopManufacturer
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    public static function getOptions() {
        $options[] = array('id' => '','name' => '--Select--');
        $options = array_merge($options, ShopManufacturer::model()->findAll());
        return $options;
    }
}