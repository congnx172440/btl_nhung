@extends('quanly.layout.Index')
@section('content')
    <div class="col-sm-4">
        <a href="quanly/chamcong/chon/{{$taikhoan->id_cong_ty}}">
            <button type="button" class="btn btn-info add-new">Quay lại</button>
        </a>
    </div>
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">SỬA CHẤM CÔNG CỦA NHÂN VIÊN</h1>
    </div>
    <form class="user" action="quanly/chamcong/sua/{{$taikhoan->id}}/{{$chamcong->ngay_lam_viec}}" method="post" enctype="multipart/form-data">
        <hr />
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <h6 class="col-sm-4">Nhập tên nhân viên mới</h6>
            <input type="text" class="form-control form-control-user"
                   value="{{$taikhoan->name}}" name="name" readonly>
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập ngày làm việc</h6>
            <input type="date" class="form-control form-control-user"
                   placeholder="Nhập ngày làm việc"
                   value="{{$chamcong->ngay_lam_viec}}" name="ngay_lam_viec" readonly>
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập giờ vào làm</h6>
            <input type="time" class="form-control form-control-user"
                   placeholder="Nhập giờ vào làm"
                   value="{{$chamcong->gio_vao}}" name="gio_vao">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập giờ tan làm</h6>
            <input type="time" class="form-control form-control-user"
                   placeholder="Nhập giờ vào làm"
                   value="{{$chamcong->gio_ra}}" name="gio_ra">
        </div>

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
        <div class="alert alert-danger">
            {{session('loi')}}
        </div>
    @endif
@endsection
