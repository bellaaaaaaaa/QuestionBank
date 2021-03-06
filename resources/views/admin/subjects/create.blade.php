@extends('layouts.admin.master')

@section('content')
	<div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 d-flex">
            <h4 class="text-center mr-auto my-1">Add a new subject! </h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        {!! Form::open(['route' => 'subjects.store', 'class' => 'form', 'id' => 'form-validation']) !!}
          @include('admin.subjects.partials.form')

          <div class="card-footer text-right">
            <button type="submit" class="btn btn-info btn-fill btn-wd">Add</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
