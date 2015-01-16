<?php 
// no direct access
defined('_JEXEC') or die;	
 

class SmartlinkPaymentHelpers {
	
	public static function getResponseDescription($responseCode) {
		switch ($responseCode) {
	        case "0" : $result = "Giao dich thanh cong"; break;
	        case "1" : $result = "Ngan hang tu choi thanh toan: the/tai khoan bi khoa"; break;
	        case "2" : $result = "Loi so 2"; break;
	        case "3" : $result = "The het han"; break;
	        case "4" : $result = "Qua so lan giao dich cho phep. (Sai OTP, qua han muc trong ngay)"; break;
	        case "5" : $result = "Khong co tra loi tu Ngan hang"; break;
	        case "6" : $result = "Loi giao tiep voi Ngan hang"; break;
	        case "7" : $result = "Tai khoan khong du tien"; break;
	        case "8" : $result = "Loi du lieu truyen"; break;
	        case "9" : $result = "Kieu giao dich khong duoc ho tro"; break;
	        default  : $result = "Loi khong xac dinh"; 
	    }
	    return 'CODE: '.$responseCode . ' - MESSAGE: ' . $result;
	}
	
	public static function getBankNameWithBinCode($binCode) {
		return self::getBankName($binCode);
	}
	
	public static function getBankNameWithCode($code) {
		return self::getBankName($code);
	}
	
	public static function getBankName($value) {
		switch ($value) {
			case '970425':
			case '191919':
			case 'ABB':
				$bankName = 'Ngân hàng TMCP An Bình';
				break;				
			case '970416':
			case 'ACB':
				$bankName = 'Ngân hàng Á Châu';
				break;				
			case '970438':
			case 'BVB':
				$bankName = 'Ngân hàng TMCP Bảo Việt';
				break;
			case '707070':
			case '970431':
			case 'EIB':
				$bankName = 'Ngân hàng TMCP Xuất nhập khẩu Việt Nam';
				break;
			case '970408':
			case 'GPB':
				$bankName = 'Ngân hàng TMCP Dầu khí toàn cầu';
				break;
			case '970437':
			case 'HDB':
				$bankName = 'Ngân hàng TMCP Phát triển nhà TP.HCM';
				break;
			case '888999':
			case '970434':
			case 'IVB':
				$bankName = 'Ngân hàng TNHH Indovina';
				break;
			case '970422':
			case '193939':
			case 'MB':
				$bankName = 'Ngân hàng TMCP Quân Đội';
				break;
			case '120791':
			case '970426':
			case 'MSB':
				$bankName = 'NH TMCP Hàng Hải';
				break;
			case '970419':
			case '818188':
			case 'NVB':
				$bankName = 'Ngân hàng TMCP Nam Việt';
				break;
			case '970417':
			case '188188':
			case 'PNB':
				$bankName = 'Ngân hàng TMCP Phương Nam';
				break;
			case '157979':
			case '970429':
			case 'SCB':
				$bankName = 'Ngân hàng TMCP Sài Gòn';
				break;
			case '126688':
			case '970443':
			case 'SHB':
				$bankName = 'NHTMCP Sài Gòn Hà Nội';
				break;
			case '970468':
			case '970440':
			case 'SeAb':
				$bankName = 'Ngân hàng TMCP Đông Nam Á';
				break;
			case '970403':
			case 'STB':
				$bankName = 'Ngân hàng TMCP Sài Gòn Thương Tín';
				break;
			case '000002':
			case '970424':
			case 'SVB':
				$bankName = 'Ngân hàng Liên doanh Shinhanvina';
				break;
			case '970407':
			case '888899':
			case '889988':
			case 'TCB':
				$bankName = 'Ngân hàng TMCP Kỹ thương Việt Nam';
				break;
			case '970423':
			case 'TPB':
				$bankName = 'Ngân hàng TMCP Tiên Phong';
				break;
			case '970427':
			case '166888':
			case 'VAB':
				$bankName = 'Ngân hàng TMCP Việt Á';
				break;
			case '686868':
			case '970436':
			case 'VCB':
				$bankName = 'Ngân hàng TMCP Ngoại thương Việt Nam';
				break;
			case '180906':
			case '180909':
			case '970441':
			case 'VIB':
				$bankName = 'Ngân hàng TMCP Quốc tế';
				break;
			case '970439':
			case '668868':
			case 'VID':
				$bankName = 'Ngân hàng Liên doanh VID Public';
				break;
			case '981957':
			case '970432':
			case 'VPB':
				$bankName = 'Ngân hàng TMCP Việt Nam Thịnh Vượng';
				break;
			case '121058':
			case 'NASB':
				$bankName = 'Ngân hàng TMCP  Bắc Á';
				break;
			case '177777':
			case 'OCB':
				$bankName = 'Ngân hàng Phương Đông';
				break;
			case '668899':
			case '970418':
			case 'BIDV':
				$bankName = 'Ngân hàng Đầu Tư và Phát Triển Việt Nam';
				break;
			case '676767':
			case '201010':
			case '620101':
			case '970415':
			case 'Vietin':
				$bankName = 'Ngân hàng Công Thương Việt Nam';
				break;
			case '970406':
			case 'DAB':
				$bankName = 'Ngân hàng Đông Á';
				break;
			default:
				$bankName = null;
				break;
	    }
	    
	    if (!$bankName) {
	    	if (((620160 <= (int)$value) && (620169 >= (int)$value) && is_numeric($value))) {
	    		$bankName = 'Ngân hàng Công Thương Việt Nam';
	    	}
	    	if (((179200 <= (int)$value) && (179299 >= (int)$value) && is_numeric($value))) {
	    		$bankName = 'Ngân hàng Đông Á';
	    	}
	    }
	    
	    return $bankName;
	}
}
?>