<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Daerah;
use App\Model\Desa;
use App\Model\Kelompok;
use App\Model\Masjid;
use Illuminate\Http\JsonResponse;
use App\Model\UserLogin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use Validator;

class MasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.masjid.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $kelompoks = Kelompok::select('id', 'nama_kelompok')->where('active', 1)->orderBy('id', 'ASC')->get();
        return view('backend.masjid.update', compact('kelompoks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), []);

        $data = new Masjid();
        $data->nama_masjid = $request->nama_masjid;
        $data->id_kelompok = $request->kelompok;
        $data->active = $request->active;

        $data->user_modified = Session::get('userinfo')['username'];
        if ($data->save()) {
            return Redirect::to('/backend/masjid/')->with('success', "Data saved successfully")->with('mode', 'success');
        }

        return Redirect::to('/backend/masjid/create')
            ->withErrors($validator)
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
        //
        $data = Masjid::where('id', $id)->get();
        if ($data->count() > 0) {
            return view('backend.masjid.view', ['data' => $data]);
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
        $data = Masjid::where('id', $id)->get();

        $kelompoks = Kelompok::select('id', 'nama_kelompok')->where('active', 1)->orderBy('id', 'ASC')->get();

        if ($data->count() > 0) {
            return view('backend.masjid.update', compact('data', 'desas', 'kelompoks'));
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

            $data = Masjid::find($id);
            $data->nama_masjid = $request->nama_masjid;
            $data->id_kelompok = $request->kelompok;
            $data->active = $request->active;

            $data->user_modified = Session::get('userinfo')['username'];
            if ($data->save()) {
                return Redirect::to('/backend/masjid/')->with('success', "Data saved successfully")->with('mode', 'success');
            }

        return Redirect::to('/backend/masjid/' . $id . "/edit")
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
        $data = Masjid::find($id);

        $data->active = 0;

        $data->user_modified = Session::get('userinfo')['username'];

        if ($data->save()) {
            return new JsonResponse(["status" => true]);
        }

        //
        // $delete = Masjid::where('id', $id)->delete();
        //return new JsonResponse(["status"=>true]);
    }

    public function datatable()
    {


        $userticket = Masjid::select('mmasjid.*', 'mkelompok.nama_kelompok as kelompok')
            ->leftJoin('mkelompok', 'mmasjid.id_kelompok', '=', 'mkelompok.id')
            ->where('mmasjid.active', '>=', '1');

        return Datatables::of($userticket)
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
                $url_edit = url('backend/masjid/' . $userticket->id . '/edit');
                $url = url('backend/masjid/' . $userticket->id);
                $view = "<a class='btn-action btn btn-primary btn-view' href='" . $url . "' title='View'><i class='fa fa-eye'></i></a>";
                $edit = "<a class='btn-action btn btn-info btn-edit' href='" . $url_edit . "' title='Edit'><i class='fa fa-edit'></i></a>";
                $delete = "<button data-url='" . $url . "' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
                return $view . " " . $edit . " " . $delete;
            })
            ->rawColumns(['action', 'active'])
            ->make(true);
    }
}
