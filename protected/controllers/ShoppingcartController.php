<?php
/**
 * 
 */
class ShoppingCartController extends Controller {
    public $totalItems;
    public $totalPrice;
    
    public function actionAdd($id) {
        $isExist = false;
        if (isset(Yii::app()->session['carts'])) {
            $session = Yii::app()->session['carts'];
            if(is_array($session)) {
                foreach($session as &$value) {
                    if($value['product_id'] == $id) {
                        $value['quantity']++;
                        $isExist = true;
                    }
                }
            }
        }
        
        if(!$isExist) {
            $session[] = array(
                'product_id' => $id,
                'quantity' => 1,
            );          
        }
        Yii::app()->session['carts'] = $session;
        $this->redirect('/shoppingcart/order');
	}
    
    public function actionOrder($is_ajax = false){
        $session = Yii::app()->session['carts'];
        
        $products = array();
        if(is_array($session)) {
            $ids = array();
            foreach($session as $item) {
                $ids[$item['product_id']] = $item['quantity'];
            }
            $productModel = new ShopProduct;
            $products = $productModel->getProductByIds(array_keys($ids));
            foreach($products as &$product) {
                $product->quantity = $ids[$product->id];
                $product->total = $product->price * $product->quantity;
            }
        }
        if($is_ajax) {
            $this->renderPartial('order_detail_popup', array('products' => $products));
        } else {
            $this->render('order_detail', array('products' => $products));
        }
    }
    
    public function actionDeleteOrder(){
        Yii::app()->session['carts'] = array();
    }
}