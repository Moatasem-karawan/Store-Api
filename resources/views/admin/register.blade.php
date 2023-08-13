
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Register - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{asset('https://fonts.gstatic.com')}}}" rel="preconnect">
    <link href="{{asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i')}}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/vendor/quill/quill.snow.css")}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.3.1
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<main>
    <div>

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-8">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">الياء للحجوازات</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">


                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">تسجيل حساب جديد</h5>
                                    <p class="text-center small">Enter your personal details to create account</p>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('do_register') }}">
                                    @csrf

                                    <div class="col-12">
                                        <label for="yourName" class="form-label">اسمك الشخصي</label>
                                        <input type="text" name="name" class="form-control" id="yourName" required>
                                        <div class="invalid-feedback">الاسم الشخصي مطلوب!</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">ايميل الدخول</label>
                                        <input type="email" name="email" class="form-control" id="yourEmail" required>
                                        <div class="invalid-feedback">الايميل مطلوب!</div>
                                    </div>





                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">كلمة المرور</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        <div class="invalid-feedback">كلمة المرور مطلوبة!</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">+972</span>
                                            <input type="text" class="form-control" placeholder="594419959" name="phone">
                                        </div>
                                    </div>

                                    <center><u><p>نوع المصلحة التجارية</p></u></center>
                                    <div class="col-12" >

                                        <div class="row">
                                            <div class="col-12">
                                            <select class="form-select" aria-label="Default select example" name="category">
                                                <option selected>Open this select menu</option>
                                            @foreach($category as $item)
                                                @if($item->hashcode!="7000")

                                                        <option value="{{$item->hashcode}}" >{{$item->title}}</option>


                                                @endif
                                            @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100">Create Account</button>
                                    </div>
                                    <div class="col-12">

                                        <p class="small mb-0">Already have an account? <a href="{{url('/')}}">Log in</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>





                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
<script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{asset('assets/vendor/chart.js/chart.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>
