<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Kategori;
use App\Model\Kelompok;
use Illuminate\Http\JsonResponse;
use App\Model\UserLogin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use Validator;

class UserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.userlogin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelompoks = Kelompok::select('id', 'nama_kelompok')->where('active', 1)->orderBy('id', 'ASC')->get();
        $kategoris = Kategori::select('id', 'category')->orderBy('id', 'ASC')->get();
        return view('backend.userlogin.update', compact('kategoris','kelompoks'));
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
        //
        $cekusername = UserLogin::where('username', $request->username)->get()->count();

        if ($cekusername > 0) {
            $validator->getMessageBag()->add('username', 'Username already registered');
        } else {
            if ($request->tipe == "AD") {
                if (!$ldap_success) {
                    $validator->getMessageBag()->add('username', 'Username not registered in the active directory');
                } else {
                    $data = new UserLogin();
                    $data->username = $request->username;
                    $data->password = md5('12345');
                    $data->tipe = $request->tipe;
                    $data->user_level = $request->user_level;
                    $data->name = $request->name;
                    $data->email = $request->email;
                    $data->kelompok = ($request->kelompok);
                    //$data->kategori = $request->kategori;
                    $data->telp = $request->telp;
                    $data->user_modified = Session::get('userinfo')['username'];
                    if ($data->save()) {
                        return Redirect::to('/backend/user/')->with('success', "Data saved successfully")->with('mode', 'success');
                    }
                }
            } else
            if ($request->tipe == "AGEN") {
                $data = new UserLogin();
                $data->username = $request->username;
                $data->password = md5('12345');
                $data->tipe = $request->tipe;
                $data->user_level = $request->user_level;
                $data->name = $request->name;
                $data->email = $request->email;
                $data->kelompok = ($request->kelompok);
                //$data->kategori = $request->kategori;
                $data->telp = $request->telp;
                $data->user_modified = Session::get('userinfo')['username'];
                if ($data->save()) {
                    return Redirect::to('/backend/user/')->with('success', "Data saved successfully")->with('mode', 'success');
                }
            }
        }
        return Redirect::to('/backend/user/create')
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
        $data = UserLogin::where('id', $id)->get();
        if ($data->count() > 0) {
            return view('backend.userlogin.view', ['data' => $data]);
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
        $kelompoks = Kelompok::select('id', 'nama_kelompok')->where('active', 1)->orderBy('id', 'ASC')->get();
        $kategoris = Kategori::select('id', 'category')->orderBy('id', 'ASC')->get();
        $data = UserLogin::where('id', $id)->get();

        if ($data->count() > 0) {
            return view('backend.userlogin.update', ['data' => $data], compact('kategoris','kelompoks'));
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
        $cekusername = UserLogin::where('user_login.id', '<>', $id)->where('username', $request->username)->get()->count();

        if ($cekusername > 0) {
            $validator->getMessageBag()->add('username', 'Username already registered');
        } else {
            if ($request->tipe == "AD") {
                if (!$ldap_success) {
                    $validator->getMessageBag()->add('username', 'Username not registered in the active directory');
                } else {
                    $data = UserLogin::find($id);
                    $data->username = $request->username;
                    $data->reldag = $request->reldag;
                    $data->tipe = $request->tipe;
                    $data->user_level = $request->user_level;
                    $data->name = $request->name;
                    $data->kelompok = ($request->kelompok);
                    $data->email = $request->email;
                    $data->telp = $request->telp;
                    $data->user_modified = Session::get('userinfo')['username'];
                    if ($data->save()) {
                        return Redirect::to('/backend/user/')->with('success', "Data saved successfully")->with('mode', 'success');
                    }
                }
            } else
            if ($request->tipe == "AGEN") {
                $data = UserLogin::find($id);
                $data->username = $request->username;
                if ($request->password_check == 1) {
                    $data->password = md5($request->pwd);
                }
                $data->tipe = $request->tipe;
                $data->user_level = $request->user_level;
                $data->name = $request->name;
                $data->kelompok = ($request->kelompok);
                $data->email = $request->email;
                $data->telp = $request->telp;
                $data->user_modified = Session::get('userinfo')['username'];
                if ($data->save()) {
                    return Redirect::to('/backend/user/')->with('success', "Data saved successfully")->with('mode', 'success');
                }
            }
        }
        return Redirect::to('/backend/user/' . $id . "/edit")
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
        //
        $delete = UserLogin::where('id', $id)->delete();
        return new JsonResponse(["status" => true]);
    }

    public function datatable()
    {
        $userticket = UserLogin::all();
        return Datatables::of($userticket)

            ->editColumn('user_level', function ($userticket) {
                if ($userticket->user_level == "VSUPER") {
                    return "SUPER ADMIN";
                } else
                if ($userticket->user_level == "VADM") {
                    return "ADMIN";
                } else {
                    return $userticket->user_level;
                }
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
            ->addColumn('action', function ($userticket) {
                $url_edit = url('backend/user/' . $userticket->id . '/edit');
                $url = url('backend/user/' . $userticket->id);
                $view = "<a class='btn-action btn btn-primary btn-view' href='" . $url . "' title='View'><i class='fa fa-eye'></i></a>";
                $edit = "<a class='btn-action btn btn-info btn-edit' href='" . $url_edit . "' title='Edit'><i class='fa fa-edit'></i></a>";
                $delete = "<button data-url='" . $url . "' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
                return $view . " " . $edit . " " . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
