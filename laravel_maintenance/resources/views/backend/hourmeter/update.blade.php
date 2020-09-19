<?php
   $breadcrumb = [];
   $breadcrumb[0]['title'] = 'Dashboard';
   $breadcrumb[0]['url'] = url('backend/dashboard');
   $breadcrumb[1]['title'] = 'Hourmeter';
   $breadcrumb[1]['url'] = url('backend/hourmeter');
   $breadcrumb[2]['title'] = 'Add';
   $breadcrumb[2]['url'] = url('backend/hourmeter/create');
   if (isset($data)){
   	$breadcrumb[2]['title'] = 'Edit';
   	$breadcrumb[2]['url'] = url('backend/hourmeter/'.$data[0]->id.'/edit');
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
Master Hour Meter - <?=$mode;?>
@endsection
<!-- CONTENT -->
@section('content')
<?php
   $kondisi = old('kondisi');
   $kode = old('kode');
   $nama = old('nama');
   $jenis = old('jenis');
   $assetx = old('asset');
   $mainthour = old('mainthour');
   $department = old('department');


   $method = "POST";
   $mode = "Create";
   $url = "backend/hourmeter/";

   if (isset($data)){

       $kondisi = $data[0]->Kondisi;
       $kode = $data[0]->Kode;
       $nama = $data[0]->Nama;
       $assetid = $data[0]->AssetID;
       $kategori = $data[0]->Kat1;
       $jenis = $data[0]->Jenis;
       $isdel = $data[0]->IsDel;
       $realhourmeter = $data[0]->realhourmeter;
       $nextmt = $data[0]->nextmt;
       $department = $data[0]->Department;
       $lokasi = $data[0]->Lokasi;
       $lastmaintdate = $data[0]->LastMaintDate;
       $mainthour = $data[0]->MaintHour;

   $method = "PUT";
   $mode = "Edit";
       $url = "backend/hourmeter/".$data[0]->AssetID;

   }
   ?>
<div class="page-title">
   <div class="title_left">
      <h3>Master Hour Meter - <?=$mode;?></h3>
   </div>
   <div class="title_right">
      <div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
         @include('backend.elements.back_button',array('url' => '/backend/hourmeter'))
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
               <h2>Data Hour Meter Asset </h2>
               <div class="clearfix"></div>
            </div>

            <br>
            <div class="table-responsive">
               <table class="table table-striped jambo_table bulk_action">
                  <thead>
                     <tr class="headings">
                        <th>
                           <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" id="check-all" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                        </th>
                        <th class="column-title" style="display: table-cell;">No </th>
                        <th class="column-title" style="display: table-cell;">Asset</th>
                        <th class="column-title" style="display: table-cell;">Hour Meter </th>
                        </th>
                        <th class="bulk-actions" colspan="7" style="display: none;">
                           <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt">1 Records Selected</span> ) <i class="fa fa-chevron-down"></i></a>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                    @for($i=1; $i<=15 ;$i++)
                     <tr class="even pointer">
                        <td class="a-center ">
                           <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" name="table_records" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                        </td>
                        <td class=" ">{{$i}}</td>
                        <td class=" ">
                            <div class="col-sm-8 col-xs-12">
                                <select class="form-control select_asset" name="asset[]"  >
                                    <option value="">(Pilih Asset)</option>
                                    @foreach($assets as $asset)
                                    <option value="{{$asset->AssetID}}">{{$asset->Kode}} - {{$asset->Nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td class=" ">
                            <div class="col-sm-4 col-xs-12">
                                 <input type="number" min="0" name="hourmeter[]" class="form-control" />
                            </div>
                        </td>
                     </tr>
                    @endfor
                  </tbody>
               </table>
            </div>
            <div class="form-group">
               <div class="col-sm-6 col-xs-12 col-sm-offset-3">
                  <a href="<?=url('/backend/hourmeter')?>"                 class="btn btn-warning">Cancel</a>
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
   $('.select_asset').select2();

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
