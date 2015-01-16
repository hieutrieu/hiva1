<?php
class baokimConfig {
	public $STATE = '1';
	public $RECEIVER_EMAIL = 'nhaj_ben@yahoo.com.vn';
	public $MERCHANT_SITE_CODE = '577';
	public $SECURE_PASS = 'ebc9f951ea3020e8';
	public $CHECKOUT_URL = 'http://sandbox.baokim.vn/payment/customize_payment/order';
	public $RETURN_URL = 'index.php?option=com_payment&task=payment.complete&token=xxxxxx';
	public $CANCEL_URL = 'index.php?option=com_payment&task=payment.cancel&token=xxxxxx';
	public $NOTIFY_URL = 'index.php?option=com_payment&task=payment.notify&token=xxxxxx';
}