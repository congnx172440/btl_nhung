<?php

namespace App\Http\Controllers;
use App\Models\ThietBi;
use App\Models\ChamCong;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class Esp32Controller extends Controller
{
    public function getThemuid($idu,$idp)
    {

        if(ThietBi::where('id','=',$idp)->exists())
        {


            $thietbi = ThietBi::find($idp);
            if ($thietbi->trangthai == '2')
            {
                $thietbi->id_rfid = $idu;
                $thietbi->save();
                return response("OK", 200);
            }
            if (User::where('id_rfid', '=', $idu)->exists())
            {
                if ($thietbi->trangthai == '0')
                {
                    $thietbi->id_rfid = $idu;
                    $thietbi->trangthai = '1';
                    $thietbi->save();

                    //Ham chuyen trong truong hop chua xong chuc nang xac thuc khau trang
                    $taikhoan=User::where('id_rfid', '=', $idu)->first();
                    $ngay_lam_viec = Carbon::now()->format('Y-m-d');
                    $taikhoan = User::where('id_rfid', '=', $idu)->first();
                    if (ChamCong::where('id_user', '=', $taikhoan->id)->where('ngay_lam_viec', '=', $ngay_lam_viec)->doesntExist()) {
                        $chamcong=new ChamCong();
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
                    //Ket thuc ham khau trang goi

                    $thietbi->trangthai = '0';
                    $thietbi->save();
                    return response("OK", 200);
                }
            }
            else
            {
                return response("NOK", 200);
            }
        }
        else
        {
            return response("NOK", 200);
        }

    }
    public function getresult($idu)
    {
        $thietbi = ThietBi::where('id_rfid', '=', $idu)->first();
        if($thietbi->trangthai=='0')
        {
            $taikhoan=User::where('id_rfid','=',$idu)->first();
            return response($taikhoan->ten_hien_thi, 200);
        }
        elseif ($thietbi->trangthai=='2')
        {
            return response('THEM THANH CONG', 200);
        }
        else
        {
            $taikhoan=User::where('id_rfid','=',$idu)->first();
            return response($taikhoan->ten_hien_thi, 404);
        }

    }
}
