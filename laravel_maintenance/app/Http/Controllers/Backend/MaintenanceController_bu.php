<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Asset;
use App\Model\AvianFixAsset;
use App\Model\Kategori;
use App\Model\Maintenance;
use Illuminate\Http\JsonResponse;
use App\Model\UserLogin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use Validator;
use DateTime;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = 999;
        $kategori = 999;
        $assignee = 999;
    	$startDate = "01"."-".date('m-Y');
        $endDate = date('d-m-Y');
        $mode = "limited";

        if ((isset($_GET['startDate'])) && ($_GET['startDate'] != "")){
            $startDate = $_GET["startDate"];
        }
        if ((isset($_GET['endDate'])) && ($_GET['endDate'] != "")){
            $endDate = $_GET["endDate"];
        }
        if ((isset($_GET['status'])) && ($_GET['status'] != "")){
            $status = $_GET["status"];
        }
        if (isset($_GET["kategori"])){
            $kategori = $_GET['kategori'];
        }
        if (isset($_GET["assignee"])){
            $assignee = $_GET['assignee'];
        }
        if (isset($_GET["mode"])){
            $mode = $_GET['mode'];
        }

        $assignees = UserLogin::all('username');
        $kategoris = Kategori::all();

		return view ('backend.maintenance.indexa',compact('status','kategori','assignee','startDate','endDate','mode','assignees','kategoris'));
    }

    public function cari(Request $request)
    {
        $query = DB::table('master_mt')->select('*')->where('active','1');
        //jika selesai Maintenance
        if ($request->status == 2){
            $query = DB::table('master_mt')->select('*')->where('active','2');
        }
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);

        }
        if ($request->assignee) {
            $query->where('assignee', $request->assignee);

        }
        $status = 2;
        $kategori = 1;
        $assignee = 'ibra';

        $result = $query->get();

        return view('backend.maintenance.index',['result' => $result],compact('status','kategori','assignee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //autoincrement kode mt

        $getRow = Maintenance::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "MT00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "MT0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "MT000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "MT00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "MT0".''.($lastId->id + 1);
            } else {
                    $kode = "MT".''.($lastId->id + 1);
            }
        }

        $assets = AvianFixAsset::select('AssetID','Kode','Nama')->orderBy('Kode', 'DESC')->get();
        $kategoris = Kategori::select('id','category')->where('active',1)->orderBy('id', 'ASC')->get();

		return view ('backend.maintenance.update',compact('kode','assets','kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $getRow = Maintenance::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        $lastId = $getRow->first();

        $kode = "MT00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "MT0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "MT000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "MT00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "MT0".''.($lastId->id + 1);
            } else {
                    $kode = "MT".''.($lastId->id + 1);
            }
        }

        $validator = Validator::make($request->all(),[]);
        $cekasset = Maintenance::where('asset',$request->asset)->get()->count();

        $cekkode = Maintenance::where('kode',$request->kode)->get()->count();

        // if($cekkode > 0) {
        //     $data = Maintenance::where('kode',$request->kode)->first();
        //     $data->kode = $kode;
        //     $data->asset = $request->asset;
        //     $data->kategori = $request->kategori;
        //     $data->tgl_selesai = $request->tgl_selesai;
        //     $data->tgl_realisasi = Carbon::today();
        //     $data->jenis = $request->jenis;
        //     $data->active = 1;
        //     $data->assignee = Session::get('userinfo')['username'];

        //     $data->user_modified = Session::get('userinfo')['username'];
        //     $data->supervisor = Session::get('userinfo')['supervisor'];
        //     if($data->update()){
        //         return Redirect::to('/backend/maintenance/')->with('success', "Data saved successfully")->with('mode', 'success');
        //     }
        // }

        if($cekkode > 0) {
            if($cekasset > 0) {
                $validator->getMessageBag()->add('Kode', 'Barang sudah terdaftar di Maintenance');
            }
        }else {
                    $data = new Maintenance();

                    $data->kode = $kode;
                    $data->asset = $request->asset;

                    $data->kategori = $request->kategori;
                    $data->tgl_selesai = $request->tgl_selesai;
                    $data->tgl_realisasi = Carbon::today();
                    $data->jenis = $request->jenis;
                    $data->active = 1;
                    $data->assignee = Session::get('userinfo')['username'];

                    $data->user_modified = Session::get('userinfo')['username'];
                    $data->supervisor = Session::get('userinfo')['supervisor'];
                    if($data->save()){
                        return Redirect::to('/backend/maintenance/')->with('success', "Data saved successfully")->with('mode', 'success');
                    }
        }

		// if($cekasset > 0){
		// 	$validator->getMessageBag()->add('Kode', 'Barang sudah terdaftar di Maintenance');
        // } else
        // {

        //     $data = new Maintenance();

        //         $data->kode = $kode;
        //         $data->asset = $request->asset;

        //         $data->kategori = $request->kategori;
        //         $data->tgl_selesai = $request->tgl_selesai;
        //         $data->tgl_realisasi = Carbon::today();
        //         $data->jenis = $request->jenis;
        //         $data->active = 1;
        //         $data->assignee = Session::get('userinfo')['username'];

        //         $data->user_modified = Session::get('userinfo')['username'];
        //         $data->supervisor = Session::get('userinfo')['supervisor'];
        //         if($data->save()){
        //             return Redirect::to('/backend/maintenance/')->with('success', "Data saved successfully")->with('mode', 'success');
        //         }

        // }
		return Redirect::to('/backend/asset/')
				->withErrors($validator)
				->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Maintenance::where('kode', $id)->get();

        $asset = AvianFixAsset::where('AssetID', $data[0]->asset)->get();

        $kategori = Kategori::where('id', $data[0]->kategori)->get();


        if ($data->count() > 0){
			return view ('backend.maintenance.view', ['data' => $data, 'asset'=>$asset , 'kategori'=>$kategori]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $kategoris = Kategori::select('id','category')->where('active',1)->orderBy('id', 'ASC')->get();
        $datamt = AvianFixAsset::where('AssetID', $id)->get();
        $data = Maintenance::where('kode',$id)->get();
        $assets = AvianFixAsset::select('AssetID','Kode','Nama')->orderBy('Kode', 'DESC')->get();

        $tanggal_selesai = $data[0]->tgl_selesai;

        $jenis = '';
        $kategori = '';

        if (count($data)){
            $jenis = $data[0]->jenis;
            $kategori = $data[0]->kategori;
        }

        if (count($data)) {
            $kode = $data[0]->kode;
        }


        view()->share('jenisx', $jenis);
        view()->share('kategori', $kategori);
        view()->share('kode', $kode);

		if ($data->count() > 0){
			return view ('backend.maintenance.update',compact('data','kategoris' ,'assets','datamt','tanggal_selesai'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //generate kode

            $data = Maintenance::where('kode',$request->kode)->first();

            $data->tgl_selesaimt = Carbon::today();
            $data->active = 2;
            //user yang melakukan maintenance
            $data->assignee = Session::get('userinfo')['username'];

            //mencari lama jam mt mesin
            $tglStartMT = (new DateTime($request->tgl_maintenance));
            $tglSekarang = Carbon::today();
            $lamaMT = $tglSekarang->diff($tglStartMT);
            $lamaMTFormat = $lamaMT->d;

            $data->lama_mt = $lamaMTFormat;


            //user yang melakukan realisasi
            $data->user_modified = Session::get('userinfo')['username'];
            $data->updated_at = Carbon::now();

 //ketika blm maintenance flag 1 setelah Maintenance/maintenacne flag 2
            $dataAsset = AvianFixAsset::where('AssetID',$request->kodeasset)->first();
            //$dataAsset->LastMaintDate = Carbon::today();
            $dataAsset->UpdateDate = Carbon::today();
            $dataAsset->Flag = 1;
            $dataAsset->update();

            if($data->update()){
                return Redirect::to('/backend/maintenance/')->with('success', "Asset sudah direalisasi selesai Maintenance")->with('mode', 'success');
            }



		return Redirect::to('/backend/maintenance/'.$id."/edit")
				->withErrors($validator)
                ->withInput();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {


        $data = Maintenance::where('kode',$id)->first();

        $dataAsset = AvianFixAsset::where('AssetID',$data->asset)->first();
        $dataAsset->LastMaintDate = $data->tgl_lastmaintdate;
         //ketika blm maintenance flag 1 setelah Maintenance/maintenacne flag 2
        $dataAsset->Flag = 1;
        $dataAsset->update();


        // $data->find($data_->id);

        $data->active = 0;

        $data->user_modified = Session::get('userinfo')['username'];

        if($data->save()){
            return new JsonResponse(["status"=>true]);
        }


        //
        // $delete = Kategori::where('id', $id)->delete();
		//return new JsonResponse(["status"=>true]);
    }

	public function datatable() {

        $userinfo = Session::get('userinfo');
        $status = 999;
        $kategori = 999;
        $assignee = 999;
        $mode = "limited";
    	$startDate = "01"."-".date('m-Y');
        $endDate = date('d-m-Y');


        if (isset($_GET["status"]) || isset($_GET["kategori"]) || isset($_GET["assignee"]) ){
			if ((isset($_GET['startDate'])) && ($_GET['startDate'] != "")){
				$startDate = $_GET["startDate"];
			}
			if ((isset($_GET['endDate'])) && ($_GET['endDate'] != "")){
				$endDate = $_GET["endDate"];
            }
			if ((isset($_GET['status'])) && ($_GET['status'] != "")){
				$status = $_GET["status"];
            }
			if (isset($_GET["kategori"])){
				$kategori = $_GET['kategori'];
            }
			if (isset($_GET["assignee"])){
				$assignee = $_GET['assignee'];
            }
            if (isset($_GET["mode"])){
				$mode = $_GET['mode'];
            }


        }

        //kueri utama
        $usermt = Maintenance::where('active','>=','1');

        if ($mode != "all"){
            $usermt = $usermt->where('created_at','>=', date('Y-m-d 00:00:00',strtotime($startDate)));
            $usermt = $usermt->where('created_at','<=',date('Y-m-d 23:59:59',strtotime($endDate)));
        }

        //mencari asset yang proses maintenance
        if ($status == 1){
            $usermt = $usermt->where('active','=', 1)
            ->whereRaw('CURDATE() < tgl_perkiraan');
        }

        //mencari asset yang selesai maintenance
        if ($status == 1 || $status == 3){
            $usermt = $usermt->where('active','=', $status);
        }

        //mencari asset yang belum realisasi
        if ($status == 2){
            $usermt = $usermt->where('active','=', 1)
            ->whereRaw('CURDATE() >= tgl_perkiraan');
        }

        if ($kategori != 999){
            $usermt = $usermt->where('kategori','=', $kategori);
        }

        if ($assignee != 999){
            $usermt = $usermt->where('assignee','=',$assignee);
        }


        return Datatables::of($usermt)
        ->editColumn('status', function($usermt) {

            $tglMulai = (new DateTime($usermt->{"tgl_realisasi"}));
            $tglPerkiraan = (new DateTime($usermt->{"tgl_perkiraan"}));
            $hariini = Carbon::Now();
            $hariiniformat = $hariini->format('d');

            //mencari tgl ke brp proses
             $tglKe = $tglMulai->diff($hariini);
             $tglkeFormat = $tglKe->d;

            //tgl berapa lama proses mt
            $diffDate = $tglPerkiraan->diff($tglMulai);
            $diffDateFormat = $diffDate->d;

            //persentase
            $persentase = ($tglkeFormat/$diffDateFormat)*100;
            $pembulatan = round($persentase);

            if($usermt->active == 2){
                $sukses = "<a href='#' class='badge badge-success'>Maintenance Selesai</a>";
                return $sukses;
            }else {
                if ($pembulatan >=100 && $usermt->active == 1){
                    $sukses = "<a href='#' class='badge badge-warning'>Belum Realisasi</a>";
                    return $sukses;
                }
                else if ($pembulatan >=100 && $usermt->active == 2){
                    $sukses = "<a href='#' class='badge badge-success'>Maintenance Selesai</a>";
                    return $sukses;
                } else {
                    $sukses = "<div class='progress'>
                    <div class='progress-bar bg-blue' role='progressbar' aria-valuenow='$pembulatan' aria-valuemin='0' aria-valuemax='100' style='width: $pembulatan%;color: black'>
                     <span class='sr-only'>$pembulatan% Complete</span><p class='text-dark'>$pembulatan %</p>
                    </div>
                    </div>";
                    return $sukses;
                }
            }

            return $sukses;
        })
        ->editColumn('tgl_realisasi', function($usermt) {
            $convertdate = (new DateTime($usermt->{"tgl_realisasi"}))->format('d-m-Y');
            return $convertdate;
        })
        ->editColumn('tgl_perkiraan', function($usermt) {
            $convertdate = (new DateTime($usermt->{"tgl_perkiraan"}))->format('d-m-Y');
            return $convertdate;
        })
        ->editColumn('asset', function($usermt) {

            $fixasset = AvianFixAsset::where('AssetID',$usermt->asset)
            ->get();

            if($fixasset){
                $sukses = $fixasset[0]->Kode .'-'. $fixasset[0]->Nama;
                return $sukses;
            }

        })
        ->editColumn('kategori', function($usermt) {

            $cekkategori = DB::table('category')->find($usermt->kategori);

            if($cekkategori){
                $sukses = $cekkategori->category;
                return $sukses;
            }

        })
        ->addColumn('action', function ($usermt) {
            $url_edit = url('backend/maintenance/'.$usermt->kode.'/edit');
            $url = url('backend/maintenance/'.$usermt->kode);
            $view = "<a class='btn-action btn btn-primary btn-view' href='".$url."' title='Lihat Detail'><i class='fa fa-eye'></i></a>";
            $edit = "<a class='btn-action btn btn-info btn-edit' href='".$url_edit."' title='Realisasi'><i class='fa fa-check'></i></a>";
            if($usermt->active == 1){
                $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
                return $view." ".$edit." ".$delete;
            }else{
                return $view;
            }

        })
        ->rawColumns(['action','kategori','asset','status'])
        ->make(true);

    }


}
