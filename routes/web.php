<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//frontend
Route::get('/','HomeController@index' );
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');

Route::get('/danh-muc-san-pham/{category_id}','CategoryController@category');
Route::get('/thuong-hieu/{brand_id}','BrandController@brand');
Route::get('/chi-tiet-san-pham/{product_id}','ProductController@product');
//Cart
Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-cart/{rowId}','CartController@delete_cart');
Route::post('/update-quantity','CartController@update_qty');
Route::post('/shipping-info','CartController@shipping_info');
Route::post('/order-place','CartController@order_place');
Route::get('/payment','CartController@payment');
Route::get('/login-checkout','CartController@login_checkout');
Route::get('/logout-checkout','CartController@logout_checkout');
Route::get('/checkout','CartController@checkout');
Route::post('/add-customer','CustomerController@add_customer');
Route::post('/login-customer','CustomerController@login_customer');


//backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout','AdminController@logout');

//category product
Route::get('/add-category','CategoryController@add_category');
Route::get('/all-category','CategoryController@all_category');
Route::get('/delete-category/{category_id}','CategoryController@delete_category');
Route::post('/save-category','CategoryController@save_category');
Route::post('/update-category/{category_id}','CategoryController@update_category');

Route::get('/edit-category/{category_id}','CategoryController@edit_category');
Route::get('/unactive-category/{category_id}','CategoryController@unactive_category');
Route::get('/active-category/{category_id}','CategoryController@active_category');

//brand
Route::get('/add-brand','BrandController@add_brand');
Route::get('/all-brand','BrandController@all_brand');
Route::get('/delete-brand/{brand_id}','BrandController@delete_brand');
Route::post('/save-brand','BrandController@save_brand');
Route::post('/update-brand/{brand_id}','BrandController@update_brand');

Route::get('/edit-brand/{brand_id}','BrandController@edit_brand');
Route::get('/unactive-brand/{brand_id}','BrandController@unactive_brand');
Route::get('/active-brand/{brand_id}','BrandController@active_brand');

//Product
Route::get('/add-product','ProductController@add_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');

Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');



