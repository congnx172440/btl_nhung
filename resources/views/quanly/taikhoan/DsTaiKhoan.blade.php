@extends('quanly.layout.Index')
@section('content')
    <div style="margin-bottom:10px" class="col-sm-12">
        <a href="quanly/taikhoan/chonRFID/{{$id}}">
            <button type="button" class="col-sm btn btn-info add-new">Thêm mới tài khoản người dùng</button>
        </a>
    </div>
    <div class="col-sm-12 card shadow mb-4 ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách tài khoản người dùng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="text-center table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Vị trí</th>
                        <th>Công ty</th>
                        <th>Mã RFID</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($taikhoan as $tk)
                        <tr>
                            <td>{{$tk->id}}</td>
                            <td>{{$tk->name}}</td>
                            <td>{{$tk->email}}</td>
                            <td>{{$tk->vitri->vi_tri}}</td>
                            <td>{{$tk->congty->ten_cong_ty}}</td>
                            <td>{{$tk->id_rfid}}</td>
                            <td><a href="quanly/taikhoan/xoa/{{$tk->id}}/{{$tk->id_cong_ty}}"><i class="far fa-trash-alt"></i></a></td>
                            <td><a href="quanly/taikhoan/sua/{{$tk->id}}"><i class="far fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
        <div class="alert alert-success">
            {{session('loi')}}
        </div>
    @endif
@endsection

