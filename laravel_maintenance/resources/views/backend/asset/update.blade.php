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
            $kategori = $data[0]->Kat1;
            $jenis = $data[0]->Jenis;
            $seksi = $data[0]->Seksi;
            $isdel = $data[0]->IsDel;
            $realhourmeter = $data[0]->realhourmeter;
            $nextmt = $data[0]->nextmt;
            $department = $data[0]->Department;
            $lokasi = $data[0]->Lokasi;
            $lastmaintdate = $data[0]->LastMaintDate;
            $mainthour = $data[0]->MaintHour;

			$method = "PUT";
			$mode = "Edit";
            $url = "backend/asset/".$data[0]->AssetID;

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
                        <div class="row">
                            <div class="col-md-6 col-sm-6 ">
                                <div class="x_panel">
                                <div class="x_title">
                                <h2>Komponen yang harus di maintenace <small></small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                                </ul>
                                <div class="clearfix"></div>
                                </div>
                                <div class="x_content" style="display: block;">
                                <div class="">
                                    @if (count($listkomponenmt) <= 0)
                                        <strong>Tidak ada komponen yang harus di Maintenance</strong>
                                    @else
                                        @foreach ($listkomponenmt as $list)
                                        <div class="alert alert-danger alert-dismissible " role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                        Komponen <strong>{{$list->Komponen}}</strong> harus diganti .
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 ">
                                <div class="x_panel">
                                <div class="x_title">
                                <h2>History Maintenace <small>{{$nama}}</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                                </ul>
                                <div class="clearfix"></div>
                                </div>
                                <div class="x_content" style="display: block;">
                                    <div class="">
                                        @if (count($historymt) <= 0  )
                                            <strong>Tidak ada history Maintenance</strong>
                                        @else
                                            @foreach ($historymt[0]->detailmt as $history)
                                            <div class="alert alert-success alert-dismissible " role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                                </button>
                                            Tanggal <strong>{{ date('d-m-Y', strtotime($history->created_at)) }}</strong> Komponen <strong>{{$history->kodeKomponen}} sudah di maintenance</strong>.
                                            </div>
                                            @endforeach

                                        @endif
                                    </div>
                                </div>
                                </div>
                                </div>

                        </div>

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
							<label class="control-label col-sm-3 col-xs-12">Hour Meter<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
                                <input type="number" readonly class="form-control" name="realhourmeter" max="" min="0" id=""  value="{{ $realhourmeter }}"" autofocus>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Lokasi<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
								<input type="text" readonly name="lokasi" required="required" class="form-control" value="<?=$lokasi;?>" autofocus>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Terakhir Maintenance<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
                                <input type="text" readonly required="required" class="form-control" value="{{ date('d-m-Y', strtotime($lastmaintdate)) }}" autofocus>
                                <input type="hidden" readonly name="tgl_lastmaintdate" required="required" class="form-control" value="<?=$lastmaintdate;?>" autofocus>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Next Maintenance<span class="required"></span></label>
							<div class="col-sm-3 col-xs-12">
								<input type="text" name="tgl_maintenance" required="required" class="form-control" value="{{ date('d-m-Y', strtotime($nextmt)) }}" autofocus readonly>
							</div>
                        </div>
                        <div class="x_title">
                            <h2>Data Maintenance </h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Kategori<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
                                <select class="form-control" name="kategori" required=""  >
                                    <option value="">(Jenis Kategori)</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{$kategori->id}}" {{ $seksi == $kategori->id ? 'selected' : '' }}>{{$kategori->category}}</option>
                                    @endforeach
                                </select>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">PIC<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
                                <select class="form-control" name="pic" required=""  >
                                    <option value="">(Pilih PIC)</option>
                                    @foreach($pics as $pic)
                                        <option value="{{$pic->id}}">{{$pic->nama}}</option>
                                    @endforeach
                                </select>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">List Komponen Asset<span class="required">*</span></label>

                        </div>



                        @if (empty($listkomponenmt->count()))
                                <h5 class="text-center">Komponen Aset tidak ada yang perlu di maintenance</h5>
                        @else

                        @for ($i = 0; $i <= $listkomponenmt->count() - 1; $i++)


                        <div class="form-group">
                        <label class="control-label col-sm-3 col-xs-12"><input type="checkbox" id="mt{{$i}}check" value=""> </label>
                            <div class="col-sm-4 col-xs-12">
                                <input type="text" name="komponen[]" readonly id="reject{{$i}}text" value="{{$listkomponenmt[$i]->Komponen}}"  class="form-control" disabled=""  />
                            </div>
                            <label class="control-label col-sm-1 col-xs-12">Qty<span class="required">*</span></label>
                            <div class="col-sm-2 col-xs-12">
                                    <input type="number" name="qty[]" id="reject{{$i}}qty" step=".01" class="form-control" value="" disabled="" required="">
                                    <input type="text" name="sat" id="" class="form-control" value="{{$listkomponenmt[$i]->Sat}}" style="text-align: right" readonly>
                            </div>
                        </div>


                        @endfor

                        @endif


                        <br>

                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Tgl Start Maintenance<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
								<input type="date" name="tgl_maintenance" required="required" class="form-control" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" autofocus >
							</div>
                        </div>

                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Tgl Perkiraan Selesai Maintenance<span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
								<input type="date" name="tgl_perkiraan" required="required" class="form-control" autofocus>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Keterangan Perbaikan <br>/ Alasan Terlambat*</label>
							<div class="col-sm-7 col-xs-12">
								<textarea required="required" rows="5" name="keterangan" class="form-control"></textarea>
							</div>
                        </div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-sm-6 col-xs-12 col-sm-offset-3">
								<a href="<?=url('/backend/asset')?>"                 class="btn btn-warning">Cancel</a>
								<button type="submit" class="btn btn-primary btn-submit">Submit </button>
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

        $('#mt0check').change(function(){
            $("#reject0text").prop("disabled", !$(this).is(':checked'));
            $("#reject0qty").prop("disabled", !$(this).is(':checked'));
        });

        $('#mt1check').change(function(){
            $("#reject1text").prop("disabled", !$(this).is(':checked'));
            $("#reject1qty").prop("disabled", !$(this).is(':checked'));
        });

        $('#mt2check').change(function(){
            $("#reject2text").prop("disabled", !$(this).is(':checked'));
            $("#reject2qty").prop("disabled", !$(this).is(':checked'));
        });

        $('#mt3check').change(function(){
            $("#reject3text").prop("disabled", !$(this).is(':checked'));
            $("#reject3qty").prop("disabled", !$(this).is(':checked'));
        });

        $('#mt4check').change(function(){
            $("#reject4text").prop("disabled", !$(this).is(':checked'));
            $("#reject4qty").prop("disabled", !$(this).is(':checked'));
        });

        $('#mt5check').change(function(){
            $("#reject5text").prop("disabled", !$(this).is(':checked'));
            $("#reject5qty").prop("disabled", !$(this).is(':checked'));
        });

        $('#mt6check').change(function(){
            $("#reject6text").prop("disabled", !$(this).is(':checked'));
            $("#reject6qty").prop("disabled", !$(this).is(':checked'));
        });

        $('#mt7check').change(function(){
            $("#reject7text").prop("disabled", !$(this).is(':checked'));
            $("#reject7qty").prop("disabled", !$(this).is(':checked'));
        });

		$('body').on('click', '.btn-submit', function() {
			if (confirm("Apakah anda yakin submit data ini?")) {
				return true;
			}
			return false;
		});

	</script>
@endsection
