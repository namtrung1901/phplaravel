<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandController extends Controller
{
//Frontend
    public function brand($brand_id)
    {
        $name = DB::table('brand')->where('brand_id',$brand_id)->limit(1)->get();
        $cat = DB::table('category')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $product = DB::table('product')->join('brand','brand.brand_id','=','product.brand_id')->where('product.brand_id',$brand_id)->limit(6)->get();
        return view('pages.brand.brand')->with('category',$cat)->with('brand',$brand)->with('product',$product)->with('name',$name);
    }


//Backend
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand()
    {
        $this->AuthLogin();
    	return view('admin.add_brand');
    }

    public function all_brand()
    {
        $this->AuthLogin();
    	$all_brand = DB::table('brand')->get();
    	$manage = view('admin.all_brand')->with('all_brand',$all_brand);
    	return view('admin_layout')->with('admin.all_brand', $manage);
    }
    public function save_brand(Request $request)
    {
        $this->AuthLogin();
    	$data = array();
    	$data['brand_name'] = $request->brand_name;
    	$data['brand_status'] = $request->brand_status;

 		DB::table('brand')->insert($data);
 		Session::put('message','Them thanh cong');
 		return Redirect::to('add-brand');
    }
    public function update_brand(Request $request, $brand_id)
    {
        $this->AuthLogin();
    	$data = array();
    	$data['brand_name'] = $request->brand_name;
    	DB::table('brand')->where('brand_id',$brand_id)->update($data);
    	Session::put('message','Cap nhat thanh cong');
    	return Redirect::to('all-brand');
    }
    public function delete_brand($brand_id)
    {
        $this->AuthLogin();
    	DB::table('brand')->where('brand_id',$brand_id)->delete();
    	Session::put('message','Xoa thanh cong');
    	return Redirect::to('all-brand');
    }

    public function edit_brand($brand_id)
    {
        $this->AuthLogin();
    	$edit_brand = DB::table('brand')->where('brand_id',$brand_id)->get();
    	$manage = view('admin.edit_brand')->with('edit_brand',$edit_brand);
    	return view('admin_layout')->with('admin.edit_brand', $manage);
    }
    public function unactive_brand($brand_id){
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$brand_id)->update(['brand_status'=>1]);
        Session::put('message','Đã kích hoạt');
        return Redirect::to('all-brand');

    }
    public function active_brand($brand_id){
        $this->AuthLogin();
        DB::table('brand')->where('brand_id',$brand_id)->update(['brand_status'=>0]);
        Session::put('message','Chưa kích hoạt');
        return Redirect::to('all-brand');
    }
}