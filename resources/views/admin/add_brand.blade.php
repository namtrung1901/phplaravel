@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Them Brand
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action="{{URL::to('/save-brand')}}" role="form" method="post">
                                	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Status</label>
                                     <select name="brand_status" class="form-control input-sm m-bot15">
		                                <option value="0">Ẩn</option>
		                                <option value="1">Hiển thị</option>
                            		</select>
                                </div>

                                <button type="submit" name="submit_brand" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
 @endsection