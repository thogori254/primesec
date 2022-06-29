<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscription;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_ADMIN');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::leftJoin('subscriptions','subscriptions.user_id','=','users.id')
            ->selectRaw('users.*,subscriptions.amount as samount,subscriptions.expiration as sexpiration')
            ->groupBy('users.id')->get();
        $subscriptions = Subscription::all();
        return view('admin.users.index')->with('users', $users);
    }




//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\User  $user
//     * @return \Illuminate\Http\Response
//     */
//    public function show(User $user)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $user = User::findOrFail($id);
        $subscription = Subscription::where('subscriptions.user_id', '=', $user->id);

        return view('admin.users.edit')->with([
            'user' => $user,
            'subscription' =>$subscription
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user = User::findOrFail($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->subscription_status = $request->subscription_status;
        $user->save();

        $users = User::leftJoin('subscriptions','subscriptions.user_id','=','users.id')
            ->selectRaw('users.*,subscriptions.amount as samount,subscriptions.expiration as sexpiration')
            ->groupBy('users.id')->get();
        $subscriptions = Subscription::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $users = User::leftJoin('subscriptions','subscriptions.user_id','=','users.id')
            ->selectRaw('users.*,subscriptions.amount as samount,subscriptions.expiration as sexpiration')
            ->groupBy('users.id')->get();
        $subscriptions = Subscription::all();
        return view('admin.users.index')->with('users', $users);
    }
}
