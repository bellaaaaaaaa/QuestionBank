@extends('layouts.client.stranger')

@section('content')
<div class="login-register">
    <div class="container">
      <div class="row">
        {!! Form::open(['route' => 'client.register', 'id' => 'form-validation', 'class' => 'col-10 col-sm-8 col-lg-4 login-register-form']) !!}
          <div class=" card-login">
            <div class="text-center">
              <h4 class="header text-center">Register Form</h4>
              <p>Don't have an account? Register now</p>
            </div> 
            <div class="">
              <div class="form-group has-label">
                <label>Email Address
                        <star class="star">*</star>
                      </label> 
                      <input name="email" type="text" email="true" required="required" class="form-control">
                  </div>
                  <div class="form-group has-label">
                    <label>Name
                        <star class="star">*</star>
                      </label> 
                      <input name="name" type="text" required="required" class="form-control">
                  </div> 
                  <div class="form-group has-label">
                    <label>Password
                        <star class="star">*</star>
                      </label> 
                      <input name="password" type="password" required="required" class="form-control">
                  </div>
                  <div class="form-group has-label">
                    <label>Confirm Password
                        <star class="star">*</star>
                      </label> 
                      <input name="password_confirmation" type="password" required="required" class="form-control">
                  </div>
                  <div class="form-group has-label">
                    <label>Subject
                        <star class="star">*</star>
                      </label> 
                      <select class="custom-select" aria-label="Select Subject">
                        <option hidden>Select Subject</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
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
