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
    return redirect('backend/dashboard');
});

;

Route::get('/backup-database', function () {
    $tables = false;
    $host = "localhost";
    $user = env('DB_USERNAME');
    $pass = env('DB_PASSWORD');
    $name = env('DB_DATABASE');
    $backup_path = 'backup/backup_' . date('l') . '.sql';

    set_time_limit(3000);
    $mysqli = new mysqli($host, $user, $pass, $name);
    $mysqli->select_db($name);
    $mysqli->query("SET NAMES 'utf8'");
    $queryTables = $mysqli->query('SHOW TABLES');
    while ($row = $queryTables->fetch_row()) {
        $target_tables[] = $row[0];
    }
    if ($tables !== false) {
        $target_tables = array_intersect($target_tables, $tables);
    }
    $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $name . "`\r\n--\r\n\r\n\r\n";
    foreach ($target_tables as $table) {
        if (empty($table)) {
            continue;
        }
        $result    = $mysqli->query('SELECT * FROM `' . $table . '`');
        $fields_amount = $result->field_count;
        $rows_num = $mysqli->affected_rows;
        $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
        $TableMLine = $res->fetch_row();
        $content .= "\n\n" . $TableMLine[1] . ";\n\n";
        $TableMLine[1] = str_ireplace('CREATE TABLE `', 'CREATE TABLE IF NOT EXISTS `', $TableMLine[1]);
        for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
            while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                if ($st_counter % 100 == 0 || $st_counter == 0) {
                    $content .= "\nINSERT INTO " . $table . " VALUES";
                }
                $content .= "\n(";
                for ($j = 0; $j < $fields_amount; $j++) {
                    $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                    if (isset($row[$j])) {
                        $content .= '"' . $row[$j] . '"';
                    } else {
                        $content .= '""';
                    }
                    if ($j < ($fields_amount - 1)) {
                        $content .= ',';
                    }
                }
                $content .= ")";
                //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                    $content .= ";";
                } else {
                    $content .= ",";
                }
                $st_counter = $st_counter + 1;
            }
        }
        $content .= "\n\n\n";
    }
    $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
    $myfile =  fopen($backup_path, "w");
    fwrite($myfile, $content);
    fclose($myfile);
});

Route::match(array('GET', 'POST'), '/backend/login', 'Backend\LoginController@index');
//logout
Route::get('backend/logout', 'Backend\LoginController@logout');


/* SUPER ADMIN */
Route::group(array('prefix' => 'backend', 'middleware' => ['token_super_admin']), function () {

    // Route::get('/maintenance/cari','Backend\MaintenanceController@cari');

    Route::get('/siswa/datatable', 'Backend\SiswaController@datatable');
    Route::resource('siswa', 'Backend\SiswaController');

    Route::get('/absensi/datatable', 'Backend\AbsensiController@datatable');
    Route::get('/absensilakilaki/{id}/datatable', 'Backend\AbsensiController@datatablelakilaki');
    Route::get('/absensiperempuan/{id}/datatable', 'Backend\AbsensiController@datatableperempuan');

    Route::post('/absensi/{id}/gantistatus','Backend\AbsensiController@gantiStatus');

    Route::resource('absensi', 'Backend\AbsensiController');

    Route::get('/kategori/datatable', 'Backend\KategoriController@datatable');
    Route::resource('kategori', 'Backend\KategoriController');

    Route::get('/dapukan/datatable', 'Backend\DapukanController@datatable');
    Route::resource('dapukan', 'Backend\DapukanController');

    Route::get('/alquran/datatable', 'Backend\AlquranController@datatable');
    Route::resource('alquran', 'Backend\AlquranController');

    Route::get('/hadist/datatable', 'Backend\HadistController@datatable');
    Route::resource('hadist', 'Backend\HadistController');

    Route::get('/daerah/datatable', 'Backend\DaerahController@datatable');
    Route::resource('daerah', 'Backend\DaerahController');

    Route::get('/desa/datatable', 'Backend\DesaController@datatable');
    Route::resource('desa', 'Backend\DesaController');

    Route::get('/masjid/datatable', 'Backend\MasjidController@datatable');
    Route::resource('masjid', 'Backend\MasjidController');

    Route::get('/pengajian/datatable', 'Backend\PengajianController@datatable');
    Route::resource('pengajian', 'Backend\PengajianController');

    Route::get('/kelompok/datatable', 'Backend\KelompokController@datatable');
    Route::resource('kelompok', 'Backend\KelompokController');

    Route::get('/user/datatable', 'Backend\UserLoginController@datatable');
    Route::resource('user', 'Backend\UserLoginController');


    Route::get('/setting', 'Backend\SettingController@index');
    Route::post('/setting', 'Backend\SettingController@update');



    Route::get('/general-report', 'Backend\ReportController@general_report');
    Route::get('/general-report/datatable', 'Backend\ReportController@general_report_datatable');
    Route::get('/general-report/export', 'Backend\ReportController@general_report_export');
});



/* ADMIN */
Route::group(array('prefix' => 'backend', 'middleware' => ['token_admin']), function () {
    Route::get('/dashboard', 'Backend\DashboardController@dashboard');
    Route::get('/maintenance/datatable', 'Backend\MaintenanceController@datatable');
    Route::resource('maintenance', 'Backend\MaintenanceController');

    Route::get('/siswa/datatable', 'Backend\SiswaController@datatable');
    Route::resource('siswa', 'Backend\SiswaController');

    Route::get('/absensi/datatable', 'Backend\AbsensiController@datatable');

    Route::get('/absensilakilaki/{id}/datatable', 'Backend\AbsensiController@datatablelakilaki');
    Route::get('/absensiperempuan/{id}/datatable', 'Backend\AbsensiController@datatableperempuan');

    Route::post('/absensi/{id}/gantistatus','Backend\AbsensiController@gantiStatus');

    Route::resource('absensi', 'Backend\AbsensiController');

    Route::get('/pic/datatable', 'Backend\PicController@datatable');
    Route::resource('pic', 'Backend\PicController');

    Route::get('/general-report', 'Backend\ReportController@general_report');
    Route::get('/general-report/datatable', 'Backend\ReportController@general_report_datatable');
    Route::get('/general-report/export', 'Backend\ReportController@general_report_export');
});


/* ADMIN DAN USER*/
Route::group(array('prefix' => 'backend', 'middleware' => ['token_all']), function () {
    Route::get('/user-guide', function () {
        $userinfo = Session::get('userinfo');
        return response()->file('upload/SOP Avia Maintenance.pdf');
    });

    Route::get('', function () {
        return Redirect::to('backend/setting');
    });


    Route::get('/change-password', 'Backend\ChangePasswordController@change_password');
    Route::post('/change-password', 'Backend\ChangePasswordController@store_change_password');


});
