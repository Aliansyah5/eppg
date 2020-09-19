<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Asset';
	$breadcrumb[1]['url'] = url('backend/asset');
	$breadcrumb[2]['title'] = 'Add';
	$breadcrumb[2]['url'] = url('backend/asset/create');
	if (isset($data)){
		$breadcrumb[2]['title'] = 'Edit';
		$breadcrumb[2]['url'] = url('backend/asset/'.$data[0]->id.'/edit');
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
    Master Asset - <?=$mode;?>
@endsection

<!-- CONTENT -->
@section('content')
    <?php


        $kondisi = old('kondisi');
        $kode = old('kode');
        $nama = old('nama');
        $jenis = old('jenis');
        $asset = old('asset');
        $mainthour = old('mainthour');
        $department = old('department');


		$method = "POST";
		$mode = "Create";
        $url = "backend/asset/";

		if (isset($data)){



            $kondisi = $data[0]->Kondisi;
            $kode = $data[0]->Kode;
            $nama = $data[0]->Nama;
            $assetid = $data[0]->AssetID;
            $isdel = $data[0]->IsDel;

            $kategori = $data[0]->Kat1;
            $jenis = $data[0]->Jenis;
            $department = $data[0]->Department;
            $lokasi = $data[0]->Lokasi;
            $lastmaintdate = $data[0]->LastMaintDate;
            $mainthour = $data[0]->MaintHour;
            $realhourmeter = $data[0]->realhourmeter;

			$method = "POST";
			$mode = "Edit";
            $url = "backend/asset/simpanwaktu/".$data[0]->AssetID;

		}
	?>
	<div class="page-title">
		<div class="title_left">
			<h3>Master Asset - <?=$mode;?></h3>
		</div>
		<div class="title_right">
			<div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
                @include('backend.elements.back_button',array('url' => '/backend/asset'))
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
                        {!! csrf_field() !!}
                        <div class="x_title">
                            <h2>Informasi Asset</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Kondisi<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
								<input type="text"readonly name="kondisi" required="required" class="form-control" value="<?=$kondisi;?>" autofocus>
							</div>
						</div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Kode Asset<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
                                <input type="text" readonly name="kode" required="required" class="form-control" value="<?=$kode;?>" autofocus>
                                <input type="hidden" readonly name="assetid" required="required" class="form-control" value="<?=$assetid;?>" autofocus>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Nama Asset<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
								<input type="text" readonly name="asset" required="required" class="form-control" value="<?=$nama;?>" autofocus>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Jenis<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
								<input type="text" readonly name="jenis" required="required" class="form-control" value="<?=$jenis;?>" autofocus>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Kategori<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
								<input type="text" readonly name="kategori" required="required" class="form-control" value="<?=$kategori;?>" autofocus>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Department<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
								<input type="text" readonly name="asset" required="required" class="form-control" value="<?=$department;?>" autofocus>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Lokasi<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
								<input type="text" readonly name="lokasi" required="required" class="form-control" value="<?=$lokasi;?>" autofocus>
							</div>
                        </div>
                        <div class="x_title">
                            <h2>Hour Meter {{$nama}} </h2>
                                <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">Type Hour Meter<span class="required"></span></label>
                            <div class="col-sm-3 col-xs-12">
                                <select class="form-control" name="isdel" required=""  >

                                    <option value="0" {{ $isdel == 0 ? 'selected' : ''}} >ACTIVE</option>
                                    <option value="2" {{ $isdel == 2 ? 'selected' : ''}} >INACTIVE</option>
                                    <option value="3" {{ $isdel == 3 ? 'selected' : ''}} >STOP</option>
                                </select>
                                *Pilih Active jika asset terdapat Hour Meter<br/>
                                *Pilih Inactive jika asset tidak terdapat Hour Meter<br/>
                                *Pilih Stop jika asset diletakan digudang / tidak digunakan<br/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3 col-xs-12">Hour Meter<span class="required"></span></label>
                            <div class="col-sm-3 col-xs-12">
                            <input type="number" min="0"  name="mainthourasset" required="required" class="form-control" value="{{ $isdel != 2 ? $mainthour : $realhourmeter}}" autofocus>
                            </div>
                        </div>
                        <div class="x_title">
                        <h2>{{$komponen->count()}} Komponen Maintenance </h2>
                            <div class="clearfix"></div>
                        </div>
                        @if ($komponen->count() != 0)
                            @foreach ($komponen as $komp)
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Kode NAV<span class="required"></span></label>
                                <div class="col-sm-3 col-xs-12">
                                <input type="text" min="0" readonly name="mainthour" required="required" class="form-control" value="{{$komp->KodeNAV}}" autofocus>
                                </div>
                            </div>
                                <input type="hidden" name="idx[]" id="" value="{{$komp->Idx}}">
                                <input type="hidden" name="assetid[]" id="" value="{{$komp->AssetID}}">
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Nama<span class="required"></span></label>
                                <div class="col-sm-3 col-xs-12">
                                <input type="text" min="0" readonly name="mainthour" required="required" class="form-control" value="{{$komp->Nama}}" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Qty<span class="required"></span></label>
                                <div class="col-sm-3 col-xs-12">
                                    <input type="number" readonly min="0" name="mainthour" required="required" class="form-control" value="{{$komp->Qty}}" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Harga<span class="required"></span></label>
                                <div class="col-sm-3 col-xs-12">
                                    <input type="text" min="0" readonly name="mainthour" required="required" class="form-control" value="{{$komp->Harga}}"" autofocus>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-sm-3 col-xs-12">Hour Meter<span class="required"></span></label>
                                <div class="col-sm-3 col-xs-12">
                                    <input type="number" min="0" @if($kodearea == "2") readonly @endif  name="hourmeter[]" required="required" class="form-control" value="{{$komp->HourMeter}}"" autofocus>*Satuan dalam km ( 1 Hari = 5 km )
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            @endforeach
                        @else
                            <h3 class="text-center">Belum ada detail komponen di master maintenance </h3>
                        @endif

						<div class="form-group">
							<div class="col-sm-6 col-xs-12 col-sm-offset-3">
								<a href="<?=url('/backend/asset')?>" class="btn btn-warning">Cancel</a>
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
