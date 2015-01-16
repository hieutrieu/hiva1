<?php 
// no direct access
defined('_JEXEC') or die;	
 
//require_once 'Gateway.php';
require_once JPATH_COMPONENT . DS . 'payment/smartlink/smartlink.class.php';
require JPATH_COMPONENT . DS . 'payment/payment.php';

class smartlinkPayment extends Payment {
	
	private $orderPrice;
	
	private $smartlinkType;
	
	public function __construct($order = null) {
		parent::__construct('smartlink', $order);
		$this->setSmartlinkType($order->payment_extra);
	}
	
	
	public function setSmartlinkType($type = 'national') {
		$type = strtolower($type);
		$types = array('national', 'international', 'NATIONAL', 'INTERNATIONAL');
		if (in_array($type, $types)) {
			$this->smartlinkType = strtoupper($type);
		} else {
			$this->smartlinkType = strtoupper('national');
		}
	}
	
	public function _createUrl() {
		
		$post 		= JRequest::get('POST');
		$smartlink 	= new smartlinkClass($this->order->payment_extra);
		
		$params = array();
		$params['vpc_Version'] 		= 1;
		$params['vpc_Command'] 		= 'pay';
		$params['vpc_AccessCode'] 	= $smartlink->getSecurePass();
		$params['vpc_MerchTxnRef']	= $this->order->access_key;
		$params['vpc_Merchant'] 	= $smartlink->getMerchant();
		$params['vpc_OrderInfo']	= 'HD-'.$this->order->id;
		
		if ($this->smartlinkType == 'INTERNATIONAL') {
			$params['vpc_Amount'] 		= $this->order->amount;
		} else {
			$params['vpc_Amount'] 		= $this->order->amount * 100;
		}
		
		$params['vpc_Locale']		= 'vn';
		$params['vpc_Currency']		= 'VND';
		$params['vpc_ReturnURL']	= str_replace('token=xxxxxx', 'token='.$this->order->access_key, JRoute::_(JURI::root(false) . $this->config->RETURN_URL));
		$params['vpc_BackURL']		= str_replace('token=xxxxxx', 'token='.$this->order->access_key, JRoute::_(JURI::root(false) . $this->config->CANCEL_URL));
		
		// TODO: log
		
		return $smartlink->buildCheckoutUrl($params);
		
	}
	
	public function findToken() {
		return JRequest::getString('vpc_MerchTxnRef', '');
	}
	
	public function notify($order) {
		$get 		= JRequest::get('GET');
		$smartlink 	= new smartlinkClass();
		
		// Check Smartlink Type
		$type = JRequest::getString('smartlinktype');
		if (!$type) {
			$merchant = JRequest::getString('vpc_Merchant');
			if ($merchant == $this->config->INTERNATIONAL_MERCHANT_SITE_CODE) {
				$type = 'INTERNATIONAL';
			} else {
				$type = 'NATIONAL';
			}
		}
		$this->setSmartlinkType($type);
		$smartlink->setSmartlinkType($type);
		
		$params = $get;
		
		unset($params['paymentmethod']);
		unset($params['smartlinktype']);
		unset($params['option']);
		unset($params['task']);
		unset($params['token']);
		unset($params['currentURL']);
		unset($params['Itemid']);
		unset($params['view']);
		
		// TODO: log 
		
		if($order->state == Deallibs_Order::$STATE_FAILED) {
			$this->updatePaymentResponse($order, $params);
		}
		
		return $smartlink->verifyPayment($order, $params);
	}
	
	public function send() {
		$url = $this->_createUrl();
		
		$app = JFactory::getApplication();
		$app->redirect($url);
	}

	public function receive(&$order) {
		
		$get 		= JRequest::get('GET');
		$smartlink 	= new smartlinkClass($order->payment_extra);
		
		$this->setSmartlinkType($order->payment_extra);
		
		$params = $get;
		
		unset($params['smartlinktype']);
		unset($params['option']);
		unset($params['task']);
		unset($params['token']);
		unset($params['currentURL']);
		unset($params['Itemid']);
		unset($params['view']);
		
		// TODO: log
		
		if($order->state == Gli_Payment::STATE_FAILED) {
			$this->updatePaymentResponse($order, $params);
		}
		
		return $smartlink->verifyPayment($order, $params);
	}
	
	private function updatePaymentResponse($order, $params) {
		$db = JFactory::getDbo();
		
		JLoader::register('SmartlinkPaymentHelpers', JPATH_ROOT.'/components/com_shopping/payment/smartlink/smartlink.helpers.php');
		
		$card = '';
		if (isset($params['vpc_CardType'])) {
			$card = $params['vpc_CardType'];
		} elseif (isset($params['vpc_Card'])) {
			$card = $params['vpc_Card'];
		}
		
		$updateOrder = new stdClass();
		$updateOrder->id					= (int)$order->id;
		$updateOrder->payment_transaction	= isset($params['vpc_TransactionNo']) ? $params['vpc_TransactionNo'] : null;
		if ($card) {
			$updateOrder->payment_card_type 	= $card;
		}
		// Phien ban nay co ten vpc_AdditionData. Tu phien ban tiep the se la vpc_AdditionalData
		$updateOrder->payment_bank	 		= isset($params['vpc_AdditionData']) ? $params['vpc_AdditionData'] : null;
		$updateOrder->payment_bank_name		= SmartlinkPaymentHelpers::getBankNameWithBinCode($updateOrder->payment_bank);
		$db->updateObject('#__balance_proccess_payments', $updateOrder, 'id');
	}
	
	private function getResponseDescription($responseCode) {
		switch ($responseCode) {
	        case "0" : $result = "Giao dich thanh cong"; break;
	        case "1" : $result = "Ngan hang tu choi thanh toan: the/tai khoan bi khoa"; break;
	        case "2" : $result = "Loi so 2"; break;
	        case "3" : $result = "The het han"; break;
	        case "4" : $result = "Qua so lan giao dich cho phep. (Sai OTP, qua han muc trong ngay)"; break;
	        case "5" : $result = "Khong co tra loi tu Ngan hang"; break;
	        case "6" : $result = "Loi giao tiep voi Ngan hang"; break;
	        case "7" : $result = "Tai khoan khong du tien"; break;
	        case "8" : $result = "Loi du lieu truyen"; break;
	        case "9" : $result = "Kieu giao dich khong duoc ho tro"; break;
	        default  : $result = "Loi khong xac dinh"; 
	    }
	    return 'CODE: '.$responseCode . ' - MESSAGE: ' . $result;
	}
}
?>