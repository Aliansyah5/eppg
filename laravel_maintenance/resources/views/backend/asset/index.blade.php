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
			<h3>Master Asset</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	@include('backend.elements.breadcrumb',array('breadcrumb' => $breadcrumb))
	<div class="row">
		<div class="col-xs-12">
			<div class="x_panel">
                <div class="x_content">

                    <form id="form-work" class="form-horizontal" role="form" autocomplete="off" method="GET">
                        <div class="row">
                            <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                                Status
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <select name="status" class="form-control">
                                    <option value="999" selected="" @if($status==999) selected @endif>All</option>
                                    <option value="1" @if($status==1) selected @endif>Belum Waktunya Maintenance</option>
                                    <option value="2" @if($status==2) selected @endif>Waktunya Maintenance</option>
                                    <option value="3" @if($status==3) selected @endif>Sedang Maintenance</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                                Lokasi
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <select class="form-control" name="lokasi">
                                    <option value="999" @if(999===$lokasi) selected @endif>All</option>
                                    @foreach($lokasis as $loka)
                                    <option value="{{$loka->lokasi}}" @if($loka->lokasi === $lokasi)
                                        selected
                                        @endif
                                        >{{$loka->lokasi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                                Jenis
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <select class="form-control" name="jenis">
                                    <option value="999" @if(999===$jenis) selected @endif>All</option>
                                    @foreach($jeniss as $jenisx)
                                    <option value="{{$jenisx->jenis}}" @if($jenisx->jenis === $jenis)
                                        selected
                                        @endif
                                        >{{$jenisx->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                                Department
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <select class="form-control" name="department">
                                    <option value="999" @if(999===$department) selected @endif>All</option>
                                    @foreach($departments as $departmentx)
                                    <option value="{{$departmentx->Department}}" @if($departmentx->Department === $department)
                                        selected
                                        @endif
                                        >{{$departmentx->Department}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                               Kondisi
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <select name="kondisi" class="form-control">
                                    <option value="999" selected="" @if($kondisi==999) selected @endif>All</option>
                                    <option value="GOOD" @if($kondisi=='GOOD') selected @endif>Good</option>
                                    <option value="DAMAGED" @if($kondisi=='DAMAGED') selected @endif>Damaged</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                               Kode Asset
                            </div>
                            <div class="col-xs-12 col-sm-5">
                            <input class="form-control"  type="text" name="kode"  value="{{$kode}}">
                            </div>
                            <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                                Nama Asset
                             </div>
                             <div class="col-xs-12 col-sm-5">
                             <input class="form-control" type="text"  name="nama"  value="{{$nama}}">
                             </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-1" style="margin-top:7px;">
                                Tanggal Jatuh MT
                            </div>
                            <div class="col-xs-12 col-sm-3 date">
                                <div class="input-group date" id="myDatepicker">
                                    <input type="text" class="form-control" name="startDate" value=<?=$startDate;?> />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 date">
                                <div class="input-group date" id="myDatepicker2">
                                    <input type="text" class="form-control" name="endDate" value=<?=$endDate;?> />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-1 text-right">
                                <?php
                                    $checked = "";
                                    if ($mode == "all"){
                                        $checked = "checked";
                                    }
                                ?>
                                <div class="checkbox">
                                    <input type="checkbox" name="mode" value="all" id="show-all" <?=$checked;?>>Show all
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <input type="submit" class="btn btn-primary btn-block" value="Submit">
                            </div>
                        </div>
                    </form>
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
                                <th>Actions</th>
                                <th>Status</th>
                                <th>Asset</th>
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
        // $('input[name="mode"]').change(function() {
        //     if(this.checked) {
        //         $(this).prop('value', 'all');
        //     } else {
        //         $(this).prop('value', 'limited');
        //     }
        // });
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
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'Status', name: 'Status'},
                {data: 'cabang', name: 'cabang'},
				{data: 'Kode', name: 'Kode'},
                {data: 'Nama', name: 'Nama'},
                {data: 'Kondisi', name: 'Kondisi',orderable: false, searchable: false},
                {data: 'terakhirmt', name: 'terakhirmt',  orderable: false, searchable: false},
                {data: 'nextmt', name: 'nextmt'},
                {data: 'HourMeter', name: 'HourMeter', className: "text-right"},
                {data: 'Jenis', name: 'Jenis'},
                {data: 'Lokasi', name: 'Lokasi'},
                {data: 'Department', name: 'Department'}
			],
			responsive: false,
            order : [[ 1, "asc" ]]
		});
	</script>
@endsection
