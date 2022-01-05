<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pages');
});

Route::get('dangnhap','App\Http\Controllers\PageController@getdangnhap');
Route::post('dangnhap','App\Http\Controllers\PageController@postdangnhap');
Route::get('dangxuat','App\Http\Controllers\PageController@getdangxuat');
Route::get('quenmatkhau', function (){
    return view('quenmatkhau');
});
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
    Route::get('thongtin/{id}','App\Http\Controllers\PageController@getthongtinadmin');
    Route::group(['prefix'=>'congty'],function() {
        Route::get('danhsach', 'App\Http\Controllers\CongTyController@getDanhSach');

        Route::get('them','App\Http\Controllers\CongTyController@getThem');
        Route::post('them','App\Http\Controllers\CongTyController@postThem');

        Route::get('sua/{id}','App\Http\Controllers\CongTyController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\CongTyController@postSua');
        Route::get('xoa/{id}','App\Http\Controllers\CongTyController@getXoa');
    });
    Route::group(['prefix'=>'thietbi'],function() {
        Route::get('danhsach', 'App\Http\Controllers\ThietBiController@getDanhSach');

        Route::get('them','App\Http\Controllers\ThietBiController@getThem');
        Route::post('them','App\Http\Controllers\ThietBiController@postThem');

        Route::get('sua/{id}','App\Http\Controllers\ThietBiController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\ThietBiController@postSua');
        Route::get('xoa/{id}','App\Http\Controllers\ThietBiController@getXoa');
    });
    Route::group(['prefix'=>'taikhoan'],function() {
        Route::get('danhsach/{id}','App\Http\Controllers\TaiKhoanController@getDanhSach');

        Route::get('sua/{id}/{id_rfid?}','App\Http\Controllers\TaiKhoanController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\TaiKhoanController@postSua');

        Route::get('thongtin/{id}','App\Http\Controllers\TaiKhoanController@getThongTin');

        Route::get('xoa/{id}/{id_ct}','App\Http\Controllers\TaiKhoanController@getXoa');

        Route::get('chon','App\Http\Controllers\TaiKhoanController@getChon');
        Route::post('chon','App\Http\Controllers\TaiKhoanController@postChon');

        Route::get('chonRFID/{id}','App\Http\Controllers\TaiKhoanController@getChonRFID');

        Route::get('choncn/{id}','App\Http\Controllers\TaiKhoanController@getChoncn');

        Route::get('chontb/{id}','App\Http\Controllers\TaiKhoanController@getChontb');
        Route::post('chontb/{id}','App\Http\Controllers\TaiKhoanController@postChontb');

        Route::get('them/{id}/{id_rfid?}','App\Http\Controllers\TaiKhoanController@getThem');
        Route::post('them/{id}','App\Http\Controllers\TaiKhoanController@postThem');

        Route::get('nhapma/{id}','App\Http\Controllers\TaiKhoanController@getNhapMa');
        Route::post('nhapma/{id}','App\Http\Controllers\TaiKhoanController@postNhapMa');

        Route::get('kiemtra/{id}','App\Http\Controllers\TaiKhoanController@getKiemTra');

        Route::get('chontbsua/{id}/{id_rfid?}','App\Http\Controllers\TaiKhoanController@getChontbsua');
        Route::post('chontbsua/{id}','App\Http\Controllers\TaiKhoanController@postChontbsua');

        Route::get('kiemtrasua/{id_tb}/{id_user}','App\Http\Controllers\TaiKhoanController@getKiemTraSua');
    });
});
Route::group(['prefix'=>'quanly','middleware'=>'quanlyLogin'],function(){
    Route::get('thongtin/{id}','App\Http\Controllers\PageController@getthongtinql');
    Route::group(['prefix'=>'taikhoan'],function() {
        Route::get('danhsach/{id}','App\Http\Controllers\TaiKhoanController@getQLDanhSach');

        Route::get('sua/{id}/{id_rfid?}','App\Http\Controllers\TaiKhoanController@getQLSua');
        Route::post('sua/{id}','App\Http\Controllers\TaiKhoanController@postQLSua');

        Route::get('thongtin/{id}','App\Http\Controllers\TaiKhoanController@getQLThongTin');

        Route::get('xoa/{id}/{id_ct}','App\Http\Controllers\TaiKhoanController@getQLXoa');

        Route::get('chon','App\Http\Controllers\TaiKhoanController@getQLChon');
        Route::post('chon','App\Http\Controllers\TaiKhoanController@postQLChon');

        Route::get('chonRFID/{id}','App\Http\Controllers\TaiKhoanController@getQLChonRFID');

        Route::get('choncn/{id}','App\Http\Controllers\TaiKhoanController@getQLChoncn');

        Route::get('chontb/{id}','App\Http\Controllers\TaiKhoanController@getQLChontb');
        Route::post('chontb/{id}','App\Http\Controllers\TaiKhoanController@postQLChontb');

        Route::get('them/{id}/{id_rfid?}','App\Http\Controllers\TaiKhoanController@getQLThem');
        Route::post('them/{id}','App\Http\Controllers\TaiKhoanController@postQLThem');

        Route::get('nhapma/{id}','App\Http\Controllers\TaiKhoanController@getQLNhapMa');
        Route::post('nhapma/{id}','App\Http\Controllers\TaiKhoanController@postQLNhapMa');

        Route::get('kiemtra/{id}','App\Http\Controllers\TaiKhoanController@getQLKiemTra');

        Route::get('chontbsua/{id}/{id_rfid?}','App\Http\Controllers\TaiKhoanController@getQLChontbsua');
        Route::post('chontbsua/{id}','App\Http\Controllers\TaiKhoanController@postQLChontbsua');

        Route::get('kiemtrasua/{id_tb}/{id_user}','App\Http\Controllers\TaiKhoanController@getQLKiemTraSua');
    });
    Route::group(['prefix'=>'chamcong'],function() {
        Route::get('chon/{id}','App\Http\Controllers\ChamCongController@getChon');
        Route::post('chon/{id}','App\Http\Controllers\ChamCongController@postChon');
        Route::get('them/{id}','App\Http\Controllers\ChamCongController@getThem');
        Route::post('them/{id}','App\Http\Controllers\ChamCongController@postThem');
        Route::get('sua/{id}','App\Http\Controllers\ChamCongController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\ChamCongController@postSua');
        Route::get('chonnv/{id}','App\Http\Controllers\ChamCongController@getChonNV');
        Route::post('chonnv/{id}','App\Http\Controllers\ChamCongController@postChonNV');

    });

});
Route::get('uid/{idu}/{idd}', 'App\Http\Controllers\Esp32Controller@getThemuid');
Route::get('auth/{idu}', 'App\Http\Controllers\Esp32Controller@getresult');


