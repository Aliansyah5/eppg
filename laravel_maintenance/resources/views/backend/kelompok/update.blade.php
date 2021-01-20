<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Kelompok';
	$breadcrumb[1]['url'] = url('backend/kelompok');
	$breadcrumb[2]['title'] = 'Add';
	$breadcrumb[2]['url'] = url('backend/kelompok/create');
	if (isset($data)){
		$breadcrumb[2]['title'] = 'Edit';
		$breadcrumb[2]['url'] = url('backend/kelompok/'.$data[0]->id.'/edit');
	}
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title')
<?php
		$mode = "Create";
		if (isset($data)){
			$mode = "Edit";
		}
	?>
Master Kelompok - <?=$mode;?>
@endsection

<!-- CONTENT -->
@section('content')
<?php
        $nama_kelompok = old('nama_kelompok');
        $desax = old('desa');
        $daerahx = old('daerah');
        $active = old('active');

		$method = "POST";
		$mode = "Create";
		$url = "backend/kelompok/";
		if (isset($data)){

            $nama_kelompok = $data[0]->nama_kelompok;
            $desax = $data[0]->id_desa;
            $daerahx = $data[0]->id_daerah;
			$active = $data[0]->active;

			$method = "PUT";
			$mode = "Edit";
			$url = "backend/kelompok/".$data[0]->id;
		}
	?>
<div class="page-title">
    <div class="title_left">
        <h3>Master Kelompok - <?=$mode;?></h3>
    </div>
    <div class="title_right">
        <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
            @include('backend.elements.back_button',array('url' => '/backend/kelompok'))
        </div>
    </div>
    <div class="clearfix"></div>
    @include('backend.elements.breadcrumb',array('breadcrumb' => $breadcrumb))
</div>
<div class="clearfix"></div>
<br /><br />
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel">
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
                {{ Form::open(['url' => $url, 'method' => $method,'class' => 'form-horizontal form-label-left']) }}
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Nama Kelompok<span class="required">*</span></label>
                    <div class="col-sm-3 col-xs-12">
                        <input type="text" name="nama_kelompok" required="required" class="form-control"
                            value="<?=$nama_kelompok;?>" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Desa<span class="required">*</span></label>
                    <div class="col-sm-3 col-xs-12">
                        <select class="form-control" name="desa" required="">
                            <option value="">(Pilih Desa)</option>
                            @foreach($desas as $desa)
                            <option value="{{$desa->id}}" {{ $desax == $desa->id ? 'selected' : '' }}>
                                {{$desa->nama_desa}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Daerah<span class="required">*</span></label>
                    <div class="col-sm-3 col-xs-12">
                        <select class="form-control" name="daerah" required="">
                            <option value="">(Pilih Daerah)</option>
                            @foreach($daerahs as $daerah)
                            <option value="{{$daerah->id}}" {{ $daerahx == $daerah->id ? 'selected' : '' }}>
                                {{$daerah->nama_daerah}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Active </label>
                    <div class="col-sm-3 col-xs-12">
                        {{
								Form::select(
									'active',
									['1' => 'Active', '2' => 'Unactive'],
									$active,
									array(
										'class' => 'form-control',
									))
								}}
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12 col-sm-offset-3">
                        <a href="<?=url('/backend/kelompok')?>" class="btn btn-warning">Cancel</a>
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
<script>
    $("#password_check").on("change", function(){
			if($(this).prop('checked') == true){
				$("#password").removeClass("hide");
				$("#password").prop('required',true);
			} else {
				$("#password").addClass("hide");
				$("#password").prop('required',false);
			}
		});
</script>
@endsection
