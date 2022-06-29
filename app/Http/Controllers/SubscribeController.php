<?php

namespace App\Http\Controllers;

use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
       	public function createform()
	{

    return view('subscribe');

	}

	public function storeform()
	{

		$data = request()->validate([
			'payment' => 'required',
			'amount' => 'required',
			'mpesa_number' => 'required',

		]);

		$amount = $data['amount'];
		$phone = $data['mpesa_number'];
		$payment_id = 'Sim001';

		$subscription = new Subscription();
		$subscription->amount = $amount;
		$subscription->phone_number = $phone;
		$subscription->user_id = \request()->user()->id;
//        $subscription->user_id = 9099;
		$subscription->package_type = $data['payment'];
		$subscription->expiration = Carbon::today()->addMonths($data['payment']);
		$subscription->subscription_status = 0;
		$subscription->save();


		$this->lipaNaMpesa($amount, $phone, $subscription->id);

        return redirect('subscribe')->with('notice','You have initiated your payment successfully please check your phone to complete the transaction');

	}


public function lipaNaMpesa($amount,$phone,$payment_id){

    $passkey ='d18299af88cf217e67a826b39ab8c6fc133b8888d15539870ae620f259e3c2b1';
    $timestamp = '20180116143600';
    $password = base64_encode('7031587'.$passkey.$timestamp);
    $callback = url('api/callback/'.$payment_id);
    $curl_post_data = array(
        //Fill in the request parameters with valid values
        'BusinessShortCode' =>'7031587',
        'Password' => $password,
        'Timestamp' => '20180116143600',
        'TransactionType' => 'CustomerBuyGoodsOnline',
        'Amount' => round($amount,0),
        'PartyA' => $this->formatPhone($phone),
        'PartyB' => '5030581',
        'PhoneNumber' => $this->formatPhone($phone),
        'CallBackURL' => $callback,
        'AccountReference' => 'PRIMESEC FRAM ENTERPRISE',
        'TransactionDesc' => "payment-".$payment_id
    );


    $data_string = json_encode($curl_post_data);

    $url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    $headers = array('Content-Type:application/json','Authorization:Bearer '.$this->getAccessToken()->access_token);

    $res = $this->doCurl($url,$data_string,'POST',$headers);

//    return $res;
}


protected function getAccessToken(){

    $consumer_key = 'RG34AR1a1FjURZvzp0T45fcc5KiYaHGa';
    $consumer_secret = '0Zrlmp8fnk9mESY5';
    $url = "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
    $data = '';
    $header = [
        'Authorization: Basic '.base64_encode($consumer_key.':'.$consumer_secret)
    ];
    $response = $this->doCurl($url,$data,'GET',$header);
    return $response;
}
protected function doCurl($url,$data,$method='POST',$header = null){
    if (!$header) {
        $header = array(
            'Accept: application/json',
            'Accept-Language: en_US',
        );
    }
    $curl = \curl_init($url);
    \curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_POST, true);

    \curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    \ curl_setopt($curl, CURLOPT_HEADER, 0);
    \curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    \curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    $content = \curl_exec($curl);
    $status = \curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $json_response = null;
    if ($status == 200 || $status == 201) {
        $json_response = json_decode($content);
        return $json_response;
    } else {
        throw new \Exception($content);
    }
}




    public function formatPhone($phone){
        $phone = 'hfhsgdgs'.$phone;
        $phone = str_replace('hfhsgdgs0','',$phone);
        $phone = str_replace('hfhsgdgs','',$phone);
        $phone = str_replace('+','',$phone);
        if(strlen($phone) == 9){
            $phone = '254'.$phone;
        }
        return $phone;
    }

}
