<?php
// no direct access
defined('_JEXEC') or die;

class nganluongClass
{
	// URL checkout của nganluong.vn
	private $nganluong_url = '';

	// Mã merchante site 
	private $merchant_site_code = '';	// Biến này được nganluong.vn cung cấp khi bạn đăng ký merchant site

	// Mật khẩu bảo mật
	private $secure_pass= ''; // Biến này được nganluong.vn cung cấp khi bạn đăng ký merchant site
	
	public function __construct() {
		$nganluongConfig = PaymentClass::getConfig('nganluong');
		
		$this->nganluong_url 		= $nganluongConfig->CHECKOUT_URL;
		$this->merchant_site_code 	= $nganluongConfig->MERCHANT_SITE_CODE;
		$this->secure_pass			= $nganluongConfig->SECURE_PASS;
	}

	//Hàm xây dựng url, trong đó có tham số mã hóa (còn gọi là public key)
	public function buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price)
	{
		
		// Mảng các tham số chuyển tới nganluong.vn
		$arr_param = array(
			'merchant_site_code'=>	strval($this->merchant_site_code),
			'return_url'		=>	strtolower(urlencode($return_url)),
			'receiver'			=>	strval($receiver),
			'transaction_info'	=>	strval($transaction_info),
			'order_code'		=>	strval($order_code),
			'price'				=>	strval($price)					
		);
		
		$secure_code ='';
		$secure_code = implode(' ', $arr_param) . ' ' . $this->secure_pass;
		$arr_param['secure_code'] = md5($secure_code);
		
		/* Bước 2. Kiểm tra  biến $redirect_url xem có '?' không, nếu không có thì bổ sung vào*/
		$redirect_url = $this->nganluong_url;
		if (strpos($redirect_url, '?') === false)
		{
			$redirect_url .= '?';
		}
		else if (substr($redirect_url, strlen($redirect_url)-1, 1) != '?' && strpos($redirect_url, '&') === false)
		{
			// Nếu biến $redirect_url có '?' nhưng không kết thúc bằng '?' và có chứa dấu '&' thì bổ sung vào cuối
			$redirect_url .= '&';			
		}
				
		/* Bước 3. tạo url*/
		$url = '';		
		
		foreach ($arr_param as $key=>$value)
		{
			if ($url == '')
				$url .= $key . '=' . $value;
			else
				$url .= '&' . $key . '=' . $value;
		}
		return $redirect_url.$url;
	}
	
	/*Hàm thực hiện xác minh tính đúng đắn của các tham số trả về từ nganluong.vn*/
	
	public function verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code, $order)
	{
		// Tạo mã xác thực từ chủ web
		$str = '';
		$str .= ' ' . strval($transaction_info);
		$str .= ' ' . strval($order_code);
		$str .= ' ' . strval($price);
		$str .= ' ' . strval($payment_id);
		$str .= ' ' . strval($payment_type);
		$str .= ' ' . strval($error_text);
		$str .= ' ' . strval($this->merchant_site_code);
		$str .= ' ' . strval($this->secure_pass);

        // Mã hóa các tham số
		$verify_secure_code = '';
		$verify_secure_code = md5($str);
		
		// Xác thực mã của chủ web với mã trả về từ nganluong.vn
		
		if ($verify_secure_code === $secure_code) {
			if ($error_text == '') return true;
		}
		
		return false;
	}
}