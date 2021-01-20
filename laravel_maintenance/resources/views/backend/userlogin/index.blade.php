<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'User';
    $breadcrumb[1]['url'] = url('backend/user');
    // $arr1 = array(1,4,5);
    // $arr2 = array(1,2,3);
    // $arr3 = array_diff($arr1, $arr2);
    // dd(count($arr3));
    // if (count($arr3) == 0) {
    // // all of $arr1 is in $arr2
    // }
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title', 'Master User')

<!-- CONTENT -->
@section('content')
	<div class="page-title">
		<div class="title_left">
			<h3>Master User</h3>
		</div>
		<div class="title_right">
			<div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
                <a href="<?=url('/backend/user/create');?>" class="btn-index btn btn-primary btn-block" title="Add"><i class="fa fa-plus"></i>&nbsp; Add</a>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	@include('backend.elements.breadcrumb',array('breadcrumb' => $breadcrumb))
	<div class="row">
		<div class="col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					@include('backend.elements.notification')
                    <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTable" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>ID</th>
								<th>Username</th>
                                <th>Level</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Kelompok</th>
                                <th>Telp</th>
								<th>Actions</th>
							</tr>
						</thead>
					</table>
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
	<script>
		$('.dataTable').dataTable({
			processing: true,
			serverSide: true,
			ajax: "<?=url('backend/user/datatable');?>",
			columns: [
				{data: 'id', name: 'id'},
				{data: 'username', name: 'username'},
                {data: 'user_level', name: 'user_level'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'kelompok', name: 'kelompok'},
                {data: 'telp', name: 'telp'},
				{data: 'action', name: 'action', orderable: false, searchable: false}
			],
			responsive: true,
            order : [[ 0, "desc" ]]
		});
	</script>
@endsection
