<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Asset';
	$breadcrumb[1]['url'] = url('backend/asset');
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title', 'Master Asset')

<!-- CONTENT -->
@section('content')
<div class="page-title">
    <div class="title_left">
       <h3>Master Hour Meter</h3>
    </div>
    <div class="title_right">
       <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
            <a href="<?=url('/backend/hourmeter/create');?>" class="btn-index btn btn-primary btn-block" title="Back"><i class="fa fa-plus"></i>&nbsp; Add Hour Meter</a>


       </div>
    </div>
    <div class="clearfix"></div>
 </div>
	@include('backend.elements.breadcrumb',array('breadcrumb' => $breadcrumb))
	<div class="row">
		<div class="col-xs-12">
			<div class="x_panel">
                <div class="x_content">



                </div>
				<div class="x_content">
                    @if ($errors->any())
						<div class="col-xs-12 alert alert-danger alert-dismissible" role="alert">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@include('backend.elements.notification')
                    <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTable" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Kode</th>
                                <th>Nama</th>
                                <th>Kondisi</th>
                                <th>Terakhir MT</th>
                                <th>Next MT</th>
                                <th>HourMeter</th>
                                <th>Jenis</th>
                                <th>Lokasi</th>
                                <th>Department</th>
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
        $('#myDatepicker').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#myDatepicker2').datetimepicker({
            format: 'DD-MM-YYYY'
        });
		$('.dataTable').dataTable({
			processing: true,
            orderClasses: false,
            serverSide: true,
            ajax: "<?=url('backend/asset/datatable?status='.$status.'&lokasi='.$lokasi.'&jenis='.$jenis.'&kode='.$kode.'&nama='.$nama.'&department='.$department.'&startDate='.$startDate.'&kondisi='.$kondisi.'&mode='.$mode.'&endDate='.$endDate);?>",
			columns: [
				{data: 'Kode', name: 'Kode'},
                {data: 'Nama', name: 'Nama'},
                {data: 'Kondisi', name: 'Kondisi',orderable: false, searchable: false},
                {data: 'LastMaintDate', name: 'LastMaintDate',  orderable: false, searchable: false},
                {data: 'nextmt', name: 'nextmt'},
                {data: 'HourMeter', name: 'HourMeter', className: "text-right"},
                {data: 'Jenis', name: 'Jenis'},
                {data: 'Lokasi', name: 'Lokasi'},
                {data: 'Department', name: 'Department'}
			],
			responsive: false,
            order : [[ 2, "asc" ]]
		});
	</script>
@endsection
