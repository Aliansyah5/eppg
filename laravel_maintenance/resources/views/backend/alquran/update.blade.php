<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'AlQuran';
	$breadcrumb[1]['url'] = url('backend/alquran');
	$breadcrumb[2]['title'] = 'Add';
	$breadcrumb[2]['url'] = url('backend/alquran/create');
	if (isset($data)){
		$breadcrumb[2]['title'] = 'Edit';
		$breadcrumb[2]['url'] = url('backend/alquran/'.$data[0]->id.'/edit');
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
Master AlQuran - <?=$mode;?>
@endsection

<!-- CONTENT -->
@section('content')
<?php

        $nama_surat = old('nama_surat');
        $juz = old('juz');
        $jumlah_ayat = old('jumlah_ayat');
        $active = old('active');

		$method = "POST";
		$mode = "Create";
		$url = "backend/alquran/";
		if (isset($data)){

            $nama_surat = $data[0]->nama_surat;
            $juz = $data[0]->juz;
            $jumlah_ayat = $data[0]->jumlah_ayat;
			$active = $data[0]->active;

			$method = "PUT";
			$mode = "Edit";
			$url = "backend/alquran/".$data[0]->id;
		}
	?>
<div class="page-title">
    <div class="title_left">
        <h3>Master AlQuran - <?=$mode;?></h3>
    </div>
    <div class="title_right">
        <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
            @include('backend.elements.back_button',array('url' => '/backend/alquran'))
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
                    <label class="control-label col-sm-3 col-xs-12">Nama Surat<span class="required">*</span></label>
                    <div class="col-sm-3 col-xs-12">
                        <input type="text" name="nama_surat" required="required" class="form-control"
                            value="<?=$nama_surat;?>" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Juz<span class="required">*</span></label>
                    <div class="col-sm-3 col-xs-12">
                        <input type="number" min="0" name="juz" required="required" class="form-control"
                            value="<?=$juz;?>" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Jumlah Ayat<span class="required">*</span></label>
                    <div class="col-sm-3 col-xs-12">
                        <input type="number" min="0" name="jumlah_ayat" required="required" class="form-control"
                            value="<?=$jumlah_ayat;?>" autofocus>
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
                        <a href="<?=url('/backend/alquran')?>" class="btn btn-warning">Cancel</a>
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
