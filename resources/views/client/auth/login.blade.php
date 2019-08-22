@extends('layouts.client.stranger')

@section('content')
<div class="login-register">
	<div class="container">
		<div class="row">
        {!! Form::open(['route' => 'login', 'id' => 'form-validation', 'class' => 'col-10 col-sm-8 col-lg-4 login-register-form']) !!}
				<div class=" card-login"> 
					<div class="text-center">
						<h4 class="header text-center">Welcome back</h4>
						<p>Login below to access your dashboard</p>
					</div> 
					<div class="">
						<div class="form-group has-label">
							<label>Email Address
                <span class="star">*</span>
              </label> 
              {{ Form::text('email', null, ['class'=>'form-control', 'email' => 'true', 'required' => true]) }}
          </div> 
          <div class="form-group has-label">
            <label>Password
                <span class="star">*</span>
              </label> 
              {{ Form::password('password', [ 'class'=>'form-control', 'required' => true]) }}
          </div>
          <div class="form-group has-label">
            <label>Subject
              <span class="star">*</span>
            </label> 
            
            {!! Form::select('subject', $subjects, null, ['class' => 'custom-select']) !!}
          </div> 
          <div class=" form-category">
            <span class="star">*</span> 
            Required fields
						</div>
					</div> 
					<div class="text-center mt-3">
						<button type="submit" class="btn btn-primary login-btn">Login</button>
					</div>
				</div>
        {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection