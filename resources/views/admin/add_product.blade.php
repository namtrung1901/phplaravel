@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Them Product
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action="{{URL::to('/save-product')}}" role="form" method="post" enctype="multipart/form-data">
                                	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Picture</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Brand</label>
                                     <select name="brand_id" class="form-control input-sm m-bot15">
                                     	@foreach($brand_pro as $ket => $brand)
                                     		<option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                     	@endforeach
                            		</select>
                                </div>
                                 <div class="form-group">
                                	<label for="exampleInputPassword1">Category</label>
                                     <select name="category_id" class="form-control input-sm m-bot15">
                                     	@foreach($cat_pro as $key => $cat)
		                                	<option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
		                                @endforeach
                            		</select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize: none" rows="5" type="text" name="product_description" class="form-control" id="exampleInputPassword1" placeholder="Mo ta product"></textarea> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Detail</label>
                                    <textarea style="resize: none" rows="5" type="text" name="product_detail" class="form-control" id="exampleInputPassword1" placeholder="Chi tiet product"></textarea> 
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Status</label>
                                     <select name="product_status" class="form-control input-sm m-bot15">
		                                <option value="0">An</option>
		                                <option value="1">Hien thi</option>
		                                
                            		</select>
                                </div>

                                <button type="submit" name="submit_product" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
 @endsection