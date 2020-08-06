@extends('dashboard')
<?php
    use App\User;
	$users = User::all();
?>
@section('dashboardContent')
<style>
	form#registerForm{
		font-family:Tahoma;
		word-spacing:2px !important;
	}
	button#register{
		word-spacing:2px !important;
	}
	.panel-body{
		padding:30px;
	}
</style>
<div class="main_div">
	<ol class="breadcrumb">
		<li><a href="{{url('home')}}" title="Home"><span class="glyphicon glyphicon-home"></span></a></li>
		<li><a href="{{url('settings')}}" title="Home"><span class="glyphicon glyphicon-cog"></span> सेटिङ्गहरु </a></li>
		<li><span class="glyphicon glyphicon-user"></span> संचालन व्यवस्थापन  </li>
	</ol>
	<div class="col-md-12 col-lg-12">
		<div class="row">
			<div class="col-md-12 col-lg-12" data-appear-animation="fadeIn" data-appear-delay="1400">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> नया संचालक थप्नुहोस  </h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" id="registerForm" role="form" method="POST" action="{{ route('profile.add-profile.store') }}">
							{!! csrf_field() !!}
							<div class="form-group{{ $errors->has('users_type_id') ? ' has-error' : '' }}">
								<div class="input-group col-md-6 col-lg-6">
									<label class="control-label">Users Type:</label>
									<select name="users_type_id" id="users_type_id" required class="form-control">
										<option value="0" selected> Choose Users Type </option>
										<option value="1"> Administrator </option>
										<option value="2"> Ordinary User </option>
									</select>
									@if ($errors->has('users_type_id'))
										<span class="help-block">
											<strong>{{ $errors->first('users_type_id') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<div class="input-group col-md-6 col-lg-6">
									<label class="control-label">Name</label>
									<input type="text" class="form-control" name="name" value="{{ old('name') }}">

									@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<div class="input-group col-md-6 col-lg-6">
									<label class="control-label">E-Mail Address</label>	
									<input type="email" class="form-control" name="email" value="{{ old('email') }}">

									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<div class="input-group col-md-6 col-lg-6">
									<label class="control-label">Password</label>	
									<input type="password" class="form-control" name="password">

									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
								<div class="input-group col-md-6 col-lg-6">
									<label class="control-label">Confirm Password</label>
									<input type="password" class="form-control" name="password_confirmation">

									@if ($errors->has('password_confirmation'))
										<span class="help-block">
											<strong>{{ $errors->first('password_confirmation') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<!-- status -->
                            <div class="form-group col-md-12 col-lg-12 pro_checkbox" style="margin-left:-30px;">
                                <input type="checkbox" name="status" id="status" class="fourth_color" @if(old('status')) @else checked="checked" @endif />
                                <label for="status">Is Active?</label>
                            </div>

							<div class="form-group">
								<div class="col-md-6">
									<button type="submit" class="btn btn-primary" id="register" style="margin-left:-15px;">
										<i class="glyphicon glyphicon-pencil"></i> Register New User
									</button>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection