@extends('admin.layout.Index')
@section('content')
    <div style="margin-bottom:10px" class="col-sm-12">
        <a href="admin/congty/them">
            <button type="button" class="col-sm btn btn-info add-new">Thêm mới công ty</button>
        </a>
    </div>
    <div class="col-sm-12 card shadow mb-4 ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách công ty</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="text-center table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Tên công ty</th>
                        <th>Địa chỉ công ty</th>
                        <th>Giờ vào làm</th>
                        <th>Giờ tan làm</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($congty as $ct)
                        <tr>
                            <td>{{$ct->ten_cong_ty}}</td>
                            <td>{{$ct->dia_chi_cong_ty}}</td>
                            <td>{{$ct->gio_vao}}</td>
                            <td>{{$ct->gio_ra}}</td>
                            <td><a href="admin/congty/xoa/{{$ct->id}}"><i class="far fa-trash-alt"></i></a></td>
                            <td><a href="admin/congty/sua/{{$ct->id}}"><i class="far fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

