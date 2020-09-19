<?php

namespace App\Exports;

use App\Model\Ticket;

use Session;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class GeneralReportAdmin implements FromView, ShouldAutoSize
{
    use Exportable;

    public function __construct(string $startDate, string $endDate, string $status, string $category, string $assignee, string $closeby, string $overdue, string $mode, string $user_type, string $user_agen)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
        $this->category = $category;
        $this->assignee = $assignee;
        $this->closeby = $closeby;
        $this->overdue = $overdue;
        $this->mode = $mode;
        $this->user_type = $user_type;
        $this->user_agen = $user_agen;
    }
    
    public function view(): View
    {
        $userinfo = Session::get('userinfo');
        $data = Ticket::select([
            DB::raw('IF((ticket.status = 1),"Open", IF((ticket.status = 2),"Assign", IF((ticket.status = 3),"Request to Close", IF((ticket.status = 4),"Close", "")))) as Setatus'),
            'ticket.no_ticket as Ticket_No',
            'user_ticket.name as Requester',
            'ticket.judul as Title',
            'ticket.keterangan as Description',
            'ticket.created_at as Request_Date',
            'category.category as Category',
            'ticket.prioritas as Priority',
            'ticket.start as Start_Date',
            'assignee_t.name as Assignee',
            'answer_t.name as Answer_By',
            'ticket.request_close_date as Request_Close_Date',
            'request_close_t.name as Request_Close_By',
            'ticket.close_date as Close_Date',
            'ticket.user_close as Close_By',
            'ticket.status',
            'ticket.id',
            'komentar.komen',
            DB::raw('
            ifnull
            (
                datediff(date_add(ticket.start, interval left(ticket.prioritas,1)-0 day)
                , ticket.close_date),0) as overdue
            '),
            DB::raw('
            ifnull
            (
                datediff(date_add(ticket.start, interval left(ticket.prioritas,1)-0 day)
                , CURDATE()),0) as overdue_2
            ')])
        ->leftJoin('user_ticket','ticket.user_created','=','user_ticket.username')
        ->leftJoin('user_ticket as assignee_t','ticket.assignee','=','assignee_t.username')
        ->leftJoin('user_ticket as request_close_t','ticket.user_request_close','=','request_close_t.username')
        ->leftJoin('user_ticket as answer_t','ticket.user_jawab','=','answer_t.username')
        ->leftJoin('category','ticket.category_id','=','category.id')
        ->leftJoin(DB::raw("
                (select group_concat(concat(if (a.name is not null, 'A', 'U') , ' : ', c.comment) SEPARATOR '\n\r') as komen, c.ticket_id
                    from comment c
                    left join assignee a
                    on c.username = a.name
                    where c.type = 'comment'
                group by c.ticket_id) komentar
        "),
        function($join){
            $join->on('ticket.id','=','komentar.ticket_id');
        })
        ->where('ticket.active', '!=', 0);

        //SLS 
        //jika SLS lihat semua areanya
        //ga perlu ditambahi query plus punyanya sendiri karena sudah satu area
        if ($userinfo['priv'] == "SLS"){
            $data = $data->where('user_ticket.area','=',$userinfo['area']);
        }

        //DSD
        //jika DSD lihat semua agen dan SLS dan punyanya sendiri
        if ($userinfo['priv'] == "DSD"){
            $data = $data->whereRaw("(user_ticket.tipe = 'AGEN' or user_ticket.user_level = 'SLS' or ticket.reldag = '".$userinfo['reldag']."' )");
        }

        //cek mode
        if ($this->mode != "all"){
            $data = $data->where('ticket.created_at','>=', date('Y-m-d 00:00:00',strtotime($this->startDate)));
            $data = $data->where('ticket.created_at','<=',date('Y-m-d 23:59:59',strtotime($this->endDate)));
        }

        if ($this->status != 999){
            $data = $data->where('ticket.status','=', $this->status);
        }

        if ($this->category != 999){
            $data = $data->where('ticket.category_id','=', $this->category);
        } 

        if ($this->assignee != 999){
            $data = $data->where('ticket.assignee','=',$this->assignee);
        }

        if ($this->closeby == 1){
            //close by user 
            $data = $data->where('ticket.status','=', 4)->where('ticket.user_close','!=','system');
        } else 
        if ($this->closeby == 2){
            //close by system
            $data = $data->where('ticket.status','=', 4)->where('ticket.user_close','=','system');
        }

        if ($this->overdue == 1){ 
            $data = $data->havingRaw('(overdue < 0 or (overdue_2 < 0 and status < 4))');
        } 
        if ($this->overdue == 2){
            $data = $data->havingRaw('(overdue >= 0 and (overdue_2 >= 0 or (overdue_2 < 0 and status >= 4)))');
        }

        if ($this->user_type != 999){
            $data = $data->where('user_ticket.tipe','=',$this->user_type);
        }

        if ($this->user_agen != 999){
            $data = $data->where('ticket.reldag','=',$this->user_agen);
        }


        $data = $data->orderBy('ticket.created_at','DESC')->get();

        return view('excel.general-report-admin', [
            'data' => $data
        ]);
    }   

}