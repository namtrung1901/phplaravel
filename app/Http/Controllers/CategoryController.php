<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryController extends Controller
{
//Frontend
    public function category($category_id)
    {
        $name = DB::table('category')->where('category_id',$category_id)->limit(1)->get();
        $cat = DB::table('category')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $product = DB::table('product')->join('category','category.category_id','=','product.category_id')->where('product.category_id',$category_id)->limit(6)->get();
        return view('pages.category.category')->with('category',$cat)->with('brand',$brand)->with('product',$product)
        ->with('name',$name);
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
    public function add_category()
    {
        $this->AuthLogin();
        $parent = DB::table('category')->orderby('category_id','desc')->get();
    	return view('admin.add_category')->with('parent',$parent);
    }

    public function all_category()
    {
        $this->AuthLogin();
    	$all_category = DB::table('category')->get();
    	$manage = view('admin.all_category')->with('all_category',$all_category);
    	return view('admin_layout')->with('admin.all_category', $manage);
    }
    public function save_category(Request $request)
    {
        $this->AuthLogin();
    	$data = array();
    	$data['category_name'] = $request->category_name;
    	$data['category_parent'] = $request->category_parent;
    	$data['category_status'] = $request->category_status;

 		DB::table('category')->insert($data);
 		Session::put('message','Them thanh cong');
 		return Redirect::to('add-category');
    }
    public function update_category(Request $request, $category_id)
    {
        $this->AuthLogin();
    	$data = array();
    	$data['category_name'] = $request->category_name;
    	$data['category_parent'] = $request->category_parent;
    	DB::table('category')->where('category_id',$category_id)->update($data);
    	Session::put('message','Cap nhat thanh cong');
    	return Redirect::to('all-category');
    }
    public function delete_category($category_id)
    {
        $this->AuthLogin();
    	DB::table('category')->where('category_id',$category_id)->delete();
    	Session::put('message','Xoa thanh cong');
    	return Redirect::to('all-category');
    }

    public function edit_category($category_id)
    {
        $this->AuthLogin();
    	$edit_category = DB::table('category')->where('category_id',$category_id)->get();
        $parent = DB::table('category')->orderby('category_parent','desc')->get();
    	$manage = view('admin.edit_category')->with('edit_category',$edit_category)->with('parent',$parent);
    	return view('admin_layout')->with('admin.edit_category', $manage);
    }
    public function unactive_category($category_id){
        $this->AuthLogin();
        DB::table('category')->where('category_id',$category_id)->update(['category_status'=>1]);
        Session::put('message','Đã kích hoạt');
        return Redirect::to('all-category');

    }
    public function active_category($category_id){
        $this->AuthLogin();
        DB::table('category')->where('category_id',$category_id)->update(['category_status'=>0]);
        Session::put('message','Chưa kích hoạt');
        return Redirect::to('all-category');
    }
}
