<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Dapukan;
use App\Model\Kategori;
use App\Model\Kelompok;
use App\Model\Siswa;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use DateTime;
use Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $kelas = 999;
    	$startDate = "01"."-".date('m-Y');
        $endDate = date('d-m-Y');
        $kelompok = 999;
        $mode = "all";
        $jk = 999;

        if ((isset($_GET['startDate'])) && ($_GET['startDate'] != "")){
            $startDate = $_GET["startDate"];
        }
        if ((isset($_GET['endDate'])) && ($_GET['endDate'] != "")){
            $endDate = $_GET["endDate"];
        }

        if (isset($_GET["kelas"])){
            $kelas = $_GET['kelas'];
        }

        if (isset($_GET["jk"])){
            $jk = $_GET['jk'];
        }

        if (isset($_GET["kelompok"])){
            $kelompok = $_GET['kelompok'];
        }

        if ((!isset($_GET["mode"])) && (isset($_GET['kelompok']))){
            $mode = "limited";
         }

        $kelompoks = Kelompok::select('id','nama_kelompok')->where('active',1)->orderBy('id', 'ASC')->get();

        $kelass = Kategori::select('id','category')->where('active',1)->orderBy('id', 'ASC')->get();



        return view('backend.siswa.index',compact( 'jk','kelas','kelass','kelompok','startDate','endDate','mode','kelompoks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::select('id', 'category')->where('active', 1)->orderBy('id', 'ASC')->get();
        $kelompoks = Kelompok::select('id', 'nama_kelompok')->where('active', 1)->orderBy('id', 'ASC')->get();
        $dapukans = Dapukan::select('id', 'nama_dapukan')->where('active', 1)->orderBy('id', 'ASC')->get();
        return view('backend.siswa.update', compact('kategoris', 'kelompoks', 'dapukans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = new Siswa();
        $data->nama = $request->namasiswa;
        $data->tgl_lahir = date('Y-m-d',strtotime($request->tgl_lahir));
        $data->jk = $request->jeniskelamin;
        $data->id_kategori = $request->kelas;
        $data->status_nikah = $request->status;
        $data->id_kelompok = $request->kelompok;
        $data->alamat = $request->alamatsiswa;
        $data->email = $request->email;
        $data->telp_murid = $request->telpsiswa;
        $data->walimurid = $request->namawali;
        $data->email_wali = $request->emailwali;
        $data->alamat_wali = $request->alamatwali;
        $data->telp_wali =$request->telpwali;
        $data->sekolah = $request->namasekolah;
        $data->pendidikan =$request->pendidikan;
        $data->jurusan =$request->jurusan;
        $data->id_dapukan = $request->dapukan;
        $data->active = 1;
        $data->user_modified = Session::get('userinfo')['username'];
        if ($data->save()) {
            return Redirect::to('/backend/siswa/')->with('success', "Data saved successfully")->with('mode', 'success');
        }

        return Redirect::to('/backend/siswa/create')
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
        $data = Siswa::select('msiswa.*','category.category as kelas','mkelompok.nama_kelompok as kelompok',
                'mdapukan.nama_dapukan as dapukan')
                ->leftJoin('category', 'msiswa.id_kategori', '=', 'category.id')
                ->leftJoin('mkelompok', 'msiswa.id_kelompok', '=', 'mkelompok.id')
                ->leftJoin('mdapukan', 'msiswa.id_dapukan', '=', 'mdapukan.id')
                ->where('msiswa.active', '>=', '1')
                ->where('msiswa.id', $id)
                ->get();

        $pendidikan = '';
        if($data[0]->pendidikan == 1){
            $pendidikan = "PAUD";
        }
        else if($data[0]->pendidikan == 2){
            $pendidikan = "SD";
        }
        else if($data[0]->pendidikan == 3){
            $pendidikan = "SMP";
        }
        else if($data[0]->pendidikan == 4){
            $pendidikan = "SMA/SMK";
        }
        else if($data[0]->pendidikan == 5){
            $pendidikan = "UNIVERSITAS";
        }else{
            $pendidikan ="";
        }

        if ($data->count() > 0) {
            return view('backend.siswa.view', compact('data','pendidikan'));
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
        $data = Siswa::where('id', $id)->get();

        $kategoris = Kategori::select('id', 'category')->where('active', 1)->orderBy('id', 'ASC')->get();
        $kelompoks = Kelompok::select('id', 'nama_kelompok')->where('active', 1)->orderBy('id', 'ASC')->get();
        $dapukans = Dapukan::select('id', 'nama_dapukan')->where('active', 1)->orderBy('id', 'ASC')->get();


        if ($data->count() > 0) {
            return view('backend.siswa.update', compact('data','kategoris', 'kelompoks', 'dapukans'));
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
        $ceksiswa = Siswa::where('msiswa.id', '<>', $id)->where('nama', $request->namasiswa)->get()->count();

        // if ($ceksiswa > 0) {
        //     $validator->getMessageBag()->add('siswa', 'Siswa already registered');
        // } else {
        $data = Siswa::find($id);

        $data->nama = $request->namasiswa;
        $data->tgl_lahir = date('Y-m-d',strtotime($request->tgl_lahir));
        $data->jk = $request->jeniskelamin;
        $data->id_kategori = $request->kelas;
        $data->status_nikah = $request->status;
        $data->id_kelompok = $request->kelompok;
        $data->alamat = $request->alamatsiswa;
        $data->email = $request->email;
        $data->telp_murid = $request->telpsiswa;
        $data->walimurid = $request->namawali;
        $data->email_wali = $request->emailwali;
        $data->alamat_wali = $request->alamatwali;
        $data->telp_wali =$request->telpwali;
        $data->sekolah = $request->namasekolah;
        $data->pendidikan =$request->pendidikan;
        $data->jurusan =$request->jurusan;
        $data->id_dapukan = $request->dapukan;

        $data->user_modified = Session::get('userinfo')['username'];
        if ($data->save()) {
            return Redirect::to('/backend/siswa/')->with('success', "Data saved successfully")->with('mode', 'success');
        }
        // }
        return Redirect::to('/backend/siswa/' . $id . "/edit")
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
        $data = Siswa::find($id);

        $data->active = 0;

        $data->user_modified = Session::get('userinfo')['username'];

        if ($data->save()) {
            return new JsonResponse(["status" => true]);
        }

        //
        // $delete = Siswa::where('id', $id)->delete();
        //return new JsonResponse(["status"=>true]);
    }

    public function datatable()
    {


        $kelas = 999;
    	$startDate = "01"."-".date('m-Y');
        $endDate = date('d-m-Y');
        $kelompok = 999;
        $mode = "all";
        $jk = 999;
        $kelompokUser = Session::get('userinfo')['kelompok'];

        if ((isset($_GET['startDate'])) && ($_GET['startDate'] != "")){
            $startDate = $_GET["startDate"];
        }
        if ((isset($_GET['endDate'])) && ($_GET['endDate'] != "")){
            $endDate = $_GET["endDate"];
        }

        if (isset($_GET["kelas"])){
            $kelas = $_GET['kelas'];
        }

        if (isset($_GET["jk"])){
            $jk = $_GET['jk'];
        }

        if (isset($_GET["kelompok"])){
            $kelompok = $_GET['kelompok'];
        }

        if (isset($_GET["mode"])){
            $mode = $_GET['mode'];
        }



        $userticket = Siswa::select('msiswa.*','category.category as kelas','mkelompok.nama_kelompok as kelompok',
        'mdapukan.nama_dapukan as dapukan')
            ->leftJoin('category', 'msiswa.id_kategori', '=', 'category.id')
            ->leftJoin('mkelompok', 'msiswa.id_kelompok', '=', 'mkelompok.id')
            ->leftJoin('mdapukan', 'msiswa.id_dapukan', '=', 'mdapukan.id')
            ->where('msiswa.active', '>=', '1');


        //filter per kelompok user
        if(Session::get('userinfo')['priv'] != 'VSUPER'){
            $userticket = $userticket->WhereIn('msiswa.id_kelompok',$kelompokUser);
        }


        if($kelas != 999){
            $userticket = $userticket->where('msiswa.id_kategori', $kelas);
        }

        if($jk != 999){
            $userticket = $userticket->where('msiswa.jk', $jk);
        }

        if($kelompok != 999){
            $userticket = $userticket->where('msiswa.id_kelompok', $kelompok);
        }

        if ($mode != "all"){
            $userticket = $userticket->where('msiswa.tgl_lahir','>=', date('Y-m-d 00:00:00',strtotime($startDate)));
            $userticket = $userticket->where('msiswa.tgl_lahir','<=',date('Y-m-d 23:59:59',strtotime($endDate)));
        }

        return Datatables::of($userticket)
            ->editColumn('tgl_lahir', function($userticket) {
                $convertdate = (new DateTime($userticket->{"tgl_lahir"}))->format('d-m-Y');
                return $convertdate;
            })
            ->editColumn('jk', function($userticket) {
                if ($userticket->jk == 'P'){
                    $sukses = "<i class='fa fa-venus'></i> Cewek";
                    return $sukses;
                }
                else {
                    $sukses = "<i class='fa fa-mars'></i> Cowok";
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
            ->addColumn('action', function ($userticket) {
                $url_edit = url('backend/siswa/' . $userticket->id . '/edit');
                $url = url('backend/siswa/' . $userticket->id);
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
            ->rawColumns(['tgl_lahir','jk','action', 'active'])
            ->make(true);
    }
}
