@extends('admin.layout.Index')
@section('content')
    <div class="col-sm-4">
        <a href="admin/thietbi/danhsach">
            <button type="button" class="btn btn-info add-new">Quay lại</button>
        </a>
    </div>
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">SỬA CÔNG TY</h1>
    </div>
    <form class="user" action="admin/thietbi/sua/{{ $thietbi->id }}" method="post">
        <hr />
        <div class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <h6 class="col-sm-4">Mã thiết bị</h6>
            <input type="text" class="form-control form-control-user" name="ma_thiet_bi"
                   value="{{$thietbi->ma_thiet_bi}}">
        </div>

        <div class="form-group">
            <h6 class="col-sm-4">Nhập công ty</h6>
            <select class="form-control" style="font-size: 0.8rem;border-radius: 10rem;height: 3.1rem;"
                    name="ten_cong_ty">
                @foreach($congty as $ct)
                    <option readonly=""
                            @if($thietbi->id_cong_ty==$ct->id)
                            {{"selected"}}
                            @endif
                            value="{{$ct->id}}"->{{$ct->ten_cong_ty}}</option>
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

