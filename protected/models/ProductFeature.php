<?php

Yii::import('application.models._base.BaseProductFeature');

class ProductFeature extends BaseProductFeature
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}