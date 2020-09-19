<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Model\AvianFixAsset;
use Carbon\Carbon;

Route::get('/', function () {
	return redirect('backend/');
});

Route::get('/email-reminder', function () {
    //asset 7 hari sebelum jatuh tempo maintenance


//     $fixasset = DB::connection('DB-AMS')->table('masset')->select([
//         'masset.AssetID','masset.Kode','masset.CabangID','masset.Nama','masset.Kondisi','masset.LastMaintDate','masset.MaintHour'
//         ,'masset.Jenis','masset.Lokasi','masset.Department','masset.Flag','masset.IsDel',
//         DB::raw('DATE_ADD(Lastmaintdate,INTERVAL (mainthour/8) DAY) AS DueDate'),

//         DB::raw('DATE_ADD(IFNULL((SELECT H.created_at FROM aviamaintenance.master_mt H, aviamaintenance.detail_mt dmt
//         WHERE H.id=dmt.Id AND dmt.kodekomponen=D.nama AND dmt.assetID=d.assetID ORDER BY H.created_at DESC LIMIT 1),masset.LastMaintDate),
//         INTERVAL D.Hourmeter/5 DAY) AS nextmt'),

//         DB::raw('(masset.Mainthour+
//         CASE WHEN IsDel IN (0,3) THEN 0 ELSE
//         (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = masset.assetid AND dmt.kodeKomponen =
//         d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate))*5) END ) AS realhourmeter'),

//         DB::raw('(masset.Mainthour+  CASE WHEN IsDel IN (0,3) THEN 0 ELSE (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at
//         FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = masset.assetid AND dmt.kodeKomponen =
//   d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate ))*5 ) END ) DIV D.hourmeter AS Target'),


//         DB::raw('(SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA=Masset.Kode AND t.kodekomponen=d.nama  ) AS JumMT'),
//     ])
//     ->join('dassetmt as d', 'Masset.AssetID', '=', 'd.AssetID')
//     ->whereRaw("masset.CabangID = $kodearea AND Kode IS NOT NULL AND Kode <> '' AND Department IS NULL AND IsDel != 1 GROUP BY masset.Nama,
//     (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA= Kode) ");



    $tujuhjatuhtempo = collect(DB::connection('DB-AMS')
                            ->select("SELECT M.Assetid, M.CabangID ,M.Kode,D.KodeNAV, M.Nama AS Asset,D.Nama,D.HourMeter,M.IsDel, M.Lokasi,

                            DATE_ADD(IFNULL((SELECT H.Tgl_selesaimt FROM aviamaintenance.master_mt H, aviamaintenance.detail_mt dmt
                            WHERE H.id=dmt.Id AND dmt.kodekomponen=D.nama AND dmt.assetID=d.assetID ORDER BY H.tgl_selesaimt DESC LIMIT 1),M.`LastMaintDate`),
                            INTERVAL D.Hourmeter/5 DAY) AS tglalert,

                            (m.Mainthour+
        CASE WHEN M.IsDel IN (0,3) THEN 0 ELSE
        (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = m.assetid AND dmt.kodeKomponen =
        d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate))*5) END ) AS realhourmeter,

        (m.Mainthour+  CASE WHEN M.IsDel IN (0,3) THEN 0 ELSE (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at
        FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = m.assetid AND dmt.kodeKomponen =
  d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate ))*5 ) END ) DIV D.hourmeter AS Target,

                                  (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA=M.Kode   ) AS jummt
					, mspart.Stok
                            FROM avian.Masset M

                            INNER JOIN avian.DassetMT D ON (D.AssetID=M.AssetID)
                            LEFT JOIN avian.mspart ON (Mspart.Kode = D.KodeNav)
                            WHERE M.IsDel != 1
                            AND  (SELECT COUNT(t.KodeFA) FROM aviamaintenance.detail_mt t WHERE t.KodeFA=M.Kode   ) < (m.Mainthour+  CASE WHEN M.IsDel IN (0,3) THEN 0 ELSE (DATEDIFF(SYSDATE(), IFNULL((SELECT created_at
        FROM aviamaintenance.detail_mt AS dmt WHERE dmt.id = m.assetid AND dmt.kodeKomponen =
  d.nama ORDER BY dmt.created_at DESC LIMIT 1 ), LastMaintDate ))*5 ) END ) DIV D.hourmeter ORDER BY Kode
                            ")
    );



    $tujuhjatuhtemposerang = $tujuhjatuhtempo->where('CabangID',2);

    $tujuhjatuhtempopusat = $tujuhjatuhtempo->where('CabangID',1);





    //DATE(DueDate) > CURDATE() AND DATE(DueDate) <= CURDATE() + INTERVAL 1 WEEK

  //WHERE DATE(DueDate) <= CURDATE() - INTERVAL 1 WEEK"));
    $jumlahtujuhjatuhtempopusat = $tujuhjatuhtempopusat->count();

    $jumlahtujuhjatuhtemposerang = $tujuhjatuhtemposerang->count();


    //overdue yang belum dikerjakan & jatuh tempo

    $tanggalhariini = Carbon::Today()->format('d-m-Y');

    //email 2 orang pak kamim/p andri

    $backup = \Mail::getSwiftMailer();

    $transport = new Swift_SmtpTransport('192.168.110.112', 587);
    $transport->setUsername('info@avian.com');
    $transport->setPassword('123456789012345');


    $email = ['it_7@avianbrands.com'];

    $emailserang = ['ibrahimaliansyah5@gmail.com'];

    // $email = ['deviana@avian.com'];
    $mail = new Swift_Mailer($transport);

    $message_2 = "Jadwal Maintenance Tanggal : ".$tanggalhariini."<br/>";
    $message_2 .= "Total Barang 7 Hari sebelum jatuh tempo : ".$jumlahtujuhjatuhtempopusat."<br/>";


    if($jumlahtujuhjatuhtempopusat >= 0 ){
    $message_2 .= "<br/>==List Barang 7 hari sebelum jatuh tempo maintenance== <br/>";

    $message_2 .="<table width='70%' border='1'>";
    $message_2 .="<tr>";
    $message_2 .="<th>No</th>";
    $message_2 .="<th>Cabang</th>";
    $message_2 .="<th>Kode FA</th>";
    $message_2 .="<th>Nama FA</th>";
    $message_2 .="<th>Lokasi</th>";
    $message_2 .="<th>Sparepart</th>";
    $message_2 .="<th>Stok Sparepart</th>";
    $message_2 .="</tr>";

    $no = 1;
    foreach ($tujuhjatuhtempopusat as $tujuh):
        //$formattanggalx =  date('d-m-Y', strtotime($tujuh->DueDate));
        $message_2 .= "<tr>";
        $message_2 .= "<td>$no</td>";
        if($tujuh->CabangID == 2){
            $message_2 .= "<td>Serang</td>";
        }else{
            $message_2 .= "<td>PUSAT</td>";
        }
        $message_2 .= "<td>$tujuh->Kode</td>";
        $message_2 .= "<td>$tujuh->Asset</td>";
        $message_2 .= "<td>$tujuh->Lokasi</td>";
        $message_2 .= "<td>$tujuh->Nama</td>";
        $message_2 .= "<td>$tujuh->Stok</td>";
        $message_2 .= "</tr>";
        $no++;
    endforeach;
    $message_2 .="</table>";

    //tabel hariini
    $message_2 .= "<br/><br/>";
}


    $message_2 .= "<br/><br/>Harap barang segera diproses <br/><br/><br/>";


    \Mail::send([], [], function ($message) use ($email, $message_2) {
        $message->to($email)
        ->subject('(AVIA Maintenance) List asset yang harus di maintenance')
        ->setBody($message_2, 'text/html');
    });

    //email untuk serang

    if($tujuhjatuhtemposerang->count() >= 0){

        $message_3 = "Jadwal Maintenance Tanggal : ".$tanggalhariini."<br/>";
        $message_3 .= "Total Barang 7 Hari sebelum jatuh tempo : ".$jumlahtujuhjatuhtemposerang."<br/>";

        $message_3 .= "<br/>==List Barang 7 hari sebelum jatuh tempo maintenance== <br/>";

        $message_3 .="<table width='70%' border='1'>";
        $message_3 .="<tr>";
        $message_3 .="<th>No</th>";
        $message_3 .="<th>Cabang</th>";
        $message_3 .="<th>Kode FA</th>";
        $message_3 .="<th>Nama FA</th>";
        $message_3 .="<th>Lokasi</th>";
        $message_3 .="<th>Sparepart</th>";
        $message_3 .="<th>Stok Sparepart</th>";
        $message_3 .="</tr>";

        $no = 1;
        foreach ($tujuhjatuhtemposerang as $serang):
            //$formattanggalx =  date('d-m-Y', strtotime($serang->DueDate));
            $message_3 .= "<tr>";
            $message_3 .= "<td>$no</td>";
            if($serang->CabangID == 2){
                $message_3 .= "<td>Serang</td>";
            }else{
                $message_3 .= "<td>PUSAT</td>";
            }
            $message_3 .= "<td>$serang->Kode</td>";
            $message_3 .= "<td>$serang->Asset</td>";
            $message_3 .= "<td>$serang->Lokasi</td>";
            $message_3 .= "<td>$serang->Nama</td>";
            $message_3 .= "<td>$serang->Stok</td>";
            $message_3 .= "</tr>";
            $no++;
        endforeach;
        $message_3 .="</table>";

        //tabel hariini
        $message_3 .= "<br/><br/>";


        $message_3 .= "<br/><br/>Harap barang segera diproses <br/><br/><br/>";


        \Mail::send([], [], function ($message) use ($emailserang, $message_3) {
            $message->to($emailserang)
            ->subject('(AVIA Maintenance) List asset yang harus di maintenance')
            ->setBody($message_3, 'text/html');
        });
    };



    // $email = ['it_1@avianbrands.com', 'it_2@avianbrands.com', 'it_3@avianbrands.com', 'it_4@avianbrands.com', 'it_5@avianbrands.com', 'it_6@avianbrands.com'];

    // $message_2 = "Ticket baru dengan nomor : ".$data->no_ticket."<br/><br/>"."Judul : ".$data->judul."<br/><br/>Keterangan : ".nl2br($data->keterangan)."<br/><br/>Diminta oleh : ".$data->user_created." - ".Session::get('userinfo')['name']."<br/><br/><br/>Harap segera diberi tanggapan<br/><br/><br/>

    //     \Mail::send([], [], function ($message) use ($email, $data, $message_2) {
    //         $message->to($email)
    //         ->subject('(AVIA Maintenance) Jadwal Maintenance Tanggal '.$data->no_ticket.' oleh user '.$data->user_created." - ".Session::get('userinfo')['name'])
    //         ->setBody($message_2, 'text/html');
    //     });
});

Route::get('/updatemainthour', function () {

    //script crunjob untuk update mainthour berdasarkan lastmain date

    $data = AvianFixAsset::where('AssetID','3101')->get();
    $tanggalhariini = Carbon::Today();

    foreach ($data as $row) {
        $terakhirmt = Carbon::parse($row->LastMaintDate);
        $date_diff=$tanggalhariini->diffInDays($terakhirmt);
        $mainthour = $date_diff *5;

        AvianFixAsset::where('AssetID', $row->AssetID)
       ->update([
           'MaintHour' => $mainthour
        ]);

    };

});

Route::get('/backup-database', function () {
    $tables = false;
    $host = "localhost";
    $user = env('DB_USERNAME');
    $pass = env('DB_PASSWORD');
    $name = env('DB_DATABASE');
    $backup_path = 'backup/backup_'.date('l').'.sql';

	set_time_limit(3000); $mysqli = new mysqli($host,$user,$pass,$name); $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
	$queryTables = $mysqli->query('SHOW TABLES'); while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }	if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); }
	$content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
	foreach($target_tables as $table){
		if (empty($table)){ continue; }
		$result	= $mysqli->query('SELECT * FROM `'.$table.'`');  	$fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows; 	$res = $mysqli->query('SHOW CREATE TABLE '.$table);	$TableMLine=$res->fetch_row();
		$content .= "\n\n".$TableMLine[1].";\n\n";   $TableMLine[1]=str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `',$TableMLine[1]);
		for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
			while($row = $result->fetch_row())	{ //when started (and every after 100 command cycle):
				if ($st_counter%100 == 0 || $st_counter == 0 )	{$content .= "\nINSERT INTO ".$table." VALUES";}
					$content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}	   if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
				//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
				if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";}	$st_counter=$st_counter+1;
			}
		} $content .="\n\n\n";
	}
	$content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
    $myfile =  fopen($backup_path, "w");
    fwrite($myfile, $content);
    fclose($myfile);
});

Route::match(array('GET','POST'),'/backend/login','Backend\LoginController@index');
//logout
Route::get('backend/logout','Backend\LoginController@logout');

/* SUPER ADMIN */
Route::group(array('prefix' => 'backend','middleware'=> ['token_super_admin']), function()
{



   // Route::get('/maintenance/cari','Backend\MaintenanceController@cari');


    Route::get('/kategori/datatable','Backend\KategoriController@datatable');
    Route::resource('kategori', 'Backend\KategoriController');

    Route::get('/user/datatable','Backend\UserLoginController@datatable');
    Route::resource('user', 'Backend\UserLoginController');



    Route::get('/setting','Backend\SettingController@index');
    Route::post('/setting','Backend\SettingController@update');

    Route::get('/category/datatable','Backend\CategoryController@datatable');
    Route::resource('category', 'Backend\CategoryController');

    Route::get('/user-group/datatable','Backend\UserGroupController@datatable');
    Route::resource('user-group', 'Backend\UserGroupController');

    Route::get('/question/datatable','Backend\QuestionController@datatable');
    Route::resource('question', 'Backend\QuestionController');

    Route::get('/answer/datatable','Backend\AnswerController@datatable');
    Route::resource('answer', 'Backend\AnswerController');

    Route::get('/questionnaire/{id}/email','Backend\QuestionnaireController@email');
    Route::get('/questionnaire/datatable','Backend\QuestionnaireController@datatable');
    Route::resource('questionnaire', 'Backend\QuestionnaireController');

    Route::get('/general-report','Backend\ReportController@general_report');
    Route::get('/general-report/datatable','Backend\ReportController@general_report_datatable');
    Route::get('/general-report/export','Backend\ReportController@general_report_export');
});



/* ADMIN */
Route::group(array('prefix' => 'backend','middleware'=> ['token_admin']), function()
{
    Route::get('/dashboard','Backend\DashboardController@dashboard');
    Route::get('/maintenance/datatable','Backend\MaintenanceController@datatable');
    Route::resource('maintenance', 'Backend\MaintenanceController');

    Route::post('/asset/simpanwaktu/{id}','Backend\FixAssetController@simpanwaktu');
    Route::get('/asset/{id}/waktu','Backend\FixAssetController@waktu');

    Route::get('/asset/datatable','Backend\FixAssetController@datatable');
    Route::resource('asset', 'Backend\FixAssetController');

    Route::get('/hourmeter/datatable','Backend\HourMeterController@datatable');
    Route::resource('hourmeter', 'Backend\HourMeterController');

    Route::get('/pic/datatable','Backend\PicController@datatable');
    Route::resource('pic', 'Backend\PicController');

    Route::get('/general-report','Backend\ReportController@general_report');
    Route::get('/general-report/datatable','Backend\ReportController@general_report_datatable');
    Route::get('/general-report/export','Backend\ReportController@general_report_export');

});


/* ADMIN DAN USER*/
Route::group(array('prefix' => 'backend','middleware'=> ['token_all']), function()
{
    Route::get('/user-guide', function () {
        $userinfo = Session::get('userinfo');
        return response()->file('upload/SOP Avia Maintenance.pdf');
    });

	Route::get('',function (){return Redirect::to('backend/dashboard');});


    Route::get('/change-password','Backend\ChangePasswordController@change_password');
    Route::post('/change-password','Backend\ChangePasswordController@store_change_password');

    Route::resource('questionnaire-user', 'Backend\QuestionnaireUserController');
});
