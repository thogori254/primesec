<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;

/**
* mpesa callback
*/
class TransactionsController extends Controller
{


public function salesCallback($payment_id)
{


 $raw_post_json = file_get_contents('php://input');

 $postData = json_decode($raw_post_json)->Body->stkCallback;
 $result_code = $postData->ResultCode;

 $payment = Subscription::where('id','=',$payment_id)->first();
 $status = User::where('id','=',$payment->user_id)->first();

 if (intval($result_code) === 0) {


     $payment->subscription_status = 1;
     $payment->save();
     $status->subscription_status = 1;
     $status->save();

 }

 if (isset($postData->CallbackMetadata)) {
 $items = $postData->CallbackMetadata->Item;
 foreach ($items as $item) {
 if ($item->Name == 'MpesaReceiptNumber') {
 $payment->transaction_reference = $item->Value;
 $payment->save();
 }
 }
 }



}
}
