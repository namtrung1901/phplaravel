@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Them Category
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action="{{URL::to('/save-category')}}" role="form" method="post">
                                	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Parent</label>
                                    <select name="category_parent" class="form-control input-sm m-bot15">
                                        @foreach($parent as $key => $cat)
                                            @if($cat->category_parent == 0)
                                                <option class="form-control" value="{{ $cat->category_id }}">{{$cat->category_name}}</option>
                                            @endif
                                        @endforeach
                                        <option class="form-control" value="0">0</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                	<label for="exampleInputPassword1">Status</label>
                                     <select name="category_status" class="form-control input-sm m-bot15">
		                                <option class="form-control" value="0">Ẩn</option>
		                                <option class="form-control" value="1">Hiển thị</option>
                            		</select>
                                </div>

                                <button type="submit" name="submit_category" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
 @endsection