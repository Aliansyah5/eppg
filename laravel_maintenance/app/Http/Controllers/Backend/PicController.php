<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Kategori;
use App\Model\Pic;
use Illuminate\Http\JsonResponse;
use App\Model\UserLogin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use Validator;

class PicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view ('backend.pic.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::select('id','category')->where('active',1)->orderBy('id', 'ASC')->get();
		return view ('backend.pic.update', compact('kategoris'));
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
        $cekkategori = Pic::where('nama',$request->nama)->get()->count();

		if($cekkategori > 0){
			$validator->getMessageBag()->add('category', 'PIC already registered');
        } else
        {

            $data = new Pic();
                $data->seksi = $request->seksi;
                $data->nama = $request->nama;
                $data->cabangid = $request->cabang;
                $data->active = $request->active;

                $data->user_modified = Session::get('userinfo')['username'];
                if($data->save()){
                    return Redirect::to('/backend/pic/')->with('success', "Data saved successfully")->with('mode', 'success');
                }

        }
		return Redirect::to('/backend/pic/create')
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
		$data = Kategori::where('id', $id)->get();
		if ($data->count() > 0){
			return view ('backend.pic.view', ['data' => $data]);
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
		$data = Pic::where('id', $id)->get();
		if ($data->count() > 0){
            return view ('backend.pic.update',
            ['data' => $data],
            ['kategoris' =>$kategoris]);
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
        $validator = Validator::make($request->all(),[]);
        $cekkategori = Pic::where('pic.id','<>',$id)->where('nama',$request->nama)->get()->count();

		if($cekkategori > 0){
			$validator->getMessageBag()->add('category', 'Pic already registered');
        } else
        {
                $data = Pic::find($id);

                $data->nama = $request->nama;
                $data->seksi = $request->seksi;
                $data->cabangid = $request->cabang;
                $data->active = $request->active;

                $data->user_modified = Session::get('userinfo')['username'];
                if($data->save()){
                    return Redirect::to('/backend/pic/')->with('success', "Data saved successfully")->with('mode', 'success');
                }

        }
		return Redirect::to('/backend/pic/'.$id."/edit")
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
        $data = Pic::find($id);


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
        if($userinfo['area'] == 'AAP'){
            $kodearea = 1;
        }if($userinfo['area'] == 'AAS'){
            $kodearea = 2;
        }else{
            $kodearea= 1;
        }

        $userticket = Pic::select('pic.*','category.category as seksi')
        ->join('category', 'category.id', '=', 'pic.seksi')
        ->where('pic.cabangid',$kodearea)
        ->where('pic.active','>=','1');

        //dd($userticket->get());




        return Datatables::of($userticket)
            ->editColumn('active', function($userticket) {
                if ($userticket->active == "1"){
                    $sukses = "<a href='#' class='badge badge-success'>Aktif</a>";
                    return $sukses;
                } else
                if ($userticket->active == "2"){
                    $sukses = "<a href='#' class='badge badge-warning'>Tidak Aktif</a>";
                    return $sukses;
                } else {
                    return $userticket->active;
                }
            })
			->addColumn('action', function ($userticket) {
				$url_edit = url('backend/pic/'.$userticket->id.'/edit');
				$url = url('backend/pic/'.$userticket->id);
				$view = "<a class='btn-action btn btn-primary btn-view' href='".$url."' title='View'><i class='fa fa-eye'></i></a>";
				$edit = "<a class='btn-action btn btn-info btn-edit' href='".$url_edit."' title='Edit'><i class='fa fa-edit'></i></a>";
				$delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
				return $view." ".$edit." ".$delete;
            })
            ->rawColumns(['action','active'])
            ->make(true);
	}

}
