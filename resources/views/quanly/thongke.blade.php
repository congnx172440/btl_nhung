@extends('quanly.layout.Index')
@section('content')

    <div class="row">

        <!-- Card1 -->
        <div class="col-xl-5 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                SỐ GIỜ LÀM</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$gio_lam}} giờ {{$phut_lam}} phút {{$giay_lam}} giây</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card2 -->
        <div class="col-xl-5 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                TỔNG SỐ GIỜ LÀM THIẾU</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$gio_thieu}} giờ {{$phut_thieu}} phút {{$giay_thieu}} giây</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="col-sm-12 card shadow mb-4 ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DANH SÁCH CHẤM CÔNG THEO THÁNG</h6>
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
                        <th>Tổng giờ làm</th>
                        <th>Thiếu giờ</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($chamcong as $cc)
                        <tr>
                            <td>{{$cc->ngay_lam_viec}}</td>
                            <td>{{$cc->user->name}}</td>
                            <td>{{$cc->gio_vao}}</td>
                            <td>{{$cc->gio_ra}}</td>
                            <td>{{$cc->gio_lam_viec}}</td>
                            <td>{{$cc->thieu_gio}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
