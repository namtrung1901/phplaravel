<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CustomerController extends Controller
{
	public function login_customer(Request $request)
	{
		$email = $request->customer_email;
		$password = md5($request->customer_password);
		$result = DB::table('customers')->where('customer_email',$email)->where('customer_password',$password)->first();
		//return $result;
		if($result)
		{
			Session::put('customer_id',$result->customer_id);
			return Redirect::to('/checkout');
		}
		else{
			return Redirect::to('/login-checkout');
		}
		
	}
    public function add_customer(Request $request)
    {
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
    	$data['customer_phone'] = $request->customer_phone;

    	$customer_id = DB::table('customers')->insertGetId($data);
    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);

    	return Redirect::to('/checkout');
    }
}
