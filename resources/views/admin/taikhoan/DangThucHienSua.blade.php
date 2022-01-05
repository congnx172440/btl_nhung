@extends('admin.layout.Index')
@section('meta')
    <meta http-equiv="refresh" content="10">
@endsection
@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">THÊM MÃ RFID</h1>
    </div>
    <form class="user"  >
        <div class="alert alert-info">
            <strong>Đang chờ ...</strong> Xin mời quẹt thẻ, khi quẹt thẻ thành công sẽ có thông báo hiển thị trên LCD
            Đã chờ : {{$thoigian*10}}s
        </div>
        <a href="admin/taikhoan/chontbsua/{{$id_user}}/{{$id_tb}}">
            <input type="button" value="Hủy bỏ việc sửa mã RFID" class="btn btn-primary btn-user btn-block" />
        </a>
        <br>
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

