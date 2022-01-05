@extends('admin.layout.Index')
@section('content')
    <div class="col-sm-4">
        <a href="admin/thietbi/danhsach">
            <button type="button" class="btn btn-info add-new">Quay lại</button>
        </a>
    </div>
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">THÊM MỚI THIẾT BỊ</h1>
    </div>
    <form class="user" action="admin/thietbi/them" method="post">
        <hr />
        <div class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <h6 class="col-sm-4">Nhập mã thiết bị mới</h6>
            <input type="text" class="form-control form-control-user"
                   placeholder="Nhập mã thiết bị mới" name="ma_thiet_bi">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Nhập công ty sử dụng</h6>
            <select class="form-control" style="font-size: 0.8rem;border-radius: 10rem;height: 3.1rem;"
                    name="ten_cong_ty">
                @foreach($congty as $ct)
                    <option value="{{$ct->id}}">{{$ct->ten_cong_ty}}</option>
                @endforeach
            </select>
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
