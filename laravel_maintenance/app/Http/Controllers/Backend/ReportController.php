<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Model\CampaignH;
use App\Model\Kategori;
use App\Model\UserLogin;
use App\Model\Maintenance;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use App\Exports\GeneralReport;
use Excel;
use DateTime;
use Carbon\Carbon;
use App\Model\UserGroup;


class ReportController extends Controller
{
    public function general_report(Request $request)
    {
        //
        $status = 999;
        $kategori = 999;
        $assignee = 999;
        $lokasi = 999;
        $kode = '';
        $nama = '';
    	$startDate = "01"."-".date('m-Y');
        $endDate = date('d-m-Y');
        $mode = "limited";


        if (isset($_GET["startDate"]) || isset($_GET["endDate"]) || isset($_GET["mode"])){
			if ((isset($_GET['startDate'])) && ($_GET['startDate'] != "")){
				$startDate = $_GET["startDate"];
			}
			if ((isset($_GET['endDate'])) && ($_GET['endDate'] != "")){
				$endDate = $_GET["endDate"];
            }
			if (isset($_GET["mode"])){
				$mode = $_GET['mode'];
            }
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
        if (isset($_GET["lokasi"])){
            $lokasi = $_GET['lokasi'];
        }
        if (isset($_GET["kode"])){
            $kode = $_GET['kode'];
        }
        if (isset($_GET["nama"])){
            $nama = $_GET['nama'];
        }
        if (isset($_GET['export'])){
            return Excel::download(new GeneralReport($startDate, $endDate, $status, $kategori, $assignee, $lokasi, $mode), 'General Report.xlsx');
        }

        $lokasis = collect(DB::connection('DB-AMS')
        ->select("SELECT lokasi FROM masset WHERE Kode IS NOT NULL AND Department IS NULL AND lokasi != '' GROUP BY Lokasi ORDER BY lokasi ASC "));
        $assignees = UserLogin::all('username');
        $kategoris = Kategori::select('id','category')->where('active',1)->orderBy('id', 'ASC')->get();

        view()->share('status', $status);
        view()->share('kategoris', $kategoris);
        view()->share('kode', $kode);
        view()->share('nama', $nama);
        view()->share('kategori', $kategori);
        view()->share('lokasis', $lokasis);
        view()->share('lokasi', $lokasi);
        view()->share('assignees', $assignees);
        view()->share('assignee', $assignee);
		view()->share('startDate',$startDate);
		view()->share('endDate',$endDate);
        view()->share('mode',$mode);

        return view ('backend.report.general_report');
    }

	public function general_report_datatable() {

        $status = 999;
        $kategori = 999;
        $assignee = 999;
        $lokasi = 999;
        $kode = '';
        $nama = '';
        $userinfo = Session::get('userinfo');
    	$startDate = "01"."-".date('m-Y');
        $endDate = date('d-m-Y');
        $mode = "limited";
        if (isset($_GET["startDate"]) || isset($_GET["endDate"]) || isset($_GET["mode"])){
			if ((isset($_GET['startDate'])) && ($_GET['startDate'] != "")){
				$startDate = $_GET["startDate"];
			}
			if ((isset($_GET['endDate'])) && ($_GET['endDate'] != "")){
				$endDate = $_GET["endDate"];
            }
			if (isset($_GET["mode"])){
				$mode = $_GET['mode'];
            }
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
        if (isset($_GET["lokasi"])){
            $lokasi = $_GET['lokasi'];
        }
        if (isset($_GET["kode"])){
            $kode = $_GET['kode'];
        }
        if (isset($_GET["nama"])){
            $nama = $_GET['nama'];
        }


        $data = Maintenance::select(['master_mt.*','category.category',DB::raw('avian.masset.Kode as Kode_Asset'),
        DB::raw('avian.masset.Nama as Nama_Asset'), 'avian.masset.MaintHour', 'avian.masset.lokasi'])
        ->leftJoin('category', 'category.id', '=', 'master_mt.kategori')
        ->leftJoin('avian.masset', 'master_mt.asset', '=', 'avian.masset.AssetID')
        ->orWhereRaw('master_mt.active = 2');


        //cek mode
        if ($mode != "all"){
            $data = $data->where('master_mt.created_at','>=', date('Y-m-d 00:00:00',strtotime($startDate)));
            $data = $data->where('master_mt.created_at','<=',date('Y-m-d 23:59:59',strtotime($endDate)));
        }

        //mencari asset yang proses maintenance
        if ($status == 1){
            $data = $data->whereRaw(DB::raw("master_mt.tgl_selesaimt > master_mt.tgl_perkiraan"));

        }

        //mencari asset yang belum realisasi
        if ($status == 2){
            $data = $data->whereRaw(DB::raw("master_mt.tgl_selesaimt <= master_mt.tgl_perkiraan"));
        }

         //mencari asset yang selesai maintenance
         if ( $status == 3){
            $data = $data->whereNotNull('tgl_selesaimt')->whereNotNull('lama_mt');
        }


        if ($kategori != 999){
            $data = $data->where('kategori','=', $kategori);
        }

        if ($assignee != 999){
            $data = $data->where('assignee','=',$assignee);
        }

        if ($lokasi != 999){
            $data = $data->where('lokasi','=', $lokasi);
        }
        if ($kode != null || $kode != ''){
            $data = $data ->whereRaw(DB::raw("avian.masset.Kode LIKE '%".$kode."%'"));
        }

        if ($nama != null || $nama != ''){
            $data = $data ->whereRaw(DB::raw("avian.masset.Nama LIKE '%".$nama."%'"));
        }




        return Datatables::of($data)
        ->editColumn('status', function($data) {

            $tglMulai = (new DateTime($data->{"tgl_realisasi"}));
            $tglPerkiraan = (new DateTime($data->{"tgl_perkiraan"}));
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

            if($data->active == 2){
                $sukses = "<a href='#' class='badge badge-success'>Maintenance Selesai</a>";
                return $sukses;
            }else {
                if ($pembulatan >=100 && $data->active == 1){
                    $sukses = "<a href='#' class='badge badge-warning'>Belum Realisasi</a>";
                    return $sukses;
                }
                else if ($pembulatan >=100 && $data->active == 2){
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
        ->editColumn('lama_mt', function($data) {
            $lama_mt = ($data->{"lama_mt"}.' Hari');
            return $lama_mt;
        })
        ->editColumn('MaintHour', function($data) {
            $MaintHour = ($data->{"MaintHour"}.' Jam');
            return $MaintHour;
        })
        ->editColumn('tgl_realisasi', function($data) {
            $convertdate = (new DateTime($data->{"tgl_realisasi"}))->format('d-m-Y');
            return $convertdate;
        })
        ->editColumn('tgl_perkiraan', function($data) {
            $convertdate = (new DateTime($data->{"tgl_perkiraan"}))->format('d-m-Y');
            return $convertdate;
        })
        ->editColumn('tgl_selesaimt', function($data) {
            $convertdate = (new DateTime($data->{"tgl_selesaimt"}))->format('d-m-Y');
            return $convertdate;
        })
        ->editColumn('tgl_lastmaintdate', function($data) {
            $tgl_lastmaintdate = (new DateTime($data->{"tgl_lastmaintdate"}))->format('d-m-Y');
            return $tgl_lastmaintdate;
        })
        ->addColumn('action', function ($data) {
            $url_edit = url('backend/maintenance/'.$data->kode.'/edit');
            $url = url('backend/maintenance/'.$data->kode);
            $view = "<a class='btn-action btn btn-primary btn-view' href='".$url."' title='Lihat Detail'><i class='fa fa-eye'></i></a>";
            $edit = "<a class='btn-action btn btn-info btn-edit' href='".$url_edit."' title='Realisasi'><i class='fa fa-check'></i></a>";
            if($data->active == 1){
                $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
                return $view." ".$edit." ".$delete;
            }else{
                return $view;
            }

        })
        ->rawColumns(['action','kategori','asset','status','lama_mt','MaintHour','tgl_lastmaintdate'])
        ->make(true);

	}

}
