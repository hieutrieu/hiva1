<?php 
Yii::import('zii.widgets.CPortlet');
 
class Footermenu extends CPortlet{
    public function init() {
        parent::init();
    }
 
    protected function renderContent(){
        $this->render('footermenu');
    }
}
