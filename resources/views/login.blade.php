<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Posyandu Apps</title>
        <link rel="icon" type="image/png" href="#.ico">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Login Posyandu Apps</p>
                    <form action="javascript:void(0)" method="post" id="loginForm">
                        <div class="input-group mb-3">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" id="remember" value="1">
                                    <label for="remember"> Ingat Saya </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">LOGIN</button>

                        {{-- <p class="mb-1 mt-3"> --}}
                            {{-- <a href="#">Lupa Password</a>
                        </p> --}}

                        <p class="mb-1 mt-3">
                            <a href="{{route('register')}}" class="text-center">Daftar Akun Ibu Baru</a>
                        </p>


                    </form>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#loginForm').on('submit',(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.LoadingOverlay("show");
                    $.ajax({
                        method  : "POST",
                        url     : "{{ route('login.post') }}",
                        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data    : formData,
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function(data, status, xhr) {
                            $.LoadingOverlay("hide");
                            try {
                                var result = JSON.parse(xhr.responseText);
                                if (result.status == true) {
                                    swal({
                                        title: "Login Success",
                                        icon: "success",
                                    }).then((acc) => {
                                        // if(result.role == 'admin'){
                                        //     window.location.href = "{{ route('admin.dashboard') }}";
                                        // }else if(result.role == 'ibu'){
                                        //     window.location.href = "{{ url('/ibu') }}";
                                        // }else if(result.role == 'bidan'){
                                        //     window.location.href = "{{ url('bidan') }}";
                                        // }else{
                                        //     window.location.href = "{{ route('login') }}";
                                        // }
                                        location.reload();
                                    });
                                } else {
                                swal("Warning!", result.message, "warning");
                                }
                            } catch (e) {
                                swal("Warning!", "Sistem error.", "warning");
                            }
                        },
                        error: function(data) {
                            $.LoadingOverlay("hide");
                            swal("Warning!", "Gagal Tersambung Dengan Sistem.", "warning");
                        }
                    });
                }));
            });
        </script>
    </body>
</html>