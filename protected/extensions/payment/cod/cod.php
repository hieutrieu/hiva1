<?php

defined('_JEXEC') or die;
require_once JPATH_COMPONENT . DS . 'payment/cod/cod.class.php';
require JPATH_COMPONENT . DS . 'payment/payment.php';

class codPayment extends Payment {
	
	public function __construct($order = null) {
		parent::__construct('cod', $order);
	}	
	
	public function findToken() {
		return false;
	}
	
	public function notify($order) {
		return false;
	}
	
	public function send() {		
		$url = JRoute::_('index.php?option=com_payment&view=payment&tmpl=component&token='.$this->order->access_key);
		
		$app = JFactory::getApplication();
		//$app->enqueueMessage('Chúc mừng bạn đã thực hiện đặt thành công đơn hàng mới');
		//$app->enqueueMessage('Nhân viên chúng tôi sẽ chuyển hàng đến cho bạn trong khoảng thời gian sớm nhất');
		$app->redirect($url);
	}

	public function receive(&$order) {
		return false;
	}
}
?>