<?php

jimport('joomla.application.component.controller');
jimport('joomla.application.component.model');

	
	/**
	 * @return ShoppingModelOrder $model
	 */
	function nganluongOrderGetModel() {
		JModel::addIncludePath(JPATH_SITE.'/components/com_payment/models');
		$model 	= JModel::getInstance('Order', 'ShoppingModel');
		
		return $model;
	}
	
	/**
	 * Enter description here ...
	 * @param String $transaction_info
	 * @param String $order_code
	 * @param String $payment_id
	 * @param String $payment_type
	 * @param String $secure_code
	 * @return String $test
	 */
	
	function UpdateOrder($transaction_info, $order_code, $payment_id, $payment_type, $secure_code) {

		$model = nganluongOrderGetModel();
		$order = $model->getOrder(array('id'=>$order_code));
		
		if (!$order) {
			return false;
		}
		
		$nganluongConfig= ShoppingPayment::getConfig('nganluong');
	    $secure_pass	= $nganluongConfig->SECURE_PASS;
	    $merchant_id	= $nganluongConfig->MERCHANT_SITE_CODE;
	    
	   $total_price = (double)$order->total_price;
		
		if ($order) {
			$textLog = ' ORDER_ID:' . $order->id.'; USERNAME:'.$order->customer_name.'; TYPE: IPN; ';
		} else {
			$textLog = ' ORDER_ID:; USERNAME:; TYPE: IPN; ';
		}
		
	 	/**
		Logger
		 */
		$paramsLogs = array();
		$paramsLogs['order_code'] 	= $order_code;
		$paramsLogs['transaction_info'] = $transaction_info;		
		$paramsLogs['payment_id'] 	= $payment_id;
		$paramsLogs['payment_type'] = $payment_type;
		
		foreach ($paramsLogs as $key => $value) {
			$textLog .= $key . ':' . $value . '; ';
		}
		
		// Log IPN
		$updateOrder = new stdClass();
		$updateOrder->id = $order->id;
		$updateOrder->payment_ipn = 1;
		$updateOrder->payment_transaction = $payment_id;
		JFactory::getDbo()->updateObject('#__order', $updateOrder, 'id');
		
		Deallibs_Order::logOrderAction($order, $order->state, $textLog, 'Nganluong Webservice');
		
	    // Kiểm tra chuỗi bảo mật
	   	$secure_code_new = md5($transaction_info.' '.$order_code.' '.$payment_id.' '.$payment_type.' '.$secure_pass);
	   	
		if($secure_code_new != $secure_code) {	
			return false; // Sai mã bảo mật
		} else  {	
			// Thanh toán thành công	
			// Trường hợp là thanh toán tạm giữ. Hãy đưa thông báo thành công và cập nhật hóa đơn phù hợp
			if($payment_type == 2) {
				// Lập trình thông báo thành công và cập nhật hóa đơn
			} elseif($payment_type == 1) {	// Trường hợp thanh toán ngay. Hãy đưa thông báo thành công và cập nhật hóa đơn phù hợp	
				// Lập trình thông báo thành công và cập nhật hóa đơn
			}
			
			if ($order->state == Deallibs_Order::$STATE_FAILED) {
				
				// CHANGE STATE TO PAID
				$result = Deallibs_Order::changeOrderState($order, Deallibs_Order::$STATE_PAID, true, true);
				
				// GENERATE DIGITAL VOUCHER
				if ((int)$order->digital_voucher == 1) {
					$vouchers = $model->generateVoucher($order);
					$order->send_digital_voucher = $vouchers;
					
					// CHANGE STATE COMPLETE - ONLY DIGITAL VOUCHER
					if (isset($result['error']) && $result['error'] == 0) {
						$order->state = Deallibs_Order::$STATE_PAID;
						Deallibs_Order::changeOrderState($order, Deallibs_Order::$STATE_COMPLETE, true, false);
					}
				}
				
				// SEND MAIL PLACED ORDER SUCCESS
				$model->sendMailPlacedOrder($order);
			}
		}
		
		return true;
	}
	
	function zaiapaymentlog($type, $message) {
		error_log('['.$type.'] '.$message ."\n", 3, JPATH_BASE . '/payment.log');
    }
