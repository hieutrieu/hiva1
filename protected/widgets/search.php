<?php 
Yii::import('zii.widgets.CPortlet');
 
class Search extends CPortlet{
   
    public function init() {
        parent::init();
    }
 
    protected function renderContent(){     
        $this->render('search');
    }
}
