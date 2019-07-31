@extends('layouts.admin.master')

@section('content')
	<div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 d-flex">
            <h4 class="text-center mr-auto my-1">Edit subject </h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        {!! Form::model($subject, ['method'=>'PUT', 'route' => ['subjects.update', $subject->id], 'class' => 'form', 'id' => 'form-validation']) !!}
        <div class="form-group has-label">
          <label>Subject
            <star class="star">*</star>
          </label>
          {{ Form::text('name', null, [ 'class'=>'form-control', 'required' => true]) }}
        </div>

        <div class="card-category form-category">
          <star class="star">*</star> Required fields
				</div>

        <div class="card-footer text-right">
          <button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
        </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
@extends('layouts.admin.master')

