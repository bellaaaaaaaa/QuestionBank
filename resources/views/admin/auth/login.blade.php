@extends('layouts.admin.stranger')

@section('content')
  <div class="col-md-6 ml-auto mr-auto">
    {!! Form::open(['route' => 'admin.login', 'id' => 'form-validation', 'class' => 'form']) !!}
      <div class="card card-login card-hidden">
        <div class="card-header ">
          <h4 class="header text-center">Login Form</h4>
        </div>
        <div class="card-body ">
          <div class="form-group has-label">
            <label>Email Address
              <star class="star">*</star>
            </label>
            <input class="form-control" name="email" type="text" email="true" required="true" />
          </div>
          <div class="form-group has-label">
            <label>Password
              <star class="star">*</star>
            </label>
            <input class="form-control" name="password" type="password" required="true" />
          </div>
          <div class="card-category form-category">
						<star class="star">*</star> Required fields
					</div>
        </div>
        <div class="card-footer mx-auto">
          <button type="submit" class="btn btn-wd btn-primary">Login</button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
@endsection
