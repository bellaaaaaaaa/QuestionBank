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
        <div class="text-right">
          {!! Form::open(['route' => ['topics.import', $subject->id], 'enctype' => 'multipart/form-data', 'class' => 'd-inline-block topics__import__form import_form']) !!} 
            <label for="topics_import_file">
              <span class="btn btn-info btn-fill btn-wd">
                <i class="fa fa-upload" aria-hidden="true"></i> Upload Topics
              </span>
              <input type="file" class="custom-file-input on__file__import import_file" id="topics_import_file" accept=".csv" name="topics" data-target=".topics__import__form" style="display:none;">
            </label> 
          {!! Form::close() !!}  
          
          {!! Form::open(['route' => ['questions.import', $subject->id], 'enctype' => 'multipart/form-data', 'class' => 'd-inline-block questions__import__form import_form']) !!} 
            <label for="questions_import_file">
              <span class="btn btn-info btn-fill btn-wd">
                <i class="fa fa-question" aria-hidden="true"></i> Upload Questions
              </span>
              <input type="file" class="custom-file-input on__file__import import_form" id="questions_import_file" accept=".csv" name="questions" data-target=".questions__import__form" style="display:none;">
            </label> 
          {!! Form::close() !!}  
        </div>

        {!! Form::model($subject, ['method'=>'PUT', 'route' => ['subjects.update', $subject->id], 'class' => 'form', 'id' => 'form-validation']) !!}
          @include('admin.subjects.partials.form')

          <div class="card-footer text-right">
            <button type="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection