<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ChamCong;
class ChamCongController extends Controller
{
    public function getChon($id){
        return view('quanly.chamcong.DsNgayThang',['id'=>$id]);
    }
    public function postChon(Request $request,$id){
        $chamcong=ChamCong::all();
        $bat_dau=Carbon::create($request->bat_dau)->format('Y-m-d');
        $ketthuc=Carbon::create($request->ket_thuc)->format('Y-m-d');
        foreach($chamcong as $key => $item)
        {
            if($item->user->id_cong_ty!=$id || $item->ngay_lam_viec <$bat_dau || $item->ngay_lam_viec >$ketthuc)
            {
                $chamcong->forget($key);
            }
            $item->ngay_lam_viec=Carbon::create($item->ngay_lam_viec)->format('d-m-Y');
        }
        return view('quanly.chamcong.DsTaiKhoan',['chamcong'=>$chamcong]);
    }
    public function getThem($id){
        $taikhoan=User::where('id_cong_ty','=',$id)->get();
        return view('quanly.chamcong.ThemChamCong',['id'=>$id,'taikhoan'=>$taikhoan]);
    }

    public function postThem(Request $request, $id){
        $this->validate($request,[
            'name' => 'required',
            'ngay_lam_viec'=>'required',
            'gio_vao'=>'required',
            'gio_ra'=>'required',

        ],[
            'name.required' => 'Bạn chưa nhập tên người sẽ chấm công',
            'ngay_lam_viec.required' => 'Bạn chưa nhập ngày làm việc',
            'gio_vao.required' => 'Bạn chưa nhập giờ vào làm',
            'gio_ra.required' => 'Bạn chưa nhập giờ tan làm',
        ]);
        $ngay_lam_viec=Carbon::create($request->ngay_lam_viec)->format('Y-m-d');
        $chamcong=ChamCong::where('id_user','=',$request->name)->get();
        foreach($chamcong as $cc)
        {
            if($ngay_lam_viec==$cc->ngay_lam_viec)
              {
                  return redirect('quanly/chamcong/them/'.$id)->with('loi','Ngày chấm công của nhân viên này đã có trong cơ sở dữ liệu');
              }
        }

        $chamcongmoi=new ChamCong();
        $chamcongmoi->id_user=$request->name;
        $chamcongmoi->ngay_lam_viec=$ngay_lam_viec;
        $chamcongmoi->gio_vao=Carbon::create($request->gio_vao)->format('H:i:s');
        $chamcongmoi->gio_ra=Carbon::create($request->gio_ra)->format('H:i:s');
        $chamcongmoi->save();
        return redirect('quanly/chamcong/them/'.$id)->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
        $chamcong=ChamCong::find($id);
        $taikhoan=User::find($chamcong->id_user);
        return view('quanly.chamcong.SuaChamCong',['chamcong'=>$chamcong,'taikhoan'=>$taikhoan]);
    }
    public function postSua(Request $request,$id){
        $chamcong=ChamCong::find($id);
        $chamcong->gio_vao=Carbon::create($request->gio_vao)->format('H:i:s');
        $chamcong->gio_ra=Carbon::create($request->gio_ra)->format('H:i:s');
        $chamcong->save();
        return redirect('quanly/chamcong/chon/'.$id)->with('thongbao','Sửa thành công');
    }
    public function getXoa($id){
        $chamcong=ChamCong::find($id);
        $taikhoan=User::find($chamcong->id_user);
        $chamcong->delete();
        return redirect('quanly/chamcong/chon/'.$taikhoan->id_cong_ty)->with('thongbao','Xóa thành công');
    }
    public function getChonNV($id){
        $taikhoan=User::where('id_cong_ty','=',$id)->get();
        return view('quanly.chamcong.DsNhanVien',['id'=>$id,'taikhoan'=>$taikhoan]);
    }
    public function postChonNV(Request $request,$id){
        $chamcong=ChamCong::where('id_user','=',$request->id_user)->get();
        return view('quanly.chamcong.DsTaiKhoan',['chamcong'=>$chamcong]);
    }
}
