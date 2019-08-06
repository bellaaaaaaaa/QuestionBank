@extends('layouts.client.master')

@section('content')

<div class="page-container m-3 m-sm-5">
	<div class="row my-3 mb-sm-0 mb-sm-5">
		<div class="col-sm-12">
			<h1 class="">Quiz - {{ $subject->name }}</h1>
			<p>
      {{ $subject->description }}
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque bibendum elit eget auctor mattis. Suspendisse id tortor nec tellus placerat varius. Sed nec molestie nunc, sit amet posuere nisi. Nulla at tincidunt lectus, a venenatis erat. Aenean in ex quam. Nam diam turpis, rutrum eget mattis non, feugiat vitae sem. Nulla pellentesque egestas aliquet.Fusce nec odio ipsum. Maecenas pretium sapien tortor. Praesent sagittis efficitur libero, non aliquet orci posuere eu.
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