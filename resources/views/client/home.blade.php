@extends('layouts.client.master')

@section('content')

<div class="page-container m-5">
	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<h2>Personal Details</h2>
				<table cellspacing="10">
					<tr>
						<td>Name:</td>
						<td>{{ $username }}</td>
					</tr>
					<tr>
						<td>Email:</td>
						<td>{{ $useremail }}</td>
					</tr>
					<tr>
						<td>Age:</td>
					<td> {{ $age }}</td>
					</tr>
					<tr>
						<td>Subject:</td>
						<td>Management Accounting</td>
					</tr>
					<tr>
						<td>Subscription:</td>
						<td>{{ $subscription }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl-6">
			<div class="box mh">
				<h2>Learning Progress</h2>
				<table cellspacing="10">
					<tr>
						<td>Next Topic:</td>
						<td>Balance Sheet</td>
					</tr>
					<tr>
						<td>Completion:</td>
						<td>
							<div id="piechart"></div>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="col-xl-6">
			<div class="box mh">
				<h2>MCQ Exam</h2>
				<div class="border-box">
					<table class="table-striped">
						<tr>
							<td><i class="fas fa-check-circle"></i>Attempt 1:</td>
							<td>45%</td>
						</tr>
						<tr>
							<td><i class="fas fa-check-circle"></i>Attempt 2:</td>
							<td>65%</td>
						</tr>
						<tr>
							<td><i class="fas fa-check-circle"></i>Attempt 3:</td>
							<td>Incomplete</td>
						</tr>
						<tr>
							<td><i class="fas fa-check-circle"></i>Attempt 4:</td>
							<td>Incomplete</td>
						</tr>
						<tr>
							<td><i class="fas fa-check-circle"></i>Attempt 5:</td>
							<td>Incomplete</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="box">
				<h2>Subjective Exam</h2>
				<table cellspacing="10">
					<tr>
						<td>Submission:</td>
						<td>24/07/2019</td>
					</tr>
					<tr>
						<td>Marked:</td>
						<td>No</td>
					</tr>
					<tr>
						<td colspan="2"><small>*Marking takes 3 days from submission date</small></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection