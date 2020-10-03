@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cap nhat Product
                        </header>
                        <div class="panel-body">
                        	@foreach($edit_product as $key => $pro)
                            <div class="position-center">
                                <form action="{{URL::to('/update-product/'.$pro->product_id)}}" role="form" method="post" enctype="multipart/form-data">
                                	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Picture</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/backend/images/product/'.$pro->product_image)}}" height="100", width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" value="{{$pro->product_price}}" name="product_price" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Brand</label>
                                     <select name="brand_id" class="form-control input-sm m-bot15">
                                     	@foreach($brand_pro as $ket => $brand)
                                     		@if($brand->brand_id == $pro->brand_id)
                                     			<option selected value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                     		@else
                                     			<option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                     		@endif
                                     	@endforeach
                            		</select>
                                </div>
                                 <div class="form-group">
                                	<label for="exampleInputPassword1">Category</label>
                                     <select name="category_id" class="form-control input-sm m-bot15">
                                     	@foreach($cat_pro as $key => $cat)
                                     		@if($cat->category_id == $pro->category_id)
                                     			<option selected value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                                     		@else
                                     			<option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                                     		@endif
		                                @endforeach
                            		</select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize: none" rows="5" type="text" name="product_description" class="form-control" id="exampleInputPassword1">{{$pro->product_desc}}</textarea> 
                                </div>

                                <button type="submit" name="submit_product" class="btn btn-info">Submit</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
        </div>
 @endsection