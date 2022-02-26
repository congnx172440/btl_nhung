<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ChamCong;
use App\Models\CongTy;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function getthongtin($id){

        $chamcong=ChamCong::all()->sortByDesc('id');
        $congty=CongTy::find($id);
        $thang=Carbon::now()->month;
        $tong_thieu_gio= 0;
        $tong_thoi_gian_lam= 0;
        $gio_lam_cong_ty=Carbon::create($congty->gio_ra)->diffInSeconds(Carbon::create($congty->gio_vao));
        foreach($chamcong as $key => $item)
        {
            $item->append('thieu_gio');
            $item->append('gio_lam_viec');
            if($item->user->id_cong_ty!=$id || Carbon::create($item->ngay_lam_viec)->month != $thang)
            {
                $chamcong->forget($key);
                continue;
            }
            if(Carbon::create($item->gio_vao) <  Carbon::create($congty->gio_vao)) $item->gio_vao=$congty->gio_vao;
            if(Carbon::create($item->gio_vao) >  Carbon::create($congty->gio_ra)) $item->gio_vao=$congty->gio_ra;

            if(Carbon::create($item->gio_ra) >  Carbon::create($congty->gio_ra)) $item->gio_ra=$congty->gio_ra;
            if(Carbon::create($item->gio_ra) <  Carbon::create($congty->gio_vao)) $item->gio_ra=$congty->gio_vao;

            $sub_second_lam_viec=Carbon::create($item->gio_ra)->diffInSeconds(Carbon::create($item->gio_vao));
            $sub_second_tre_vao=Carbon::create($item->gio_vao)->diffInSeconds(Carbon::create($congty->gio_vao));
            $sub_second_tre_ra=Carbon::create($congty->gio_ra)->diffInSeconds(Carbon::create($congty->gio_vao));
            $tong_tre=$sub_second_tre_vao+$sub_second_tre_ra;
            if($tong_tre>$gio_lam_cong_ty) $tong_tre=$gio_lam_cong_ty;
            $item->gio_lam_viec=gmdate("H:i:s", $sub_second_lam_viec);
            $item->thieu_gio=gmdate("H:i:s", ($tong_tre));
            $item->ngay_lam_viec=Carbon::create($item->ngay_lam_viec)->format('d-m-Y');
            $tong_thieu_gio+=$tong_tre;
            $tong_thoi_gian_lam+=$sub_second_lam_viec;
            $gio_lam = floor($tong_thoi_gian_lam / 3600);
            $phut_lam = floor(($tong_thoi_gian_lam / 60) % 60);
            $giay_lam = $tong_thoi_gian_lam % 60;
            $gio_thieu = floor($tong_thieu_gio / 3600);
            $phut_thieu = floor(($tong_thieu_gio / 60) % 60);
            $giay_thieu = $tong_thieu_gio % 60;
        }
        return view('quanly.thongke',['chamcong'=>$chamcong, 'gio_lam'=>$gio_lam,
            'phut_lam'=>$phut_lam,
            'giay_lam'=>$giay_lam,
            'gio_thieu'=>$gio_thieu,
            'phut_thieu'=>$phut_thieu,
            'giay_thieu'=>$giay_thieu]);
    }
    public function getadminthongtin(){
        $congty=CongTy::all()->count();
        $taikhoan=User::all()->count();
        return view('admin.thongke',['congty'=>$congty, 'taikhoan'=>$taikhoan]);
    }
}
