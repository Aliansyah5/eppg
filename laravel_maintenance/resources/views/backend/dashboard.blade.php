<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
    $breadcrumb[0]['url'] = url('backend/dashboard');

?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title', 'Dashboard')

<!-- CONTENT -->
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Dashboard</h3>
    </div>
    <div class="title_right">
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-calendar-check-o"></i></div>
                    <div class="count">
                       {{$jumlahPengajian}} <span style="font-size:13px"></span> </div>
                    <h3>TOTAL PENGAJIAN</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="count">
                         {{$jumlahSiswa}}<span style="font-size:13px"></span> </div>
                    <h3>TOTAL SISWA</h3>
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

 </script>

@endsection
