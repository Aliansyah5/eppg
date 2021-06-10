<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Absensi';
	$breadcrumb[1]['url'] = url('backend/absensi');
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title', 'Master Absensi')

<!-- CONTENT -->
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Master Absensi</h3>
    </div>
    <div class="title_right">
        <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
            <a href="<?=url('/backend/absensi/create');?>" class="btn-index btn btn-primary btn-block" title="Add"><i
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
                <form id="form-work" class="form-horizontal" role="form" autocomplete="off" method="GET">
                    <div class="row">
                        <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                            Tingkat
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <select name="tingkat" class="form-control">
                                <option value="999" selected="" @if($tingkat==999) selected @endif>All</option>
                                <option value="1" @if($tingkat== 1) selected @endif>Kelompok</option>
                                <option value="2" @if($tingkat== 2) selected @endif>Desa</option>
                                <option value="3" @if($tingkat== 3) selected @endif>Daerah</option>
                                <option value="4" @if($tingkat== 4) selected @endif>Pusat</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                            Pengajian
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <select class="form-control" name="pengajian">
                                <option value="999" @if(999===$pengajian) selected @endif>All</option>
                                @foreach($pengajians as $pengajianx)
                                <option value="{{$pengajianx->id}}" @if($pengajian == $pengajianx->id)
                                    selected
                                    @endif
                                    >{{$pengajianx->nama_pengajian}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                            Kelas
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <select class="form-control" name="kelas">
                                <option value="999" @if(999===$kelas) selected @endif>All</option>
                                @foreach($kelass as $kelasx)
                                <option value="{{$kelasx->id}}" @if($kelas == $kelasx->id)
                                    selected
                                    @endif
                                    >{{$kelasx->category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                            Kelompok
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <select class="form-control" name="kelompok">
                                <option value="999" @if(999===$kelompok) selected @endif>All</option>
                                @foreach($kelompoks as $kelompokx)
                                <option value="{{$kelompokx->id}}" @if($kelompok == $kelompokx->id)
                                    selected
                                    @endif
                                    >{{$kelompokx->nama_kelompok}}</option>
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
                @include('backend.elements.notification')
                <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTable"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kehadiran</th>
                            <th>Tingkat</th>
                            <th>Pengajian</th>
                            <th>Tanggal</th>
                            <th>Peserta</th>
                            <th>AlQuran</th>
                            <th>Hadist</th>
                            <th>Kelompok</th>
                            <th>Tempat</th>
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

$('#myDatepicker').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#myDatepicker2').datetimepicker({
            format: 'DD-MM-YYYY'
        });

    $('.dataTable').dataTable({
			processing: true,
			serverSide: true,
            ajax: "<?=url('backend/absensi/datatable?tingkat='.$tingkat.'&pengajian='.$pengajian.'&kelas='.$kelas.'&kelompok='.$kelompok.'&startDate='.$startDate.'&mode='.$mode.'&endDate='.$endDate);?>",
			columns: [
				{
                    "data": "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
				{data: 'kehadiran', name: 'kehadiran', searchable:false },
				{data: 'tingkat', name: 'tingkat'},
                {data: 'nama_pengajian', name: 'a.nama_pengajian'},
                {data: 'tanggal', name: 'absensi.tgl'},
                {data: 'peserta', name: 'absensi.peserta'},
                {data: 'nama_surat', name: 'b.nama_surat'},
                {data: 'nama_hadist', name: 'c.nama_hadist'},
                {data: 'kelompok', name:'absensi.kelompok '},
                {data: 'tempat', name: 'tempat'},
				{data: 'action', name: 'action', orderable: false, searchable: false}
			],
			responsive: true,
            order : [[ 0, "desc" ]]
		});
</script>
@endsection
