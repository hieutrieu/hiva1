<?php 
defined('_JEXEC') or die;
//require_once 'Gateway.php';
require_once JPATH_COMPONENT . DS . 'payment/baokim/baokim.class.php';
require JPATH_COMPONENT . DS . 'payment/payment.php';

class baokimPayment extends Payment {
	
	public function __construct($order = null) {
		parent::__construct('baokim', $order);
	}
	
	public function findToken() {
		return JRequest::getString('token', null);
	}
	
	public function _createUrl() {
		
		$receiver	= $this->config->RECEIVER_EMAIL;
		$returnUrl 	= str_replace('xxxxxx', $this->order->access_key, JRoute::_(JURI::root(false) . $this->config->RETURN_URL));
		$price 		= $this->order->amount;
		$orderId	= $this->order->id;
		$info 		= 'HD-' . $orderId;
	    
		//Khai báo đối tượng của lớp NL_Checkout
		$baokim = new baokimClass();
		
		//TODO: log
		
		//Tạo link thanh toán đến baokim.vn
		return $baokim->createRequestUrl($orderId, $receiver, $price, 0, 0, $info, $returnUrl, '', '');		
	}
	
	public function notify($order) {
		return false;
	}
	
	public function send() {
		$url = $this->_createUrl();
		
		$app = JFactory::getApplication();
		$app->redirect($url);
	}

	public function receive(&$order) {
		
		/**
		Logger
		 
		$paramsLogs = array();
		$paramsLogs['created_on'] 		= JRequest::getString("created_on");
		$paramsLogs['customer_email'] 	= JRequest::getString("customer_email");
		$paramsLogs['customer_name'] 	= JRequest::getString("customer_name");
		$paramsLogs['customer_phone'] 	= JRequest::getString("customer_phone");
		$paramsLogs['fee_amount'] 		= JRequest::getString("fee_amount");
		$paramsLogs['merchant_email'] 	= JRequest::getString("merchant_email");
		$paramsLogs['merchant_id'] 		= JRequest::getString("merchant_id");
		$paramsLogs['merchant_name'] 	= JRequest::getString("merchant_name");
		$paramsLogs['merchant_phone'] 	= JRequest::getString("merchant_phone");
		$paramsLogs['net_amount'] 		= JRequest::getString("net_amount");
		$paramsLogs['order_id'] 		= JRequest::getString("order_id");
		$paramsLogs['payment_type'] 	= JRequest::getString("payment_type");
		$paramsLogs['total_amount'] 	= JRequest::getString("total_amount");
		$paramsLogs['transaction_id'] 	= JRequest::getString("transaction_id");
		$paramsLogs['transaction_status'] 	= JRequest::getString("transaction_status");
		$paramsLogs['checksum'] 		= JRequest::getString("checksum");
		*/
		
		$paramsLogs = $_GET;
		if (isset($paramsLogs['option'])) unset($paramsLogs['option']);
		if (isset($paramsLogs['task'])) unset($paramsLogs['task']);
		if (isset($paramsLogs['token'])) unset($paramsLogs['token']);
		if (isset($paramsLogs['currentURL'])) unset($paramsLogs['currentURL']);
		if (isset($paramsLogs['Itemid'])) unset($paramsLogs['Itemid']);
		if (isset($paramsLogs['view'])) unset($paramsLogs['view']);
		
		/*$textLog = ' ORDER_ID:' . $order->id.'; USERNAME:'.$order->username.'; TYPE: PDT; ';
		foreach ($paramsLogs as $key => $value) {
			$textLog .= $key . ':' . $value . '; ';
		}
		
		JLoader::register('Logger', JPATH_BANANA_LIB.'log'.DS.'Logger.php');
		$logger = Logger::getLogger('baokim', PAYMENT_BAOKIM_LOG.'_in');
		$logger->debug($textLog);
		*/
		
		$baokim = new baokimClass();
		$verify = $baokim->verifyResponseUrl($paramsLogs);
		
		return $verify;
	}
	
	private function updatePaymentResponse($order, $params) {
		var_dump($order); exit;
		$db = JFactory::getDbo();
		$paymentResponse = new stdClass();
		$paymentResponse->id						= (int)$order->id;
		$paymentResponse->payment_merchant			= $params['merchant_name'];
		$paymentResponse->payment_transaction_no	= $params["transaction_id"];
		$paymentResponse->payment_message 			= $params["transaction_status"];
		$paymentResponse->payment_amount 			= $params["total_amount"];
		$db->updateObject('#__balance_proccess_payments', $paymentResponse, 'id');	
	}
}
?>