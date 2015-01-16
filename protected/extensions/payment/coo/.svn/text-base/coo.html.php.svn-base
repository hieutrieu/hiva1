<?php 
// no direct access
defined('_JEXEC') or die;	
?>

<script type="text/javascript">
jQuery().ready(function($) {
	var originPrice = $("#confirmCheckoutForm #total_payment_price").html().replace(" đ", "").replace(".", "").replace(",", "");
	originPrice = jQuery.trim(originPrice.replace(".", ""));

	function changePaymentMethodNganluong() {

		var checkedValue = $(".paymentmethod:checked").val();
		if (checkedValue == 'nganluong') {
			promotion_discount = $("#confirmCheckoutForm #paymentmethod-discount-value").html().replace(" đ", "").replace(".", "").replace(",", "");
			promotion_discount = jQuery.trim(promotion_discount.replace(".", ""));
			
			if (Number(promotion_discount) < Number(originPrice)) {
	        	var NewPrice = Number(originPrice) - Number(promotion_discount);
	        	$("#confirmCheckoutForm #total_payment_price").html(formatNumber(NewPrice) + ' đ');
        	}
		} else {
			$("#confirmCheckoutForm #total_payment_price").html(formatNumber(originPrice) + ' đ');
		}
	}
	changePaymentMethodNganluong();
	$(".paymentmethod").click(changePaymentMethodNganluong);
});
</script>
<div class="payment-item-row" style="text-align: left">
	<input type="radio" class="paymentmethod" name="paymentmethod" value="nganluong" id=nganluongpayment />	 
	<label for="nganluongpayment">
		<span style="color: #ff5b00">NgânLượng.vn</span>		
	</label> 
</div>
