@extends('layouts.admin.master')

@section('content')
<div class="row">
	<div class="col-12">
	  <div class="card card-stats" style="border:#0077be 1px solid">
		<div class="card-body">
			<div class="row">
				<div class="col-5">
					<div class="icon-big text-left ml-2">
						<i class="fab fa-telegram" aria-hidden="true" style="color:#0077be"></i>
					</div>
				</div>
				<div class="col-7">
					<div class="numbers">
						<p class="card-category" style="color:#0077be"><b>Company Details</b></p>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer ">
		  <hr>
		  <div class="stats">
			Company:
			<h4 class="card-title">
			  The Techy Hub Sdn Bhd
			</h4>
		  </div>
		</div>
	  </div>
  
	  <div class="card card-stats" style="border:#0077be 1px solid">
		<div class="card-body ">
			<div class="row">
				<div class="col-5">
					<div class="icon-big text-left ml-2">
						<i class="fa fa-usd" aria-hidden="true" style="color:#0077be"></i>
					</div>
				</div>
				<div class="col-7">
					<div class="numbers">
						<p class="card-category" style="color:#0077be"><b>{{ date('F')}}: Total Earnings</b></p>
						<br>
						<h5 class="card-title">
							RM {{ $current_month_earnings }}
						</h5>
					</div>
				</div>
			</div>
		</div>
	  </div>
  
	  <div class="row">
		<div class="col-12 col-md-4">
		  <div class="card card-stats" style="border:#0077be 1px solid">
			  <div class="card-body ">
				  <div class="row">
					  <div class="col-5">
						  <div class="icon-big text-left ml-2 icon-warning">
							<i class="fa fa-fire" aria-hidden="true" style="color:#0077be"></i>
						  </div>
					  </div>
					  <div class="col-7">
						  <div class="numbers">
							  <p class="card-category" style="color:#0077be"><b>Most Subscribed Subjects</b></p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <div class="card-footer ">
				  <hr>
				  <div class="stats">
						Most Subscribed Subjects
					<h5 class="card-title">
						{{ $most_subscribed_subject }}
					</h5>
				  </div>
			  </div>
		  </div>
		</div>
  
		<div class="col-12 col-md-4">
		  <div class="card card-stats" style="border:#0077be 1px solid">
			  <div class="card-body ">
				  <div class="row">
					  <div class="col-5">
						  <div class="icon-big text-left ml-2 icon-warning">
							<i class="fa fa-user-md" aria-hidden="true" style="color:#0077be"></i>
						  </div>
					  </div>
					  <div class="col-7">
						  <div class="numbers">
							  <p class="card-category" style="color:#0077be"><b>Total Subscribers</b></p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <div class="card-footer ">
				  <hr>
				  <div class="stats">
				  Total Subscribers
					<h5 class="card-title">
					  {{ $count_subscribers }}
					</h5>
				  </div>
			  </div>
		  </div>
		</div>
  
		<div class="col-12 col-md-4">
		  <div class="card card-stats" style="border:#0077be 1px solid">
			  <div class="card-body ">
				  <div class="row">
					  <div class="col-5">
						  <div class="icon-big text-left ml-2 icon-warning">
							<i class="fa fa-bookmark" aria-hidden="true" style="color:#0077be"></i>
						  </div>
					  </div>
					  <div class="col-7">
						  <div class="numbers">
							  <p class="card-category" style="color:#0077be"><b>Number of Administrators</b></p>
						  </div>
					  </div>
				  </div>
			  </div>
			  <div class="card-footer ">
				  <hr>
				  <div class="stats">
					Number of Administrators
					<h5 class="card-title">
					  {{ $count_admin }}
					</h5>
				  </div>
			  </div>
		  </div>
		</div>
	  </div>
	</div>
  </div>
@endsection
