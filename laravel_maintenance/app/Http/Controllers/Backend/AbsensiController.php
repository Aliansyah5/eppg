<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Absensi;
use App\Model\Dabsensi;
use App\Model\Dapukan;
use App\Model\Kategori;
use App\Model\Kelompok;
use App\Model\Malquran;
use App\Model\Masjid;
use App\Model\Mhadist;
use App\Model\Pengajian;
use App\Model\Siswa;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Model\UserLogin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use DateTime;
use Validator;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = 999;
        $tingkat = 999;
    	$startDate = "01"."-".date('m-Y');
        $endDate = date('d-m-Y');
        $kelompok = 999;
        $pengajian = 999;
        $mode = "limited";

        if ((isset($_GET['startDate'])) && ($_GET['startDate'] != "")){
            $startDate = $_GET["startDate"];
        }
        if ((isset($_GET['endDate'])) && ($_GET['endDate'] != "")){
            $endDate = $_GET["endDate"];
        }

        if (isset($_GET["tingkat"])){
            $tingkat = $_GET['tingkat'];
        }

        if (isset($_GET["kelas"])){
            $kelas = $_GET['kelas'];
        }

        if (isset($_GET["kelompok"])){
            $kelompok = $_GET['kelompok'];
        }

        if (isset($_GET["pengajian"])){
            $pengajian = $_GET['pengajian'];
        }

        if ((isset($_GET["mode"]))){
            $mode = "all";
         }



        $kelompoks = Kelompok::select('id','nama_kelompok')->where('active',1)->orderBy('id', 'ASC')->get();

        $pengajians = Pengajian::select('id','nama_pengajian')->where('active',1)->orderBy('id', 'ASC')->get();

        $kelass = Kategori::select('id','category')->where('active',1)->orderBy('id', 'ASC')->get();


        return view('backend.absensi.index',compact('pengajian','pengajians','tingkat','kelas','kelass','kelompok','startDate','endDate','mode','kelompoks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelompokUser = Session::get('userinfo')['kelompok'];
        $kategoris = Kategori::select('id', 'category')->where('active', 1)->orderBy('id', 'ASC')->get();
        $kelompoks = Kelompok::select('id', 'nama_kelompok')->where('active', 1)->orderBy('id', 'ASC')->get();
        $kelompoks = $kelompoks->WhereIn('id',$kelompokUser);

        $dapukans = Dapukan::select('id', 'nama_dapukan')->where('active', 1)->orderBy('id', 'ASC')->get();
        $pengajians = Pengajian::select('id', 'nama_pengajian')->where('active', 1)->orderBy('id', 'ASC')->get();
        $tempats = Masjid::select('id', 'nama_masjid')->where('active', 1)->orderBy('id', 'ASC')->get();
        $qurans = Malquran::select('id', 'nama_surat')->where('active', 1)->orderBy('id', 'ASC')->get();
        $hadists = Mhadist::select('id', 'nama_hadist')->where('active', 1)->orderBy('id', 'ASC')->get();

        $pemateris = Siswa::select('id','nama')->where('active',1)->where('id_dapukan',8)->orderBy('id','ASC')->get();



        return view('backend.absensi.update',
        compact('kategoris', 'kelompoks',
        'dapukans','pengajians','tempats','qurans','hadists','pemateris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = new Absensi();
        $data->pengajian = $request->pengajian;
        $data->tgl = date('Y-m-d',strtotime($request->tanggal));
        $data->tempat = $request->tempat;
        $data->kelompok = ($request->kelompok);
        $data->peserta = ($request->kelas);
        $data->tingkat = $request->tingkat;
        $data->jam_mulai = $request->jam_mulai;
        $data->jam_akhir = $request->jam_akhir;
        $data->quran = $request->quran;
        $data->pengajar_quran = $request->pengajar_quran;
        $data->hadist = $request->hadist;
        $data->pengajar_hadist = $request->pengajar_hadist;
        $data->penasehat = $request->penasehat;
        $data->ayat_awal = $request->ayat_awal ?? 0;
        $data->ayat_akhir = $request->ayat_akhir ?? 0;
        $data->hal_awal = $request->hal_awal ?? 0;
        $data->hal_akhir = $request->hal_akhir ?? 0;
        $data->active = 1;
        $data->user_modified = Session::get('userinfo')['username'];

        if ($data->save()) {
            return Redirect::to('/backend/absensi/')->with('success', "Data saved successfully")->with('mode', 'success');
        }

        return Redirect::to('/backend/absensi/create')
            ->withInput();;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserLevel  $userLevel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategoris = Kategori::select('id', 'category')->where('active', 1)->orderBy('id', 'ASC')->get();
        $kelompoks = Kelompok::select('id', 'nama_kelompok')->where('active', 1)->orderBy('id', 'ASC')->get();
        $pemateris = Siswa::select('id','nama')->where('active',1)->where('id_dapukan',8)->orderBy('id','ASC')->get();
        $pengajians = Pengajian::select('id', 'nama_pengajian')->where('active', 1)->orderBy('id', 'ASC')->get();
        $tempats = Masjid::select('id', 'nama_masjid')->where('active', 1)->orderBy('id', 'ASC')->get();
        $qurans = Malquran::select('id', 'nama_surat')->where('active', 1)->orderBy('id', 'ASC')->get();
        $hadists = Mhadist::select('id', 'nama_hadist')->where('active', 1)->orderBy('id', 'ASC')->get();

        $data = Absensi::where('id', $id)->first();



        if ($data->count() > 0) {
            return view('backend.absensi.view', compact('data',
            'kategoris', 'kelompoks', 'pemateris','pengajians','tempats','qurans','hadists'));
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
        $kelompokUser = Session::get('userinfo')['kelompok'];
        $kategoris = Kategori::select('id', 'category')->where('active', 1)->orderBy('id', 'ASC')->get();
        $kelompoks = Kelompok::select('id', 'nama_kelompok')->where('active', 1)->orderBy('id', 'ASC')->get();
        $kelompoks = $kelompoks->WhereIn('id',$kelompokUser);
        $pemateris = Siswa::select('id','nama')->where('active',1)->where('id_dapukan',8)->orderBy('id','ASC')->get();
        $pengajians = Pengajian::select('id', 'nama_pengajian')->where('active', 1)->orderBy('id', 'ASC')->get();
        $tempats = Masjid::select('id', 'nama_masjid')->where('active', 1)->orderBy('id', 'ASC')->get();
        $qurans = Malquran::select('id', 'nama_surat')->where('active', 1)->orderBy('id', 'ASC')->get();
        $hadists = Mhadist::select('id', 'nama_hadist')->where('active', 1)->orderBy('id', 'ASC')->get();

        $data = Absensi::where('id', $id)->first();

        $carisiswa = Siswa::wherein('id_kelompok', $data->kelompok)
        ->wherein('id_kategori', $data->peserta)->get();


        foreach ($carisiswa as $siswa ) {

            //jika siswa berada dalam kategori dan kelompok yang dimaksud
            //maka data baru akan ditambahkan
            $idxSiswa = Dabsensi::where('id',$id)->max('idx') ?? 0;


            $newUser = Dabsensi::firstOrCreate([
                'id' => $data->id,
                'id_siswa' => $siswa->id,
            ],[
                'idx' => $idxSiswa + 1,
                'jam_datang' => null,
                'user_modified' => Session::get('userinfo')['username']
            ]);

        }

        if ($data->count() > 0) {
            return view('backend.absensi.update', compact('data',
            'kategoris', 'kelompoks', 'pemateris','pengajians','tempats','qurans','hadists'));
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
        //
        $validator = Validator::make($request->all(), []);

            $data = Absensi::find($id);
            $data->pengajian = $request->pengajian;
            $data->tgl = date('Y-m-d',strtotime($request->tanggal));
            $data->tempat = $request->tempat;
            $data->kelompok = ($request->kelompok);
            $data->peserta = ($request->kelas);
            $data->tingkat = $request->tingkat;
            $data->jam_mulai = $request->jam_mulai;
            $data->jam_akhir = $request->jam_akhir;
            $data->quran = $request->quran;
            $data->pengajar_quran = $request->pengajar_quran;
            $data->hadist = $request->hadist;
            $data->pengajar_hadist = $request->pengajar_hadist;
            $data->penasehat = $request->penasehat;
            $data->ayat_awal = $request->ayat_awal ?? 0;
            $data->ayat_akhir = $request->ayat_akhir ?? 0;
            $data->hal_awal = $request->hal_awal ?? 0;
            $data->hal_akhir = $request->hal_akhir ?? 0;

            $data->user_modified = Session::get('userinfo')['username'];

        if ($data->save()) {
            return Redirect::to('/backend/absensi/')->with('success', "Data saved successfully")->with('mode', 'success');
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


        $deleteDetail =  Dabsensi::where('id',$id)->delete();
        $deleteAbsensi =  Absensi::where('id',$id)->delete();

        return new JsonResponse(["status" => true]);


    }

    //ajax
    public function gantiStatus(Request $request){

        if($request->col == 'status') {

            if($request->status == 'H') {

                Dabsensi::where('id',$request->formid)
                ->where('id_siswa',$request->idsiswa)
                ->update([
                    'status' => $request->status,
                    'jam_datang' => Carbon::Now()
                ]);

            }else{

                Dabsensi::where('id',$request->formid)
                ->where('id_siswa',$request->idsiswa)
                ->update([
                    'status' => $request->status,
                    'jam_datang' => null
                ]);

            }

        }else if($request->col == 'keterangan') {


                Dabsensi::where('id',$request->formid)
                ->where('id_siswa',$request->idsiswa)
                ->update([
                    'keterangan' => $request->keterangan
                ]);


        }


        return ['success' => true, 'message' => 'Data Berhasil dirubah !!'];
    }
    //end ajax

    public function datatable()
    {

        $kelas = 999;
        $tingkat = 999;
    	$startDate = "01"."-".date('m-Y');
        $endDate = date('d-m-Y');
        $kelompok = 999;
        $pengajian = 999;
        $mode = "all";
        $kelompokUser = Session::get('userinfo')['kelompok'];

        if ((isset($_GET['startDate'])) && ($_GET['startDate'] != "")){
            $startDate = $_GET["startDate"];
        }
        if ((isset($_GET['endDate'])) && ($_GET['endDate'] != "")){
            $endDate = $_GET["endDate"];
        }

        if (isset($_GET["tingkat"])){
            $tingkat = $_GET['tingkat'];
        }

        if (isset($_GET["kelas"])){
            $kelas = $_GET['kelas'];
        }

        if (isset($_GET["kelompok"])){
            $kelompok = $_GET['kelompok'];
        }

        if (isset($_GET["pengajian"])){
            $pengajian = $_GET['pengajian'];
        }

        if ((isset($_GET["mode"]))){
            $mode = $_GET['mode'];
         }

        $userticket = Absensi
        ::select('absensi.id as id','a.nama_pengajian', 'absensi.tingkat as tingkat',
        'b.nama_surat', 'c.nama_hadist','absensi.peserta as peserta',
        'absensi.tingkat as tingkat', 'absensi.ayat_awal as ayatAwal','absensi.ayat_akhir as ayatAkhir','absensi.user_modified as user',
        'absensi.hal_awal as halAwal', 'absensi.hal_akhir as halAkhir',
        'absensi.kelompok as kelompok','d.nama_masjid as tempat','absensi.tgl as tanggal')
        ->leftJoin('mpengajian as a', 'absensi.pengajian', '=', 'a.id')
        ->leftJoin('malquran as b', 'absensi.quran', '=', 'b.id')
        ->leftJoin('mhadist as c', 'absensi.hadist', '=', 'c.id')
        ->leftJoin('mmasjid as d', 'absensi.tempat', '=', 'd.id')
        ->where('a.active', '>=', '1')
        ;

        //filter berdasarkan kelompok user

        if(Session::get('userinfo')['priv'] != 'VSUPER'){
            if (count($kelompokUser) == 1) {
                $userticket->where('kelompok', 'like', '%"' . $kelompokUser[0] . '"%');
            }else{
                $userticket->where(function ($userticket) use ($kelompokUser){
                    $userticket->where('kelompok', 'like', '%"' . $kelompokUser[0] . '"%');
                    for ($i=1; $i <= count($kelompokUser) - 1 ; $i++) {
                        $userticket->orWhere('kelompok', 'like', '%"' . $kelompokUser[$i] . '"%');
                    }
               });
            }

        }

        //select * from absensi where kelompok like '%"18"%'

        //end filter kelompok

        if($kelas != 999){
            $userticket = $userticket->Where('absensi.peserta', 'like', '%' . $kelas . '%');
        }

        if($tingkat != 999){
            $userticket = $userticket->where('absensi.tingkat', $tingkat);
        }

        if($pengajian != 999){
            $userticket = $userticket->where('absensi.pengajian', $pengajian);
        }

        if($kelompok != 999){
            $userticket = $userticket->Where('absensi.kelompok', 'like', '%' . $kelompok . '%');
        }

        if ($mode != "all"){
            $userticket = $userticket->where('absensi.tgl','>=', date('Y-m-d 00:00:00',strtotime($startDate)));
            $userticket = $userticket->where('absensi.tgl','<=',date('Y-m-d 23:59:59',strtotime($endDate)));
        }


        return Datatables::of($userticket)
            ->editColumn('tingkat', function($userticket){
                if ($userticket->tingkat == "1") {
                    $sukses = "<a href='#' class='badge badge-primary'>Kelompok</a>";
                    return $sukses;
                } else
                if ($userticket->tingkat == "2") {
                    $sukses = "<a href='#' class='badge badge-success'>Desa</a>";
                    return $sukses;
                }else
                if ($userticket->tingkat == "3") {
                    $sukses = "<a href='#' class='badge badge-warning'>Daerah</a>";
                    return $sukses;
                }else
                if ($userticket->tingkat == "4") {
                    $sukses = "<a href='#' class='badge badge-info'>Pusat</a>";
                    return $sukses;
                }
                else {
                    $sukses = "<a href='#' class='badge badge-default'>Lain</a>";
                    return $sukses;
                }
            })
            ->editColumn('kehadiran', function($userticket) {
                $hadir = Dabsensi::where('id', $userticket->id)->where('status','H')->count();
                $total = Dabsensi::where('id', $userticket->id)->count();

                $hadir = ($hadir == 0) ? 1 : $hadir ;
                $total = ($total == 0) ? 1 : $total ;

                $pembulatan = ($hadir /$total )*100;
                $pembulatan = round($pembulatan, 0);

                $sukses = "<div class='progress'>
                <div class='progress-bar bg-blue' role='progressbar' aria-valuenow='$pembulatan' aria-valuemin='0' aria-valuemax='100' style='width: $pembulatan%;color: white'>
                    <span class='sr-only'>$pembulatan% Complete</span><p class='text-dark'>$pembulatan %</p>
                </div>
                </div>";
                return $sukses;

            })
            ->editColumn('tanggal', function($userticket) {
                $convertdate = (new DateTime($userticket->{"tanggal"}))->format('d-m-Y');
                return $convertdate;
            })
            ->editColumn('peserta', function($userticket) {
                $arrPeserta = [];
                $tempPeserta = $userticket->{"peserta"};
                foreach($tempPeserta as $a){
                    $cariPeserta = Kategori::where('id',$a)->pluck('category')->first();
                    array_push($arrPeserta, $cariPeserta);
                }
                $arrPeserta = join(",",$arrPeserta);

                return $arrPeserta;
            })
            ->editColumn('kelompok', function($userticket){
                $arrKelompok = [];
                $tempKelompok = $userticket->{"kelompok"};
                foreach($tempKelompok as $a){
                    $cariKelompok = Kelompok::where('id',$a)->pluck('nama_kelompok')->first();
                    array_push($arrKelompok, $cariKelompok);
                }
                $arrKelompok = join(",",$arrKelompok);

                return $arrKelompok;
            })
            ->editColumn('jk', function($userticket) {
                if ($userticket->jk == 'P'){
                    $sukses = "<i class='fa fa-mars'></i> Cowok";
                    return $sukses;
                }
                else {
                    $sukses = "<i class='fa fa-venus'></i> Cewek";
                    return $sukses;
                }
            })
            ->editColumn('active', function ($userticket) {
                if ($userticket->active == "1") {
                    $sukses = "<a href='#' class='badge badge-success'>Aktif</a>";
                    return $sukses;
                } else
                if ($userticket->active == "2") {
                    $sukses = "<a href='#' class='badge badge-warning'>Tidak Aktif</a>";
                    return $sukses;
                } else {
                    return $userticket->active;
                }
            })
            ->editColumn('nama_surat', function($userticket) {

                $ayatAwal = $userticket->ayatAwal ?? 0 ;
                $ayatAkhir = $userticket->ayatAkhir ?? 0 ;

                $kombinasi = $userticket->nama_surat.' : '.$ayatAwal.' - '.$ayatAkhir;
                return $kombinasi;
            })
            ->editColumn('nama_hadist', function($userticket) {
                $halAwal = $userticket->halAwal ?? 0 ;
                $halAkhir = $userticket->halAkhir ?? 0 ;
                $kombinasi = $userticket->nama_hadist.' : '.$halAwal.' - '.$halAkhir;
                return $kombinasi;
            })
            ->addColumn('action', function ($userticket) {
                $url_edit = url('backend/absensi/' . $userticket->id . '/edit');
                $url = url('backend/absensi/' . $userticket->id);
                if (Session::get('userinfo')['priv'] == 'VSUPER'){
                    $view = "<a class='btn-action btn btn-primary btn-edit' href='" . $url . "' title='View'><i class='fa fa-eye'></i></a>";
                    $edit = "<a class='btn-action btn btn-info btn-edit' href='" . $url_edit . "' title='Edit'><i class='fa fa-edit'></i></a>";
                    $delete = "<button data-url='" . $url . "' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
                    return $view . " " . $edit . " " . $delete;
                }
                else{
                    if($userticket->user == Session::get('userinfo')['username']){
                        $view = "<a class='btn-action btn btn-primary btn-edit' href='" . $url . "' title='View'><i class='fa fa-eye'></i></a>";
                        $edit = "<a class='btn-action btn btn-info btn-edit' href='" . $url_edit . "' title='Edit'><i class='fa fa-edit'></i></a>";
                        $delete = "<button data-url='" . $url . "' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
                        return $view . " " . $edit . " " . $delete;
                    }else{
                        $view = "<a class='btn-action btn btn-primary btn-edit' href='" . $url . "' title='View'><i class='fa fa-eye'></i></a>";
                        return $view;
                    }
                }

            })
            ->rawColumns(['kehadiran','nama_hadist','nama_surat','kelompok','peserta','tingkat','tgl_lahir','jk','action', 'active'])
            ->make(true);
    }

    public function datatablelakilaki($id)
    {
        $userticket = Dabsensi
        ::select('dabsensi.idx as nomor','a.nama','dabsensi.status','dabsensi.id as formid','dabsensi.id_siswa as id_siswa','dabsensi.keterangan as keterangan')
        ->leftJoin('msiswa as a', 'a.id', '=', 'dabsensi.id_siswa')
        ->where('a.jk','=','L')
        ->where('dabsensi.id',$id)
        ->where('a.active', '>=', '1')
        ;

        return Datatables::of($userticket)
            ->editColumn('status', function($userticket) {
                if($userticket->status == 'A'){
                    return "<select name='status' class='form-control status'>
                    <option value='A' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa selected > A</option>
                    <option value='H' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa >H</option>
                    <option value='S' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa >S</option>
                    <option value='I' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa >I</option>
                    </select>";
                }
                else if($userticket->status == 'H'){
                    return "<select name='status' class='form-control status' >
                    <option value='H' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  selected > H</option>
                    <option value='A' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa >A</option>
                    <option value='S' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >S</option>
                    <option value='I' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >I</option>
                    </select>";
                }
                else if($userticket->status == 'S'){
                    return "<select name='status' class='form-control status'>
                    <option value='S'  selected > S</option>
                    <option value='A' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >A</option>
                    <option value='H' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >H</option>
                    <option value='I' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >I</option>
                    </select>";
                }
                else if($userticket->status == 'I'){
                    return "<select name='status' class='form-control status'>
                    <option value='I' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  selected > I</option>
                    <option value='A' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  > A</option>
                    <option value='H' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >H</option>
                    <option value='S' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >S</option>
                    </select>";
                }
                else{
                    return $userticket->status;
                }
            })
            ->editColumn('keterangan', function($userticket){
                return "<input type='text' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  name='keterangan'  value='$userticket->keterangan'  class='form-control keterangan' />";
            })
            ->rawColumns(['status','keterangan'])
            ->make(true);
    }

    public function datatableperempuan($id)
    {
        $userticket = Dabsensi
        ::select('dabsensi.idx as nomor','a.nama','dabsensi.status','dabsensi.id as formid','dabsensi.id_siswa as id_siswa','dabsensi.keterangan as keterangan')
        ->leftJoin('msiswa as a', 'a.id', '=', 'dabsensi.id_siswa')
        ->where('a.jk','=','P')
        ->where('dabsensi.id',$id)
        ->where('a.active', '>=', '1')
        ;

        return Datatables::of($userticket)
            ->editColumn('status', function($userticket) {
                if($userticket->status == 'A'){
                    return "<select name='status' class='form-control status'>
                    <option value='A' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa selected > A</option>
                    <option value='H' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa >H</option>
                    <option value='S' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa >S</option>
                    <option value='I' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa >I</option>
                    </select>";
                }
                else if($userticket->status == 'H'){
                    return "<select name='status' class='form-control status' >
                    <option value='H' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  selected > H</option>
                    <option value='A' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa >A</option>
                    <option value='S' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >S</option>
                    <option value='I' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >I</option>
                    </select>";
                }
                else if($userticket->status == 'S'){
                    return "<select name='status' class='form-control status'>
                    <option value='S'  selected > S</option>
                    <option value='A' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >A</option>
                    <option value='H' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >H</option>
                    <option value='I' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >I</option>
                    </select>";
                }
                else if($userticket->status == 'I'){
                    return "<select name='status' class='form-control status'>
                    <option value='I' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  selected > I</option>
                    <option value='A' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  > A</option>
                    <option value='H' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >H</option>
                    <option value='S' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  >S</option>
                    </select>";
                }
                else{
                    return $userticket->status;
                }
            })
            ->editColumn('keterangan', function($userticket){
                return "<input type='text' data-formid=$userticket->formid data-id_siswa=$userticket->id_siswa  name='keterangan' value='$userticket->keterangan' class='form-control keterangan' />";
            })
            ->rawColumns(['status','keterangan'])
            ->make(true);
    }
}
