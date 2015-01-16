<?php 
Yii::import('zii.widgets.CPortlet');
 
class Mainmenu extends CPortlet{
    const ID_DAMAT = 2;
    const ID_TOC = 3;
    const ID_MAKEUP = 4;
    const ID_DACTRI = 5;
    const ID_OTHER = 6;
    
    public function init() {
        parent::init();
    }
 
    protected function renderContent(){
        $catalogModel = new ShopCategory;
        $productModel = new ShopProduct;
        $catalogs = $catalogModel->getAllcategories();
        
        $this->render('mainmenu', array('catalogs' => $catalogs));
    }
}
