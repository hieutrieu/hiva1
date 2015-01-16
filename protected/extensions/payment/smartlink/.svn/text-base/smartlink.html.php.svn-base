<?php 
// no direct access
defined('_JEXEC') or die;	
?>

<script type="text/javascript">
jQuery().ready(function($) {	
	function changePaymentMethodSmartlink() {
		var checkedValue = $(".paymentmethod:checked").val();
		if (checkedValue == 'smartlink') {
			var positionParent = $('#smartlinktype-wrapper').parent().offset();
			$("#smartlinktype-wrapper").fadeIn()
				.css({'left': positionParent.left + 137 + 'px', 'top': positionParent.top + 'px'});
		} else {
			$("#smartlinktype-wrapper").fadeOut();
		}
	}
	changePaymentMethodSmartlink();
	$(".paymentmethod").click(changePaymentMethodSmartlink);
});
</script>
 
<div class="payment-item-row" style="text-align: left">
	<input type="radio" class="paymentmethod" name="paymentmethod" value="smartlink" id="smartlinkpayment" />	 
	<label for="smartlinkpayment">
		<span style="color: #0d3366">Smart</span><span style="color: #0188ca">link</span> <span style="color: #38658f; font-size: 14px; top: -8px;" class="relative">&reg;</span>		
	</label>
	
	<div id="smartlinktype-wrapper" style="position: absolute; display: none; background: #DDDCCC; height: 50px; line-height: 25px; padding: 4px 15px; border: 1px solid #3c3c3c; z-index: 2">
		<input type="radio" name="smartlinktype" value="national" id="smartlinktype-national" checked="checked" />
		<label for="smartlinktype-national" style="font-size: 13px; font-style: normal;">
			Thẻ ghi nợ nội địa
		</label><br />
		<input type="radio" name="smartlinktype" value="international" id="smartlinktype-international" />
		<label for="smartlinktype-international" style="font-size: 13px; font-style: normal;"">
			Thẻ thanh toán quốc tế (Visa, MasterCard, JCB)
		</label>
	</div>
</div>
