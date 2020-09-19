<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Maintenance';
	$breadcrumb[1]['url'] = url('backend/maintenance');
	$breadcrumb[2]['title'] = 'Add';
	$breadcrumb[2]['url'] = url('backend/maintenance/create');
	if (isset($data)){
		$breadcrumb[2]['title'] = 'Edit';
		$breadcrumb[2]['url'] = url('backend/maintenance/'.$data[0]->id.'/edit');
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
    Master Maintenance - <?=$mode;?>
@endsection

<!-- CONTENT -->
@section('content')
    <?php

        $category = old('category');
        $active = old('active');

		$method = "POST";
		$mode = "Create";
        $url = "backend/maintenance/";
        $assetx  ='';
        $kategorix = '';
        $tanggalselesai = '';
        $jenis = old('jenis');


		if (isset($data)){


            $kondisi = $data[0]->Kondisi;
            $kode ?? '' == $data[0]->kode;

            $komponen = $data[0]->detail->kodeKomponen;
            $qty = $data[0]->detail->Qty;
            $keterangan = $data[0]->keterangan;

            $nama  = $data[0]->Nama;
        //    $assetx = $data[0]->asset;
            $assetx = $data[0]->asset;


            $jenis = $data[0]->jenis ;


            $lokasi = $data[0]->Lokasi;
            $kategorix = $kategori;

            $tgl_realisasi = $data[0]->tgl_realisasi;


            $lastmaintdate = $data[0]->LastMaintDate;

			$method = "PUT";
			$mode = "Edit";
            $url = "backend/maintenance/".$data[0]->kode;


		}
	?>
	<div class="page-title">
		<div class="title_left">
			<h3>Master Maintenance - <?=$mode;?></h3>
		</div>
		<div class="title_right">
			<div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">

                    @include('backend.elements.back_button',array('url' => '/backend/maintenance'))

			</div>
        </div>
        <div class="clearfix"></div>
		@include('backend.elements.breadcrumb',array('breadcrumb' => $breadcrumb))
	</div>
	<div class="clearfix"></div>
	<br/><br/>
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
                    <div class="x_title">
                        <h2>Form Asset Maintenance </h2>
                        <div class="clearfix"></div>
                    </div>
						{!! csrf_field() !!}
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Kode Maintenance<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
                                <input type="text" name="kode" required="required" class="form-control" value="<?=$kode ?? '';?>" autofocus readonly>
                                <input type="hidden" name="kodeasset" required="required" class="form-control" value="<?=$assetx ?? '';?>" autofocus readonly>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Nama Asset<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
                                <select id="asset" name="asset" disabled class="form-control select_asset form-control" required {{ $mode == 'Edit' ? 'readonly' : '' }}>
                                    <option value="">(Pilih Asset)</option>
                                    @foreach($assets ?? '' as $asset)
                                        <option value="{{$asset->AssetID}}" {{ $assetx  == $asset->AssetID ? 'selected' : '' }} >{{$asset->Kode}}-{{$asset->Nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Kategori Maintenance<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
                                <select class="form-control" disabled name="kategori" required="" readonly >
                                    <option value="">(Jenis Kategori)</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{$kategori->id}}" {{ $kategorix == $kategori->id ? 'selected' : '' }}>{{$kategori->category}}</option>
                                    @endforeach
                                </select>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Komponen Maintenance<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
                                <input type="text" name="komponen" required="required" class="form-control" value="<?=$komponen ?? '';?>" autofocus readonly>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Qty<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
                                <input type="number" min="0" name="qtykomponen" required="required" class="form-control" value="<?=$qty ?? '';?>" autofocus readonly>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Keterangan<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
                                <input type="textarea" min="0" name="keterangan" required="required" class="form-control" value="<?=$keterangan ?? '';?>" autofocus readonly>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Tgl Mulai Maintenance<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
								<input type="date" name="tgl_maintenance" required="required" class="form-control" value="{{ date('Y-m-d', strtotime($tgl_realisasi)) }}" autofocus readonly>
							</div>
                        </div>
                    <input type="hidden" name="realhourmeter" id="" value="{{$datamt[0]->realhourmeter}}">
                    <input type="hidden" name="assetid" id="" value="{{$datamt[0]->AssetID}}">
                        <hr>
						<div class="ln_solid"></div>
                        <div class="form-group">
							<div class="col-sm-12 col-xs-12 text-center">
								<a href="<?=url('/backend/maintenance')?>" class="btn btn-warning" style="min-width : 120px">&nbsp;Cancel</a>
                                								<button type="submit" class="btn-index btn btn-success btn-submit" style="min-width : 120px"><i class="fa fa-wrench"></i>&nbsp; Selesai MT</button>
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
        $(document).ready(function() {
    $('.select_asset').select2();
});

$('#myDatepicker').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#myDatepicker2').datetimepicker({
            format: 'DD-MM-YYYY'
        });


		$("#password_check").on("change", function(){
			if($(this).prop('checked') == true){
				$("#password").removeClass("hide");
				$("#password").prop('required',true);
			} else {
				$("#password").addClass("hide");
				$("#password").prop('required',false);
			}
		});

	$('body').on('click', '.btn-submit', function() {
		if (confirm("Apakah anda yakin menyelsaikan proses maintenance ini?")) {
			return true;
		}
		return false;
	});
	</script>
@endsection
