@extends('layouts.admin.master')


@section('content')
	<div class="card bootstrap-table">
    <div class="card-body table-full-width">
      <div class="toolbar">
        <a href="{{ route('questions.create') }}" class="ml-1">
          <button class="btn btn-outline" style="border-radius: 30px">
            <i class="glyphicon fa fa-plus"></i> Add New
          </button>
        </a>
      </div>
      <table id="bootstrap-table" class="table" data-clickable="name" data-url="{{ route('questions.index') }}">
        <thead>
          <th data-field="id" class="text-center" data-sortable="true">ID</th>
          <th data-field="topic">Topic</th>
          <th data-field="name" class="edit-hover">Questions</th>
          <th data-field="explanation">Explanation</th>
          <th data-field="number_of_attempts">Number of Attempts</th>
          <th data-field="number_of_correct_attempts">Number of Correct Attempts</th>
          <th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>
        </thead>
      </table>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    function operateFormatter(value, row, index) {
      return [
        // '<a rel="tooltip" title="Edit" class="btn btn-link btn-warning table-action edit" href="javascript:void(0)">',
        // '<i class="fa fa-edit"></i>',
        // '</a>',
				'<a rel="tooltip" title="Delete" class="btn btn-link btn-danger table-action remove" href="javascript:void(0)">',
        '<i class="fas fa-times"></i> Delete',
        '</a>'
      ].join('');
    }
  </script>
@endsection

