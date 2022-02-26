<?php

namespace App\Http\Controllers;
use App\Models\ThietBi;
use App\Models\ChamCong;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class Esp32Controller extends Controller
{

    public function getokmask($idp)
    {
        $idtb=$idp[0];
        $thietbi = ThietBi::where('id', '=', $idtb)->first();
        $idu = substr($idp, 2,-1);
        if($thietbi->trangthai!='2')
        {
            if (!(User::where('id_rfid', '=', $idu)->exists()))
            {
                $thietbi->trangthai = '0';
                $thietbi->save();
                return;
            }
            $thietbi->trangthai = '1';
            $thietbi->id_rfid=$idu;
            $thietbi->save();
            $taikhoan = User::where('id_rfid', '=', $idu)->first();
            $ngay_lam_viec = Carbon::now()->format('Y-m-d');
            $taikhoan = User::where('id_rfid', '=', $idu)->first();
            if (ChamCong::where('id_user', '=', $taikhoan->id)->where('ngay_lam_viec', '=', $ngay_lam_viec)->doesntExist()) {
                $chamcong = new ChamCong();
                $chamcong->ngay_lam_viec = $ngay_lam_viec;
                $chamcong->id_user = $taikhoan->id;
                $chamcong->gio_vao = Carbon::now()->format('H:i:s');
                $chamcong->gio_ra = Carbon::now()->format('H:i:s');
                $chamcong->save();
            } else {
                $chamcong = ChamCong::where('id_user', '=', $taikhoan->id)->where('ngay_lam_viec', '=', $ngay_lam_viec)->first();
                $chamcong->gio_ra = Carbon::now()->format('H:i:s');
                $chamcong->save();
            }
        }
        else{
            $thietbi->id_rfid=$idu;
            $thietbi->save();
        }
    }
    public function getnokmask($idp)
    {
        $idtb=$idp[0];
        $thietbi = ThietBi::where('id', '=', $idtb)->first();
        $idu = substr($idp, 2,-1);

        if($thietbi->trangthai!='2')
        {
            if (!(User::where('id_rfid', '=', $idu)->exists()))
            {
                $thietbi->trangthai = '0';
                $thietbi->save();
                return;
            }
            $thietbi->trangthai = '3';
            $thietbi->id_rfid=$idu;
            $thietbi->save();
        }
        else{
            $idu = substr($idp, 2,-1);
            $thietbi->id_rfid=$idu;
            $thietbi->save();
        }
    }

    public function getresult($idu)
    {
        $thietbi = ThietBi::where('id_rfid', '=', $idu)->first();
        if($thietbi->trangthai=='1')
        {
            $taikhoan=User::where('id_rfid','=',$idu)->first();
            $thietbi->trangthai = '0';
            $thietbi->save();
            return response($taikhoan->ten_hien_thi, 200);
        }
        elseif ($thietbi->trangthai=='2')
        {
            return response('THEM THANH CONG', 200);
        }
        elseif ($thietbi->trangthai=='3')
        {
            $thietbi->trangthai = '0';
            $thietbi->save();
            return response('CHINH KHAU TRANG', 200);
        }
        else
        {
            $taikhoan=User::where('id_rfid','=',$idu)->first();
            return response('LOI XAC THUC', 200);
        }

    }
}
