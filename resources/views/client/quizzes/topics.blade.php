@extends('layouts.client.master')

@section('content')

<div class="page-container m-3 m-sm-5">
	<div class="row my-3 mb-sm-0 mb-sm-5">
		<div class="col-sm-12">
			<h1 class="">Quiz - {{ $subject->name }}</h1>
			<p>
      {{ $subject->description }}
      </p>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="box topics">
				<h2>Topics</h2>
				<ul>
          @foreach($topics as $key => $topic)
					  <a href="{{ route('quizzes.questions', $topic['id']) }}"><li>Chapter {{ $key + 1 }} - {{ $topic['name'] }}</li></a>
          @endforeach
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection