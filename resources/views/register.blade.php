<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Datar Baru - Posyandu Apps</title>
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
                    <p class="login-box-msg">Daftar Akun Ibu Baru Posyandu Apps</p>
                    <form action="javascript:void(0)" method="post" id="formInsert">
                        <div class="input-group mb-3">
                            <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
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
                        <button type="submit" class="btn btn-primary btn-block mt-3">Daftar Baru</button>
                        
                        <p class="mt-3 mb-1">
                            <a href="{{ route('login') }}">Sudah Punya Akun ?</a>
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
                $('#formInsert').on('submit', (function(e) {
                    $.LoadingOverlay("show");
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('register.store') }}",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data, status, xhr) {
                            $.LoadingOverlay("hide");
                            try {
                                var result = JSON.parse(xhr.responseText);
                                if (result.status) {
                                    swal(result.message, {
                                        icon: "success",
                                        title: "Success",
                                        text: result.message,
                                    }).then((acc) => {
                                        window.location.href = "{{ route('login') }}";
                                    });
                                } else {
                                    swal("Warning!", result.message, "warning");
                                }
                            } catch (e) {
                                swal("Warning!", "Terjadi kesahalan sistem", "error");
                            }
                        },
                        error: function(data) {
                            $.LoadingOverlay("hide");
                            swal("Warning!", "Terjadi kesahalan sistem", "error");
                        }
                    });
                }));
            });
        </script>
    </body>
</html>