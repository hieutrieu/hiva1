<?php

/** TransactionSearch NVP example
 *  Class NL_Paypal
 *  Version 1.0
 *  Created date : 30/11/2011
 *  Create by : Mr.Hung
 *  Modified by : Mr.Hung
 *  Skype : hunghd268 - YM : iphan_group 
*/
  

class NL_Paypal
{
	/**
	 * 
	 * Enter description here ...
	 * @param String $username
	 * @param String $password
	 * @param String $signature
	 * @param String $enviroment
	 * 
	 * @return NL_Paypal
	 */
     function __construct($username, $password, $signature, $enviroment) {
            $this->API_UserName = urlencode($username);
			$this->API_Password = urlencode($password);
			$this->API_Signature = urlencode($signature);
			$this->API_Endpoint = "https://api-3t.paypal.com/nvp";
			$this->API_Environment = $enviroment;	// or 'beta-sandbox' or 'live'					
     }
  	/**
	 *function NL_Paypal : Constructor.
	 *
	 * @param	string	$username : API_Username do paypal cung cấp.
	 * @param	string	$password : API_Password do paypal cung cấp.
	 * @param   string  $signature : API_Signature chữ ký điện tử do paypal cung cấp tương ứng với tài khoản.
	 * @return	void
	 */
     /*
  	function NL_Paypal($username,$password,$signature){
  		
  		    $this->API_UserName = urlencode($username);
			$this->API_Password = urlencode($password);
			$this->API_Signature = urlencode($signature);
			$this->API_Endpoint = "https://api-3t.paypal.com/nvp";
			$this->API_Environment = "sandbox";	// or 'beta-sandbox' or 'live'
			
			echo "Da chay toi paypal 1";	
  	}*/
     
     /*
      * Lấy vể số tiền có trong tài khoản paypal
      */
     function PPHttpPostGetBalance() {
     	    $methodName_ = "GetBalance";
     	    $nvpStr_ = "";
			if("sandbox" === $this->API_Environment || "beta-sandbox" === $this->API_Environment) {
				$this->API_Endpoint = "https://api-3t.$this->API_Environment.paypal.com/nvp";
			}
			$version = urlencode('51.0');
		
			// setting the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// turning off the server and peer verification(TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			// NVPRequest for submitting to server
			
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$this->API_Password&USER=$this->API_UserName&SIGNATURE=$this->API_Signature$nvpStr_";
		    
			// setting the nvpreq as POST FIELD to curl
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
			// getting response from server
			$httpResponse = curl_exec($ch);
		
			if(!$httpResponse) {
				exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			}
		
			// Extract the RefundTransaction response details
			$httpResponseAr = explode("&", $httpResponse);
		
			$httpParsedResponseAr = array();
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}
		
			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
				exit("Invalid HTTP Response for POST request($nvpreq) to $this->API_Endpoint.");
			}
		    
			return $httpParsedResponseAr;
	}
     
     
	/*
	 * Ham thục hiện thanh toán
	 * 
	 */
	function PPHttpPostDoGetExpressCheckOut($payerid,$token,$currentcy,$amount, $bananaOrderID = null, $bananaTransactionID = null) {
		
				$methodName_ = "DoExpressCheckoutPayment";
				$payerID = $payerid;
				$token = $token;
				
				$paymentType ="Sale";			// or 'Sale' or 'Order'
				$paymentAmount = $amount;
				$currencyID = $currentcy;						// or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
		
			// Add request-specific fields to the request string.
			$nvpStr_ = "&TOKEN=$token&PAYERID=$payerID&PAYMENTACTION=$paymentType&AMT=$paymentAmount&CURRENCYCODE=$currencyID";
			
			// NGUYEN VAN CONG UPDATE
			if ($bananaOrderID) {
				$nvpStr_ .= "&INVNUM=$bananaOrderID";
			}
			if ($bananaTransactionID) {
				$nvpStr_ .= "&DESC=TransactionID:$bananaTransactionID";
			}
			// END NGUYEN VAN CONG UPDATE
		
			if("sandbox" === $this->API_Environment || "beta-sandbox" === $this->API_Environment) {
				$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
			}
			$version = urlencode('51.0');
		
			// setting the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// Set the curl parameters.
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
		
			// Set the API operation, version, and API signature in the request.
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$this->API_Password&USER=$this->API_UserName&SIGNATURE=$this->API_Signature$nvpStr_";
		
			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
			// Get response from the server.
			$httpResponse = curl_exec($ch);
		
			if(!$httpResponse) {
				exit('$methodName_ failed: '.curl_error($ch).'('.curl_errno($ch).')');
			}
		    //var_dump("Response : ".$httpResponse);
			// Extract the response details.
			$httpResponseAr = explode("&", $httpResponse);
		    //var_dump($httpResponseAr);
			$httpParsedResponseAr = array();
			//var_dump($httpResponseAr);
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}
		
			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
				exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
			}
		
			return $httpParsedResponseAr;
		}
	/*
      *  Function Paypal Refund : Thực hiện việc hoàn trả lại một số tiền cho người dùng
      *  @param TransactionID string : Mã giao dịch tương ứng cần hoàn trả lại tiền
      *  @param Refundstyle String : Kiểu hoản trả lại tiền <Full : Hoàn trả toàn bộ>,<Partial : Hoàn trả một phần tiền>
      *  @param Curency String : Mã đơn vị tiền tệ
      *  @param amount String : Số tiền cần refund
      *  @param Memo String : Chú giải về lệnh refund.
      * 
      */
     function PPHttpPostRefundTransaction($TransactionID,$_refundType,$_Currency,$amount,$memo) {
     	
     	    $methodName_ = "RefundTransaction";
     	    $nvpStr_  = "";
			if("sandbox" === $this->API_Environment || "beta-sandbox" === $this->API_Environment) {
				$this->API_Endpoint = "https://api-3t.$this->API_Environment.paypal.com/nvp";
			}
			$version = urlencode('51.0');
		
     		// Set request-specific fields.
			$transactionID = urlencode($TransactionID);
			$refundType = urlencode($_refundType);						// or 'Partial' Full
			//$amount;												// required if Partial.
			//$memo;													// required if Partial.
			$currencyID = urlencode($_Currency);							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD','USD')
			
			// Add request-specific fields to the request string.
			$nvpStr = "&TRANSACTIONID=$transactionID&REFUNDTYPE=$refundType&CURRENCYCODE=$currencyID";
			
			if(isset($memo)) {
				$nvpStr .= "&NOTE=$memo";
			}
			
			if(strcasecmp($refundType, 'Partial') == 0) {
				if(!isset($amount)) {
					exit('Partial Refund Amount is not specified.');
				} else {
			 		$nvpStr = $nvpStr."&AMT=$amount";
				}
			
				if(!isset($memo)) {
					exit('Partial Refund Memo is not specified.');
				}
			}
			
			$nvpStr_ = $nvpStr;
			// Set the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
		
			// Set the API operation, version, and API signature in the request.
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$this->API_Password&USER=$this->API_UserName&SIGNATURE=$this->API_Signature$nvpStr_";
		    
			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
			// Get response from the server.
			$httpResponse = curl_exec($ch);
		
			if(!$httpResponse) {
				exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			}
		
			// Extract the response details.
			$httpResponseAr = explode("&", $httpResponse);
		
			$httpParsedResponseAr = array();
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}
		
			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
				exit("Invalid HTTP Response for POST request($nvpreq) to $this->API_Endpoint.");
			}
		
			return $httpParsedResponseAr;
	}
     
  	/**
	 *function PPHttpPostGetTransactionDetail : Hàm lấy về thông tin chi tiết của một giao dịch.
	 *
	 * @param	string	$methodName_ : tên phương thức được gọi về
	 * @param	string	$nvpStr_ : mã của giao dịch
	 * @return	Arrray : mảng thông tin về giao dịch
	 */
  	function PPHttpPostGetTransactionDetail($TransactionID) {
  		
  		  $methodName_ = "GetTransactionDetails";
  		
  		// Set up your API credentials, PayPal end point, and API version.			
			if("sandbox" === $this->API_Environment || "beta-sandbox" === $this->API_Environment) {
				$this->API_Endpoint = "https://api-3t.$this->API_Environment.paypal.com/nvp";
			}
			$nvpStr_ = "&TRANSACTIONID=$TransactionID";
			$version = urlencode('51.0');
		
			// Set the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
		
			// Set the API operation, version, and API signature in the request.
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$this->API_Password&USER=$this->API_UserName&SIGNATURE=$this->API_Signature$nvpStr_";
		   // die($nvpreq);
			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
			// Get response from the server.
			$httpResponse = curl_exec($ch);
		
			if(!$httpResponse) {
				exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			}
		
			// Extract the response details.
			$httpResponseAr = explode("&", $httpResponse);
		
			$httpParsedResponseAr = array();
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}
		
			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
				exit("Invalid HTTP Response for POST request($nvpreq) to $this->API_Endpoint.");
			}
		
			return $httpParsedResponseAr;
  	}
	/**
	 *function PPHttpPostSearchTransaction : Hàm tìm kiếm các thông tin giao dịch.
	 *
	 * @param	string	$methodName_ : tên phương thức được gọi về
	 * @param	string	$nvpStr_ : mã của giao dịch
	 * @param	string	$dateStart : ngày bắt đầu tìm giao dịch
	 * @param   string  $dateEnd   : Ngày kết thúc giao dịch
	 * @return	Arrray : mảng thông tin về tất cả các giao dịch phát sinh trong khoảng thời gian.
	 */
    function PPHttpPostSearchTransaction($Transaction,$dateStart,$dateEnd) {	
    	$methodName_ = "TransactionSearch";
    	$nvpStr_ = "";
    	//$nvpStr_="&token=EC-31K51592R84709308&PayerID=GDZ4XV5GEUFL2";
    	$nvpStr = "&TRANSACTIONID=$Transaction";

		// Set additional request-specific fields and add them to the request string.
		
    	$startDateStr=$dateStart;			// in 'mm/dd/ccyy' format
		$endDateStr=$dateEnd;			// in 'mm/dd/ccyy' format
		/*
		if(isset($startDateStr)) {
		   $start_time = strtotime($startDateStr);
		   $iso_start = date('Y-m-d\T00:00:00\Z',  $start_time);
		   $nvpStr .= "&STARTDATE=$iso_start";
		  }
		
		if(isset($endDateStr)&&$endDateStr!='') {
		   $end_time = strtotime($endDateStr);
		   $iso_end = date('Y-m-d\T24:00:00\Z', $end_time);
		   $nvpStr .= "&ENDDATE=$iso_end";
		}
		*/
		$nvpStr_ = $nvpStr;
		
    	if("sandbox" === $this->API_Environment || "beta-sandbox" === $this->API_Environment) {
			$this->API_Endpoint = "https://api-3t.$this->API_Environment.paypal.com/nvp";
		}
			$version = urlencode('51.0');
		
			// Set the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
		
			// Set the API operation, version, and API signature in the request.
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$this->API_Password&USER=$this->API_UserName&SIGNATURE=$this->API_Signature$nvpStr_";
		    //die($nvpreq);
			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
			// Get response from the server.
			$httpResponse = curl_exec($ch);
		
			if(!$httpResponse) {
				exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			}
		
			// Extract the response details.
			$httpResponseAr = explode("&", $httpResponse);
		
			$httpParsedResponseAr = array();
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}
		
			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
				exit("Invalid HTTP Response for POST request($nvpreq) to $this->API_Endpoint.");
			}
		
			return $httpParsedResponseAr;
	}
	/**
	 *function PPHttpPostSetExpressCheckOut : hàm lấy về đường dẫn thanh toán.
	 *
	 * @param	string	$pAmount : giá trị của giao dịch
	 * @param	string	$pCurrency : mã đơn vị tiền tệ
	 * @param	string	$pReturnUrl : đường dẫn trả về url khi thanh toán thành công.
	 * @param   string  $pCancelUrl   :  đường dẫn trả về khi hủy bỏ giao dịch
	 * @return	String : trả về đường dẫn bao gồm  tokenkey để giao dịch 
	 */
	function PPHttpPostSetExpressCheckOut($pAmount,$pCurrency,$pReturnUrl,$pCancelUrl) {			
		    $methodName_ = 'SetExpressCheckout';
			// Set request-specific fields.
			$paymentAmount = urlencode($pAmount);
			$currencyID = urlencode($pCurrency);							// or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
			$paymentType = urlencode('Sale');				// or 'Sale' or 'Order' Authorization
			
			$returnURL = urlencode($pReturnUrl);
			$cancelURL = urlencode($pCancelUrl);
			
			// Add request-specific fields to the request string.
			$nvpStr_ = "&Amt=$paymentAmount&ReturnUrl=$returnURL&CANCELURL=$cancelURL&PAYMENTACTION=$paymentType&CURRENCYCODE=$currencyID";
			
			
			if("sandbox" === $this->API_Environment || "beta-sandbox" === $this->API_Environment) {
				$this->API_Endpoint = "https://api-3t.$this->API_Environment.paypal.com/nvp";
			}
			$version = urlencode('51.0');
		
			// Set the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
		
			// Set the API operation, version, and API signature in the request.
			$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$this->API_Password&USER=$this->API_UserName&SIGNATURE=$this->API_Signature$nvpStr_";
		    //die($nvpreq);
			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
			// Get response from the server.
			$httpResponse = curl_exec($ch);
		
			if(!$httpResponse) {
				exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			}
		
			// Extract the response details.
			$httpResponseAr = explode("&", $httpResponse);
		
			$httpParsedResponseAr = array();
			foreach ($httpResponseAr as $i => $value) {
				$tmpAr = explode("=", $value);
				if(sizeof($tmpAr) > 1) {
					$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
				}
			}
		
			if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
				exit("Invalid HTTP Response for POST request($nvpreq) to $this->API_Endpoint.");
			}
		
			return $httpParsedResponseAr;
	}
	/**
	 *function PPHttpPostSetExpressCheckOut : hàm lấy về đường dẫn thanh toán.
	 *
	 * @param	string	$pAmount : giá trị của giao dịch
	 * @param	string	$pCurrency : mã đơn vị tiền tệ
	 * @param	string	$pReturnUrl : đường dẫn trả về url khi thanh toán thành công.
	 * @param   string  $pCancelUrl   :  đường dẫn trả về khi hủy bỏ giao dịch
	 * @return	Array : thông tin về giao dịch có mã tookenkey 
	 */
	 function PPHttpPostGetExpressCheckOut($token) {
	 			$methodName_ = 'GetExpressCheckoutDetails';
				$nvpStr_ = "&TOKEN=$token";
				if("sandbox" === $this->API_Environment || "beta-sandbox" === $this->API_Environment) {
					$this->API_Endpoint = "https://api-3t.$this->API_Environment.paypal.com/nvp";
				}
			
				$version = urlencode('51.0');
			
				// Set the curl parameters.
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
				curl_setopt($ch, CURLOPT_VERBOSE, 1);
			
				// Turn off the server and peer verification (TrustManager Concept).
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
			
				// Set the API operation, version, and API signature in the request.
				$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$this->API_Password&USER=$this->API_UserName&SIGNATURE=$this->API_Signature$nvpStr_";
			    //die($nvpreq);
				// Set the request as a POST FIELD for curl.
				curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
			
				// Get response from the server.
				$httpResponse = curl_exec($ch);
			
				if(!$httpResponse) {
					exit('$methodName_ failed: '.curl_error($ch).'('.curl_errno($ch).')');
				}
			
				// Extract the response details.
				$httpResponseAr = explode("&", $httpResponse);
			
				$httpParsedResponseAr = array();
				foreach ($httpResponseAr as $i => $value) {
					$tmpAr = explode("=", $value);
					if(sizeof($tmpAr) > 1) {
						$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
					}
				}
			
				if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
					exit("Invalid HTTP Response for POST request($nvpreq) to $this->API_Endpoint.");
				}
			
				return $httpParsedResponseAr;
	}
	  	
}
?> 