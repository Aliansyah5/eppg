<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'AlQuran';
	$breadcrumb[1]['url'] = url('backend/alquran');
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title', 'Master AlQuran')

<!-- CONTENT -->
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Master AlQuran</h3>
    </div>
    <div class="title_right">
        <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
            <a href="<?=url('/backend/alquran/create');?>" class="btn-index btn btn-primary btn-block" title="Add"><i
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
                            <th>Nama Surat</th>
                            <th>Juz</th>
                            <th>Jumlah Ayat</th>
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
			ajax: "<?=url('backend/alquran/datatable');?>",
			columns: [
				{data: 'id', name: 'id'},
				{data: 'nama_surat', name: 'nama_surat'},
				{data: 'juz', name: 'juz'},
				{data: 'jumlah_ayat', name: 'jumlah_ayat'},
                {data: 'active', name: 'active'},
				{data: 'action', name: 'action', orderable: false, searchable: false}
			],
			responsive: true,
            order : [[ 0, "desc" ]]
		});
</script>
@endsection
