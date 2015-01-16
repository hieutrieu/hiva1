<?php 
//require_once 'Gateway.php';
require_once JPATH_COMPONENT . DS . 'payment/paypal/NL_PaypalController.php';
require JPATH_COMPONENT . DS . 'payment/payment.php';

class paypalPayment extends Payment {
	
	public function __construct($order = null) {
		parent::__construct('paypal', $order);
	}
	
	public function findToken() {
		return JRequest::getString('token');
	}
	
	public function send() {
		
		// CURENCY = USD
		$orderUpdate = new stdClass();
		$orderUpdate->id = $this->order->id;
		$orderUpdate->currency 	= 'USD';
		$orderUpdate->conversion_total_price	= number_format(Deallibs_Helpers::convertVndToOtherCurrency($this->order->total_price, 'usd'), 2);
		
		$apiUsername 	= $this->config->PAYPAL_CHECKOUT_USERNAME;
		$apiPassword 	= $this->config->PAYPAL_CHECKOUT_PASSWORD;
		$apiSignature 	= $this->config->PAYPAL_CHECKOUT_SIGNATURE;
		
		if (in_array(strtolower($this->config->PAYPAL_CHECKOUT_MODE), array('sandbox', 'beta-sandbox', 'live'))) {
			$enviroment 	= strtolower($this->config->PAYPAL_CHECKOUT_MODE);
		} else {
			$enviroment 	= 'live';
		}
		
		// Init Setting URLs
		$returnUrl = str_replace('xxxxxx', $this->order->token, JRoute::_(JURI::root(false) . $this->config->RETURN_URL));
		$cancelUrl = str_replace('xxxxxx', $this->order->token, JRoute::_(JURI::root(false) . $this->config->CANCEL_URL));
		
		
		$calls = new NL_PaypalController($apiUsername, $apiPassword, $apiSignature, $enviroment);
		$paypalUrl = $calls->SetExpressCheckOutFuntion($orderUpdate->conversion_total_price, $orderUpdate->currency, $returnUrl, $cancelUrl);
		
		
		/**
		Logger
		 */
		/*$paramsLogs = array();
		$paramsLogs['price']			= $orderUpdate->conversion_total_price;
		$paramsLogs['currency']			= $orderUpdate->currency;
		$paramsLogs['order_code'] 		= $this->order->transaction_id;
		$paramsLogs['transaction_info'] = $this->order->validation;
		
		$textLog = ' ORDER_ID:' . $this->order->id.'; USERNAME:'.$this->order->username.'; TYPE: EXPRESS_CHECKOUT; ';
		
	   	JLoader::register('Logger', JPATH_BANANA_LIB.'log'.DS.'Logger.php');
		$logger = Logger::getLogger('paypal', PAYMENT_PAYPAL_LOG.'_out');
		foreach ($paramsLogs as $key => $value) {
			$textLog .= $key . ':' . $value . '; ';
		}
		$logger->debug($textLog);
		*/
		if ($paypalUrl) {
			//$db = JFactory::getDbo();
			//$db->updateObject('#__order', $orderUpdate, 'id');
		}
		
		$app = JFactory::getApplication();
		$app->redirect($paypalUrl);
		die();
	}
	
	public function receive(&$order) {
		
 		$token = JRequest::getString('token', '');
		$paramsLogs = array();
		
		$apiUsername 	= $this->config->PAYPAL_CHECKOUT_USERNAME;
		$apiPassword 	= $this->config->PAYPAL_CHECKOUT_PASSWORD;
		$apiSignature 	= $this->config->PAYPAL_CHECKOUT_SIGNATURE;
		
		if (in_array(strtolower($this->config->PAYPAL_CHECKOUT_MODE), array('sandbox', 'beta-sandbox', 'live'))) {
			$enviroment 	= strtolower($this->config->PAYPAL_CHECKOUT_MODE);
		} else {
			$enviroment 	= 'live';
		}
	   
		$calls = new NL_PaypalController($apiUsername, $apiPassword, $apiSignature, $enviroment);
	   	$entity = $calls->GetExpressCheckOutFuntion($token);
	   	
	   	$result = false;
		
		if ($entity->ACK =="Success" || $entity->ACK =="Successwithwarnning"){
	   	
	   		//Truy vấn trong order tương ứng với đơn hàng có token = $token
			//==> Lấy ra được số tiền tương ứng với đơn hàng đó
	   	  	/*$rs = $calls->DoGetExpressCheckOutCustomize($entity->PAYERID, $entity->TOKEN, $order->currency, $order->conversion_total_price, $order->id, $order->transaction_id);   
	   	  
	   	  	if ($rs) {
	   	  		
	   	  		foreach ($rs as $key=>$value) {
	   	  			$paramsLogs[$key] = urldecode($value);
	   	  		}
	   	  		$this->updatePaymentResponse($order, $paramsLogs);
	   	  		
	   	  		if("SUCCESS" == strtoupper($rs["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($rs["ACK"])) { //Thanh cong
	   	  			
		   	  		$OrderModel 	= JModel::getInstance('Order', 'Banana_ShoppingModel');
			   	  	if ($order->state != 4) {
						$OrderModel->updateBonusCode($order->id, 1);
						$OrderModel->validationIPN($order->id, 1);
					}
					
					$result = true;
	    		}
	   	  	}
	   	  	*/
			$result = true;
	   	}
	   	
	   	/**
		Logger
		 */
		/*$textLog = ' ORDER_ID:' . $order->id.'; USERNAME:'.$order->username.'; TYPE: EXPRESS_CHECKOUT; ';
		
	   	JLoader::register('Logger', JPATH_BANANA_LIB.'log'.DS.'Logger.php');
		$logger = Logger::getLogger('paypal', PAYMENT_PAYPAL_LOG.'_in');
		foreach ($paramsLogs as $key => $value) {
			$textLog .= $key . ':' . $value . '; ';
		}
		$logger->debug($textLog);
		*/
	   	return $result;
	}
	
	public function notify($order) {
		return false;
	}
	
	private function updatePaymentResponse(&$order, $params) {
		$db = JFactory::getDbo();
		$paymentResponse = new stdClass();
		$paymentResponse->id						= (int)$order->id;
		$paymentResponse->payment_transaction_no	= $params["TRANSACTIONID"];
		$paymentResponse->payment_message 			= $params["ACK"];
		$paymentResponse->payment_amount 			= $params["AMT"];
		
		$db->updateObject('#__orders', $paymentResponse, 'id');	
	}
	
}
?>