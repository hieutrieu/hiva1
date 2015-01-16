<?php
defined('_JEXEC') or die;
//require_once 'Gateway.php';
require_once JPATH_COMPONENT . DS . 'payment/nganluong/nganluong.class.php';
require JPATH_COMPONENT . DS . 'payment/payment.php';

class nganluongPayment extends Payment {
	
	public function __construct($order = null) {
		parent::__construct('nganluong', $order);
	}
	
	public function _createUrl() {
		
		$receiver	= $this->config->RECEIVER_EMAIL;
		$returnUrl 	= str_replace('xxxxxx', $this->order->access_key, JRoute::_(JURI::root(false) . $this->config->RETURN_URL));
		$price 		= $this->order->amount;
		$orderId	= $this->order->id;
		$info 		= 'HD-' . $orderId;
		
		//Khai báo đối tượng của lớp NL_Checkout
		$nganluong = new nganluongClass();
		
		//Tạo link thanh toán đến nganluong.vn
		$link =  $nganluong->buildCheckoutUrl($returnUrl, $receiver, $info,  $orderId, $price);
	
		return $link;
	}
	
	public function findToken() {
		return JRequest::getString('token', '');
	}
	
	public function notify($order) {
		return false;
	}
	
	public function send() {
		$url = $this->_createUrl();
		
		// Load Frame
		$nganluong = new nganluongClass();
		
		$app = JFactory::getApplication();
		$app->redirect($url);
	}

	public function receive(&$order) {
		
		$transaction_info	= JRequest::getVar("transaction_info");	//Lấy thông tin giao dịch
		$order_code			= JRequest::getVar("order_code");	//Lấy mã đơn hàng
		$price				= JRequest::getVar("price");		//Lấy tổng số tiền thanh toán tại ngân lượng 
		$payment_id			= JRequest::getVar("payment_id");	//Lấy mã giao dịch thanh toán tại ngân lượng
		$payment_type		= JRequest::getVar("payment_type");	//Lấy loại giao dịch tại ngân lượng (1=thanh toán ngay ,2=thanh toán tạm giữ)
		$error_text			= JRequest::getVar("error_text");	//Lấy thông tin chi tiết về lỗi trong quá trình giao dịch
		$secure_code		= JRequest::getVar("secure_code");	//Lấy mã kiểm tra tính hợp lệ của đầu vào
		$token_code			= JRequest::getVar("token_code");	//Lấy mã kiểm tra tính hợp lệ của đầu vào
			
		$nganluong = new nganluongClass();
		$verify = $nganluong->verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code, $order);
		
		return $verify;
	}
	
	private function updatePaymentResponse(&$order, $params) {
		$db = JFactory::getDbo();
		$paymentResponse = new stdClass();
		$paymentResponse->id					= (int)$order->id;
		$paymentResponse->payment_transaction	= $params['payment_id'];
		
		$db->updateObject('#__balance_proccess_payments', $paymentResponse, 'id');	
	}
	
	private function getOrderPayment($merchant_id, $order_code, $payment_id, $secure_pass) {
		
		$apiWsdl = "http://beta.nganluong.vn/public_api.php?wsdl";
		
		$client = new SoapClient($apiWsdl);
		
		$stringParam = '<ORDERS>
			<TOTAL>1</TOTAL>
			<ORDER>
				<ORDER_CODE>'.$order_code.'</ORDER_CODE>
				<PAYMENT_ID>'.$payment_id.'</PAYMENT_ID>		
			</ORDER>
		</ORDERS>';
		$checksum = md5($merchant_id .$stringParam. $secure_pass);
		
		$return = $client->__soapCall('checkOrder', array($merchant_id, $stringParam, $checksum));
		
		$xml = simplexml_load_string($return);
		
		return $xml;
	}
}