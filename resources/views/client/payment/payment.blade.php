@extends('layouts.client.stranger')

@section('content')
<div class="login-register">
	<div class="container">
		<div class="row">
        	<form id="form-validation" class="col-10 col-sm-8 col-lg-4 login-register-form">
				<div class="card-payment">
					<div class="text-center">
						<h4 class="header text-center">Payment</h4>
						<p>Select the plan you would like to commit to</p>
					</div> 
					<div class="">
						<div class="row form-group has-label">
							<label class="col-12">Subject
				              <star class="star">*</star>
				          	</label> 
				            <input name="subject" type="text"readonly value="Accounting" required="required" class="form-control-plaintext col-12">
				        </div> 
				        <div class="row form-group has-label">
				        	<label class="col-12">Payment Plan
				              <star class="star">*</star>
				          	</label> 
							<div class="form-group col-12">
								<select class="form-control" id="currency">
								  <option value="MYR">MYR</option>
								  <option value="USD">USD</option>
								</select>
							</div>
							<div class="payment-plan justify-content-between col-12">
					          	<div class="form-check">
								  <input class="form-check-input" type="radio" id="1month" value="123">
								  <label class="form-check-label" for="1month">
								    1 Month <br> <span class="currency"></span><span id="amount1">123</span>
								  </label>
								</div>
								<div class="form-check">
								  <input class="form-check-input" type="radio" id="2months" value="230">
								  <label class="form-check-label" for="2months">
								    2 Months <br> <span class="currency"></span><span id="amount2">230</span>
								  </label>
								</div>
								<div class="form-check">
								  <input class="form-check-input" type="radio" id="3months" value="350">
								  <label class="form-check-label" for="3months">
								    3 Months <br> <span class="currency"></span><span id="amount3">350</span>
								  </label>
								</div>
							</div>


				        </div>
				        
				        <div class=" form-category">
				        	<star class="star">*</star> 
				        	Required fields
						</div>
					</div> 
					<div class="text-center mt-3">
						<button type="submit" class="btn btn-primary login-btn">Submit</button>
					</div>
				</div>
        	</form>
		</div>
	</div>
</div>
@endsection