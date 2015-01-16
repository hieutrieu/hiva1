<?php
/** TransactionSearch NVP example
 *  Class Controller
 *  Version 1.0
 *  Created Date : 30/11/2011
 *  Created by : Mr.Hùng
 *  Modified by : Mr.Hung
 *  Skype : hunghd268 - YM : iphan_group 
*/

require_once JPATH_COMPONENT . DS . 'payment/paypal/NL.Paypal.class.php';

class NL_PaypalController
{	
	private $call = null;
	private  $API_Environment = "sandbox";
	
		
	function __construct($username,$password,$signature,$enviroment) {
		$this->API_Environment = $enviroment;
       	$this->call = new NL_Paypal($username,$password,$signature,$enviroment);
    }
    
    public function DoGetExpressCheckOut($payerid,$token,$currentcy,$amount) {
    	$rs = $this->call->PPHttpPostDoGetExpressCheckOut($payerid,$token,$currentcy,$amount);
    	if("SUCCESS" == strtoupper($rs["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($rs["ACK"])) { //Thanh cong
    	  return "1";
    	}
    	else {
    		return "0";
    	}
    }
    
    /**
     * Thuc hien thanh toan
     * @author Nguyen Van Cong
     * @param String $payerid
     * @param String $token
     * @param String $currentcy
     * @param Double $amount
     */
    public function DoGetExpressCheckOutCustomize($payerid, $token, $currentcy, $amount, $bananaOrderID, $bananaTransactionID) {
    	return $this->call->PPHttpPostDoGetExpressCheckOut($payerid, $token, $currentcy, $amount, $bananaOrderID, $bananaTransactionID );
    }
    
    public function GetBalance() {
       $rs = $this->call->PPHttpPostGetBalance();
       $arr = array();
       if("SUCCESS" == strtoupper($rs["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($rs["ACK"])) { //Thanh cong
       	  $arr["Amount"] = urldecode($rs["L_AMT0"]);
       	  $arr["Curency"]=urldecode($rs["L_CURRENCYCODE0"]);
       	  $arr["Error"] = "00";
       }
       else {
       	  $arr["ErrorCode"] = urldecode($rs["L_ERRORCODE0"]);
       	  $arr["Errorname"] = urldecode($rs["L_SHORTMESSAGE0"]);
       	  $arr["Message"] = urldecode($rs["L_LONGMESSAGE0"]);
       }
       return $arr;
      
    }
    public function RefundTransaction($TransactionID,$_refundType,$_Currency,$amount,$memo) {
        $httpParsedResponseAr = $this->call->PPHttpPostRefundTransaction($TransactionID,$_refundType,$_Currency,$amount,$memo);
		$httpParsedResponseAr;
    }
    /*
     * Array ( [TIMESTAMP] => 2011%2d12%2d01T02%3a33%3a35Z [CORRELATIONID] => b0c9772056595 [ACK] => Failure [VERSION] => 51%2e0 [BUILD] => 2271164 [L_ERRORCODE0] => 81131 [L_SHORTMESSAGE0] => Missing%20Parameter [L_LONGMESSAGE0] => TransactionID%20%3a%20Required%20parameter%20missing [L_SEVERITYCODE0] => Error ) 
     */
    public function SetExpressCheckOutFuntion($amount,$curentcy,$urlReturn,$urlCancel) {    	    	
    	$httpParsedResponseAr = $this->call->PPHttpPostSetExpressCheckOut($amount, $curentcy, $urlReturn, $urlCancel);
	  	//var_dump($httpParsedResponseAr);
	  	//DIE();
    	if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
			// Redirect to paypal.com.
			$token = urldecode($httpParsedResponseAr["TOKEN"]);
			$payPalURL = "https://www.paypal.com/webscr&cmd=_express-checkout&token=$token";
			if("sandbox" === $this->API_Environment || "beta-sandbox" === $this->API_Environment) {
				$payPalURL = "https://www.$this->API_Environment.paypal.com/webscr&cmd=_express-checkout&token=$token";
				
			}
			$payPalURL .= "&useraction=commit";
			//echo "ec ec." .$payPalURL; 
			//die();
			
			return $payPalURL;
		} else  {
			// congnv add line return false;
			return false;
			return 'SetExpressCheckout failed: ' . print_r($httpParsedResponseAr, true);
		}
    }
    
	public function GetExpressCheckOutFuntion($token) {
		 $entity = new EntityDetailExpressCheckOut();    
		//Goi ham lay ve thong tin checkout theo token key.
			$httpParsedResponseAr = $this->call->PPHttpPostGetExpressCheckOut($token);
			
			if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
			{
				$entity->ACK = $httpParsedResponseAr["ACK"];
				$entity->TOKEN = $httpParsedResponseAr["TOKEN"];
				$entity->TIMESTAMP =$httpParsedResponseAr["TIMESTAMP"];
				$entity->CORRELATIONID = $httpParsedResponseAr["CORRELATIONID"];
				$entity->VERSION = $httpParsedResponseAr["VERSION"];
				$entity->BUILD = $httpParsedResponseAr["BUILD"];
				$entity->EMAIL = $httpParsedResponseAr["EMAIL"];
				$entity ->PAYERSTATUS =$httpParsedResponseAr["PAYERSTATUS"];
				//$entity->BUSINESS = $httpParsedResponseAr["BUSINESS"]; // OLD CODE
				$entity->BUSINESS = isset($httpParsedResponseAr["BUSINESS"]) ? $httpParsedResponseAr["BUSINESS"] : '';
				$entity->FIRSTNAME = $httpParsedResponseAr["FIRSTNAME"];
				$entity->LASTNAME = $httpParsedResponseAr["LASTNAME"];
				$entity->COUNTRYCODE = $httpParsedResponseAr["COUNTRYCODE"];
				$entity->SHIPTONAME = $httpParsedResponseAr["SHIPTONAME"];
				$entity->ADDRESSSTATUS = $httpParsedResponseAr["ADDRESSSTATUS"];
				
				// Extract the response details.
			    $entity->PAYERID = $httpParsedResponseAr['PAYERID'];
				$entity->SHIPTOSTREET1 = $httpParsedResponseAr["SHIPTOSTREET"];
				if(array_key_exists("SHIPTOSTREET2", $httpParsedResponseAr)) {
					$entity->SHIPTOSTREET2 = $httpParsedResponseAr["SHIPTOSTREET2"];
			    }
				$entity->SHIPTOCITY = $httpParsedResponseAr["SHIPTOCITY"];
				$entity->SHIPTOSTATE = $httpParsedResponseAr["SHIPTOSTATE"];
				$entity->SHIPTOZIP = $httpParsedResponseAr["SHIPTOZIP"];
				$entity->SHIPTOCOUNTRYCODE = $httpParsedResponseAr["SHIPTOCOUNTRYCODE"];								   
			} else  {
				$entity->ACK = $httpParsedResponseAr["ACK"];
				$entity->TIMESTAMP =$httpParsedResponseAr["TIMESTAMP"];
				$entity->CORRELATIONID = $httpParsedResponseAr["CORRELATIONID"];
				$entity->VERSION = $httpParsedResponseAr["VERSION"];
				$entity->BUILD = $httpParsedResponseAr["BUILD"];
				$entity->ERRORCODE = $httpParsedResponseAr["L_ERRORCODE0"];
				$entity->SHORTMESSAGE =$httpParsedResponseAr["L_SHORTMESSAGE0"]; 
				$entity->LONGMESSAGE =$httpParsedResponseAr["L_LONGMESSAGE0"]; 
				$entity->SEVERITYCODE = $httpParsedResponseAr["L_SEVERITYCODE0"];
			}
			//echo "Da chay toi day roi";
			return $entity;
	 }
    
	public function GetDetailTransaction($TransactionID) {
		$entity = new EntityTransaction();
		$result = $this->call->PPHttpPostGetTransactionDetail($TransactionID);
		if("SUCCESS" == strtoupper($result["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($result["ACK"])) {	
			$entity->RECEIVERBUSINESS=$result["RECEIVERBUSINESS"];
 	     	$entity->RECEIVEREMAIL = $result["RECEIVEREMAIL"];
		 	$entity->RECEIVERID = $result["RECEIVERID"];
		 	$entity->EMAIL = $result["EMAIL"];
		 	$entity->PAYERID = $result["PAYERID"];
		 	$entity->PAYERSTATUS = $result["PAYERSTATUS"];
		 	$entity->COUNTRYCODE=$result["COUNTRYCODE"];
		 	$entity->BUSINESS=$result["BUSINESS"];
		 	$entity->SHIPTONAME=$result["SHIPTONAME"];
		 	$entity->SHIPTOSTREET=$result["SHIPTOSTREET"];
		 	$entity->SHIPTOCITY=$result["SHIPTOCITY"];
		 	$entity->SHIPTOSTATE=$result["SHIPTOSTATE"];
		 	$entity->SHIPTOCOUNTRYCODE = $result["SHIPTOCOUNTRYCODE"];
		 	$entity->SHIPTOCOUNTRYNAME=$result["SHIPTOCOUNTRYNAME"];
		 	$entity->SHIPTOZIP = $result["SHIPTOZIP"];
		 	$entity->ADDRESSOWNER=$result["ADDRESSOWNER"];
		 	$entity->ADDRESSSTATUS=$result["ADDRESSSTATUS"];
		 	$entity->SALESTAX =$result["SALESTAX"];
		 	$entity->TIMESTAMP = $result["TIMESTAMP"];
		 	$entity->CORRELATIONID = $result["CORRELATIONID"];
		 	$entity->ACK=$result["ACK"];
		 	$entity->VERSION = $result["VERSION"];
		 	$entity->BUILD = $result["BUILD"];
		 	$entity->FIRSTNAME = $result["FIRSTNAME"];
		 	$entity->LASTNAME=$result["LASTNAME"];
		 	$entity->TRANSACTIONID=$result["TRANSACTIONID"];
		 	$entity->TRANSACTIONTYPE=$result["TRANSACTIONTYPE"];
		 	$entity->PAYMENTTYPE=$result["PAYMENTTYPE"];
		 	$entity->ORDERTIME=$result["ORDERTIME"];
		 	$entity->AMT=$result["AMT"];
		 	$entity->TAXAMT =$result["TAXAMT"];
		 	$entity->CURRENCYCODE=$result["CURRENCYCODE"];
		 	$entity->PAYMENTSTATUS=$result["PAYMENTSTATUS"];
		 	$entity->PENDINGREASON=$result["PENDINGREASON"];
		 	$entity->REASONCODE=$result["REASONCODE"];
		 	$entity->L_NAME0=$result["L_NAME0"];
		 	$entity->L_NUMBER0 = $result["L_NUMBER0"];
		 	$entity->L_QTY0=$result["L_QTY0"];
		 	$entity->L_TAXAMT0=$result["L_TAXAMT0"];
		 	$entity->L_CURRENCYCODE0=$result["L_CURRENCYCODE0"];			
		} else  {
			$entity->ADDRESSOWNER=$result["ADDRESSOWNER"];
		 	$entity->ADDRESSSTATUS=$result["ADDRESSSTATUS"];
		 	$entity->TIMESTAMP = $result["TIMESTAMP"];
		 	$entity->CORRELATIONID = $result["CORRELATIONID"];
		 	$entity->ACK=$result["ACK"];
		 	$entity->VERSION = $result["VERSION"];
		 	$entity->BUILD = $result["BUILD"];
		 	$entity->L_ERRORCODE0=$result["L_ERRORCODE0"];
		 	$entity->L_SHORTMESSAGE0=$result["L_SHORTMESSAGE0"];
		 	$entity->L_LONGMESSAGE0 = $result["L_LONGMESSAGE0"];
		 	$entity->L_SEVERITYCODE0 = $result["L_SEVERITYCODE0"];
		}
		return $entity;
	}
	
	public function SearchTransaction($Transaction,$DateStart,$DateEnd) {
		$result = $this->call->PPHttpPostSearchTransaction($Transaction, $DateStart, $DateEnd);
		//var_dump($result);
		$arrResult = array();
		if("SUCCESS" == strtoupper($result["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($result["ACK"])) {
			$count = sizeof($result);
			//Có giá trị trả về.
			if ($count > 6)
			{
				$run = ($count-5)/11;
				for ($index=0;$index < $run;$index++){
					$entity = new EntitySearchResult();
					$entity->L_TIMESTAMP = $result['TIMESTAMP'.$index];
					$entity->L_TIMEZONE = $result['L_TIMEZONE'.$index];
					$entity->L_TYPE=$result['L_TYPE'.$index];
					$entity->L_EMAIL = $result['L_EMAIL'.$index];
					$entity->L_NAME = $result['L_NAME'.$index];
					$entity->L_TRANSACTIONID = $result['L_TRANSACTIONID'.$index];
					$entity->L_STATUS= $result['L_STATUS'.$index];
					$entity->L_AMT = $result['L_AMT'.$index];
					$entity->L_CURRENCYCODE= $result['L_CURRENCYCODE'.$index];
					$entity->L_FEEAMT = $result['L_FEEAMT'.$index];
					$entity->L_NETAMT = $result['L_NETAMT'.$index];
					//Chung
					$entity->TIMESTAMP = $result["TIMESTAMP"];
					$entity->CORRELATIONID=$result["CORRELATIONID"];
					$entity->ACK=$result["ACK"];
					$entity->VERSION=$result["VERSION"];
					$entity->BUILD=$result["BUILD"];

					$arrResult[] = $entity; 
				}
			}
		} else  {
			  $entity = new EntitySearchResult();
			  $entity->TIMESTAMP = $result["TIMESTAMP"];
			  $entity->CORRELATIONID=$result["CORRELATIONID"];
			  $entity->ACK=$result["ACK"];
			  $entity->VERSION=$result["VERSION"];
		      $entity->BUILD=$result["BUILD"];
		      $entity->L_ERRORCODE = $result["L_ERRORCODE0"];
			  $entity->L_SHORTMESSAGE = $result["L_SHORTMESSAGE0"];
			  $entity->L_LONGMESSAGE = $result["L_LONGMESSAGE0"];
			  $entity->L_SEVERITYCODE=$result["L_SEVERITYCODE0"];
			  
			  $arrResult[] = $entity;
		}
		return $arrResult;
	}
} 

 class EntityDetailExpressCheckOut
 {
 	 var $TOKEN = "";
     var $TIMESTAMP = "";
     var $CORRELATIONID = "";
     var $ACK = "";
     var $VERSION = "";
     var $BUILD = "";
     var $EMAIL = "";
     var $PAYERID = "";
     var $PAYERSTATUS = "";
     var $BUSINESS = "";
     var $FIRSTNAME = "";
     var $LASTNAME = "";
     var $COUNTRYCODE = "";	
     var $SHIPTONAME = "";
     var $SHIPTOSTREET1 = "";
     var $SHIPTOSTREET2 = "";
     var $SHIPTOCITY = "";
     var $SHIPTOSTATE = "";
     var $SHIPTOZIP = "";
     var $SHIPTOCOUNTRYCODE = "";
     var $SHIPTOCOUNTRYNAME = "";
     var $ADDRESSSTATUS = ""; 
     
     //ERROR 
     var $ERRORCODE="";
     var $SHORTMESSAGE="";
     var $LONGMESSAGE = "";
     var $SEVERITYCODE = "";
     
     
 	function __construct() {
 		
 	}
 	
 }
 class EntityTransaction
 {
 	var $RECEIVERBUSINESS="";
 	var $RECEIVEREMAIL = "";
 	var $RECEIVERID = "";
 	var $EMAIL = "";
 	var $PAYERID = "";
 	var $PAYERSTATUS = "";
 	var $COUNTRYCODE="";
 	var $BUSINESS="";
 	var $SHIPTONAME="";
 	var $SHIPTOSTREET="";
 	var $SHIPTOCITY="";
 	var $SHIPTOSTATE="";
 	var $SHIPTOCOUNTRYCODE = "";
 	var $SHIPTOCOUNTRYNAME="";
 	var $SHIPTOZIP = "";
 	var $ADDRESSOWNER="";
 	var $ADDRESSSTATUS="";
 	var $SALESTAX ="";
 	var $TIMESTAMP = "";
 	var $CORRELATIONID = "";
 	var $ACK="";
 	var $VERSION = "";
 	var $BUILD = "";
 	var $FIRSTNAME = "";
 	var $LASTNAME="";
 	var $TRANSACTIONID="";
 	var $TRANSACTIONTYPE="";
 	var $PAYMENTTYPE="";
 	var $ORDERTIME="";
 	var $AMT="";
 	var $TAXAMT ="";
 	var $CURRENCYCODE="";
 	var $PAYMENTSTATUS="";
 	var $PENDINGREASON="";
 	var $REASONCODE="";
 	var $L_NAME0="";
 	var $L_NUMBER0 = "";
 	var $L_QTY0="";
 	var $L_TAXAMT0="";
 	var $L_CURRENCYCODE0="";
 	
 	//Error
 	var $L_ERRORCODE0="";
 	var $L_SHORTMESSAGE0="";
 	var $L_LONGMESSAGE0 = "";
 	var $L_SEVERITYCODE0 = "";
 
 }
 class EntitySearchResult
 {
 	//Yes O
 	var $L_TIMESTAMP = "";
 	var $L_TIMEZONE = "";
 	var $L_TYPE = "";
 	var $L_EMAIL = "";
 	var $L_NAME = "";
 	var $L_TRANSACTIONID = "";
 	var $L_STATUS = "";
 	var $L_AMT = "";
 	var $L_CURRENCYCODE = "";
 	var $L_FEEAMT="";
 	var $L_NETAMT="";
 	//Not o
 	var $TIMESTAMP="";
 	var $CORRELATIONID="";
 	var $ACK="";
 	var $VERSION="";
 	var $BUILD="";
 	//Yes O
 	var $L_ERRORCODE = "";
 	var $L_SHORTMESSAGE = "";
 	var $L_LONGMESSAGE = "";
 	var $L_SEVERITYCODE="";
 }

 ?>