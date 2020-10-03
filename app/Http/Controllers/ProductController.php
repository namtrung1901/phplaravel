<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
//Fronten function
    public function product($product_id)
    {
        $cat = DB::table('category')->where('category_status','1')->orderby('category_id','asc')->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $product = DB::table('product')->join('category','category.category_id','=','product.category_id')->join('brand','brand.brand_id','=','product.brand_id')->where('product_id',$product_id)->get();
        foreach($product as $key => $pro){
            $cate_id = $pro->category_id;
        }
        $product_related = DB::table('product')->join('category','category.category_id','=','product.category_id')->join('brand','brand.brand_id','=','product.brand_id')->where('category.category_id',$cate_id)->whereNotIn('product.product_id',[$product_id])->get();
        return view('pages.product.product_detail')->with('category',$cat)->with('brand',$brand)->with('product_detail',$product)->with('related',$product_related);
    }


//Backend function
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product()
    {
    	$this->AuthLogin();
    	$cat = DB::table('category')->orderby('category_id','desc')->get();
    	$brand = DB::table('brand')->orderby('brand_id','desc')->get();

    	return view('admin.add_product')->with('cat_pro',$cat)->with('brand_pro',$brand);
    }

    public function all_product()
    {
    	$this->AuthLogin();
    	$all_product = DB::table('product')
    	->join('category','category.category_id','=','product.category_id')
    	->join('brand','brand.brand_id','=','product.brand_id')->orderby('product_id','desc')->get();
    	$manage = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product', $manage);
    }
    public function save_product(Request $request)
    {
    	$this->AuthLogin();
    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['brand_id'] = $request->brand_id;
    	$data['category_id'] = $request->category_id;
    	$data['product_desc'] = $request->product_description;
        $data['product_detail'] = $request->product_detail;
    	$data['product_price'] = $request->product_price;
    	$data['product_status'] = $request->product_status;
		$getImage = $request->file('product_image');
    	if($getImage){
    		$get_nameImage = $getImage->getClientOriginalName();
            $nameImage = current(explode('.',$get_nameImage));
            $newImage =  $nameImage.rand(0,99).'.'.$getImage->getClientOriginalExtension();
            $getImage->move('public/backend/images/product',$newImage);
            $data['product_image'] = $newImage;
            DB::table('product')->insert($data);
            Session::put('message','Them thanh cong');
            return Redirect::to('add-product');
    	}
    	$data['product_image'] = '';
 		DB::table('product')->insert($data);
 		Session::put('message','Them thanh cong');
 		return Redirect::to('add-product');
    }
    public function update_product(Request $request, $product_id)
    {
    	$this->AuthLogin();
    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['brand_id'] = $request->brand_id;
    	$data['category_id'] = $request->category_id;
    	$data['product_desc'] = $request->product_description;
        $data['product_detail'] = $request->product_detail;
    	$data['product_price'] = $request->product_price;
		$getImage = $request->file('product_image');
    	if($getImage){
    		$get_nameImage = $getImage->getClientOriginalName();
            $nameImage = current(explode('.',$get_nameImage));
            $newImage =  $nameImage.rand(0,99).'.'.$getImage->getClientOriginalExtension();
            $getImage->move('public/backend/images/product',$newImage);
            $data['product_image'] = $newImage;
            DB::table('product')->where('product_id',$product_id)->update($data);
    		Session::put('message','Cap nhat thanh cong');
    		return Redirect::to('all-product');
    	}
    	
    	DB::table('product')->where('product_id',$product_id)->update($data);
    	Session::put('message','Cap nhat thanh cong');
    	return Redirect::to('all-product');
    }
    public function delete_product($product_id)
    {
    	$this->AuthLogin();
    	DB::table('product')->where('product_id',$product_id)->delete();
    	Session::put('message','Xoa thanh cong');
    	return Redirect::to('all-product');
    }

    public function edit_product($product_id)
    {
    	$this->AuthLogin();
    	$cat = DB::table('category')->orderby('category_id','desc')->get();
    	$brand = DB::table('brand')->orderby('brand_id','desc')->get();
    	$edit_product = DB::table('product')->where('product_id',$product_id)->get();
    	$manage = view('admin.edit_product')->with('edit_product',$edit_product)->with('cat_pro',$cat)->with('brand_pro',$brand);
    	return view('admin_layout')->with('admin.edit_product', $manage);
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Đã kích hoạt');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Chưa kích hoạt');
        return Redirect::to('all-product');
    }
}
