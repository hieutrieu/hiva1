<?php
class nganluongConfig {
	public $STATE = '1';
	public $RECEIVER_EMAIL = 'trieutrunghieu@gli.vn';
	//public $RECEIVER_EMAIL = 'nguyenvancong@gli.vn';
	public $MERCHANT_SITE_CODE = '29662';
	//public $MERCHANT_SITE_CODE = '703';
	public $SECURE_PASS = '123QWE';
	public $CHECKOUT_URL = 'https://www.nganluong.vn/checkout.php';
	public $RETURN_URL = 'index.php?option=com_payment&task=payment.complete&token=xxxxxx';
	public $CANCEL_URL = 'index.php?option=com_payment&task=payment.cancel&token=xxxxxx';
	public $NOTIFY_URL = 'index.php?option=com_payment&task=payment.notify&token=xxxxxx';
}