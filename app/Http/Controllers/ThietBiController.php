<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThietBi;
use App\Models\CongTy;

class ThietBiController extends Controller
{
    public function getDanhSach()
    {
        $thietbi=ThietBi::all();
        return view('admin.thietbi.DsThietBi',['thietbi'=>$thietbi]);
    }
    public function getThem()
    {
        $congty=CongTy::all();
        return view('admin.thietbi.ThemThietBi',['congty'=>$congty]);
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            ['ma_thiet_bi'=>'required',
                'ten_cong_ty'=>'required',
            ],
            [
                'ma_thiet_bi.required'=>'Bạn chưa nhập mã thiết bị mới mới',
                'ten_cong_ty.required'=>'Bạn chưa nhập mã công ty mới',
            ]);
        $thietbi=new ThietBi();
        $thietbi->ma_thiet_bi=$request->ma_thiet_bi;
        $thietbi->id_cong_ty = $request->ten_cong_ty;
        $thietbi->trangthai = "0";
        $thietbi->id_rfid = "0";
        $thietbi->count = 6;
        $thietbi->save();

        return redirect('admin/thietbi/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id){
        $congty = Congty::all();
        $thietbi = ThietBi::find($id);
        return view('admin.thietbi.SuaThietBi',['thietbi'=>$thietbi,'congty'=>$congty]);
    }
    public function postSua(Request $request,$id)
    {
        $thietbi =ThietBi::find($id);
        $this->validate($request,
            ['ma_thiet_bi'=>'required',
                'ten_cong_ty'=>'required',
            ],
            [
                'ma_thiet_bi.required'=>'Bạn chưa nhập mã thiết bị mới mới',
                'ten_cong_ty.required'=>'Bạn chưa nhập mã công ty mới',
            ]);
        $thietbi->ma_thiet_bi=$request->ma_thiet_bi;
        $thietbi->id_cong_ty = $request->ten_cong_ty;
        $thietbi->trangthai = "0";
        $thietbi->id_rfid = "0";
        $thietbi->count = 6;
        $thietbi->save();

        return redirect('admin/thietbi/sua/'.$id)->with('thongbao','Sửa thành công');
    }
    public function getXoa($id){
        $thietbi = ThietBi::find($id);
        $thietbi -> delete();
        return redirect('admin/thietbi/danhsach');
    }
}
