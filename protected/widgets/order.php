<?php 
Yii::import('zii.widgets.CPortlet');
 
class Order extends CPortlet{
   
    public function init() {
        parent::init();
    }
 
    protected function renderContent(){     
        $this->render('order');
    }
}
