@extends('layouts.client.stranger')

@section('content')
<div class="login-register">
	<div class="container">
		<div class="row">
        	<form id="form-validation" class="col-10 col-sm-8 col-lg-4 login-register-form">
				<div class=" card-login">
					<div class="text-center">
						<h4 class="header text-center">Payment</h4>
						<p>Select the plan you would like to commit to</p>
					</div> 
					<div class="">
						<div class="form-group has-label">
							<label>Subject
				              <star class="star">*</star>
				          	</label> 
				            <input name="subject" type="text"readonly value="Accounting" required="required" class="form-control-plaintext">
				        </div> 
				        <div class="form-group has-label">
				        	<label>Payment Plan
				              <star class="star">*</star>
				          	</label> 
				          	<div class="form-check">
							  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
							  <label class="form-check-label" for="exampleRadios1">
							    1 Month - RM123
							  </label>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
							  <label class="form-check-label" for="exampleRadios2">
							    2 Months - RM240
							  </label>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
							  <label class="form-check-label" for="exampleRadios2">
							    3 Months - RM350
							  </label>
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