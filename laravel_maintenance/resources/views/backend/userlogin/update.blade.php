<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'User';
	$breadcrumb[1]['url'] = url('backend/user');
	$breadcrumb[2]['title'] = 'Add';
	$breadcrumb[2]['url'] = url('backend/user/create');
	if (isset($data)){
		$breadcrumb[2]['title'] = 'Edit';
		$breadcrumb[2]['url'] = url('backend/user/'.$data[0]->id.'/edit');
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
Master User - <?=$mode;?>
@endsection

<!-- CONTENT -->
@section('content')
<?php

		$tipe = old('tipe');
        $username = old('username');
		$user_level = old('user_level');
		$tipe = old('tipe');
		$reldag = old('reldag');
        $name = old('name');
        $email = old('email');
        $telp = old('telp');
        $kelompokx = [];
		$method = "POST";
		$mode = "Create";
		$url = "backend/user/";
		if (isset($data)){

			$tipe = $data[0]->tipe;
            $username = $data[0]->username;
			$user_level = $data[0]->user_level;
			$tipe = $data[0]->tipe;
			$reldag = $data[0]->reldag;
            $kelompokx = $data[0]->kelompok;

            $name = $data[0]->name;
            $email = $data[0]->email;
            $telp = $data[0]->telp;
			$method = "PUT";
			$mode = "Edit";
			$url = "backend/user/".$data[0]->id;
		}
	?>
<div class="page-title">
    <div class="title_left">
        <h3>Master User - <?=$mode;?></h3>
    </div>
    <div class="title_right">
        <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
            @include('backend.elements.back_button',array('url' => '/backend/user'))
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
                    <label class="control-label col-sm-3 col-xs-12">Type </label>
                    <div class="col-sm-3 col-xs-12">
                        {{
								Form::select(
									'tipe',
									['AGEN' => 'LAINNYA'],
									$tipe,
									array(
										'class' => 'form-control',
									))
								}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Username <span class="required">*</span></label>
                    <div class="col-sm-3 col-xs-12">
                        <input type="text" name="username" required="required" class="form-control"
                            value="<?=$username;?>" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Level </label>
                    <div class="col-sm-3 col-xs-12">
                        {{
								Form::select(
									'user_level',
									['USER' => 'USER', 'VADM' => 'ADMIN', 'VSUPER' => 'SUPER ADMIN'],
									$user_level,
									array(
										'class' => 'form-control',
									))
								}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                    <div class="col-sm-4 col-xs-12">
                        <input type="text" name="name" required="required" class="form-control" value="<?=$name;?>">
                    </div>
                </div>
                <?php
							if ($mode == "Edit"):
						?>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Password<br /><small>default 12345</small></label>
                    <div class="col-sm-4 col-xs-12">
                        <input type="password" id="password" name="pwd" class="form-control hide">
                        <input type="checkbox" id="password_check" name="password_check" value="1">
                        Change Password
                    </div>
                </div>
                <?php
							endif;
                        ?>
                 <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Kelompok <span class="required">*</span></label>
                    <div class="col-sm-5 col-xs-12">
                        <select class=" form-control"  id="kelompok" name="kelompok[]" multiple="multiple" required="" >
                            <option value="">(Pilih Kelas)</option>
                            @foreach($kelompoks as $kelompok)
                            <option value="{{$kelompok->id}}" {{ (in_array($kelompok->id, $kelompokx )) ? 'selected' : '' }} >
                                {{$kelompok->nama_kelompok}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                    <div class="col-sm-5 col-xs-12">
                        <input type="text" name="email" required="required" class="form-control" value="<?=$email;?>"
                            autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3 col-xs-12">Telp</span></label>
                    <div class="col-sm-5 col-xs-12">
                        <input type="number" name="telp" class="form-control" value="<?=$telp;?>" autofocus>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12 col-sm-offset-3">
                        <a href="<?=url('/backend/user')?>" class="btn btn-warning">Cancel</a>
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
        $('#kelompok').select2();
</script>
@endsection
