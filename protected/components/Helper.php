<?php
class Helper {
    const TYPE_NEWS     = 0;
    const TYPE_ABOUT    = 1;
    const TYPE_TERM     = 2;
    const TYPE_SERVICE  = 3;
    const TYPE_VOUCHER  = 4;
    const ROLE_ADMIN    = 1;
    const ROLE_CUSTOMER = 2;
    const LANGUAGE_VI = 'vi';
    const LANGUAGE_EN = 'en';
    const CURRENCY_DOLLAR = '$';
    const CURRENCY_VND = 'VND';
    
    
	public static function limitString($input, $length, $ellipses = true, $strip_html = true) {
        //strip tags, if desired
        if ($strip_html) {
            $input = strip_tags($input);
        }
      
        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }
      
        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);
      
        //add ellipses (...)
        if ($ellipses) {
            $trimmed_text .= '...';
        }
      
        return $trimmed_text;
    }
    public static function truncate($str, $length, $breakWords = TRUE, $append = '...') {
        $strLength = mb_strlen($str);
        if ($strLength <= $length) {
            return $str;
        }
        if ( ! $breakWords) {
            while ($length < $strLength AND preg_match('/^\pL$/', mb_substr($str, $length, 1))) {
                $length++;
            }
        }
        return mb_substr($str, 0, $length) . $append;
    }
    
    public static function textWrap($text) { 
        $new_text = ''; 
        $text_1 = explode('>',$text); 
        $sizeof = sizeof($text_1); 
        for ($i=0; $i<$sizeof; ++$i) { 
            $text_2 = explode('<',$text_1[$i]); 
            if (!empty($text_2[0])) { 
                $new_text .= preg_replace('#([^\n\r .]{25})#i', '\\1  ', $text_2[0]); 
            } 
            if (!empty($text_2[1])) { 
                $new_text .= '<' . $text_2[1] . '>';    
            } 
        } 
        return $new_text; 
    } 
    
    public static function dateFormat($date) {
        $date = date_create($date);
        return date_format($date, 'Y-m-d G:ia');
    }
    
    public static function mailsend($to,$from,$subject,$message){
        $mail=Yii::app()->Smtpmail;
        $mail->SetFrom($from, 'From Name');
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
            echo "Message sent!";
        }
        $mail->ClearAddresses(); //clear addresses for next email sending
    }
    
    public static function formatCurrency($price) {
        $price = number_format($price, 0, ',', ',');
        return $price;
    }
    
	function adddotstring($strNum) {

        $len = strlen($strNum);
        $counter = 3;
        $result = "";
        while ($len - $counter >= 0)
        {
            $con = substr($strNum, $len - $counter , 3);
            $result = '.'.$con.$result;
            $counter+= 3;
        }
        $con = substr($strNum, 0 , 3 - ($counter - $len) );
        $result = $con.$result;
        if(substr($result,0,1)=='.'){
            $result=substr($result,1,$len+1);   
        }
        return $result;
	}
    
    public static function getAge($birthdate = '0000-00-00') {
        if ($birthdate == '0000-00-00') return 'Unknown';
    
        $bits = explode('-', $birthdate);
        $age = date('Y') - $bits[0] - 1;
    
        $arr[1] = 'm';
        $arr[2] = 'd';
    
        for ($i = 1; $arr[$i]; $i++) {
            $n = date($arr[$i]);
            if ($n < $bits[$i])
                break;
            if ($n > $bits[$i]) {
                ++$age;
                break;
            }
        }
        return $age;
    }
    public static function userType($userType = '', $showText = false) {
        if($userType > 0) {
            $tagIcon = '<span class="icon_user_type vip-'. $userType .'"></span>';
        } elseif($showText) {
            $tagIcon = Yii::t('app', 'Normal Customer');
        } else {
            $tagIcon = '';
        }
        return $tagIcon;
    }
    
    public static function userTypes() {
        return array(
            ''
        );
    }
    
    public static function types($type) {
        switch ($type) {
            case self::TYPE_NEWS:
                return 'News';
            
            case self::TYPE_ABOUT:
                return 'About';
            
            case self::TYPE_TERM:
                return 'Term of service';
        }
    }
    
    public static function roles() {
        return array (
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_CUSTOMER => 'Customer',
        );
    }
    
    public static function getRole($role) {
        switch ($role) {
            case self::ROLE_ADMIN:
                return 'Admin';
            
            case self::ROLE_CUSTOMER:
                return 'Customer';
        }
    }
}