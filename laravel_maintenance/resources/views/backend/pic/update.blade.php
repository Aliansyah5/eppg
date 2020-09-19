<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Pic';
	$breadcrumb[1]['url'] = url('backend/pic');
	$breadcrumb[2]['title'] = 'Add';
	$breadcrumb[2]['url'] = url('backend/pic/create');
	if (isset($data)){
		$breadcrumb[2]['title'] = 'Edit';
		$breadcrumb[2]['url'] = url('backend/pic/'.$data[0]->id.'/edit');
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
    Master PIC - <?=$mode;?>
@endsection

<!-- CONTENT -->
@section('content')
    <?php

        $nama = old('category');
        $active = old('active');
        $seksi = old('seksi');
        $cabang = old('cabang');

		$method = "POST";
		$mode = "Create";
		$url = "backend/pic/";
		if (isset($data)){

            $nama = $data[0]->nama;
            $active = $data[0]->active;
            $cabang = $data[0]->cabangid;

            $seksi = $data[0]->seksi;

			$method = "PUT";
			$mode = "Edit";
			$url = "backend/pic/".$data[0]->id;
		}
	?>
	<div class="page-title">
		<div class="title_left">
			<h3>Master PIC - <?=$mode;?></h3>
		</div>
		<div class="title_right">
			<div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
                @include('backend.elements.back_button',array('url' => '/backend/pic'))
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
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Nama PIC<span class="required">*</span></label>
							<div class="col-sm-3 col-xs-12">
								<input type="text" name="nama" required="required" class="form-control" value="<?=$nama;?>" autofocus>
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
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Seksi<span class="required">*</span></label>
							<div class="col-sm-3 col-xs-12">
                                <select class="form-control" name="seksi" required=""  >
                                    <option value="">(Jenis Kategori)</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{$kategori->id}}" {{ $seksi == $kategori->id ? 'selected' : '' }}>{{$kategori->category}}</option>
                                    @endforeach
                                </select>
							</div>
                        </div>
                        <div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Cabang </label>
							<div class="col-sm-3 col-xs-12">
								{{
								Form::select(
									'cabang',
									['1' => 'Pusat', '2' => 'Serang'],
									$cabang,
									array(
										'class' => 'form-control',
									))
								}}
							</div>
                        </div>

						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-sm-6 col-xs-12 col-sm-offset-3">
								<a href="<?=url('/backend/pic')?>" class="btn btn-warning">Cancel</a>
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
