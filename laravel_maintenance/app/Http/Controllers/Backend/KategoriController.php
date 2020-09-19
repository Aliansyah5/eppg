<?php

namespace App\Http\Controllers\Backend;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Kategori;
use Illuminate\Http\JsonResponse;
use App\Model\UserLogin;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Datatables;
use Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view ('backend.kategori.index');
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
        $cekkategori = Kategori::where('category',$request->category)->get()->count();

		if($cekkategori > 0){
			$validator->getMessageBag()->add('category', 'Category already registered');
        } else
        {

            $data = new Kategori();
                $data->category = $request->category;
                $data->active = $request->active;

                $data->user_modified = Session::get('userinfo')['username'];
                if($data->save()){
                    return Redirect::to('/backend/kategori/')->with('success', "Data saved successfully")->with('mode', 'success');
                }

        }
		return Redirect::to('/backend/kategori/create')
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
			return view ('backend.kategori.view', ['data' => $data]);
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
		$data = Kategori::where('id', $id)->get();
		if ($data->count() > 0){
			return view ('backend.kategori.update', ['data' => $data]);
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
        $cekkategori = Kategori::where('category.id','<>',$id)->where('category',$request->category)->get()->count();

		if($cekkategori > 0){
			$validator->getMessageBag()->add('category', 'Category already registered');
        } else
        {
                $data = Kategori::find($id);

                $data->category = $request->category;
                $data->active = $request->active;

                $data->user_modified = Session::get('userinfo')['username'];
                if($data->save()){
                    return Redirect::to('/backend/kategori/')->with('success', "Data saved successfully")->with('mode', 'success');
                }

        }
		return Redirect::to('/backend/kategori/'.$id."/edit")
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

		$userticket = Kategori::where('active','>=','1');
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
				$url_edit = url('backend/kategori/'.$userticket->id.'/edit');
				$url = url('backend/kategori/'.$userticket->id);
				$view = "<a class='btn-action btn btn-primary btn-view' href='".$url."' title='View'><i class='fa fa-eye'></i></a>";
				$edit = "<a class='btn-action btn btn-info btn-edit' href='".$url_edit."' title='Edit'><i class='fa fa-edit'></i></a>";
				$delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn-action btn btn-danger btn-delete' title='Delete'><i class='fa fa-trash-o'></i></button>";
				return $view." ".$edit." ".$delete;
            })
            ->rawColumns(['action','active'])
            ->make(true);
	}

}
