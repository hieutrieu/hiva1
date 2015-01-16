<?php 
Yii::import('zii.widgets.CPortlet');
 
class Topleftmenu extends CPortlet{
    public function init() {
        parent::init();
    }
 
    protected function renderContent(){
        $this->render('topleftmenu');
    }
}
