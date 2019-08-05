@extends('layouts.client.master')

@section('content')

<div class="page-container m-3 m-sm-5">
	<div class="row my-3 mb-sm-0 mb-sm-5">
		<div class="col-sm-12">
			<div class="box">
				<h2>Account Settings</h2>
				<form>
					<table class="table-striped">
						<tr>
							<td>Profile Picture:</td>
							<td>
								<input type='file' id="profileImg" />
								<img id="profile-img" class="profile-img" src="{{ asset('images/user-default.jpg') }}" alt="your image" />
							</td>
						</tr>

						<tr class="form-group">
							<td><label for="name">Name:</label></td>
							<td>
	    						<input type="text" class="form-control" id="name">
							</td>
						</tr>
						<tr class="form-group">
							<td><label for="name">Email:</label></td>
							<td>
								<input type="email" class="form-control" id="email">
							</td>
						</tr>
						<tr class="form-group">
							<td><label for="name">NRIC:</label></td>
							<td>
								<input type="number" class="form-control" id="nric">
							</td>
						</tr>
						<tr>
							<td colspan="2" class="text-right"><button type="submit" class="btn btn-info">Submit</button></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>

	<div class="row my-3 mb-sm-0 mb-sm-5">
		<div class="col-sm-12">
			<div class="box">
				<h2>Change Password</h2>
				<form>
					<table class="table-striped">
						<tr>
							<td><label for="name">Current Password:</label></td>
							<td><input type="password" class="form-control" id="current-password"></td>
						</tr>
						<tr>
							<td><label for="name">New Password:</label></td>
							<td><input type="password" class="form-control" id="new-password"></td>
						</tr>
						<tr>
							<td><label for="name">Confirm Password:</label></td>
							<td><input type="password" class="form-control" id="confirm-password"></td>
						</tr>
						<tr>
							<td colspan="2" class="text-right"><button type="submit" class="btn btn-info">Submit</button></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection