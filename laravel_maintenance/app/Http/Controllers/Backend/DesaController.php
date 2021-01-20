<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Daerah;
use App\Model\Desa;
use Illuminate\Http\JsonResponse;
use App\Model\UserLogin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use Validator;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.desa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $daerahs = Daerah::select('id', 'nama_daerah')->where('active', 1)->orderBy('id', 'ASC')->get();
        return view('backend.desa.update', compact('daerahs'));
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
        $cekdesa = Desa::where('nama_desa', $request->nama_desa)->get()->count();

        if ($cekdesa > 0) {
            $validator->getMessageBag()->add('desa', 'Desa already registered');
        } else {

            $data = new Desa();
            $data->nama_desa = $request->nama_desa;
            $data->active = $request->active;

            $data->user_modified = Session::get('userinfo')['username'];
            if ($data->save()) {
                return Redirect::to('/backend/desa/')->with('success', "Data saved successfully")->with('mode', 'success');
            }
        }
        return Redirect::to('/backend/desa/create')
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
        $data = Desa::where('id', $id)->get();
        if ($data->count() > 0) {
            return view('backend.desa.view', ['data' => $data]);
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
        $data = Desa::where('id', $id)->get();
        if ($data->count() > 0) {
            return view('backend.desa.update', ['data' => $data]);
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
        $cekdesa = Desa::where('mdesa.id', '<>', $id)->where('nama_desa', $request->nama_desa)->get()->count();

        if ($cekdesa > 0) {
            $validator->getMessageBag()->add('desa', 'Desa already registered');
        } else {
            $data = Desa::find($id);

            $data->nama_desa = $request->nama_desa;
            $data->active = $request->active;

            $data->user_modified = Session::get('userinfo')['username'];
            if ($data->save()) {
                return Redirect::to('/backend/desa/')->with('success', "Data saved successfully")->with('mode', 'success');
            }
        }
        return Redirect::to('/backend/desa/' . $id . "/edit")
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
        $data = Desa::find($id);

        $data->active = 0;

        $data->user_modified = Session::get('userinfo')['username'];

        if ($data->save()) {
            return new JsonResponse(["status" => true]);
        }

        //
        // $delete = Desa::where('id', $id)->delete();
        //return new JsonResponse(["status"=>true]);
    }

    public function datatable()
    {

        $userticket = Desa::where('active', '>=', '1');

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
                $url_edit = url('backend/desa/' . $userticket->id . '/edit');
                $url = url('backend/desa/' . $userticket->id);
                $view = "<a class='btn-action btn btn-primary btn-view' href='" . $url . "' title='View'><i class='fa fa-eye'></i></a>";
                $edit = "<a class='btn-action btn btn-info btn-edit' href='" . $url_edit . "' title='Edit'><i class='fa fa-edit'></i></a>";
                $delete = "<button data-url='" . $url . "' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
                return $view . " " . $edit . " " . $delete;
            })
            ->rawColumns(['action', 'active'])
            ->make(true);
    }
}
