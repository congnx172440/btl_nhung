@extends('admin.layout.Index')
@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">THÊM MÃ RFID</h1>
    </div>
    <form class="user"  >
        <div class="alert alert-info">
            <strong>{{$loi}}</strong>{{$thongbao}}
        </div>
        <br>
        <a href="admin/taikhoan/chontb/{{$id}}">
            <input type="button" value="Quay lại" class="btn btn-primary btn-user btn-block" />
        </a>
        <br>
        <br>
        <a href="admin/taikhoan/them/{{$id}}">
            <input type="button" value="Thêm mới tài khoản không RFID" class="btn btn-success btn-user btn-block" />
        </a>
    </form>
    <br>

@endsection

