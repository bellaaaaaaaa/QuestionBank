@extends('layouts.client.master')

@section('content')

{{-- <div class="page-container m-3 m-sm-5">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="my-3 mb-sm-0 mb-sm-5">Quiz - {{ $subject->name }}</h1>
			<div class="box row">
				<h2>Legend</h2>
				<div class="q-links col-sm-12">
				    <ol> 
			            <li class="review-1 active"> <!--add class correct/wrong for different outcome-->
			            	<a href="javascript:void(0)">
			              		1 
			              	</a>           
			          	</li>
				        <li class="review-2">
			            	<a href="javascript:void(0)">
			              		2 
			              	</a>           
			          	</li>
			          	<li class="review-3">
			            	<a href="javascript:void(0)">
			              		3 
			              	</a>           
			          	</li>
			          	<li class="review-4">
			            	<a href="javascript:void(0)">
			              		4 
			              	</a>           
			          	</li>
			          	<li class="review-5">
			            	<a href="javascript:void(0)">
			              		5 
			              	</a>           
			          	</li>
			          	<li class="review-6">
			            	<a href="javascript:void(0)">
			              		6 
			              	</a>           
			          	</li>
			          	<li class="review-7">
			            	<a href="javascript:void(0)">
			              		7 
			              	</a>           
			          	</li>
				        
				    </ol>
			    </div>
			    <div class="q-revsec col-sm-12">
				      <div>
				        <span class="wpProQuiz_reviewColor correct">&nbsp;</span>
				        <span class="wpProQuiz_reviewText">Correct</span>
				      </div>

				      <div>
				        <span class="wpProQuiz_reviewColor wrong">&nbsp;</span>
				        <span class="wpProQuiz_reviewText">Wrong</span>
				      </div>      
				</div>
				<div class="box q-stats col-lg-6">
					<h2>Question Stats</h2>
					<div class="row stats-col">
						<div class="col-md-1">A</div>
						<div class="col-md-9 bar-col">
							<div class="progress-bar progress-bar-correct" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width:72%">
								%
							</div>
						</div>
						<div class="col-md-2">72%</div>
					</div>
					<div class="row stats-col">
						<div class="col-md-1">B</div>
						<div class="col-md-9 bar-col">
							<div class="progress-bar progress-bar-wrong" role="progressbar" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100" style="width:8%">
								%
							</div>
						</div>
						<div class="col-md-2 col-xl-1">8%</div>
					</div>
					<div class="row stats-col">
						<div class="col-md-1">C</div>
						<div class="col-md-9 bar-col">
							<div class="progress-bar progress-bar-wrong" role="progressbar" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100" style="width:16%">
								%
							</div>
						</div>
						<div class="col-md-2">16%</div>
					</div>
					<div class="row stats-col">
						<div class="col-md-1">D</div>
						<div class="col-md-9 bar-col">
							<div class="progress-bar progress-bar-wrong" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100" style="width:4%">
								%
							</div>
						</div>
						<div class="col-md-2">4%</div>
					</div>

					<p>72% of users answered this question correctly</p>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="box questions">
				<h2>Questions</h2>
				<h3>Question 1 of 7</h3>
				<p><small>Question Chapter : Chapter 2  - <a href="#">Biology Organisms</a></small></p>

				<p>Which one of the following statements is incorrect?</p>
				<ul>
					<li><input type="radio" id="a-option" name="selector">
					    <label for="a-option" class="correct">Viviparity is the productive pattern shown by most mammals</label>
					    <div class="check"></div>
					</li>
					<li><input type="radio" id="b-option" name="selector">
					    <label for="b-option" class="wrong">Viviparity is the productive pattern shown by most mammals</label>
					    <div class="check"></div>
					</li>
					<li><input type="radio" id="c-option" name="selector">
					    <label for="c-option">Viviparity is the productive pattern shown by most mammals</label>
					    <div class="check"></div>
					</li>
					<li><input type="radio" id="d-option" name="selector">
					    <label for="d-option">Viviparity is the productive pattern shown by most mammals</label>
					    <div class="check"></div>
					</li>
				</ul>
				<!-- <input type="button" name="next" value="Submit Answer" class="buttons submit-btn"> -->
				<input type="button" name="next" value="Next" class="buttons next-btn">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="box row">
				<h2>Explanation</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque bibendum elit eget auctor mattis. Suspendisse id tortor nec tellus placerat varius. Sed nec molestie nunc, sit amet posuere nisi. Nulla at tincidunt lectus, a venenatis erat. Aenean in ex quam. Nam diam turpis, rutrum eget mattis non, feugiat vitae sem. Nulla pellentesque egestas aliquet.</p>

				<p>Fusce nec odio ipsum. Maecenas pretium sapien tortor. Praesent sagittis efficitur libero, non aliquet orci posuere eu. Fusce pellentesque neque orci, ut hendrerit tortor blandit eget. Nam ultrices mi in fringilla rhoncus. Ut egestas ultrices hendrerit. Quisque odio ipsum, vestibulum sit amet nisi nec, hendrerit rhoncus mauris. Vivamus vitae nisi ac nisl malesuada laoreet id non nulla. Vestibulum mi urna, dignissim ac placerat quis, pellentesque eu nunc. Aenean sagittis justo ut quam porta, eget interdum neque fringilla.</p>

				<input type="button" name="read_chapter" value="Read Chapter" class="buttons read-btn">
			</div>
		</div>
	</div>
</div> --}}

<quiz-component default-subject="{{ $subject }}" default-topic="{{ $topic }}" default-questions="{{ $questions }}"></quiz-component>

@endsection