<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index()
    {
    	$cat = DB::table('category')->where('category_status','1')->orderby('category_id','asc')->get();
    	$brand = DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	$product = DB::table('product')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();

    	return view('pages.home')->with('category',$cat)->with('brand',$brand)->with('product',$product);
    }

    public function search(Request $request)
    {
    	$cat = DB::table('category')->where('category_status','1')->orderby('category_id','asc')->get();
    	$brand = DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	$keyword = $request->key_submit;
    	$search = DB::table('product')->where('product_name','like','%'.$keyword.'%')->get();
    	return view('pages.product.search')->with('category',$cat)->with('brand',$brand)->with('search',$search);	
    }
}
