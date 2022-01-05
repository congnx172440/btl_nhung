@extends('quanly.layout.Index')
@section('content')
    <ul class="list-group text-dark">
        <li class="list-group-item">
            <h6>Họ và tên</h6>
            <span style="color:blue">{{Auth::user()->name}}</span>
        </li>
        <li class="list-group-item">
            <h6>Email</h6>
            <span style="color:blue">{{Auth::user()->email}}</span>
        </li>
        <li class="list-group-item">
            <h6>Chức vụ</h6>
            <span style="color:blue">Quản lý</span>
        </li>
    </ul>
    <li class="list-group-item">
        <h6>Nơi công tác</h6>
        <span style="color:blue">{{Auth::user()->congty->ten_cong_ty}}</span>
    </li>
@endsection


