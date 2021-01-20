<?php
$breadcrumb = [];
$breadcrumb[0]['title'] = 'Dashboard';
$breadcrumb[0]['url'] = url('backend/dashboard');
$breadcrumb[1]['title'] = 'Siswa';
$breadcrumb[1]['url'] = url('backend/siswa');
$breadcrumb[2]['title'] = 'Add';
$breadcrumb[2]['url'] = url('backend/siswa/create');
if (isset($data)) {
    $breadcrumb[2]['title'] = 'Edit';
    $breadcrumb[2]['url'] = url('backend/siswa/' . $data[0]->id . '/edit');
}
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title')
<?php
$mode = "Create";
if (isset($data)) {
    $mode = "Edit";
}
?>
Master Siswa - <?= $mode; ?>
@endsection

<!-- CONTENT -->
@section('content')
<?php

$namasiswa = old('namasiswa');
$tgl_lahir = old('tgl_lahir');
$jeniskelamin = old('jeniskelamin');
$kelas = old('kelas');
$status = old('tgl_lahir');
$kelompokx = old('kelompok');
$alamatsiswa = old('alamatsiswa');
$email = old('email');
$telpsiswa = old('telpsiswa');
$namawali = old('namawali');
$alamatwali = old('alamatwali');
$telpwali = old('telpwali');
$emailwali = old('emailwali');
$pendidikan = old('pendidikan');
$namasekolah = old('namasekolah');
$jurusan = old('jurusan');
$dapukanx = old('dapukan');

$method = "POST";
$mode = "Create";
$url = "backend/siswa/";
if (isset($data)) {

    $namasiswa = $data[0]->nama;
    $tgl_lahir = $data[0]->tgl_lahir;
    $jeniskelamin = $data[0]->jk;
    $kelas = $data[0]->id_kategori;
    $status = $data[0]->status_nikah;
    $kelompokx = $data[0]->id_kelompok;
    $alamatsiswa = $data[0]->alamat;
    $email = $data[0]->email;
    $telpsiswa = $data[0]->telp_murid;
    $namawali = $data[0]->walimurid;
    $alamatwali = $data[0]->alamat_wali;
    $telpwali = $data[0]->telp_wali;
    $emailwali = $data[0]->email_wali;
    $pendidikan = $data[0]->pendidikan;
    $namasekolah = $data[0]->sekolah;
    $jurusan = $data[0]->jurusan;
    $dapukanx = $data[0]->id_dapukan;

    $method = "PUT";
    $mode = "Edit";
    $url = "backend/siswa/" . $data[0]->id;
}
?>
<div class="page-title">
    <div class="title_left">
        <h3>Master Siswa - <?= $mode; ?></h3>
    </div>
    <div class="title_right">
        <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
            @include('backend.elements.back_button',array('url' => '/backend/siswa'))
        </div>
    </div>
    <div class="clearfix"></div>
    @include('backend.elements.breadcrumb',array('breadcrumb' => $breadcrumb))
</div>
<div class="clearfix"></div>
<br /><br />
<div class="row">
    <div class="col-xs-12"">
        <div class=" x_panel">
        <div class="x_title">
            <h2>Data Murid</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
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
            {{ Form::open(['url' => $url, 'method' => $method,'class' => 'form-horizontal form-label-left']) }}
            {!! csrf_field() !!}
            <br>
            <form class="form-horizontal form-label-left">
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Nama<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12"">
                        <input type="text" name="namasiswa" value="<?=$namasiswa;?>" id="nama" required="required" class="form-control ">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tgl Lahir<span
                            class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12"">
                        <input type="date" name="tgl_lahir" value="<?=$tgl_lahir;?>"  required="required" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Jenis Kelamin<span
                            class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-6"">
                    <div class=" radio">
                        <label>
                            <input type="radio"  value="L" {{ $jeniskelamin == 'L' ? 'checked' : '' }} id="optionsRadios1" name="jeniskelamin" required>
                            Laki-Laki
                        </label>
                        <label>
                            <input type="radio" value="P" {{ $jeniskelamin == 'P' ? 'checked' : '' }} id="optionsRadios1" name="jeniskelamin">
                            Perempuan
                        </label>
                    </div>
                </div>
        </div>

        <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Kelas<span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12"">
                        <select class=" form-control" name="kelas" required="">
                <option value="">(Pilih Kelas)</option>
                @foreach($kategoris as $kategori)
                <option value="{{$kategori->id}}" {{ $kelas == $kategori->id ? 'selected' : '' }}>
                    {{$kategori->category}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 col-xs-3">Status Perkawinan</label>
            <div class="col-md-6 col-sm-6 col-xs-12"">
                <div class=" radio">
                <label>
                    <input type="radio" checked="" value="0" {{ $status == 0 ? 'checked' : '' }} id="optionsRadios1" name="status">
                    Belum Menikah
                </label>
                <label>
                    <input type="radio" value="1" {{ $status == 1 ? 'checked' : '' }} id="optionsRadios1" name="status">
                    Sudah Menikah
                </label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">Kelompok</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class=" form-control" name="kelompok" required="">
                <option value="">(Pilih Kelas)</option>
                @foreach($kelompoks as $kelompok)
                <option value="{{$kelompok->id}}" {{ $kelompokx == $kelompok->id ? 'selected' : '' }} >
                    {{$kelompok->nama_kelompok}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">Alamat</label>
        <div class="col-md-6 col-sm-6 col-xs-12"">
                <textarea id="message" class="form-control" name="alamatsiswa"><?=$alamatsiswa;?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
        <div class="col-md-6 col-sm-6 col-xs-12"">
            <input type=" email" name="email" class="form-control" value="<?=$email;?>" autofocus>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">No HP</label>
        <div class="col-md-6 col-sm-6 col-xs-12" ">
            <input class=" form-control" type="number" name="telpsiswa" value="<?=$telpsiswa;?>" data-validate-minmax="10,100" autofocus>
        </div>
    </div>
    <div class="x_title">
        <h2>Data Orang Tua</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>
    <br>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">Nama Wali (Ayah/Ibu)</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type=" text" id="first-name" name="namawali" value="<?=$namawali;?>" class="form-control ">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">Alamat</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id=" message" class="form-control" name="alamatwali" ><?=$alamatwali;?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">No HP</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class=" form-control" type="number" name="telpwali" value="<?=$telpwali;?>" data-validate-minmax="10,100" autofocus>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type=" email" name="emailwali" class="form-control" value="<?=$emailwali;?>" autofocus>
        </div>
    </div>
    <div class="x_title">
        <h2>Informasi Studi & Dapukan</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">Pendidikan<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            {{
                Form::select(
                    'pendidikan',
                    ['0' => 'Pilih Pendidikan',
                    '1' => 'PAUD', '2' => 'SD',
                    '3' => 'SMP', '4' => 'SMA/SMK',
                    '5' => 'UNIVERSITAS'
                    ],
                    $pendidikan,
                    array(
                        'class' => 'form-control',
                        'required' => 'required'
                    ))
                }}
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">Nama Sekolah / Universitas</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type=" text" id="first-name" name="namasekolah" value="<?=$namasekolah;?>" class="form-control ">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">Jurusan</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type=" text" id="first-name" name="jurusan" value="<?=$jurusan;?>" class="form-control ">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-3">Dapukan</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class=" form-control" name="dapukan"  >
                <option value="">(Pilih Dapukan)</option>
                @foreach($dapukans as $dapukan)
                <option value="{{$dapukan->id}}" {{ $dapukanx == $dapukan->id ? 'selected' : '' }}>
                    {{$dapukan->nama_dapukan}}</option>
                @endforeach
            </select>
        </div>
    </div>
    </br>
    <div class="form-group">
        <div class="col-sm-6 col-xs-12 col-sm-offset-3">
            <a href="<?= url('/backend/siswa') ?>" class="btn btn-warning  ">Cancel</a>
            <button type="submit" class="btn btn-primary" style=" ">Submit </button>
        </div>

    </div>

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
    $("#password_check").on("change", function() {
        if ($(this).prop('checked') == true) {
            $("#password").removeClass("hide");
            $("#password").prop('required', true);
        } else {
            $("#password").addClass("hide");
            $("#password").prop('required', false);
        }
    });
</script>
@endsection
