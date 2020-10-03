@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit Category
                        </header>
                        <div class="panel-body">
                            @foreach($edit_category as $key => $editcat)
                            <div class="position-center">
                                <form action="{{URL::to('/update-category/'.$editcat->category_id)}}" role="form" method="post">
                                	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" value="{{$editcat->category_name}}" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Parent</label>
                                    <select name="category_parent" class="form-control input-sm m-bot15">
                                        @if($editcat->category_parent == 0)
                                            <option selected class="form-control" value="0">0</option>
                                        @else
                                            <option class="form-control" value="0">0</option>
                                        @endif
                                        @foreach($parent as $key => $cat)
                                        @if($cat->category_id == $editcat->category_parent )
                                            <option class="form-control" selected value="{{ $cat->category_id }}">{{$cat->category_name}}</option>
                                        @else
                                             <option class="form-control" value="{{ $cat->category_id }}">{{$cat->category_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name="submit_category" class="btn btn-info">Submit</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
        </div>
 @endsection