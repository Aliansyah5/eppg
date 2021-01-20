<?php


namespace App\Http\Controllers\Backend;

use Session;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Absensi;
use App\Model\AvianFixAsset;
use App\Model\Maintenance;
use App\Model\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DB;

use Redirect;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {


        $userinfo = Session::get('userinfo');
        $userKelompok = Session::get('userinfo')['kelompok'];

        $jumlahPengajian = Absensi::where('active',1)->get();
        $jumlahSiswa = Siswa::where('active',1)->get();

        if ($userinfo['priv'] != "VSUPER") {
            $jumlahPengajian->whereIn('kelompok', $userKelompok);
            $jumlahSiswa->whereIn('id_kelompok', $userKelompok);
        }

        $jumlahPengajian = $jumlahPengajian->count();
        $jumlahSiswa = $jumlahSiswa->count();


        return view('backend.dashboard', compact(
           'jumlahPengajian',
           'jumlahSiswa'
        ));
    }
}
