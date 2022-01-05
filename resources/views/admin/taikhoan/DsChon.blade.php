@extends('admin.layout.Index')
@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">CHỌN CÁCH THÊM TÀI KHOẢN</h1>
    </div>
    <br>

    <form class="user" >
        <a href="admin/taikhoan/chontb/{{$id}}">
        <input type="button" value="Thêm mới tài khoản với mã RFID" class="btn btn-primary btn-user btn-block" />
        </a>
        <br>
        <br>
        <a href="admin/taikhoan/them/{{$id}}">
            <input type="button" value="Thêm mới tài khoản không RFID" class="btn btn-success btn-user btn-block" />
        </a>
    </form>
    <br>

@endsection

