<?php


namespace App\Http\Controllers\Backend;

use Session;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\AvianFixAsset;
use App\Model\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DB;

use Redirect;

class DashboardController extends Controller {
	public function dashboard(Request $request) {


        $userinfo = Session::get('userinfo');
        if($userinfo['area'] == 'AAP'){
            $kodearea = 1;
        }if($userinfo['area'] == 'AAS'){
            $kodearea = 2;
        }else{
            $kodearea= 1;
        }

		if ($userinfo['priv'] != "VSUPER"){
			// return Redirect::to('/backend/questionnaire-user/');
        }

        if($kodearea == 2){

            $totalAsset = DB::connection('DB-AMS')->table('masset')->select([
                'masset.AssetID', 'masset.CabangID','masset.Kode','masset.Nama','masset.Kondisi','masset.LastMaintDate','masset.MaintHour'
            ])
            ->join('dassetmt as d', 'Masset.AssetID', '=', 'd.AssetID')
            ->whereRaw("masset.CabangID = $kodearea   AND Kode IS NOT NULL AND Kode <> '' AND Department IS NULL AND IsDel != 1 GROUP BY masset.Nama,
            (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA= Kode) ")
            ->get()->count();

        }else{

            $totalAsset = DB::connection('DB-AMS')->table('masset')->select([
                'masset.AssetID', 'masset.CabangID','masset.Kode','masset.Nama','masset.Kondisi','masset.LastMaintDate','masset.MaintHour'
            ])
            ->join('dassetmt as d', 'Masset.AssetID', '=', 'd.AssetID')
            ->whereRaw("Kode IS NOT NULL AND Kode <> '' AND Department IS NULL AND IsDel != 1 GROUP BY masset.Nama,
            (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA= Kode) ")
            ->get()->count();

        }




        //$totalAsset = AvianFixAsset::where('Kode','!=',NULL)->where('Kode','<>','')->whereNull('Department')->where('CabangID', $kodearea)->count();
        $totalPerbaikan = Maintenance::where('active','=','1')
        ->leftJoin('avian.masset', 'master_mt.asset', '=', 'avian.masset.AssetID')
        ->where('avian.masset.CabangID', $kodearea)->count();

        //pie chart donught maintenance asset per kategori
        // $katMekanik = Maintenance::where('kategori',1)->count();
        // $katElektrik = Maintenance::where('kategori',2)->count();
        $KategoriMT = DB::select(("SELECT COUNT(*) AS total, category.category AS nama FROM master_mt
        INNER JOIN category ON category.id = master_mt.kategori
        LEFT JOIN avian.masset on master_mt.asset = avian.masset.AssetID
        WHERE masset.cabangid = '$kodearea'
        AND master_mt.active != 0 GROUP BY kategori "));


        //pie chart donught maintenance asset per kategori
        $SelesaiMT=  Maintenance::select(['master_mt.*','category.category', 'masset.CabangID',
        DB::raw('avian.masset.Kode as Kode_Asset'),
        DB::raw('avian.masset.Nama as Nama_Asset')])
        ->leftJoin('category', 'category.id', '=', 'master_mt.kategori')
        ->leftJoin('avian.masset', 'master_mt.asset', '=', 'avian.masset.AssetID')
        ->where('master_mt.active','=',2)
        ->where('masset.CabangID','=',$kodearea)->count();


        $ProsesMT=  Maintenance::select(['master_mt.*','category.category', 'masset.CabangID',
        DB::raw('avian.masset.Kode as Kode_Asset'),
        DB::raw('avian.masset.Nama as Nama_Asset')])
        ->leftJoin('category', 'category.id', '=', 'master_mt.kategori')
        ->leftJoin('avian.masset', 'master_mt.asset', '=', 'avian.masset.AssetID')
        ->where('master_mt.active','=',1)
        ->where('masset.CabangID','=',$kodearea)->count();

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
        ->whereRaw("masset.CabangID = $kodearea   AND Kode IS NOT NULL AND Kode <> '' AND Department IS NULL AND IsDel != 1 GROUP BY masset.Nama,
        (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA= Kode) ");


        $overdue = $fixasset->havingRaw('Target > JumMT');
        $overdue = $fixasset->havingRaw('CURDATE() > nextmt ')->get()->count();


        $failedMT=  Maintenance::select(['master_mt.*','category.category', 'masset.CabangID',
        DB::raw('avian.masset.Kode as Kode_Asset'),
        DB::raw('avian.masset.Nama as Nama_Asset'),
        DB::raw('(SELECT H.created_at FROM aviamaintenance.master_mt H, aviamaintenance.detail_mt dmt
            WHERE H.id=dmt.Id AND dmt.kodekomponen=D.nama AND dmt.assetID=d.assetID ORDER BY H.created_at DESC LIMIT 1) as terakhirmt')

        ])
        ->leftJoin('category', 'category.id', '=', 'master_mt.kategori')
        ->leftJoin('avian.masset', 'master_mt.asset', '=', 'avian.masset.AssetID')
        ->join('avian.dassetmt as d', 'aviamaintenance.master_mt.asset', '=', 'd.AssetID')
        ->where('master_mt.active','=',2)
        ->where('masset.CabangID','=',$kodearea);





        // $SelesaiMT = Maintenance::where('active',2)->count();
        // $ProsesMT = Maintenance::where('active',1)->count();

        //bar chart total maintenance per bulan
        $PerBulanMT = DB::select(("SELECT COUNT(*) AS total, DATE_FORMAT(tgl_realisasi, '%m/%Y') AS bulan,
        CASE
        WHEN masset.CabangID = 1 THEN 'Pusat'
        WHEN masset.CabangID = 30 THEN 'Serang'
        ELSE 'Pusat'
        END AS Cabang
        FROM master_mt LEFT JOIN avian.masset on master_mt.asset = avian.masset.AssetID WHERE active = 2
        AND masset.cabangid = '$kodearea' GROUP BY bulan"));


        $PerCabangMT = DB::select(("SELECT COUNT(*) AS total, DATE_FORMAT(tgl_realisasi, '%m/%Y') AS bulan,
        CASE
        WHEN masset.CabangID = 1 THEN 'Pusat'
        WHEN masset.CabangID = 2 THEN 'Serang'
        ELSE 'Pusat'
        END AS Cabang
        FROM aviamaintenance.master_mt LEFT JOIN avian.masset ON master_mt.asset = avian.masset.AssetID WHERE active = 2
        GROUP BY Cabang
        "));

        $totalCabang = [];
        foreach ($PerCabangMT as $det):
            array_push($totalCabang, $det->total);
        endforeach;



        $cabang = [];
        foreach ($PerCabangMT as $det):
            array_push($cabang, $det->Cabang);
        endforeach;






        $total = [];
        foreach ($PerBulanMT as $det):
            array_push($total, $det->total);
        endforeach;



        $bulan = [];
        foreach ($PerBulanMT as $det):
            array_push($bulan, $det->bulan);
        endforeach;

        $totalKategori = [];
        foreach ($KategoriMT as $det):
            array_push($totalKategori, $det->total);
        endforeach;

        $namaKategori = [];
        foreach ($KategoriMT as $det):
            array_push($namaKategori, $det->nama);
        endforeach;


        //bar dashboard status perbulan


        // $dayBeforeMT = (new DateTime($fixasset->{"DueDate"}))->modify('-7 day')->format('Y-m-d');
        // $hariini = Carbon::now()->format('Y-m-d');

        return view ('backend.dashboard',compact('totalAsset','totalPerbaikan', 'SelesaiMT', 'ProsesMT', 'PerBulanMT',
        'total','bulan','totalKategori','namaKategori','kodearea','totalCabang','cabang','overdue'));
	}
}
