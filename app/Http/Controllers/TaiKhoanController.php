<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CongTy;
use App\Models\User;
use App\Models\ViTri;
use App\Models\ThietBi;
class TaiKhoanController extends Controller
{
    public function getChon(){
        $congty = CongTy::all();
        return view('admin.taikhoan.DsCongTy', ['congty'=>$congty]);
    }
    public function postChon(Request $request){
        return redirect('admin/taikhoan/danhsach/'.$request->ten_cong_ty);
    }
    public function getChonRFID($id)
    {
        return view('admin.taikhoan.DsChon', ['id'=>$id]);
    }
    public function getChontb($id){
        $thietbi = ThietBi::where('id_cong_ty','=',$id)->get();

        return view('admin.taikhoan.DsThietBi', ['thietbi'=>$thietbi,'id'=>$id]);
    }
    public function postChontb(Request $request, $id){
        $thietbi=ThietBi::where('id','=',$request->ma_thiet_bi)->first();

        if($thietbi->trangthai=='1') {
            return view('admin.taikhoan.ThietBiBan',['id'=>$id,'loi'=>'Thiết bị bận', 'thongbao'=>'Xin mời quay lại trong ít phút']);
        }
        else{
            return redirect('admin/taikhoan/nhapma/'.$request->ma_thiet_bi);
        }
    }
    public function getKiemTra($id)
    {
        $thietbi = ThietBi::where('id','=',$id)->first();
        if($thietbi->trangthai!='2' && $thietbi->count==6)
        {
            $thietbi->trangthai ='2';
            $thietbi->id_rfid='0';
            $thietbi->save();
        }
        if($thietbi->id_rfid == '0'&& $thietbi->count > 0)
        {
            $thietbi->count--;
            $thietbi->save();
            return view('admin.taikhoan.DangThucHien',['id'=>$id,'thoigian'=>5-$thietbi->count]);
        }
        elseif($thietbi->id_rfid == '0'&& $thietbi->count <= 0)
        {
            $thietbi->trangthai='0';
            $thietbi->count=6;
            $thietbi->save();
            return redirect('admin/taikhoan/nhapma/'.$id)->with('loi','Không thể nhận diện do tốn quá nhiều thời gian');
        }
        else
        {
            $id_ct=$thietbi->id_cong_ty;
            $id_rf=$thietbi->id_rfid;
            $thietbi->trangthai='0';
            $thietbi->count=6;
            $thietbi->id_rfid='0';
            $thietbi->save();
            return redirect('admin/taikhoan/them/'.$id_ct.'/'. $id_rf);
        }
    }
    public function getNhapMa($id){
        $thietbi = ThietBi::where('id','=',$id)->first();
        $thietbi->trangthai = '0';
        $thietbi->id_rfid = '0';
        $thietbi->count=6;
        $thietbi->save();
        return view('admin.taikhoan.QuetMa',['id'=>$id]);
    }
    public function postNhapma($id, Request $request){
        $thietbi = ThietBi::where('id','=',$id)->first();
        $thietbi->trangthai='0';
        $thietbi->id_rfid = '0';
        $thietbi->save();
        $id=$thietbi->id_cong_ty;
        return redirect('admin/taikhoan/them/'.$id.'/'.$request->id_rfid);
    }

    public function getChoncn($id){
        return view('admin.taikhoan.QuetMa', ['id'=>$id]);
    }
    public function getDanhSach($id){
        $taikhoan = User::where('id_cong_ty','=',$id)->get();
        return view('admin.taikhoan.DsTaiKhoan',['taikhoan'=>$taikhoan,'id'=>$id]);
    }
    public function getThem($id,$id_rfid='0'){
        $congty=CongTy::find($id);
        $vitri=ViTri::all();
        return view('admin.taikhoan.ThemTaiKhoan',['congty'=>$congty,'vitri'=>$vitri,'id'=>$id,'id_rfid'=>$id_rfid]);
    }
    public function postThem(Request $request,$id){
        $congty=CongTy::find($id);
        $vitri=ViTri::all();
        $this->validate($request,[
            'name' => 'required|min:3',
            'vi_tri'=>'required',
            'ten_hien_thi'=>'required|min:3|max:16',
            'email' => 'required|email',
            'password' => 'required|min:3|max:32',
            'passwordAgain' => 'required|same:password',
            'id_rfid' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
            'vi_tri.required' => 'Bạn chưa nhập vị trí công việc',
            'ten_hien_thi.required' => 'Bạn chưa nhập tên hiển thị',
            'ten_hien_thi.min' => 'Tên hiển thị phải có độ dài từ 3 đến 16 ký tự',
            'ten_hien_thi.max' => 'Tên hiển thị có độ dài từ 3 đến 16 ký tự',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'mật khẩu phải có độ dài từ 3 đến 32 ký tự',
            'password.max' => 'mật khẩu phải có độ dài từ 3 đến 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu không khớp',
            'id_rfid.required' => 'id_rfid không được phép trống'

        ]);
        $taikhoan=new User();
        $taikhoan->name=$request->name;
        $taikhoan->ten_hien_thi=$request->ten_hien_thi;
        $taikhoan->email=$request->email;
        $taikhoan->password=bcrypt($request->password);
        $taikhoan->id_vi_tri=$request->vi_tri;
        $taikhoan->id_rfid=$request->id_rfid;
        $taikhoan->id_cong_ty=$id;
        $taikhoan->save();

        return redirect('admin/taikhoan/danhsach/'.$id)->with('thongbao','Thêm Thành Công');;
    }
    public function getSua($id,$id_rfid='0')
    {
        $taikhoan = User::find($id);

        if($id_rfid != '0')
        {
            $taikhoan->id_rfid=$id_rfid;
            $taikhoan->save();
        }
        $vitri=ViTri::all();
        return view('admin.taikhoan.SuaTaiKhoan',['taikhoan'=>$taikhoan,'vitri'=>$vitri]);
    }

    public function postSua(Request $request,$id)
    {
        $vitri=ViTri::all();
        $this->validate($request,[
            'name' => 'required|min:3',
            'vi_tri'=>'required',
            'ten_hien_thi'=>'required|min:3|max:16',
            'password' => 'required|min:3|max:32',
            'passwordAgain' => 'required|same:password',
            'id_rfid' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
            'vi_tri.required' => 'Bạn chưa nhập vị trí công việc',
            'ten_hien_thi.required' => 'Bạn chưa nhập tên hiển thị',
            'ten_hien_thi.min' => 'Tên hiển thị phải có độ dài từ 3 đến 16 ký tự',
            'ten_hien_thi.max' => 'Tên hiển thị có độ dài từ 3 đến 16 ký tự',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'mật khẩu phải có độ dài từ 3 đến 32 ký tự',
            'password.max' => 'mật khẩu phải có độ dài từ 3 đến 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu không khớp',
            'id_rfid.required' => 'id_rfid không được phép trống'

        ]);
        $taikhoan=User::find($id);
        $taikhoan->name=$request->name;
        $taikhoan->ten_hien_thi=$request->ten_hien_thi;
        $taikhoan->password=bcrypt($request->password);
        $taikhoan->id_vi_tri=$request->vi_tri;
        $taikhoan->id_rfid=$request->id_rfid;
        $taikhoan->save();

        return redirect('admin/taikhoan/sua/'.$id)->with('thongbao','Sửa Thành Công');;
    }
    public function postQLSua(Request $request,$id)
    {
        $vitri=ViTri::all();
        $this->validate($request,[
            'name' => 'required|min:3',
            'vi_tri'=>'required',
            'ten_hien_thi'=>'required|min:3|max:16',
            'password' => 'required|min:3|max:32',
            'passwordAgain' => 'required|same:password',
            'id_rfid' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
            'vi_tri.required' => 'Bạn chưa nhập vị trí công việc',
            'ten_hien_thi.required' => 'Bạn chưa nhập tên hiển thị',
            'ten_hien_thi.min' => 'Tên hiển thị phải có độ dài từ 3 đến 16 ký tự',
            'ten_hien_thi.max' => 'Tên hiển thị có độ dài từ 3 đến 16 ký tự',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'mật khẩu phải có độ dài từ 3 đến 32 ký tự',
            'password.max' => 'mật khẩu phải có độ dài từ 3 đến 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu không khớp',
            'id_rfid.required' => 'id_rfid không được phép trống'

        ]);
        $taikhoan=User::find($id);
        $taikhoan->name=$request->name;
        $taikhoan->ten_hien_thi=$request->ten_hien_thi;
        $taikhoan->password=bcrypt($request->password);
        $taikhoan->id_vi_tri=$request->vi_tri;
        $taikhoan->id_rfid=$request->id_rfid;
        $taikhoan->save();

        return redirect('quanly/taikhoan/sua/'.$id)->with('thongbao','Sửa Thành Công');;
    }
    public function getChontbsua($id,$id_thietbi=0){
        if ($id_thietbi != 0)
        {
            $thietbi=ThietBi::find($id_thietbi);
            if($thietbi->trangthai=='2')
            {
                $thietbi->trangthai = '0';
                $thietbi->id_rfid = '0';
                $thietbi->count=6;
                $thietbi->save();
            }
        }
        $taikhoan = User::find($id);
        $id_ct=$taikhoan->id_cong_ty;
        $thietbi = ThietBi::where('id_cong_ty','=',$id_ct)->get();

        return view('admin.taikhoan.DsThietBiSua', ['thietbi'=>$thietbi,'id'=>$id]);
    }

    public function postChontbsua(Request $request, $id){
        $thietbi=ThietBi::where('id','=',$request->ma_thiet_bi)->first();

        if($thietbi->trangthai=='1') {
            return redirect('admin/taikhoan/sua/'.$id)->with('loi','Thiết bị bạn chọn đang bận');
        }
        else{
            return redirect('admin/taikhoan/kiemtrasua/'.$request->ma_thiet_bi.'/'.$id);
        }
    }
    public function getKiemTraSua($id_tb,$id_user)
    {
        $thietbi = ThietBi::where('id','=',$id_tb)->first();
        if($thietbi->trangthai!='2' && $thietbi->count==6)
        {
            $thietbi->trangthai ='2';
            $thietbi->id_rfid='0';
            $thietbi->save();
        }
        if($thietbi->id_rfid == '0'&& $thietbi->count > 0)
        {
            $thietbi->count--;
            $thietbi->save();
            return view('admin.taikhoan.DangThucHienSua',['id_user'=>$id_user,'id_tb'=>$id_tb,'thoigian'=>5-$thietbi->count]);
        }
        elseif($thietbi->id_rfid == '0'&& $thietbi->count <= 0)
        {
            $thietbi->trangthai='0';
            $thietbi->count=6;
            $thietbi->save();
            return redirect('admin/taikhoan/chontbsua/'.$id_user.'/'.$id_tb)->with('loi','Không thể nhận diện do tốn quá nhiều thời gian');
        }
        else
        {
            $id_rf=$thietbi->id_rfid;
            $thietbi->trangthai='0';
            $thietbi->count=6;
            $thietbi->id_rfid='0';
            $thietbi->save();
            return redirect('admin/taikhoan/sua/'.$id_user.'/'. $id_rf);
        }
    }
    public function getXoa($id,$id_ct){
        $taikhoan = TaiKhoan::find($id);
        $taikhoan -> delete();
        return redirect('admin/taikhoan/danhsach/'.$id_ct);
    }
    public function getQLDanhSach($id){
        $taikhoan = User::where('id_cong_ty','=',$id)->get();
        return view('quanly.taikhoan.DsTaiKhoan',['taikhoan'=>$taikhoan,'id'=>$id]);
    }
    public function getQLChonRFID($id)
    {
        return view('quanly.taikhoan.DsChon', ['id'=>$id]);
    }
    public function getQLChontb($id){
        $thietbi = ThietBi::where('id_cong_ty','=',$id)->get();

        return view('quanly.taikhoan.DsThietBi', ['thietbi'=>$thietbi,'id'=>$id]);
    }
    public function postQLChontb(Request $request, $id){
        $thietbi=ThietBi::where('id','=',$request->ma_thiet_bi)->first();

        if($thietbi->trangthai=='1') {
            return view('quanly.taikhoan.ThietBiBan',['id'=>$id,'loi'=>'Thiết bị bận', 'thongbao'=>'Xin mời quay lại trong ít phút']);
        }
        else{
            return redirect('quanly/taikhoan/nhapma/'.$request->ma_thiet_bi);
        }
    }

    public function getQLNhapMa($id){
        $thietbi = ThietBi::where('id','=',$id)->first();
        $thietbi->trangthai = '0';
        $thietbi->id_rfid = '0';
        $thietbi->count=6;
        $thietbi->save();
        return view('quanly.taikhoan.QuetMa',['id'=>$id]);
    }
    public function postQLNhapma($id, Request $request){
        $thietbi = ThietBi::where('id','=',$id)->first();
        $thietbi->trangthai='0';
        $thietbi->id_rfid = '0';
        $thietbi->save();
        $id=$thietbi->id_cong_ty;
        return redirect('quanly/taikhoan/them/'.$id.'/'.$request->id_rfid);
    }
    public function getQLThem($id,$id_rfid='0'){
        $congty=CongTy::find($id);
        $vitri=ViTri::where('id','>',2)->get();
        return view('quanly.taikhoan.ThemTaiKhoan',['congty'=>$congty,'vitri'=>$vitri,'id'=>$id,'id_rfid'=>$id_rfid]);
    }
    public function postQLThem(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|min:3',
            'vi_tri'=>'required',
            'ten_hien_thi'=>'required|min:3|max:16',
            'email' => 'required|email',
            'password' => 'required|min:3|max:32',
            'passwordAgain' => 'required|same:password',
            'id_rfid' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
            'vi_tri.required' => 'Bạn chưa nhập vị trí công việc',
            'ten_hien_thi.required' => 'Bạn chưa nhập tên hiển thị',
            'ten_hien_thi.min' => 'Tên hiển thị phải có độ dài từ 3 đến 16 ký tự',
            'ten_hien_thi.max' => 'Tên hiển thị có độ dài từ 3 đến 16 ký tự',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'mật khẩu phải có độ dài từ 3 đến 32 ký tự',
            'password.max' => 'mật khẩu phải có độ dài từ 3 đến 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu không khớp',
            'id_rfid.required' => 'id_rfid không được phép trống'

        ]);
        $taikhoan=new User();
        $taikhoan->name=$request->name;
        $taikhoan->ten_hien_thi=$request->ten_hien_thi;
        $taikhoan->email=$request->email;
        $taikhoan->password=bcrypt($request->password);
        $taikhoan->id_vi_tri=$request->vi_tri;
        $taikhoan->id_rfid=$request->id_rfid;
        $taikhoan->id_cong_ty=$id;
        $taikhoan->save();

        return redirect('admin/taikhoan/danhsach/'.$id)->with('thongbao','Thêm Thành Công');;
    }
    public function getQLKiemTra($id)
    {
        $thietbi = ThietBi::where('id','=',$id)->first();
        if($thietbi->trangthai!='2' && $thietbi->count==6)
        {
            $thietbi->trangthai ='2';
            $thietbi->id_rfid='0';
            $thietbi->save();
        }
        if($thietbi->id_rfid == '0'&& $thietbi->count > 0)
        {
            $thietbi->count--;
            $thietbi->save();
            return view('quanly.taikhoan.DangThucHien',['id'=>$id,'thoigian'=>5-$thietbi->count]);
        }
        elseif($thietbi->id_rfid == '0'&& $thietbi->count <= 0)
        {
            $thietbi->trangthai='0';
            $thietbi->count=6;
            $thietbi->save();
            return redirect('quanly/taikhoan/nhapma/'.$id)->with('loi','Không thể nhận diện do tốn quá nhiều thời gian');
        }
        else
        {
            $id_ct=$thietbi->id_cong_ty;
            $id_rf=$thietbi->id_rfid;
            $thietbi->trangthai='0';
            $thietbi->count=6;
            $thietbi->id_rfid='0';
            $thietbi->save();
            return redirect('quanly/taikhoan/them/'.$id_ct.'/'. $id_rf);
        }
    }
    public function getQLSua($id,$id_rfid='0')
    {
        $taikhoan = User::find($id);

        if($id_rfid != '0')
        {
            $taikhoan->id_rfid=$id_rfid;
            $taikhoan->save();
        }
        $vitri=ViTri::all();
        return view('quanly.taikhoan.SuaTaiKhoan',['taikhoan'=>$taikhoan,'vitri'=>$vitri]);
    }
    public function getQLChontbsua($id,$id_thietbi=0){
        if ($id_thietbi != 0)
        {
            $thietbi=ThietBi::find($id_thietbi);
            if($thietbi->trangthai=='2')
            {
                $thietbi->trangthai = '0';
                $thietbi->id_rfid = '0';
                $thietbi->count=6;
                $thietbi->save();
            }
        }
        $taikhoan = User::find($id);
        $id_ct=$taikhoan->id_cong_ty;
        $thietbi = ThietBi::where('id_cong_ty','=',$id_ct)->get();

        return view('quanly.taikhoan.DsThietBiSua', ['thietbi'=>$thietbi,'id'=>$id]);
    }
    public function postQLChontbsua(Request $request, $id){
        $thietbi=ThietBi::where('id','=',$request->ma_thiet_bi)->first();

        if($thietbi->trangthai=='1') {
            return redirect('quanly/taikhoan/sua/'.$id)->with('loi','Thiết bị bạn chọn đang bận');
        }
        else{
            return redirect('quanly/taikhoan/kiemtrasua/'.$request->ma_thiet_bi.'/'.$id);
        }
    }
    public function getQLKiemTraSua($id_tb,$id_user)
    {
        $thietbi = ThietBi::where('id','=',$id_tb)->first();
        if($thietbi->trangthai!='2' && $thietbi->count==6)
        {
            $thietbi->trangthai ='2';
            $thietbi->id_rfid='0';
            $thietbi->save();
        }
        if($thietbi->id_rfid == '0'&& $thietbi->count > 0)
        {
            $thietbi->count--;
            $thietbi->save();
            return view('quanly.taikhoan.DangThucHienSua',['id_user'=>$id_user,'id_tb'=>$id_tb,'thoigian'=>5-$thietbi->count]);
        }
        elseif($thietbi->id_rfid == '0'&& $thietbi->count <= 0)
        {
            $thietbi->trangthai='0';
            $thietbi->count=6;
            $thietbi->save();
            return redirect('quanly/taikhoan/chontbsua/'.$id_user.'/'.$id_tb)->with('loi','Không thể nhận diện do tốn quá nhiều thời gian');
        }
        else
        {
            $id_rf=$thietbi->id_rfid;
            $thietbi->trangthai='0';
            $thietbi->count=6;
            $thietbi->id_rfid='0';
            $thietbi->save();
            return redirect('quanly/taikhoan/sua/'.$id_user.'/'. $id_rf);
        }
    }
    public function getQLXoa($id,$id_ct){
        $taikhoan = TaiKhoan::find($id);
        $taikhoan -> delete();
        return redirect('quanly/taikhoan/danhsach/'.$id_ct);
    }
}
