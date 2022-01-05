@extends('quanly.layout.Index')
@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">THÊM MÃ RFID</h1>
    </div>
    <form class="user" action="quanly/taikhoan/nhapma/{{$id}}" method="post" enctype="multipart/form-data" >
        <hr />
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <h6 class="col-sm-4">Nhập mã RFID</h6>
            <input type="text" class="form-control form-control-user"
                   placeholder="Nhập mã RFID" name="id_rfid">
        </div>
        <a href="quanly/taikhoan/kiemtra/{{$id}}">
            <input type="button" value="Quét mã" class="btn btn-primary btn-user btn-block" />
        </a>
        <br>
        <br>
        <input type="submit" value="Tiếp tục" class="btn btn-success btn-user btn-block" />
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

