@extends('quanly.layout.Index')
@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">THÊM MỘT CHẤM CÔNG MỚI VÀO DANH SÁCH</h1>
    </div>
    <form class="user" action="quanly/chamcong/them/{{$id}}" method="post" enctype="multipart/form-data">
        <hr />
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <h6 class="col-sm-4">Lựa chọn nhân viên </h6>
            <select class="form-control" style="font-size: 0.8rem;border-radius: 10rem;height: 3.1rem;"
                    name="name">
                @foreach($taikhoan as $tk)
                    <option value="{{$tk->id}}">{{$tk->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập ngày làm việc</h6>
            <input type="date" class="form-control form-control-user"
                   placeholder="Nhập ngày làm việc" name="ngay_lam_viec">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập giờ vào làm</h6>
            <input type="time" class="form-control form-control-user"
                   placeholder="Nhập giờ vào làm" name="gio_vao">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập giờ tan làm</h6>
            <input type="time" class="form-control form-control-user"
                   placeholder="Nhập giờ vào làm" name="gio_ra">
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
