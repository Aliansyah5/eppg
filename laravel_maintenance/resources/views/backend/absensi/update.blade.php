<?php
$breadcrumb = [];
$breadcrumb[0]['title'] = 'Dashboard';
$breadcrumb[0]['url'] = url('backend/dashboard');
$breadcrumb[1]['title'] = 'Absensi';
$breadcrumb[1]['url'] = url('backend/absensi');
$breadcrumb[2]['title'] = 'Add';
$breadcrumb[2]['url'] = url('backend/absensi/create');
if (isset($data)) {
    $breadcrumb[2]['title'] = 'Edit';
    $breadcrumb[2]['url'] = url('backend/absensi/' . $data->id . '/edit');
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
Absensi - <?= $mode; ?>
@endsection

<!-- CONTENT -->
@section('content')
<?php
$formid = 0;
$namasiswa = old('namasiswa');
$tgl = old('tgl');
$jeniskelamin = old('jeniskelamin');
$kelas = [];
$pengajianx = old('pengajian');
$kelompokx = [];
$tempatx = old('tempat');
$quranx = old('quran');
$hadistx = old('hadist');
$pematerix = old('pemateri');
$telpsiswa = old('telpsiswa');
$jam_mulai = old('jam_mulai');
$jam_akhir = old('jam_akhir');
$ayat_awal = old('ayat_awal');
$ayat_akhir = old('ayat_akhir');
$hal_awal = old('hal_awal');
$hal_akhir = old('hal_akhir');
$tingkat = old('tingkat');
$namasekolah = old('namasekolah');
$jurusan = old('jurusan');
$dapukanx = old('dapukan');
$pengajar_quran = old('pengajar_quran');
$pengajar_hadist = old('penasehat_hadist');
$penasehat = old('penasehat');

$method = "POST";
$mode = "Create";
$url = "backend/absensi/";
if (isset($data)) {
    $formid = $data->id;
    $namasiswa = $data->nama;
    $pengajianx = $data->pengajian;
    $tgl = $data->tgl;
    $jeniskelamin = $data->jk;
    $kelas = $data->peserta;
    $status = $data->status_nikah;
    $kelompokx = $data->kelompok;
    $tempatx = $data->tempat;
    $tingkat = $data->tingkat;
    $quranx = $data->quran;
    $hadistx = $data->hadist;
    $jam_mulai = $data->jam_mulai;
    $jam_akhir = $data->jam_akhir;
    $pengajar_quran = $data->pengajar_quran;
    $pengajar_hadist = $data->pengajar_hadist;
    $penasehat = $data->penasehat;
    $ayat_awal = $data->ayat_awal;
    $ayat_akhir = $data->ayat_akhir;
    $hal_awal = $data->hal_awal;
    $hal_akhir = $data->hal_akhir;

    $method = "PUT";
    $mode = "Edit";
    $url = "backend/absensi/" . $data->id;
}
?>
<div class="page-title">
    <div class="title_left">
        <h3>Master Absensi - <?= $mode; ?></h3>
    </div>
    <div class="title_right">
        <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
            @include('backend.elements.back_button',array('url' => '/backend/absensi'))
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
            <h2>Data Absensi</h2>
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
                    <label class="control-label col-md-3 col-sm-3 col-xs-6">Pilih Pengajian<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12"">
                        <select class=" form-control" name="pengajian" required="">
                            <option value="">(Pilih Kelas)</option>
                            @foreach($pengajians as $pengajian)
                            <option value="{{$pengajian->id}}" {{ $pengajianx == $pengajian->id ? 'selected' : '' }}>
                                {{ Str::upper($pengajian->nama_pengajian) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 col-xs-6">Tgl<span
                            class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12"">
                        <input type="date" name="tanggal" value="<?=$tgl;?>"  required="required" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 col-xs-6">Jam Mulai<span
                            class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12"">
                        <input type="time" name="jam_mulai" value="<?=$jam_mulai;?>"  required="required" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 col-xs-6">Jam Akhir<span
                            class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12"">
                        <input type="time" name="jam_akhir" value="<?=$jam_akhir;?>"  required="required" class="form-control" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 col-xs-6">Peserta<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12"">
                                <select class="form-control" id="kelas" name="kelas[]" multiple="multiple" required="">
                        <option value="">(Pilih Peserta)</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{$kategori->id}}" {{ (in_array($kategori->id, $kelas )) ? 'selected' : ''  }} >
                            {{$kategori->category}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 col-xs-6">Tingkat Pengajian</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {{
                            Form::select(
                                'tingkat',
                                ['0' => 'Pilih Tingkat Pengajian',
                                '1' => 'KELOMPOK', '2' => 'DESA',
                                '3' => 'DAERAH', '4' => 'PUSAT'
                                ],
                                $tingkat,
                                array(
                                    'class' => 'form-control',
                                ))
                            }}
                    </div>
                </div>

    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-6">Kelompok</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class=" form-control"  id="kelompok" name="kelompok[]" multiple="multiple" required="" >
                <option value="">(Pilih Kelas)</option>
                @foreach($kelompoks as $kelompok)
                <option value="{{$kelompok->id}}" {{ (in_array($kelompok->id, $kelompokx )) ? 'selected' : '' }} >
                    {{$kelompok->nama_kelompok}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-6">Tempat</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class=" form-control select_2"  name="tempat" required="" >
                <option value="">(Pilih Tempat)</option>
                @foreach($tempats as $tempat)
                <option value="{{$tempat->id}}" {{ $tempatx == $tempat->id ? 'selected' : '' }} >
                    {{$tempat->nama_masjid}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="x_title">
        <h2>Materi</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>
    <br>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-6">Al-Quran</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class=" form-control select_2"  name="quran"  >
                <option value="">(Pilih Surat)</option>
                @foreach($qurans as $quran)
                <option value="{{$quran->id}}" {{ $quranx == $quran->id ? 'selected' : '' }} >
                    {{$quran->nama_surat}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-4">Ayat</label>
        <div class="col-md-1 col-sm-1 col-xs-3">
            <input type="number" name="ayat_awal" value="<?=$ayat_awal;?>"  min="0" id="ayat_awal" class="form-control" width="300">
        </div>
        <label class="control-label col-md-1 col-sm-1 " style="text-align: center">s/d</label>
        <div class="col-md-1 col-sm-1 col-xs-3">
            <input type="number" name="ayat_akhir" value="<?=$ayat_akhir;?>"  min="0" id="ayat_akhir" class="form-control" width="300">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-6">Pengajar Al-Quran</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="pengajar_quran" value="<?=$pengajar_quran;?>" class="form-control" >
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-6">Al-Hadist</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class=" form-control select_2"  id="hadist" name="hadist"  >
                <option value="">(Pilih Hadist)</option>
                @foreach($hadists as $hadist)
                <option value="{{$hadist->id}}" {{ $hadistx == $hadist->id ? 'selected' : '' }} >
                    {{$hadist->nama_hadist}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-4">Halaman</label>
        <div class="col-md-1 col-sm-1 col-xs-3">
            <input type="number" name="hal_awal" value="<?=$hal_awal;?>"  min="0" vaid="hal_awal" class="form-control" width="300">
        </div>
        <label class="control-label col-md-1 col-sm-1 " style="text-align: center">s/d</label>
        <div class="col-md-1 col-sm-1 col-xs-3">
            <input type="number" name="hal_akhir" value="<?=$hal_akhir;?>"  min="0" id="hal_akhir" class="form-control" width="300">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-6">Pengajar Al-Hadist</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="pengajar_hadist" value="<?=$pengajar_hadist;?>" class="form-control" >
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3 col-sm-3 col-xs-6">Penasehat</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="penasehat" value="<?=$penasehat;?>" class="form-control" >
        </div>
    </div>
    </br>
    <div class="form-group">
        <div class="col-sm-6 col-xs-12 col-sm-offset-3">
            <a href="<?= url('/backend/absensi') ?>" class="btn btn-warning  ">Cancel</a>
            <button type="submit" class="btn btn-primary" style=" ">Submit </button>
        </div>

    </div>
</div>

</div>

@if ($mode == 'Edit')

<div class="row">
    <div class="col-xs-12"">
        <div class=" x_panel">
            <div class="x_title">
                <h2>Absensi Murid</h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <br>
            <div class="x_content">
                <div class="col-xs-12 col-md-6">
                    <h2>Laki Laki</h2>
                    <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTableLakiLaki"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    </table>
                </div>
                <div class="col-xs-12 col-md-6">
                    <h2>Perempuan</h2>
                    <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTablePerempuan"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kehadiran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
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

    //datatable on change status absensi

    $(".dataTableLakiLaki, .dataTablePerempuan ").on("change",".status", function () {

        const $this = $(this); // Cache $(this)
        const formid = $this.find(':selected').data('formid'); // Get data value
        const idsiswa = $this.find(':selected').data('id_siswa'); // Get data value
        const status = $this.find(':selected').val();

        // Update record
        var plant = $('#plant').val();

        if(formid != '' && idsiswa != ''){
            jQuery.ajax({
                url: './gantistatus',
                type: "POST",
                dataType: "JSON",
                data:{
                    "formid": formid,
                    "idsiswa": idsiswa,
                    "col": 'status',
                    "status": status,
                    "_method": 'POST',
                    "_token": "{{ csrf_token() }}"
                },
                success:function(data){
                    console.log('sukses update status');
                },
                error: function(response){
                    console.log('its failed');

                }
            })
        }
    });

    $(".dataTableLakiLaki, .dataTablePerempuan ").on("blur",".keterangan", function () {

        const $this = $(this); // Cache $(this)
        const formid = $this.data('formid'); // Get data value
        const idsiswa = $this.data('id_siswa'); // Get data value
        const keterangan = $this.val();

        // Update record

        if(formid != '' && idsiswa != ''){
            jQuery.ajax({
                url: './gantistatus',
                type: "POST",
                dataType: "JSON",
                data:{
                    "formid": formid,
                    "idsiswa": idsiswa,
                    "col": 'keterangan',
                    "keterangan": keterangan,
                    "_method": 'POST',
                    "_token": "{{ csrf_token() }}"
                },
                success:function(data){
                    console.log('sukses update status');
                },
                error: function(response){
                    console.log('its failed');

                }
            })
        }
    });

    $('#kelas').select2();

    $('#kelompok').select2();
    $('#tempat').select2();

    $('.select_2').select2();

    $('.pengajar').select2({
        tags: true
    });

    $("#password_check").on("change", function() {
        if ($(this).prop('checked') == true) {
            $("#password").removeClass("hide");
            $("#password").prop('required', true);
        } else {
            $("#password").addClass("hide");
            $("#password").prop('required', false);
        }
    });

    var id = {!! json_encode($formid)  !!}

    $('.dataTableLakiLaki').dataTable({
			processing: true,
			serverSide: true,
			ajax: "<?=url('backend/absensilakilaki/'.$formid.'/datatable');?>",
			columns: [
				{data: 'nomor', name: 'dabsensi.idx '},
				{data: 'nama', name: 'a.nama'},
				{data: 'status', name: 'dabsensi.status'},
				{data: 'keterangan', name: 'dabsensi.keterangan'},
			],
			responsive: false,
            stateSave: true,
            order : [[ 0, "asc" ]],
	});

    $('.dataTablePerempuan').dataTable({
			processing: true,
			serverSide: true,
			ajax:  "<?=url('backend/absensiperempuan/'.$formid.'/datatable');?>",
            columns: [
				{data: 'nomor', name: 'dabsensi.idx '},
				{data: 'nama', name: 'a.nama'},
				{data: 'status', name: 'dabsensi.status'},
				{data: 'keterangan', name: 'dabsensi.keterangan'},
			],
			responsive: false,
            stateSave: true,
            order : [[ 0, "asc" ]],
	});

</script>
@endsection
