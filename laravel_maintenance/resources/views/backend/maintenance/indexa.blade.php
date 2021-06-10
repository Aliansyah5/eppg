<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Maintenance';
    $breadcrumb[1]['url'] = url('backend/maintenance');

?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title', 'Master Maintenance')

<!-- CONTENT -->

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Master Maintenance</h3>
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
                                <option value="1" @if($status==1) selected @endif>Proses Maintenance</option>
                                <option value="2" @if($status==2) selected @endif>Belum Realisasi</option>
                                <option value="3" @if($status==3) selected @endif>Maintenance Selesai</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                            Kategori
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <select class="form-control" name="kategori">
                                <option value="999" @if(999===$kategori) selected @endif>All</option>
                                @foreach($kategoris as $kategorix)
                                <option value="{{$kategorix->id}}" @if($kategori == $kategorix->id)
                                    selected
                                    @endif
                                    >{{$kategorix->category}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-sm-1" style="margin-top:7px;">
                            Tanggal
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
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTable"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Actions</th>
                                <th>Proses Maintenance</th>
                                <th>Asset</th>
                                <th>Kode Maintenance</th>
                                <th>Kode Asset</th>
                                <th>Nama Asset</th>
                                <th>Kategori</th>
                                <th>Sparepart</th>
                                <th>PIC</th>
                                <th>Mulai Maintenance</th>
                                <th>Selesai Maintenance</th>
                            </tr>
                        </thead>
                    </table>
                </div>

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
			serverSide: true,
            paging: false,
            orderClasses: false,
            deferRender: false,
			ajax: "<?=url('backend/maintenance/datatable?status='.$status.'&kategori='.$kategori.'&assignee='.$assignee.'&startDate='.$startDate.'&mode='.$mode.'&endDate='.$endDate);?>",
			columns: [
				{data: 'id', name: 'id'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
				{data: 'status', name: 'status', orderable: false, searchable: false},
                {data: 'cabang', name: 'avian.masset.AssetID'},
                {data: 'kode', name: 'kode'},
                {data: 'Kode_Asset', name: 'avian.masset.Kode'},
                {data: 'Nama_Asset', name: 'avian.masset.Nama'},
                {data: 'category', name: 'category.category'},
                {data: 'komponen', name: 'komponen'},
                {data: 'pic', name: 'pic'},
                {data: 'tgl_realisasi', name: 'tgl_realisasi'},
                {data: 'tgl_selesaimt', name: 'tgl_selesaimt'}
			],
			responsive: false,
            order : [[ 0, "desc" ]]
        });

</script>



@endsection
