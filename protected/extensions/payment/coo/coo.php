<?php

defined('_JEXEC') or die;
//require_once 'Gateway.php';
require_once JPATH_COMPONENT . DS . 'payment/coo/coo.class.php';
require JPATH_COMPONENT . DS . 'payment/payment.php';

class cooPayment extends Payment {
	
	public function __construct($order = null) {
		parent::__construct('coo', $order);
	}	
	
	public function findToken() {
		return false;
	}
	
	public function notify($order) {
		return false;
	}
	
	public function send() {
		
		$url = JRoute::_('index.php?option=com_payment&view=payment&token='.$this->order->access_key);
		
		$app = JFactory::getApplication();
		//$app->enqueueMessage('Chúc mừng bạn đã thực hiện đặt thành công đơn hàng mới');
		//$app->enqueueMessage('Mời bạn đến văn phòng Group Deal để thực hiện thanh toán và nhận hàng');
		$app->redirect($url);
	}

	public function receive(&$order) {
		return false;
	}
}
?>