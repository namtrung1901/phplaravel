@extends('layout')
@section('content')
<section id="cart_items">
		<div class="">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="register-req">
				<p>Please use Register or Login to checkout and view cart history</p>
			</div><!--/register-req-->
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Info Delivery</p>
							<div class="form-shipping">
								<form action="{{URL::to('/shipping-info')}}" method="POST">
									{{csrf_field()}}
									<div class="row">
										<div class="col-sm-6 input">
											<input type="text" name="shipping_name" placeholder="Name">
											<input type="text" name="shipping_phone" placeholder="Phone">
											<input type="text" name="shipping_address" placeholder="Address">
											<input type="text" name="shipping_email" placeholder="Email">
											<button type="submit" name="submit" class="btn btn-primary">Submit</button>
										</div>
										<div class="col-sm-6 input">
											<textarea name="shipping_note" placeholder="Note" rows="16"></textarea>	
										</div>
									</div>
									
								</form>
							</div>
						</div>
					</div>			
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection