<?php 
abstract class Payment {
	
	// Payment's Name
	protected $name;
	
	// Payment's Configuration
	protected $config;
	
	// Payment's Order
	protected $order;
	
	public function __construct($name, $order = null) {
		$this->name 	= $name;
		$this->config 	= PaymentClass::getConfig($this->name);		
		$this->setOrder($order);
	}
	
	public function setOrder($order) {
		$this->order	= $order;
	}
	
	public function getOrder() {
		return $this->order;
	}
	
	/**
	 * Tim Token trong truong hop Phuong thuc goi ve khong dang ky duoc Token [Order Validation].
	 * Can thiet trong truong hop Notifi IPN - Ngan Luong hoac BPN - Bao Kim	 
	 */
	abstract public function findToken();
	
	/**
	 * Nhan kich hoat tu ben doi tac thanh toan, hoac tu Admin
	 * @param Order Object $order
	 */
	abstract public function notify($order);
	
	/**
	 * Chuyen du lieu den trang thang toan 
	 */
	abstract public function send();
	
	/** 
	 * Nhan Du lieu va Validate ket qua thanh toan
	 * @param Order Object $order
	 */
	abstract public function receive(&$order);
	
}
?>