@extends('admin.layout.Index')
@section('content')
    <div style="margin-bottom:10px" class="col-sm-12">
        <a href="admin/thietbi/them">
            <button type="button" class="col-sm btn btn-info add-new">Thêm mới thiết bị</button>
        </a>
    </div>
    <div class="col-sm-12 card shadow mb-4 ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách thiết bị</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="text-center table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã thiết bị</th>
                        <th>Công ty</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($thietbi as $tb)
                        <tr>
                            <td>{{$tb->id}}</td>
                            <td>{{$tb->ma_thiet_bi}}</td>
                            <td>{{$tb->congty->ten_cong_ty}}</td>
                            <td><a href="admin/thietbi/xoa/{{$tb->id}}"><i class="far fa-trash-alt"></i></a></td>
                            <td><a href="admin/thietbi/sua/{{$tb->id}}"><i class="far fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

