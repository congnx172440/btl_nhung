@extends('admin.layout.Index')
@section('content')
    <div class="col-sm-4">
        <a href="admin/congty/danhsach">
            <button type="button" class="btn btn-info add-new">Quay lại</button>
        </a>
    </div>
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">THÊM MỚI CÔNG TY</h1>
    </div>
    <form class="user" action="admin/congty/them" method="post">
        <hr />
        <div class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <h6 class="col-sm-4">Nhập tên công ty mới</h6>
            <input type="text" class="form-control form-control-user"
                   placeholder="Nhập tên công ty mới" name="ten_cong_ty">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập địa chỉ công ty mới</h6>
            <input type="text" class="form-control form-control-user"
                   placeholder="Nhập địa chỉ công ty mới" name="dia_chi_cong_ty">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập giờ vào làm</h6>
            <input type="time" class="form-control form-control-user"
                   placeholder="Nhập địa chỉ công ty mới" name="gio_vao">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập giờ tan làm</h6>
            <input type="time" class="form-control form-control-user"
                   placeholder="Nhập địa chỉ công ty mới" name="gio_ra">
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
@endsection
