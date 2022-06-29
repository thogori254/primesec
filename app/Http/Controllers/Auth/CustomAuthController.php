<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect,Response;

class CustomAuthController extends Controller
{
    //


    /**
     * Login user
     */
    public function login(){
        \request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt(['email'=>request('email'),'password'=>\request('password')])){
            $user = Auth::user();

            if (session('url.intended'))
                return redirect(session('url.intended'));
            return redirect("/");
        }
        else{
            return redirect()->back()->withErrors(['email' => ['Invalid email or password']]);
        }
    }

    /**
     * Register New user
     * to the system
     */
    public function registerUser(){
//        return response('Not Allowed',403);
//        dd(request()->all());


        $valid = validator(\request()->only('name','email','phone_number','password'), [
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','string','min:6'],
            'phone_number' => ['required','regex:/^((\+?254|0){1}[7]{1}[0-9]{8})$/']
        ]);



        if ($valid->fails()) {

            return Response()->json(array('errors' => $valid->getMessageBag()->toArray()));

//            $arr = response()->json($valid->errors()->all(), 422);
//            return \Response::json($arr);
//            return Response()->json($arr);
        }

        $data = \request()->all();
//        dd($data);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' =>$data['phone_number'],
            'password' => Hash::make($data['password']),
            ]);

        if($user){
            $arr = array('msg' => 'Register successful!', 'status' => true);
        }



        Auth::login($user);
        return Response()->json($arr);


        return redirect("/");
    }


    protected function formatPhone($phone){
        $len = strlen($phone);
        if($len==10){
            $phone = "repl".$phone;
            $phone = str_replace('repl07','+2547',$phone);
        }
        if($len==12){
            $phone = '+'.$phone;
        }

        return $phone;
    }

    public function validateData(){
        request()->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','string','min:6','confirmed'],
            'phone_number' => ['required','regex:/^((\+?254|0){1}[7]{1}[0-9]{8})$/']
        ]);



    }


}
