<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng nhập</title>
    <base href="{{asset('')}}">

    <!-- Custom fonts for this template-->
    <link href="/library_in/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/library_in/css/sb-admin-2.css" rel="stylesheet">
    <style>
        .bg-login-image1 {
            background-position: center;
            background-size: cover;
        }
    </style>

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block ">
                            <img src="../library_in/img/c9_bachkhoalogo.jpg" style="width: 85%; height: 100%">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">VIỆN ĐIỆN TỬ VIỄN THÔNG</h1>
                                </div>
                                <form class="user" action="dangnhap" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                               placeholder="Tài khoản..." name="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                                placeholder="Mật khẩu..." name="password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Ghi nhớ</label>
                                        </div>
                                    </div>
                                    <input type="submit" value="Đăng nhập" class="btn btn-primary btn-user btn-block" />
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="quenmatkhau">Quên mật khẩu?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="">Liên hệ ?</a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="../library_in/vendor/jquery/jquery.min.js"></script>
<script src="../library_in/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../library_in/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../library_in/js/sb-admin-2.min.js"></script>

</body>

</html>
