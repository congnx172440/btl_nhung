@extends('quanly.layout.Index')
@section('content')
    <div class="col-sm-4">
        <a href="quanly/taikhoan/danhsach/{{$taikhoan->id_cong_ty}}">
            <button type="button" class="btn btn-info add-new">Quay lại</button>
        </a>
    </div>
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">SỬA THÔNG TIN TÀI KHOẢN NHÂN VIÊN</h1>
    </div>
    <form class="user" action="quanly/taikhoan/sua/{{$taikhoan->id}}" method="post" enctype="multipart/form-data">
        <hr />
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <h6 class="col-sm-4">Nhập tên nhân viên mới</h6>
            <input type="text" class="form-control form-control-user"
                   value="{{$taikhoan->name}}" name="name">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập vị trí công việc</h6>
            <select class="form-control" style="font-size: 0.8rem;border-radius: 10rem;height: 3.1rem;"
                    name="vi_tri">
                @foreach($vitri as $vt)
                    <option readonly=""
                            @if($taikhoan->id_vi_tri==$vt->id)
                            {{"selected"}}
                            @endif
                            value="{{$vt->id}}"->{{$vt->vi_tri}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập tên hiển thị của nhân viên</h6>
            <input type="text" class="form-control form-control-user"
                   value="{{$taikhoan->ten_hien_thi}}" name="ten_hien_thi">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập email </h6>
            <input type="email" class="form-control form-control-user"
                   placeholder="Nhập địa chỉ email" name="email" value="{{$taikhoan->email}}" readonly="">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập mật khẩu mới</h6>
            <input type="password" class="form-control form-control-user"
                   placeholder="Nhập mật khẩu" name="password">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập lại mật khẩu </h6>
            <input type="password" class="form-control form-control-user"
                   placeholder="Nhập lại mật khẩu" name="passwordAgain">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập mã RFID của nhân viên</h6>
            <input type="text" class="form-control form-control-user"
                   value="{{$taikhoan->id_rfid}}" name="id_rfid" >
        </div>

        <a href="quanly/taikhoan/chontbsua/{{$taikhoan->id}}">
            <input type="button" value="Quét mã" class="btn btn-success btn-user btn-block" />
        </a>

        <br>
        <input type="submit" value="Xác nhận" class="btn btn-primary btn-user btn-block" />
    </form>
    <br>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
    @endif
    @if(session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}}
        </div>
    @endif
    @if(session('loi'))
        <div class="alert alert-success">
            {{session('loi')}}
        </div>
    @endif
@endsection

