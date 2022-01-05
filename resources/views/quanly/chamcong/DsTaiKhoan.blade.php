@extends('quanly.layout.Index')
@section('content')

    <div class="col-sm-12 card shadow mb-4 ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DANH SÁCH CHẤM CÔNG</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="text-center table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Ngày làm việc</th>
                        <th>Tên</th>
                        <th>Giờ vào</th>
                        <th>Giờ ra</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($chamcong as $cc)
                        <tr>
                            <td>{{$cc->ngay_lam_viec}}</td>
                            <td>{{$cc->user->name}}</td>
                            <td>{{$cc->gio_vao}}</td>
                            <td>{{$cc->gio_ra}}</td>
                            <td><a href="quanly/chamcong/xoa/{{$cc->id}}"/><i class="far fa-trash-alt"></i></a></td>
                            <td><a href="quanly/chamcong/sua/{{$cc->id}}"><i class="far fa-edit"></i></a></td>
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
        <div class="alert alert-danger">
            {{session('loi')}}
        </div>
    @endif
@endsection

