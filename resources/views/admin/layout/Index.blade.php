<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('meta')
    <base href="{{asset('')}}">
    <title>Trang chủ admin</title>
    <!-- Custom fonts for this template-->
    <link href="/library_in/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/library_in/css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin/thongtin/{{Auth::user()->id}}">
                <div class="sidebar-brand-text ml-0 mr-0">VIỆN ĐIỆN TỬ VIỄN THÔNG</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Quản lý công ty Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="admin/congty/danhsach" >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Quản lý công ty</span>
                </a>
            </li>

            <!-- Nav Item - Quản lý thiết bị Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="admin/thietbi/danhsach" >
                    <i class="fa fa-wifi"></i>
                    <span>Quản lý thiết bị</span>
                </a>
            </li>

            <!-- Nav Item - Quản lý thài khoản khách Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="admin/taikhoan/chon"  >
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Quản lý tài khoản</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Nâng cao
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#"  >
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Thống kê</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Logo -->
                        <img style="height: 80% " class="rounded float-start " src="../library_in/img/logo_set.png" >
                        <img style="height: 80% " class="rounded float-start ml-1" src="../library_in/img/logo_hust.png" >

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                      <!-- Nav Item - User Information -->

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="../library_in/img/logo_set.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="admin/thongtin/{{Auth::user()->id}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Thông tin
                                </a>
                                <a class="dropdown-item" href="admin/taikhoan/sua/{{Auth::user()->id}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cài đặt
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="dangxuat" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->


                        @yield('content')


                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>2021 - Website quản lý chấm công: All rights reversed | Designed by nhóm 24 </span>
                        </div>
                    </div>
                </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../library_in/vendor/jquery/jquery.min.js"></script>
    <script src="../library_in/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../library_in/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../library_in/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../library_in/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../library_in/js/demo/chart-area-demo.js"></script>
    <script src="../library_in/js/demo/chart-pie-demo.js"></script>

        @yield('script')
</body>

</html>
