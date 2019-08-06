@extends('layouts.client.master')

@section('content')

<div class="page-container m-3 m-sm-5">
	<div class="row my-3 mb-sm-0 mb-sm-5">
		<div class="col-sm-12">
			<div class="box">
				<h2>Account Settings</h2>
				<form>
					<table class="table-striped account mt-3">
						<tr>
							<td>Profile Picture:</td>
							<td>
								<img id="profile-img" class="profile-img mb-3" src="{{ asset('images/user-default.jpg') }}" alt="your image" /><br>
								<!-- <input type='file' id="profileImg" accept="image/x-png,image/jpeg" /> -->
								<div class="input-group mb-3">
								  <div class="custom-file">
								    <input type="file" class="custom-file-input" id="profileImg" accept="image/x-png,image/jpeg">
								    <label class="custom-file-label" for="profileImg">Choose file</label>
								  </div>
								</div>
								
							</td>
						</tr>
						<tr class="form-group">
							<td><label for="name">Name:</label></td>
							<td>
	    						<input type="text" class="form-control" id="name">
							</td>
						</tr>
						<tr class="form-group">
							<td><label for="name">NRIC:</label></td>
							<td>
								<input type="number" class="form-control" id="nric">
							</td>
						</tr>
						<tr class="form-group">
							<td><label for="name">Email:</label></td>
							<td>
								<input type="email" class="form-control" id="email">
							</td>
						</tr>
						
					</table>
					<div class="text-right mt-3" style="width:80%;margin:0 auto;">
						<button type="submit" class="btn btn-info text-right">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row my-3 mb-sm-0 mb-sm-5">
		<div class="col-sm-12">
			<div class="box">
				<h2>Change Password</h2>
				<form>
					<table class="table-striped account mt-3">
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
					</table>
					<div class="text-right mt-3" style="width:80%;margin:0 auto;">
						<button type="submit" class="btn btn-info text-right">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection