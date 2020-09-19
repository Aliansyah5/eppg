<?php

namespace App\Exports;

use App\Model\Maintenance;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class GeneralReport implements FromView, ShouldAutoSize
{
    use Exportable;

    // $startDate, $endDate, $status, $kategori, ,$lokasi, $assignee, $mode
    public function __construct(string $startDate, string $endDate, string $status, string $kategori, string $assignee, string $lokasi, string $mode)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
        $this->kategori = $kategori;
        $this->assignee = $assignee;
        $this->lokasi = $lokasi;
        $this->mode = $mode;
        $this->status = $status;
    }

    public function view(): View
    {
        $data = Maintenance::select(['master_mt.*','category.category',DB::raw('avian.masset.Kode as Kode_Asset'),
        DB::raw('avian.masset.Nama as Nama_Asset'), 'avian.masset.MaintHour', 'avian.masset.lokasi'])
        ->leftJoin('category', 'category.id', '=', 'master_mt.kategori')
        ->leftJoin('avian.masset', 'master_mt.asset', '=', 'avian.masset.AssetID')
        ->orWhereRaw('master_mt.active = 2');


        //proses maintenance
         //cek mode
         if ($this->mode != "all"){
            $data = $data->where('master_mt.created_at','>=', date('Y-m-d 00:00:00',strtotime($this->startDate)));
            $data = $data->where('master_mt.created_at','<=',date('Y-m-d 23:59:59',strtotime($this->endDate)));
        }



        //mencari asset yang proses maintenance
        if ($this->status == 1){
            $data = $data->whereRaw(DB::raw("master_mt.tgl_selesaimt > master_mt.tgl_perkiraan"));

        }

        //mencari asset yang belum realisasi
        if ($this->status == 2){
            $data = $data->whereRaw(DB::raw("master_mt.tgl_selesaimt <= master_mt.tgl_perkiraan"));
        }


        if ($this->kategori != 999){
            $data = $data->where('kategori','=', $this->kategori);
        }



        if ($this->assignee != 999){
            $data = $data->where('assignee','=',$this->assignee);
        }


        if ($this->lokasi != 999){
            $data = $data->where('lokasi','=', $this->lokasi);
        }



        $data = $data->orderBy('master_mt.created_at','DESC')->get();



        return view('excel.general-report', [
            'data' => $data
        ]);
    }

}
