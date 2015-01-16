<?php
class Link {
	private static $_instance = null;
	public static $pathNews = 'news';
	public static $pathRecruitment = 'recruitment';
	public static $pathProduct = 'product';
	public static $pathAuth = 'auth';
	public static $pathShoppingCart = 'shoppingcart';
	
	// Call method singleton
	public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new Link();
        }
        return self::$_instance;
    }
	
	/**
     * render url for news detail
     * @param type $params
     * @return type
     */
    public static function newsDetail($params = array()) {
        $fullParams = array(
            'id' => 0,
            'title' => null,
        );
        $fullParams = array_merge($fullParams, $params);
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);
        $fullParams['title'] = UrlTransliterate::cleanString($fullParams['title'], '-');
        
        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathNews .'/detail', $fullParams);
        return $urlBefor;
    }
    
    /**
     * render url for news voucher
     * @param type $params
     * @return type
     */
    public static function newsVoucher($params = array()) {
        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathNews .'/voucher');
        return $urlBefor;
    }
    
    /**
     * render url for news detail
     * @param type $params
     * @return type
     */
    public static function newsList($params = array()) {
        $fullParams = array(
            'id' => 0,
            'title' => null,
        );
        $fullParams = array_merge($fullParams, $params);
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);
        $fullParams['title'] = UrlTransliterate::cleanString($fullParams['title'], '-');

        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathNews .'/list', $fullParams);
        return $urlBefor;
    }
    
    /**
     * render url for news detail
     * @param type $params
     * @return type
     */
    public static function recruitmentList($params = array()) {
        $fullParams = array(
            'id' => 0,
            //'alias' => null,
        );
        $fullParams = array_merge($fullParams, $params);
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);

        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathRecruitment .'/list', $fullParams);
        return $urlBefor;
    }
    
    /**
     * render url for product detail
     * @param type $params
     * @return type
     */
    public static function productDetail($params = array()) {
        $fullParams = array(
            'id' => 0,
            'title' => null,
        );
        $fullParams = array_merge($fullParams, $params);
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);
        $fullParams['title'] = UrlTransliterate::cleanString($fullParams['title'], '-');
        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathProduct .'/detail', $fullParams);
        return $urlBefor;
    }
    
    /**
     * render url for add to cart
     * @param type $params
     * @return type
     */
    public static function addToCart($params = array()) {
        $fullParams = array(
            'id' => 0,
            'title' => null,
        );
        $fullParams = array_merge($fullParams, $params);
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);
        $fullParams['title'] = UrlTransliterate::cleanString($fullParams['title'], '-');
        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathShoppingCart .'/add', $fullParams);
        return $urlBefor;
    }
    /**
     * render url for news detail
     * @param type $params
     * @return type
     */
    public static function productCatalog($params = array()) {
        $fullParams = array(
            'id' => 0,
            'title' => null,
        );
        $fullParams = array_merge($fullParams, $params);
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);
        $fullParams['title'] = UrlTransliterate::cleanString($fullParams['title'], '-');
        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathProduct .'/catalog', $fullParams);
        return $urlBefor;
    }
    
    /**
     * render url for news detail
     * @param type $params
     * @return type
     */
    public static function productManufacture($params = array()) {
        $fullParams = array(
            'id' => 0,
            'name' => null,
        );
        $fullParams = array_merge($fullParams, $params);
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);
        $fullParams['name'] = UrlTransliterate::cleanString($fullParams['name'], '-');
        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathProduct .'/manufacture', $fullParams);
        return $urlBefor;
    }
    
    /**
     * render url for news detail
     * @param type $params
     * @return type
     */
    public static function productSearch() {
        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathProduct .'/search');
        return $urlBefor;
    }
    
    
    /**
     * 
     **/
    public static function profile($params = array()) {
        $fullParams = array(
            'id' => 0,
            //'alias' => null,
        );
        $fullParams = array_merge($fullParams, $params);
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);

        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathAuth .'/profile', $fullParams);
        return $urlBefor;
    }
    
    /**
     * 
     **/
    public static function editProfile($params = array()) {
        $fullParams = array(
            'id' => 0,
            //'alias' => null,
        );
        $fullParams = array_merge($fullParams, $params);
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);

        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathAuth .'/editprofile', $fullParams);
        return $urlBefor;
    }
    
    /**
     * 
     **/
    public static function notify($params = array()) {
        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathAuth .'/notify');
        return $urlBefor;
    }
    
    /**
     * 
     **/
    public static function notifyDetail($id) {
        $fullParams = array(
            'id' => $id,
            //'alias' => null,
        );
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);

        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathAuth .'/notifydetail', $fullParams);
        return $urlBefor;
    }
    
    
    /**
     * 
     **/
    public static function orderHistory($params = array()) {
        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathAuth .'/orderhistory');
        return $urlBefor;
    }
    
    /**
     * 
     **/
    public static function orderHistoryDetail($id) {
        $fullParams = array(
            'id' => $id,
            //'alias' => null,
        );
        // convert all value of params to lower
        $fullParams = array_map('strtolower', $fullParams);

        // Create Url
        $urlBefor = Yii::app()->createUrl(self::$pathAuth .'/orderhistorydetail', $fullParams);
        return $urlBefor;
    }
    
    /**
     * 
     **/
    public static function logout() {
        $urlBefor = Yii::app()->createUrl(self::$pathAuth .'/logout');
        return $urlBefor;
    }
}