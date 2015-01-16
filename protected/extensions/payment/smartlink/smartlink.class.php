<?php 
// no direct access
defined('_JEXEC') or die;	


class smartlinkClass
{
	private $config;
	private $smartlinkType;
	
	public function __construct($smartlinktype = 'national') {
		
		$this->config 	= PaymentClass::getConfig('smartlink');
		$this->setSmartlinkType($smartlinktype);
		
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
	
	public function getSecurePass() {
		if ($this->smartlinkType == strtoupper('national')) {
			$SECURE_PASS = $this->config->NATIONAL_SECURE_PASS;
		} else {
			$SECURE_PASS = $this->config->INTERNATIONAL_SECURE_PASS;
		}
		return $SECURE_PASS;
	}
	
	public function getMerchant() {
		if ($this->smartlinkType == strtoupper('national')) {
			$SITE_CODE = $this->config->NATIONAL_MERCHANT_SITE_CODE;
		} else {
			$SITE_CODE = $this->config->INTERNATIONAL_MERCHANT_SITE_CODE;
		}
		return $SITE_CODE;
	}
	
	public function getSecureSecret() {
		if ($this->smartlinkType == strtoupper('national')) {
			$SECURE_SECRET = $this->config->NATIONAL_SECURE_SECRET_HASH_KEY;
		} else {
			$SECURE_SECRET = $this->config->INTERNATIONAL_SECURE_SECRET_HASH_KEY;
		}
		return $SECURE_SECRET;
	}
	
	public function getCheckoutUrl() {
		if ($this->smartlinkType == strtoupper('national')) {
			$CHECKOUT_URL = $this->config->NATIONAL_CHECKOUT_URL;
		} else {
			$CHECKOUT_URL = $this->config->INTERNATIONAL_CHECKOUT_URL;
		}
		return $CHECKOUT_URL;
	}
	
	public function buildCheckoutUrl($params) {
		
		$vpcURL = $this->getCheckoutUrl() . "?";
		
		// $md5HashData
		$md5HashData = $this->getSecureSecret();
		
		// sort params
		ksort($params);
		
		// set a parameter to show the first pair in the URL
		$appendAmp = 0;
		
		foreach($params as $key => $value) {
		
		    // create the md5 input and URL leaving out any fields that have no value
		    if (strlen($value) > 0) {
		        
		        // this ensures the first paramter of the URL is preceded by the '?' char
		        if ($appendAmp == 0) {
		            $vpcURL .= urlencode($key) . '=' . urlencode($value);
		            $appendAmp = 1;
		        } else {
		            $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
		        }
		        $md5HashData .= $value;
		    }
		}
		
		// Create the secure hash and append it to the Virtual Payment Client Data if
		// the merchant secret has been provided.
		if (strlen($this->getSecureSecret()) > 0) {
		    $vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($md5HashData));
		}
		
		return $vpcURL;
	}
	
	public function verifyPayment($order, $params) {
		
		// SECURE_SECRET
		$SECURE_SECRET = $this->getSecureSecret();
		
		$vpc_TxnResponseCode = isset($params["vpc_TxnResponseCode"]) ? $params["vpc_TxnResponseCode"] : null;
		$vpc_Txn_Secure_Hash = isset($params["vpc_SecureHash"]) ? $params["vpc_SecureHash"] : null;
		
		unset($params["vpc_SecureHash"]);
		
		// set a flag to indicate if hash has been validated
		$validate = false;
		
		if (strlen($SECURE_SECRET) > 0 && $vpc_TxnResponseCode != "No Value Returned") {
		    $md5HashData = $SECURE_SECRET;
		
		    // sort all the incoming vpc response fields and leave out any with no value
		    foreach($params as $key => $value) {
		        if ($key != "vpc_SecureHash" or strlen($value) > 0) {
		            $md5HashData .= $value;
		        }
		    }
		    
		    // Validate the Secure Hash (remember MD5 hashes are not case sensitive)
			// This is just one way of displaying the result of checking the hash.
			// In production, you would work out your own way of presenting the result.
			// The hash check is all about detecting if the data has changed in transit.			
		    if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(md5($md5HashData))) {
		    	if (is_numeric($vpc_TxnResponseCode) && $vpc_TxnResponseCode == 0)
		        	$validate = true;
		        
		    } else {
		        $validate = false;
		    }
		} else {
		    $validate = false;
		}
		
		return $validate;
		
	}
}
?>