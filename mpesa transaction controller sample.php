<?

// $raw_post_json = file_get_contents('php://input');
// $postData = json_decode($raw_post_json)->Body->stkCallback;
// $result_code = $postData->ResultCode;

// $payment = Payment::where('id','=',$payment_id)->first();

// if (intval($result_code) === 0) {
// $final_status = 1;

// $payment->status = getPaymentStatus('successful');
// $payment->save();

// /**
// * update the order Service
// */
// $order_service = OrderService::where('id','=',$payment->order_service_id)->first();
// $order_service->status = getOrderServiceStatus('paid');
// $order_service->save();

// /**
// * update the order
// */

// $order = Order::findOrFail($order_service->order_id);
// $order_services_count = OrderService::where('order_id',$order_service->order_id)->count();
// if ($order_services_count == 1)
// {
// $order->status = getOrderStatus('paid');
// $order->save();
// }
// elseif ($order_services_count > 1)
// {
// $order_services_count_unpaid = OrderService::where('order_id',$order_service->order_id)->whereIn('status',getOrderServiceStatus(['pending','accepted','confirmed']))->count();

// if ($order_services_count_unpaid > 1)
// {
// $order->status = getOrderStatus('partially_paid');
// $order->save();
// }
// else{
// $order->status = getOrderStatus('paid');
// $order->save();
// }

// }
// else{
// $order->status = getOrderStatus('partially_paid');
// $order->save();
// }

// }
// if (isset($postData->CallbackMetadata)) {
// $items = $postData->CallbackMetadata->Item;
// foreach ($items as $item) {
// if ($item->Name == 'MpesaReceiptNumber') {
// $payment->transaction_reference = $item->Value;
// $payment->save();
// }
// }
// }
