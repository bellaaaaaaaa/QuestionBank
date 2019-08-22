@extends('layouts.client.stranger')

@section('content')
<div class="login-register">
    <div class="container">
      <div class="row">
        {!! Form::open(['route' => 'client.register', 'id' => 'form-validation', 'class' => 'col-10 col-sm-8 col-lg-4 login-register-form']) !!}
          <div class=" card-login">
            <div class="text-center">
              <h4 class="header text-center">Register Form</h4>
              <p>Have an account? <a href="{{ route('client.login.show') }}" class="link-black">Login now</a></p>
            </div> 

            <div>
              <div class="form-group has-label">
                <label>Email Address
                  <star class="star">*</star>
                </label> 
                
                {{ Form::text('email', null, ['class'=>'form-control', 'email' => 'true', 'required' => true]) }}
              </div>
                  
              <div class="form-group has-label">
                <label>Name
                  <star class="star">*</star>
                </label> 
                {{ Form::text('name', null, ['class'=>'form-control', 'email' => 'true', 'required' => true]) }}
              </div> 

              <div class="form-group has-label">
                <label>IC Number
                  <star class="star">*</star>
                </label> 
                {{ Form::text('nric', null, ['class'=>'form-control', 'email' => 'true', 'required' => true]) }}
              </div> 
                  
              <div class="form-group has-label">
                <label>Age
                  <star class="star">*</star>
                </label> 
                {{ Form::text('age', null, ['class'=>'form-control', 'email' => 'true', 'required' => true]) }}
              </div> 

              <div class="form-group has-label">
                <label>Password
                  <star class="star">*</star>
                </label>
                {{ Form::password('password', [ 'class'=>'form-control', 'required' => true]) }}
              </div>

              <div class="form-group has-label">
                <label>Confirm Password
                  <star class="star">*</star>
                </label> 
                {{ Form::password('password_confirmation', [ 'class'=>'form-control', 'required' => true]) }}
              </div>
              
              <div class="form-group has-label">
                <label>Subject
                  <star class="star">*</star>
                </label> 
                {!! Form::select('subject', $subjects, null, ['class' => 'custom-select']) !!}
              </div> 

              <div class=" form-category">
                <star class="star">*</star> 
                Required fields
              </div>
            </div> 
            
            <div class="text-center mt-3">
              <button type="submit" class="btn btn-primary login-btn">Register</button>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
