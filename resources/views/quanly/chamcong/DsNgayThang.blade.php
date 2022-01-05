@extends('quanly.layout.Index')
@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">CHỌN NGÀY THÁNG NĂM XEM CHẤM CÔNG</h1>
    </div>
    <form class="user" action="quanly/chamcong/chon/{{$id}}" method="post" >
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <hr />
        <div class="form-group">
            <h6 class="col-sm-4">Chọn ngày bắt đầu xem</h6>
            <input type="date" class="form-control form-control-user"
                   placeholder="Chọn ngày giờ bắt đầu" name="bat_dau">
        </div>
        <div class="form-group">
            <h6 class="col-sm-4">Chọn ngày kết thúc xem</h6>
            <input type="date" class="form-control form-control-user"
                   placeholder="Chọn ngày giờ kết thúc" name="ket_thuc">
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

