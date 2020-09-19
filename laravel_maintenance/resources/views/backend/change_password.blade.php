<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Change Password';
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title')
	Change Password
@endsection

<!-- CONTENT -->
@section('content')
	<div class="page-title">
		<div class="title_left">
			<h3>Change Password</h3>
		</div>
		<div class="title_right">

        </div>
        <div class="clearfix"></div>
		@include('backend.elements.breadcrumb',array('breadcrumb' => $breadcrumb))
	</div>
	<div class="clearfix"></div>
	<br/><br/>	
	<div class="row">
		<div class="col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<?php
						if (Session::has('data')){
							$alert = "success";
							$data = Session::get('data');
							if ($data['status'] == false):
								$alert = "danger";
							endif;
					?>
							<div class="row">
								<div class="col-xs-12 alert alert-<?=$alert;?> alert-dismissible" role="alert">
									{{ $data['error'] }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								</div>
							</div>
					<?php
						}
					?>				
					{{ Form::open(['class' => 'form-horizontal form-label-left']) }}
						{!! csrf_field() !!}
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Old Password <span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
								<input type="password" name="old_pass" required="required" class="form-control" autofocus minlength=3 maxlength=15>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">New Password <span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
								<input type="password" name="new_pass" required="required" class="form-control" minlength=3 maxlength=15>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Confirm New Password <span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
								<input type="password" name="confirm_new_pass" required="required" class="form-control" minlength=3 maxlength=15>
							</div>
						</div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-sm-4 col-xs-12 col-sm-offset-3 text-right">
								<button type="submit" class="btn btn-primary">Submit </button>
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection

<!-- CSS -->
@section('css')

@endsection

<!-- JAVASCRIPT -->
@section('script')

@endsection