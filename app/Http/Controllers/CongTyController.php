<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CongTy;
use Carbon\Carbon;
class CongTyController extends Controller
{
    public function getDanhSach()
    {
        $congty=CongTy::all();
        return view('admin.congty.DsCongTy',['congty'=>$congty]);
    }
    public function getThem()
    {
        return view('admin.congty.ThemCongTy');
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            ['ten_cong_ty'=>'required|min:3',
            'dia_chi_cong_ty'=>'required|min:3',
            ],
            [
                'ten_cong_ty.required'=>'Ban chưa nhập tên công ty mới',
                'ten_cong_ty.min'=>'Tên công ty phải có tối thiểu 3 kí tự',
                'dia_chi_cong_ty.required'=>'Ban chưa nhập địa chỉ công ty mới',
                'dia_chi_cong_ty.min'=>'Đia chỉ công ty phải tối thiểu 3 kí tự',
            ]);
        $congty=new CongTy();
        $congty->ten_cong_ty=$request->ten_cong_ty;
        $congty->dia_chi_cong_ty = $request->dia_chi_cong_ty;
        $congty->gio_vao=Carbon::create($request->gio_vao)->format('H:i:s');
        $congty->gio_ra=Carbon::create($request->gio_ra)->format('H:i:s');
        $congty->save();

        return redirect('admin/congty/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id){
        $congty = CongTy::find($id);
        return view('admin.congty.SuaCongTy',['congty'=>$congty]);
    }
    public function postSua(Request $request, $id){
        $congty = CongTy::find($id);
        $this->validate($request,[

            'ten_cong_ty'=>'required|min:3',
            'dia_chi_cong_ty'=>'required|min:3',
        ],
            [
                'ten_cong_ty.required'=>'Ban chưa nhập tên công ty mới',
                'ten_cong_ty.min'=>'Tên công ty phải có tối thiểu 3 kí tự',
                'dia_chi_cong_ty.required'=>'Ban chưa nhập địa chỉ công ty mới',
                'dia_chi_cong_ty.min'=>'Đia chỉ công ty phải tối thiểu 3 kí tự',
            ]);
        $congty->ten_cong_ty=$request->ten_cong_ty;
        $congty->dia_chi_cong_ty = $request->dia_chi_cong_ty;
        $congty->gio_vao=Carbon::create($request->gio_vao)->format('H:i:s');
        $congty->gio_ra=Carbon::create($request->gio_ra)->format('H:i:s');
        $congty->save();
        return redirect('admin/congty/sua/'.$id)->with('thongbao','Sửa thành công');
    }
    public function getXoa($id){
        $congty = CongTy::find($id);
        $congty -> delete();
        return redirect('admin/congty/danhsach');
    }
}
