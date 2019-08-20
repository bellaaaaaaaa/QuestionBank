@extends('layouts.client.stranger')

@section('content')
<div class="login-register">
	<div class="container">
		<div class="row">
        	<form id="form-validation" class="col-10 col-sm-8 col-lg-4 login-register-form">
				<div class=" card-login">
					<div class="text-center">
						<h4 class="header text-center">Payment</h4>
						<p>Select the payment gateway you would like to use</p>
					</div> 
					<div class="payment-gateway">
				        <div class="form-group has-label row">
				          	<div class="col-sm-6" id="paypal">
				          		<a href="#">
							    	<img src="{{ asset('images/paypal-long.png') }}">
							    </a>
							</div>
							<div class="col-sm-6" id="stripe">
								<a href="/stripe">
							  		<img src="{{ asset('images/stripe.png') }}">
							  	</a>
							</div>
				        </div>
					</div> 
					
				</div>
        	</form>
		</div>
	</div>
</div>
@endsection