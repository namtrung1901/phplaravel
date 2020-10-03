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

			<div class="review-payment">
				<h2>Review & Payment</h2>
				<div class="table-responsive cart_info">
					<?php
					$content = Cart::content();
					?>
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image">Picture</td>
								<td class="description">Name</td>
								<td class="price">Price</td>
								<td class="quantity">Quantity</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach($content as $v_content)
							<tr>
								<td class="cart_product">
									<a href=""><img src="{{URL::to('public/frontend/images/product/'.$v_content->options->image)}}" width="90" alt="" /></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{$v_content->name}}</a></h4>
									<p>Web ID: 1089772</p>
								</td>
								<td class="cart_price">
									<p>{{number_format($v_content->price).' '.'vnđ'}}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<form action="{{URL::to('/update-quantity')}}" method="POST">
										{{ csrf_field() }}
										<input class="cart_quantity_input" type="number" min="1" name="cart_quantity" value="{{$v_content->qty}}"  >
										<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
										<input type="submit" value="Update" name="update_qty" class="btn btn-default btn-sm">
										</form>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price"><?php
										$subtotal = $v_content->price * $v_content->qty;
										echo number_format($subtotal).' '.'vnđ';
										?></p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="payment-options">
			<form action="{{URL::to('/order-place')}}" method="POST">
				{{csrf_field()}}
				<span>
					<label><input name="pay_option" value="1" type="checkbox"> Check Payment</label>
				</span>
				<span>
					<label><input name="pay_option" value="2" type="checkbox"> Paypal</label>
				</span>
				<span>
					<label><input name="pay_option" value="3" type="checkbox"> Debit Card</label>
				</span>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
</section> <!--/#cart_items-->
@endsection