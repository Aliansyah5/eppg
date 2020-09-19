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
use App\Model\Dassetmt;
use App\Model\Detailmt;
use App\Model\Pic;
use Auth;

class FixAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        //$test = Auth::user()->username;
        $userinfo = Session::get('userinfo');


        $status = 999;
        $kategori = 999;
        $assignee = 999;
        $lokasi = 999;
        $jenis = 999;
        $kondisi = 999;
        $kode = '';
        $nama = '';
        $department = 999;
    	$startDate = "01"."-".date('m-Y');
        $endDate = date('d-m-Y');
        $mode = "all";

        //dd(AvianFixAsset::with('dassetmt')->where('AssetID','3101')->get());

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
        if (isset($_GET["kondisi"])){
            $kondisi = $_GET['kondisi'];
        }
        if (isset($_GET["department"])){
            $department = $_GET['department'];
        }
        if (isset($_GET["lokasi"])){
            $lokasi = $_GET['lokasi'];
        }
        if ((!isset($_GET["mode"])) && (isset($_GET['startDate']))){
            $mode = "limited";
         }
        // if (isset($_GET['mode'])) {
        //     $mode = $_GET['mode'];
        // }
        if (isset($_GET["kode"])){
            $kode = $_GET['kode'];
        }
        if (isset($_GET["nama"])){
            $nama = $_GET['nama'];
        }


        $lokasis = collect(DB::connection('DB-AMS')
        ->select("SELECT lokasi FROM masset WHERE Kode IS NOT NULL AND Department IS NULL AND lokasi != '' GROUP BY Lokasi ORDER BY lokasi ASC "));

        $jeniss = collect(DB::connection('DB-AMS')
        ->select("SELECT jenis FROM masset WHERE jenis != '' AND Department IS NULL GROUP BY jenis ORDER BY jenis ASC "));

        $departments = collect(DB::connection('DB-AMS')
        ->select("SELECT Department FROM masset WHERE Kode IS NOT NULL AND Department != '' AND Department IS NULL GROUP BY Department ORDER BY Department ASC "));

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
        'kondisi',
        'lokasis',
        'kode',
        'nama',
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

            $data->UpdateBy  =  Session::get('userinfo')['id'];


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

        //mencari list komponen asset yang harus dimaintenance
        //mencari target terlebih dahulu
        //kemudian mencari realhour meter
        //target = list jumlah target komponen yagn harus dimaintenance
        //mencari jumlah komponen yang sudah dimaintenance
        //jadi untuk menampilkan asset komponen yang harus dimaintenance target > jummt

        $listkomponenmt = DB::connection('DB-AMS')->table('masset')->select([
            'masset.AssetID','masset.Kode','masset.Nama','masset.Kondisi','masset.LastMaintDate','masset.MaintHour'
            ,'masset.Jenis','masset.Lokasi','masset.Department','masset.Flag','d.Nama as Komponen',

            DB::raw('(masset.Mainthour+
            CASE WHEN masset.IsDel IN (0,3) THEN 0 ELSE
            (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = masset.assetid AND dmt.kodeKomponen =
            d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate))*5) END ) AS realhourmeter'),

            DB::raw('DATE_ADD(Lastmaintdate,INTERVAL (mainthour/8) DAY) AS DueDate'),

            DB::raw('SUM((masset.Mainthour+  CASE WHEN masset.IsDel IN (0,3) THEN 0 ELSE (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at
            FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = masset.assetid AND dmt.kodeKomponen =
      d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate ))*5 ) END ) DIV D.hourmeter) AS Target'),

            DB::raw('(SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA=masset.Kode AND t.kodekomponen=d.nama  ) AS JumMT'),
             'm.Sat as Sat', 'm.Stok as Stok'
        ])
        ->join('dassetmt as d', 'Masset.AssetID', '=', 'd.AssetID')
        ->leftjoin('mspart as m', 'd.KodeNAV', '=', 'm.Kode')
        ->whereRaw("masset.Kode IS NOT NULL AND masset.Kode <> '' AND Department IS NULL  ")
        ->where('d.AssetID', $id)
        ->where(DB::raw('(masset.Mainthour+  CASE WHEN masset.IsDel IN (0,3) THEN 0 ELSE (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at
        FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = masset.assetid AND dmt.kodeKomponen =
  d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate ))*5 ) END ) DIV D.hourmeter'), '>',
        DB::raw('(SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA= masset.Kode AND t.kodekomponen=d.nama)'))
        ->groupByRaw('masset.Nama')
        ->get();







        $historymt = Maintenance::with('detailmt')->where('asset',$id)->where('active',2)->orderby('created_at','DESC')->get();



        $data = AvianFixAsset::with('dassetmt')

        ->select(['masset.*',

        DB::raw('(masset.Mainthour+
        CASE WHEN masset.IsDel IN (0,3) THEN 0 ELSE
        (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = masset.assetid AND dmt.kodeKomponen =
        d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate))*5) END ) AS realhourmeter'),

        DB::raw('DATE_ADD(IFNULL((SELECT H.Tgl_selesaimt FROM aviamaintenance.master_mt H, aviamaintenance.detail_mt dmt
            WHERE H.id=dmt.Id AND dmt.kodekomponen=D.nama AND dmt.assetID=d.assetID ORDER BY H.tgl_selesaimt DESC LIMIT 1),masset.LastMaintDate),
            INTERVAL D.Hourmeter/5 DAY) AS nextmt')

        ])

        ->join('dassetmt as d', 'Masset.AssetID', '=', 'd.AssetID')
        ->where('masset.AssetID', $id)->get();


        //dd($data);


        $kategoris = Kategori::select('id','category')->where('active','!=','0')->orderBy('id', 'ASC')->get();


        $pics = Pic::select('pic.id','nama','category.category')->where('pic.active','!=','0')
        ->join('category', 'pic.seksi', '=', 'category.id')
        ->where('cabangid',$data[0]->CabangID)->orderBy('id', 'ASC')->get();

        $komponent = Dassetmt::where('AssetID',$id)->orderBy('Idx','ASC')->get();

        $usersection = strtoupper(Session::get('userinfo')['section']);


        if($usersection != 'ALL'){
            $kategoris = $kategoris->where('category', $usersection);
            $pics = $pics->where('category', $usersection);
        }



        $cekassetmt = Maintenance::where('asset', $id)->where('active','1')->get();

        $validator = Validator::make($request->all(),[]);

		// if ($cekassetmt->count() > 0){
        //     $validator->getMessageBag()->add('Kode', 'Barang sudah terdaftar di Maintenance');
		// 	return Redirect::to('/backend/asset/')
		// 		->withErrors($validator)
		// 		->withInput();
        // }

        return view ('backend.asset.update', compact('data','kategoris','listkomponenmt','historymt','komponent','pics'));
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
        //$datamt->assignee = Session::get('userinfo')['username'];
        $datamt->assignee = $request->pic;

        $datamt->tgl_lastmaintdate = $request->tgl_lastmaintdate;

        $datamt->keterangan = $request->keterangan;

        if(count($request->komponen) > 0)
        {
            $datamt->komponen = join(',', $request->komponen);
        }

        $datamt->HourMeter = $request->realhourmeter;

        //$datamt->tgl_selesaimt = Carbon::today();

        //mencari lama data mt

        $tglStartMT = (new DateTime($request->tgl_maintenance));
        $tglSekarang = Carbon::today();
        $lamaMT = $tglSekarang->diff($tglStartMT);
        $lamaMTFormat = $lamaMT->d;

        $datamt->lama_mt = $lamaMTFormat;

        $datamt->created_at = Carbon::now();
        $datamt->user_add = Session::get('userinfo')['username'];
        $datamt->supervisor = Session::get('userinfo')['supervisor'];

        $validator = Validator::make($request->all(),[]);

        //dd($datamt->tgl_realisasi);

        if($request->tgl_perkiraan < $datamt->tgl_realisasi->format('Y-m-d')){
            $validator->getMessageBag()->add('Kode', 'Tanggal perkiraan selesai maintenance tidak boleh kurang dari tanggal mulai');
            return Redirect::to('/backend/asset/'.$id."/edit")
            ->withErrors($validator)
            ->withInput();
        }


        $datamt->save();


        //menyimpan detail detailmt detaim_mt
         // "_method" => "PUT"
        // "_token" => "urAq3svkPtfS4WtYCp5szv2p24KqiHNoCawmxK1A"
        // "kondisi" => null
        // "kode" => "PM00958"
        // "assetid" => "3900"
        // "asset" => null
        // "jenis" => null
        // "kategori" => "1"
        // "lokasi" => "PRMK-SM"
        // "tgl_lastmaintdate" => "2020-04-01 00:00:00"
        // "komponen" => "Oli Regulator"
        // "qty" => null
        // "tgl_maintenance" => "2020-07-10"
        // "tgl_perkiraan" => "2020-07-10"
        // "keterangan" => "asdasd"   $getRow = Maintenance::orderBy('id', 'DESC')->get();


        $getLastIDMT = Maintenance::orderBy('id', 'DESC')->get();
        $rowCount = $getLastIDMT->count();
        $IdMt = $getLastIDMT->first();


        if(!empty($request->komponen) && !empty($request->qty)){

           for ($i=0; $i <= count($request->komponen) - 1 ; $i++) {

            $detailmt = new Detailmt();
            $detailmt->id = $IdMt->id;
            $detailmt->Idx = $i + 1;
            $detailmt->kodeFA = $request->kode;
            $detailmt->kodeKomponen= $request->komponen[$i];
            $detailmt->Qty = $request->qty[$i];
            $detailmt->assetid = $request->assetid;
            $detailmt->user_add = Session::get('userinfo')['username'];
            $detailmt->created_at= Carbon::now();

            $detailmt->save();

           }


        }


        //dd($detailmt);

        $dataAsset = AvianFixAsset::where('AssetID',$request->assetid)->first();
        //$dataAsset->LastMaintDate = Carbon::today();
        $dataAsset->UpdateBy =  Session::get('userinfo')['id'];
        $dataAsset->UpdateDate = Carbon::today();
        // $dataAsset->MaintHour = $request->realhourmeter;
       // $dataAsset->MaintHour = $request->realhourmeter;
        //ketika blm maintenance flag 1 setelah perbaikan/maintenacne flag 2
        $dataAsset->Flag = 1;
        $dataAsset->update();





        if($datamt->save()){
            return Redirect::to('/backend/asset/')->with('success', "Asset sudah dimasukkan kedalam list maintenance")->with('mode', 'success');
        }

		return Redirect::to('/backend/asset/'.$id."/edit")
				->withErrors($validator)
				->withInput();
    }

    public function waktu(Request $request, $id){

        $data = AvianFixAsset::select(['masset.*', DB::raw('(Mainthour+ (DATEDIFF(SYSDATE(), LastMaintDate )*5)) AS realhourmeter')])
        ->where('AssetID', $id)->get();



        $kategoris = Kategori::select('id','category')->where('active',1)->orderBy('id', 'ASC')->get();



        $validator = Validator::make($request->all(),[]);

        $komponen =  Dassetmt::with('mspart')->where('AssetID', $id)->get();



        $userinfo = Session::get('userinfo');
        if($userinfo['area'] == 'AAP'){
            $kodearea = 1;
        }if($userinfo['area'] == 'AAS'){
            $kodearea = 2;
        }else{
            $kodearea= 1;
        }




		return view ('backend.asset.waktu', compact('data','kategoris','komponen','kodearea'));

    }

    public function simpanwaktu(Request $request, $id) {


        //looping save dari komponen asset ke dassetmt



        $validator = Validator::make($request->all(),[]);

        $data = AvianFixAsset::where('AssetID',$id)->first();

        $data->MaintHour = $request->mainthourasset;
        $data->IsDel = $request->isdel;
        $data->Seksi = $request->seksi;
        $data->UpdateBy =  Session::get('userinfo')['id'];



        //simpan data komponen

        for ($i=0; $i <= count($request->assetid) - 1 ; $i++) {

            if($request->hourmeter[$i] < 0){
                $validator->getMessageBag()->add('Kode', 'Waktu tidak boleh minus');
                return Redirect::to('/backend/asset/'.$id."/waktu")
                    ->withErrors($validator)
                    ->withInput();
            }

            Dassetmt::where('Idx', $request->idx[$i])
            ->where('AssetID', $request->assetid[$i])
            ->update(['HourMeter' => $request->hourmeter[$i]]);

        }


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
        $kondisi = 999;
        $kode = '';
        $nama = '';
    	$startDate = "01"."-".date('m-Y');
        $endDate = date('d-m-Y');
        $mode = "limited";

        $userinfo = Session::get('userinfo');
        if($userinfo['area'] == 'AAP'){
            $kodearea = 1;
        }if($userinfo['area'] == 'AAS'){
            $kodearea = 2;
        }else{
            $kodearea= 1;
        }


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
        if (isset($_GET["kondisi"])){
            $kondisi = $_GET['kondisi'];
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
        if (isset($_GET["kode"])){
            $kode = $_GET['kode'];
        }
        if (isset($_GET["nama"])){
            $nama = $_GET['nama'];
        }


        // $fixasset = AvianFixAsset::with('dassetmt')->select(['masset.*',
        // DB::raw('DATE_ADD(Lastmaintdate,INTERVAL (mainthour/8) DAY) AS DueDate'),
        // DB::raw('MaintHour + (DATEDIFF(SYSDATE(), LastMaintDate)* 5)  AS RealMaintHour'),

        // ])
        // ->whereRaw("Kode IS NOT NULL AND Kode <> '' AND Department IS NULL AND IsDel = 0 ");

        // dd($fixasset->take(10)->get());

        // dd($fixasset->take(10)->get());



        $fixasset = DB::connection('DB-AMS')->table('masset')->select([
            'masset.AssetID','masset.Kode','masset.CabangID','masset.Nama','masset.Kondisi','masset.LastMaintDate','masset.MaintHour'
            ,'masset.Jenis','masset.Lokasi','masset.Department','masset.Flag','masset.IsDel',
            DB::raw('DATE_ADD(Lastmaintdate,INTERVAL (mainthour/8) DAY) AS DueDate'),

            DB::raw('IFNULL((SELECT H.created_at FROM aviamaintenance.master_mt H, aviamaintenance.detail_mt dmt
            WHERE H.id=dmt.Id AND dmt.kodekomponen=D.nama AND dmt.assetID=d.assetID ORDER BY H.created_at DESC LIMIT 1),masset.LastMaintDate) AS terakhirmt'),

            DB::raw('DATE_ADD(IFNULL((SELECT H.created_at FROM aviamaintenance.master_mt H, aviamaintenance.detail_mt dmt
            WHERE H.id=dmt.Id AND dmt.kodekomponen=D.nama AND dmt.assetID=d.assetID ORDER BY H.created_at DESC LIMIT 1),masset.LastMaintDate),
            INTERVAL D.Hourmeter/5 DAY) AS nextmt'),

            DB::raw('(masset.Mainthour+
            CASE WHEN IsDel IN (0,3) THEN 0 ELSE
            (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = masset.assetid AND dmt.kodeKomponen =
            d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate))*5) END ) AS realhourmeter'),

            DB::raw('(SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA=Masset.Kode ) AS JumMT'),
            DB::raw("IFNULL((SELECT SUM(Target)
            FROM (SELECT masset.AssetID, masset.Kode, masset.Nama, masset.Kondisi, masset.LastMaintDate,
            masset.MaintHour, masset.Jenis, masset.Lokasi, masset.Department, masset.Flag, d.Nama AS Komponen,

                  (masset.Mainthour+  CASE WHEN masset.IsDel IN (0,3) THEN 0 ELSE (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at
                        FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = masset.assetid AND dmt.kodeKomponen =
                  d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate ))*5 ) END ) DIV D.hourmeter AS Target,

                  (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA=masset.Kode AND t.kodekomponen=d.nama  ) AS JumMT, m.Sat AS Sat,

                  m.Stok AS Stok
                  FROM masset INNER JOIN dassetmt AS d ON Masset.AssetID = d.AssetID

                  LEFT JOIN mspart AS m ON d.KodeNAV = m.Kode
                  WHERE masset.Kode IS NOT NULL AND masset.Kode <> '' AND Department IS NULL
                  AND (masset.Mainthour+  CASE WHEN masset.IsDel IN (0,3) THEN 0 ELSE (DATEDIFF(SYSDATE(),
                  IFNULL((SELECT created_at FROM aviamaintenance.detail_mt AS dmt
                  WHERE dmt.id = masset.assetid AND dmt.kodeKomponen = d.nama
                  ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate ))*5 ) END ) DIV D.hourmeter
                  >
                  (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA= masset.Kode AND t.kodekomponen=d.nama )) AS test
                  WHERE Kode = masset.Kode),0) as Target ")
        ])
        ->join('dassetmt as d', 'Masset.AssetID', '=', 'd.AssetID')
        ->whereRaw("masset.CabangID = $kodearea   AND Kode ='PK00240' AND Kode <> '' AND Department IS NULL AND IsDel != 1 GROUP BY masset.Nama,
        (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA= Kode) ");

        //AND KODE = 'PM00369'

        //dd($fixasset->toSql());

        //dd($fixasset->get());


        // SUM(((MaintHour + (DATEDIFF(SYSDATE(), LastMaintDate)* 5)) DIV d.HourMeter)) AS Target,
        // (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA= Kode) AS jummt

        //     $fixasset = collect(DB::select(

        //         "
        //         SELECT M.*,D.Nama,D.HourMeter, -- M.MaintHour,
        // (M.Mainthour+ (DATEDIFF(SYSDATE(), m.LastMaintDate )*5)) AS realhourmeter,
        // (M.Mainthour+ (DATEDIFF(SYSDATE(), m.LastMaintDate )*5)) DIV D.hourmeter AS Target,
        // (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA=M.Kode AND t.kodekomponen=d.nama  ) AS jummt
        // FROM avian.Masset M
        // INNER JOIN avian.DassetMT D ON (D.AssetID=M.AssetID)
        //         "

        //         ));


        // if($userinfo['area'] == "AAS") {
        //     $fixasset = $fixasset->havingRaw('masset.CabangID = 2');
        // }



        //jika asset belum waktu mt
        if ($status == 1) {
            $fixasset = $fixasset->havingRaw('JumMT >= Target');
        }

        // dd($fixasset->tosql());

        //jika asset waktunya maintenance
        if ($status == 2) {
            $fixasset = $fixasset->havingRaw('JumMT < Target');
        }

        //jika asset waktunya sedang maintenance
        if ($status == 3) {
            $fixasset = $fixasset->whereRaw("Flag = 2");

        }

        // if ($mode != "all"){
        //     $fixasset = $fixasset->orWhereNull('nextmt')
        //     ->where(DB::raw('DATE_ADD(nextmt,INTERVAL (mainthour/8) DAY)'),'>=', date('Y-m-d 00:00:00',strtotime($startDate)));
        //     $fixasset = $fixasset->where(DB::raw('DATE_ADD(nextmt,INTERVAL (mainthour/8) DAY)'),'<=',date('Y-m-d 23:59:59',strtotime($endDate)));
        // }


        if ($mode != "all"){
            $fixasset = $fixasset->havingBetween('nextmt',[date('Y-m-d 00:00:00',strtotime($startDate)),
             date('Y-m-d 23:59:59',strtotime($endDate))] );
            //$query->whereBetween('age', [$ageFrom, $ageTo]);
        }


        if ($lokasi != 999){
            $fixasset = $fixasset->where('Lokasi','=', $lokasi);
        }

        if ($department != 999){
            $fixasset = $fixasset->where('Department','=', $department);
        }

        if ($kondisi != 999){
            $fixasset = $fixasset->where('Kondisi','=', $kondisi);
        }

        if ($jenis != 999){
            $fixasset = $fixasset->where('Jenis','=', $jenis);
        }

        if ($kode != null || $kode != ''){
            $fixasset = $fixasset->havingRaw(DB::raw("masset.Kode LIKE '%".$kode."%'"));
        }

        if ($nama != null || $nama != ''){
            $fixasset = $fixasset->havingRaw(DB::raw("masset.Nama LIKE '%".$nama."%'"));
        }



        $fixasset = $fixasset->get();

        return Datatables::of($fixasset)
            ->editColumn('terakhirmt', function($fixasset) {
                if($fixasset->{"terakhirmt"} === null){

                }else{
                    $sukses = (new DateTime($fixasset->{"terakhirmt"}))->format('d-m-Y');
                    return $sukses;
                }

            })
            ->editColumn('DueDate', function($fixasset) {
                $convertdate = (new DateTime($fixasset->{"DueDate"}))->format('d-m-Y');
                return $convertdate;
            })
            ->editColumn('HourMeter', function($fixasset) {
                if ($fixasset->{"IsDel"} != 2 ){
                    $sukses = $fixasset->{"MaintHour"};
                    return $sukses;
                } else{
                    $sukses = $fixasset->{"realhourmeter"};
                    return $sukses;
                }
            })

            ->editColumn('cabang', function($usermt) {
                if ($usermt->CabangID   == 2){
                    $sukses = "<a href='#' class='badge badge-primary'>Serang</a>";
                    return $sukses;
                }
                else {
                    $sukses = "<a href='#' class='badge badge-default'>Pusat</a>";
                    return $sukses;
                }
            })
            ->editColumn('nextmt', function($fixasset) {
                $convertdate = (new DateTime($fixasset->{"nextmt"}))->format('d-m-Y');
                return $convertdate;
            })
            ->editColumn('Status', function($fixasset) {
                $dayBeforeMT = (new DateTime($fixasset->{"DueDate"}))->modify('-7 day')->format('Y-m-d');
                $hariini = Carbon::now()->format('Y-m-d');

                if ($fixasset->{"Flag"} == 2){
                    $sukses = "<a href='#' class='badge badge-success'>Sedang Maintenance</a>";
                    return $sukses;
                }else{

                    //debug cek jummt & target di datatable
                    // $sukses = $fixasset->{"JumMT"} . " - " . $fixasset->{"Target"} ;
                    // return $sukses;

                    //koding cek maintenance
                    if($fixasset->{"JumMT"} < $fixasset->{"Target"} ){
                        $sukses = "<a href='#' class='badge badge-error'>Waktunya MT</a>";
                        return $sukses;

                    } else if($fixasset->{"JumMT"} >= $fixasset->{"Target"} ) {
                        $sukses = "<a href='#' class='badge badge-warning'>Blm Waktu MT</a>";
                        return $sukses;

                    }
                }

            })
			->addColumn('action', function ($fixasset) {
				$url_edit = url('backend/asset/'.$fixasset->AssetID.'/waktu');
                $url = url('backend/asset/'.$fixasset->AssetID.'/edit');
                $edit = "<a class='btn-action btn btn-info btn-edit' href='".$url_edit."' title='Hour Meter'><i class='fa fa-clock-o'></i></a>";
				$view = "<a class='btn-action btn btn-primary btn-edit' href='".$url."' title='Maintenance'><i class='fa fa-wrench'></i></a>";

                if ($fixasset->Flag == 2){
                    $view = '';
                }
				// $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
				return $view." ".$edit;
            })
            ->rawColumns(['action','Kondisi','Status','HourMeter','cabang'])
            ->make(true);

	}

}
