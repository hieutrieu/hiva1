<?php 
defined('_JEXEC') or die;	
 ?>
 <script type="text/javascript">
jQuery().ready(function($) {
	var originPrice = $("#confirmCheckoutForm #total_payment_price").html().replace(" đ", "").replace(".", "").replace(",", "");
	originPrice = jQuery.trim(originPrice.replace(".", ""));

	function changePaymentMethodPaypal() {
		var checkedValue = $(".paymentmethod:checked").val();
		if (checkedValue == 'paypal') {
        	$("#confirmCheckoutForm #total_payment_price").html('$ ' + jQuery("#origin_price_usd").html());
		} else if (checkedValue == 'nganluong') {
			changePaymentMethodNganluong();
		} else {
			$("#confirmCheckoutForm #total_payment_price").html(formatNumber(originPrice) + ' đ');
		}
	}
	changePaymentMethodPaypal();
	$(".paymentmethod").click(changePaymentMethodPaypal);
});
</script>
<div class="payment-item-row" style="text-align: left">
	<input type="radio" class="paymentmethod" name="paymentmethod" value="paypal" id=paypalpayment />	 
	<label for="paypalpayment">
		<span style="color: #113465">Pay</span><span style="color: #38658f">Pal</span> <span style="color: #38658f; font-size: 10px; top: -10px;" class="relative">TM</span>
	</label> 
</div>