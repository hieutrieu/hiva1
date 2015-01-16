<?php 
Yii::import('zii.widgets.CPortlet');
 
class Toprightmenu extends CPortlet{
    public function init() {
        parent::init();
    }
 
    protected function renderContent(){
        $this->render('toprightmenu');
    }
}
