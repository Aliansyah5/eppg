<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Asset;
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
use App\Model\AvianFixAsset;

class FixAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 999;
        $kategori = 999;
        $assignee = 999;
        $lokasi = 999;
        $jenis = 999;
        $department = 999;
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
        if (isset($_GET["jenis"])){
            $jenis = $_GET['jenis'];
        }
        if (isset($_GET["department"])){
            $department = $_GET['department'];
        }
        if (isset($_GET["lokasi"])){
            $lokasi = $_GET['lokasi'];
        }
        if (isset($_GET["mode"])){
            $mode = $_GET['mode'];
        }


        $lokasis = collect(DB::connection('DB-AMS')
        ->select("SELECT lokasi FROM masset WHERE Kode IS NOT NULL AND lokasi != '' GROUP BY Lokasi ORDER BY lokasi ASC "));

        $jeniss = collect(DB::connection('DB-AMS')
        ->select("SELECT jenis FROM masset WHERE jenis != '' GROUP BY jenis ORDER BY jenis ASC "));

        $departments = collect(DB::connection('DB-AMS')
        ->select("SELECT Department FROM masset WHERE Kode IS NOT NULL AND Department != '' GROUP BY Department ORDER BY Department ASC "));

        $assignees = UserLogin::all('username');
        $kategoris = Kategori::all();

        return view ('backend.asset.index',
        compact('status',
        'startDate',
        'endDate',
        'mode',
        'jenis',
        'jeniss',
        'lokasi',
        'lokasis',
        'department',
        'departments'
    ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view ('backend.kategori.update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[]);

            $data = new AvianFixAsset();
            $data->MaintHour = $request->mainthour;

            $data->UpdateBy = Session::get('userinfo')['username'];
            if($data->save()){
                return Redirect::to('/backend/asset/')->with('success', "Data saved successfully")->with('mode', 'success');
            }


		return Redirect::to('/backend/asset/'.$id."/edit")
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
        //
		$fixasset = AvianFixAsset::where('No_', $id)->get();
		if ($fixasset->count() > 0){
			return view ('backend.asset.view', ['data' => $fixasset]);
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        //
        $data = AvianFixAsset::where('AssetID', $id)->get();
        $kategoris = Kategori::select('id','category')->where('active','!=','0')->orderBy('id', 'ASC')->get();

        $cekassetmt = Maintenance::where('asset', $id)->where('active','1')->get();

        $validator = Validator::make($request->all(),[]);

		if ($cekassetmt->count() > 0){
            $validator->getMessageBag()->add('Kode', 'Barang sudah terdaftar di Maintenance');
			return Redirect::to('/backend/asset/')
				->withErrors($validator)
				->withInput();
        }

        return view ('backend.asset.update', compact('data','kategoris'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */

     //function untuk mengirim data asset untuk dimasukan kedalam daftar maintenance

    public function update(Request $request, $id)
    {
        //
        $getRow = Maintenance::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        $lastId = $getRow->first();

        $kodemt = "MT00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kodemt = "MT0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kodemt = "MT000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kodemt = "MT00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kodemt = "MT0".''.($lastId->id + 1);
            } else {
                    $kodemt = "MT".''.($lastId->id + 1);
            }
        }

        $datamt = new Maintenance();

        $datamt->kode = $kodemt;
        $datamt->asset = $request->assetid;

        $datamt->kategori = $request->kategori;
        $datamt->tgl_perkiraan = $request->tgl_perkiraan;
        $datamt->tgl_realisasi = Carbon::today();
        $datamt->jenis = $request->jenis;
        $datamt->active = 1;
        $datamt->assignee = Session::get('userinfo')['username'];
        $datamt->tgl_lastmaintdate = $request->tgl_lastmaintdate;

        $datamt->created_at = Carbon::now();
        $datamt->user_add = Session::get('userinfo')['username'];
        $datamt->supervisor = Session::get('userinfo')['supervisor'];

        $dataAsset = AvianFixAsset::where('AssetID',$request->assetid)->first();
        $dataAsset->LastMaintDate = Carbon::today();
        //ketika blm maintenance flag 1 setelah perbaikan/maintenacne flag 2
        $dataAsset->Flag = 2;
        $dataAsset->update();

        $validator = Validator::make($request->all(),[]);

        if($request->tgl_perkiraan <= $datamt->tgl_realisasi){
            $validator->getMessageBag()->add('Kode', 'Tanggal perkiraan selesai maintenance tidak boleh kurang dari tanggal mulai');
            return Redirect::to('/backend/asset/'.$id."/edit")
            ->withErrors($validator)
            ->withInput();
        }

        $datamt->save();

        if($datamt->save()){
            return Redirect::to('/backend/asset/')->with('success', "Asset sudah dimasukkan kedalam list maintenance")->with('mode', 'success');
        }

		return Redirect::to('/backend/asset/'.$id."/edit")
				->withErrors($validator)
				->withInput();
    }

    public function waktu(Request $request, $id){

        $data = AvianFixAsset::where('AssetID', $id)->get();
        $kategoris = Kategori::select('id','category')->orderBy('id', 'ASC')->get();

        $validator = Validator::make($request->all(),[]);


		if ($data->count() > 0){
			return view ('backend.asset.waktu', compact('data','kategoris'));
		}
    }

    public function simpanwaktu(Request $request, $id) {

        $validator = Validator::make($request->all(),[]);

        $data = AvianFixAsset::where('AssetID',$id)->first();

        $data->MaintHour = $request->mainthour;

        if($request->mainthour < 0){
            $validator->getMessageBag()->add('Kode', 'Waktu tidak boleh minus');
			return Redirect::to('/backend/asset/'.$id."/waktu")
				->withErrors($validator)
				->withInput();
        }

        $data->UpdateBy = Session::get('userinfo')['username'];
                if($data->save()){
                    return Redirect::to('/backend/asset/')->with('success', "Data saved successfully")->with('mode', 'success');
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = Kategori::find($id);


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


        $status = 999;
        $kategori = 999;
        $assignee = 999;
        $lokasi = 999;
        $jenis = 999;
        $department = 999;
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
        if (isset($_GET["jenis"])){
            $jenis = $_GET['jenis'];
        }
        if (isset($_GET["department"])){
            $department = $_GET['department'];
        }
        if (isset($_GET["lokasi"])){
            $lokasi = $_GET['lokasi'];
        }
        if (isset($_GET["mode"])){
            $mode = $_GET['mode'];
        }


        if ($status == 999 ){
            $fixasset = collect(DB::connection('DB-AMS')
            ->select("SELECT masset.AssetID,masset.Kondisi,Kode, Nama, masset.Jenis ,
            Kat1,Department, masset.Lokasi, LastMaintDate ,
            DATE_ADD(Lastmaintdate,INTERVAL (mainthour/8) DAY) AS DueDate FROM masset WHERE Kode IS NOT NULL"));
        }

        //jika asset waktunya all
        if ($status == 1) {
            $fixasset = collect(DB::connection('DB-AMS')
                        ->select("SELECT * FROM
                        (SELECT masset.AssetID,masset.Kondisi,Kode, Nama, masset.Jenis ,
                        Kat1,Department, masset.Lokasi, LastMaintDate , Flag,
                        DATE_ADD(Lastmaintdate,INTERVAL (mainthour/8) DAY) AS DueDate FROM masset WHERE Kode IS NOT NULL AND Kode <> '')
                        AS asset
                        WHERE DATE(DueDate) > CURDATE() AND Flag = 1"));
        }
        //jika asset waktunya maintenance
        if ($status == 2) {
            $fixasset = collect(DB::connection('DB-AMS')
                            ->select("SELECT * FROM
                            (SELECT masset.AssetID,masset.Kondisi,Kode, Nama, masset.Jenis ,
                            Kat1,Department, masset.Lokasi, LastMaintDate , Flag,
                            DATE_ADD(Lastmaintdate,INTERVAL (mainthour/8) DAY) AS DueDate FROM masset WHERE Kode IS NOT NULL AND Kode <> '')
                            AS asset
                            WHERE DueDate IS NULL OR CURDATE() >= DATE(DueDate) - INTERVAL 1 WEEK AND Flag = 1"));
        }
        //jika asset waktunya sedang maintenance
        if ($status == 3) {
            $fixasset = collect(DB::connection('DB-AMS')
                            ->select("SELECT * FROM
                            (SELECT masset.AssetID,masset.Kondisi,Kode, Nama, masset.Jenis ,
                            Kat1,Department, masset.Lokasi, LastMaintDate , MaintHour,Flag,
                            DATE_ADD(Lastmaintdate,INTERVAL (mainthour/8) DAY) AS DueDate FROM masset WHERE Kode IS NOT NULL AND Kode <> '')
                            AS asset
                            WHERE Flag = 2"));
        }

        if ($mode != "all"){
            $fixasset = $fixasset->where('DueDate','>=', date('Y-m-d 00:00:00',strtotime($startDate)));
            $fixasset = $fixasset->where('DueDate','<=',date('Y-m-d 23:59:59',strtotime($endDate)));
        }

        if ($lokasi != 999){
            $fixasset = $fixasset->where('Lokasi','=', $lokasi);
        }

        if ($department != 999){
            $fixasset = $fixasset->where('Department','=', $department);
        }

        if ($jenis != 999){
            $fixasset = $fixasset->where('Jenis','=', $jenis);
        }


        return Datatables::of($fixasset)
            ->editColumn('Kondisi', function($fixasset) {
                if ($fixasset->{"Kondisi"} == "GOOD"){
                    $sukses = "<a href='#' class='badge badge-success'>Baik</a>";
                    return $sukses;
                }
                if ($fixasset->{"Kondisi"} == "DAMAGED"){
                    $sukses = "<a href='#' class='badge badge-warning'>Rusak</a>";
                    return $sukses;
                }
            })
            ->editColumn('LastMaintDate', function($fixasset) {
                if($fixasset->{"LastMaintDate"} === null){

                }else{
                    $sukses = (new DateTime($fixasset->{"LastMaintDate"}))->format('d-m-Y');
                    return $sukses;
                }

            })
            ->editColumn('DueDate', function($fixasset) {
                $convertdate = (new DateTime($fixasset->{"DueDate"}))->format('d-m-Y');
                return $convertdate;
            })
            ->editColumn('Status', function($fixasset) {

                // $dayBeforeMT = (new DateTime($fixasset->{"DueDate"}))->modify('-7 day')->format('Y-m-d');
                // $hariini = Carbon::now()->format('Y-m-d');

                // $asset = ($fixasset->AssetID);
                // $cekasset = Maintenance::where('asset',$asset)->where('active',1)->get()->count();

                //CEK STATUS PERBAIKAN STATUS MT

                // if($cekasset >= 1){
                //     $sukses = "<a href='#' class='badge badge-success'>Sedang Maintenance</a>";
                //     return $sukses;
                // }else{
                //     if (strtotime($hariini) >= strtotime($dayBeforeMT) ){
                //         $sukses = "<a href='#' class='badge badge-error'>Waktunya MT</a>";
                //         return $sukses;
                //     } else {
                //         $sukses = "<a href='#' class='badge badge-warning'>Blm Waktu MT</a>";
                //         return $sukses;
                //     }
                // }

            })
			->addColumn('action', function ($fixasset) {
				$url_edit = url('backend/asset/'.$fixasset->AssetID.'/waktu');
                $url = url('backend/asset/'.$fixasset->AssetID.'/edit');
                $edit = "<a class='btn-action btn btn-info btn-edit' href='".$url_edit."' title='Jam Mesin'><i class='fa fa-clock-o'></i></a>";
				$view = "<a class='btn-action btn btn-primary btn-edit' href='".$url."' title='Maintenance'><i class='fa fa-wrench'></i></a>";

				// $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
				return $view." ".$edit;
            })
            ->rawColumns(['action','Kondisi','Status'])
            ->make(true);

	}

}
