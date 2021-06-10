<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Siswa';
	$breadcrumb[1]['url'] = url('backend/siswa');
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title', 'Master Siswa')

<!-- CONTENT -->
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Master Siswa</h3>
    </div>
    <div class="title_right">
        <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
            <a href="<?=url('/backend/siswa/create');?>" class="btn-index btn btn-primary btn-block" title="Add"><i
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
                        <div class="col-xs-12 col-sm-1 text-left" style="margin-top:7px;">
                            Jenis Kelamin
                        </div>
                        <div class="col-xs-12 col-sm-5">
                            <select name="jk" class="form-control">
                                <option value="999" selected="" @if($jk==999) selected @endif>All</option>
                                <option value="P" @if($jk== 'P') selected @endif>Perempuan</option>
                                <option value="L" @if($jk== 'L') selected @endif>Laki-Laki</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-sm-1" style="margin-top:7px;">
                            Tanggal Lahir
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
                            <th>Nama Siswa</th>
                            <th>Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>Dapukan</th>
                            <th>Kelompok</th>
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
            ajax: "<?=url('backend/siswa/datatable?jk='.$jk.'&kelas='.$kelas.'&kelompok='.$kelompok.'&startDate='.$startDate.'&mode='.$mode.'&endDate='.$endDate);?>",
			columns: [
				{data: 'id', name: 'id'},
                {data: 'nama', name: 'nama'},
                {data: 'tgl_lahir', name: 'tgl_lahir'},
                {data: 'jk', name: 'jk'},
                {data: 'kelas', name: 'kelas'},
                {data: 'dapukan', name: 'dapukan'},
                {data: 'kelompok', name: 'kelompok'},
				{data: 'action', name: 'action', orderable: false, searchable: false}
			],
			responsive: true,
            useState: true,
            order : [[ 0, "desc" ]]
		});
</script>
@endsection
