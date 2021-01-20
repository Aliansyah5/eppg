<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Kelompok';
	$breadcrumb[1]['url'] = url('backend/kelompok');
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title', 'Master Kelompok')

<!-- CONTENT -->
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Master Kelompok</h3>
    </div>
    <div class="title_right">
        <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
            <a href="<?=url('/backend/kelompok/create');?>" class="btn-index btn btn-primary btn-block" title="Add"><i
                    class="fa fa-plus"></i>&nbsp; Add</a>
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
                <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTable"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kelompok</th>
                            <th>Desa</th>
                            <th>Daerah</th>
                            <th>Active</th>
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
			ajax: "<?=url('backend/kelompok/datatable');?>",
			columns: [
				{data: 'id', name: 'id'},
				{data: 'nama_kelompok', name: 'nama_kelompok'},
				{data: 'desa', name: 'desa'},
				{data: 'daerah', name: 'daerah'},
                {data: 'active', name: 'active'},
				{data: 'action', name: 'action', orderable: false, searchable: false}
			],
			responsive: true,
            order : [[ 0, "desc" ]]
		});
</script>
@endsection
