@extends('layouts.client.stranger')

@section('content')
<div class="login-register">
	<div class="container">
		<div class="row">
        	<form id="form-validation" class="col-10 col-sm-8 col-lg-4 login-register-form">
				<div class=" card-login">
					<div class="text-center">
						<h4 class="header text-center"><img src="{{ asset('images/stripe.png') }}"></h4>
					</div> 
					
					<div class="stripe-info">
						<div class="form-group has-label">
							<label>Cardholder Name
				              <star class="star">*</star>
				          	</label> 
				            <input name="cardholder-name" type="text" required="required" class="form-control">
				        </div>

				        <div class="text-center mt-3">
							<button type="submit" class="btn btn-primary login-btn">Submit</button>
						</div>
					</div>
					
				</div>
        	</form>
		</div>
	</div>
</div>
@endsection