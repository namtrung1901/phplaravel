@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit brand
                        </header>
                        <div class="panel-body">
                            @foreach($edit_brand as $key => $editbrand)
                            <div class="position-center">
                                <form action="{{URL::to('/update-brand/'.$editbrand->brand_id)}}" role="form" method="post">
                                	{{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" value="{{$editbrand->brand_name}}" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                                </div>
                                <button type="submit" name="submit_brand" class="btn btn-info">Submit</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
        </div>
 @endsection