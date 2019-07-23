@extends('layouts.admin.master')

@section('content')
	<div class="container">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 d-flex">
            <h4 class="text-center mr-auto my-1">Add an answer to your question! </h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        {!! Form::open(['route' => 'answers.store', 'class' => 'form', 'id' => 'form-validation']) !!}
        <div class="form-group has-label">
          <label>Answer
            <star class="star">*</star>
          </label>
          {{ Form::textarea('name', null, [ 'class'=>'form-control', 'required']) }}
        </div>

        <div class="card-footer text-right">
          <button type="submit" class="btn btn-info btn-fill btn-wd">Add</button>
        </div>

        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
