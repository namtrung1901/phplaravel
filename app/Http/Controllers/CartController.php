<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
    	$productId = $request->product_hidden;
    	$quantity = $request->quantity;
    	$data_info = DB::table('product')->where('product_id',$productId)->first();

    	  $data['id'] = $data_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $data_info->product_name;
        $data['price'] = $data_info->product_price;
        $data['weight'] = $data_info->product_price;
        $data['options']['image'] = $data_info->product_image;
        Cart::add($data);
        // Cart::destroy();
        return Redirect::to('/show-cart');
    }

    public function show_cart(Request $request){
        //seo 
        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();
        //--seo
        $cat = DB::table('category')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.cart')->with('category',$cat)->with('brand',$brand)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function delete_cart($rowId)
    {
    	Cart::update($rowId,0);
    	return Redirect::to('/show-cart');
    }
    public function update_qty(Request $request)
    {
    	$rowId = $request->rowId_cart;
    	$quantity = $request->cart_quantity;
    	Cart::update($rowId,$quantity);
    	return Redirect::to('/show-cart');
   	}
   	public function checkout()
   	{
   		$cat = DB::table('category')->where('category_status','1')->orderby('category_id','asc')->get();
    	$brand = DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
   		return view('pages.cart.checkout')->with('category',$cat)->with('brand',$brand);
   	}
    public function order_place(Request $request)
    {
      $data = array();
      $data['payment_method'] = $request->pay_option;
      $data['payment_status'] = "Dang cho xu ly";
      $payment_id = DB::table('payment')->insertGetId($data);
        
      $ordata = array();
      $ordata['customer_id'] = Session::get('customer_id');
      $ordata['shipping_id'] = Session::get('shipping_id');  
      $ordata['payment_id'] = $payment_id;
      $ordata['order_total'] = Cart::total();  
      $ordata['order_status'] = "Dang cho xu ly";
      $order_id = DB::table('orders')->insertGetId($ordata);
      
      $content = Cart::content();
      foreach($content as $v_content)
      {
        $detailor['order_id'] = $order_id;
        $detailor['product_id'] = $v_content->id;  
        $detailor['product_name'] = $v_content->name;
        $detailor['product_price'] = $v_content->price;  
        $detailor['product_quantity'] = $v_content->qty;
        DB::table('order_details')->insertGetId($detailor);
      }
      if($data['payment_method'] == 1)
      {
          echo 'Check Payment';
      }
      else if($data['payment_method'] == 2)
      {
        $cat = DB::table('category')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.handcash')->with('category',$cat)->with('brand',$brand);
      }
      else{
        echo 'Debit Card';
      }
    }
   	public function login_checkout()
   	{
   		$cat = DB::table('category')->where('category_status','1')->orderby('category_id','asc')->get();
    	$brand = DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
   		return view('pages.cart.login_checkout')->with('category',$cat)->with('brand',$brand);
   	}
   	public function logout_checkout()
   	{
   		Session::flush();
   		return Redirect::to('/login-checkout');
   	}
   	public function shipping_info(Request $request)
   	{
   		$data = array();
   		$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_address'] = $request->shipping_address;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_note'] = $request->shipping_note;

    	$shipping_id = DB::table('shipping')->insertGetId($data);
    	Session::put('shipping_id',$shipping_id);
   		return Redirect::to('/payment');
   	}
   	public function payment()
   	{
      $cat = DB::table('category')->where('category_status','1')->orderby('category_id','asc')->get();
      $brand = DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
      return view('pages.cart.payment')->with('category',$cat)->with('brand',$brand);
   	}
}
