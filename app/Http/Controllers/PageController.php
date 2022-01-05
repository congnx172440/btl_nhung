<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PageController extends Controller
{
    public function getdangnhap()
    {
        return view('dangnhap');
    }
    public function postdangnhap(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:3|max:255',
        ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chua nhap password',
                'password.min' => 'Password co do dai tu 3 den 255 ky tu',
                'password.max' => 'Password co do dai tu 3 den 255 ky tu',
            ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = User::where('email', '=', $request->email)->first();
            $quyen = $user->id_vi_tri;
            if($quyen==1) return redirect('admin/thongtin/'.$user->id);
            elseif ($quyen==2) return redirect('quanly/thongtin/'.$user->id);
            else return redirect('dangnhap')->with('thongbao', 'Bạn không có quyền đăng nhập hệ thống này');
        } else {
            return redirect('dangnhap')->with('thongbao', 'Thông tin tài khoản và mật khẩu sai');
        }
    }
    public function getDangXuat(){
        Auth::logout();
        return redirect('dangnhap');
    }
    public function getthongtinadmin($id){
        $user=User::find($id);
        return view('admin.ThongTin',['user'=>$user]);
    }
    public function getthongtinql($id){
        $user=User::find($id);
        return view('quanly.ThongTin',['user'=>$user]);
    }
}
