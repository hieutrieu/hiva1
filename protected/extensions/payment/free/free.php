<?php

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . DS . 'payment/free/free.class.php';
require JPATH_COMPONENT . DS . 'payment/payment.php';

class freePayment extends Payment {
	
	public function __construct($order = null) {
		parent::__construct('free', $order);
	}	
	
	public function findToken() {
		return false;
	}
	
	public function notify($order) {
		return false;
	}
	
	public function send() {
		//$url = JRoute::_('index.php?option=com_shopping&view=order&token=' . $this->order->token, false);		
		$url = ShoppingHelperRoute::getRouteView('order', array('token='.$this->order->token));
		
		$app = JFactory::getApplication();
		
		$app->redirect($url);
	}

	public function receive(&$order) {
		return false;
	}
}
?>