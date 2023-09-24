@extends('admin.layout.index', ['title' => 'Data Ibu'])

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
   
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Ibu</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Data Ibu</li>
                        </ol>
                    </div> 
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-keyboard="false"><span class="fa fa-plus"></span> Tambah Data Ibu</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover dataTable no-footer" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIK</th>
                                            <th>Nama Ibu</th>
                                            <th>Nama Suami</th>
                                            <th>Alamat</th>
                                            <th>No. Hp</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama_ibu }}</td>
                                                <td>{{ $item->nama_suami }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->no_hp }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-primary btn-sm" onclick="ubahData({{ $item }})"><span class="fa fa-pencil-alt"></span></button>
                                                        <a href="{{route('admin.dataibu.detail', $item->id_ibu)}}" class="btn btn-success btn-sm" ><span class="fa fa-id-card"></span></a>
                                                        <button class="btn btn-danger btn-sm" onclick="hapusData({{ $item->id_ibu }})"><span class="fa fa-trash"></span></button>
                                                        @if($item->User->status == 0)
                                                        <button class="btn btn-success btn-sm" onclick="aktivasiData({{ $item->id_user }})"><span class="fa fa-check"></span></button>
                                                        @else
                                                        <button class="btn btn-warning btn-sm" onclick="nonaktivasiData({{ $item->id_user }})"><span class="fa fa-times"></span></button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="javascript:void(0)" id="formInsert" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Ibu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nik"><span class="text-danger">*</span> NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" required placeholder="Masukkan NIK">
                        </div>
                        <div class="form-group">
                            <label for="name"><span class="text-danger">*</span> Nama Ibu</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan nama ibu">
                        </div>
                        <div class="form-group">
                            <label for="name_suami"><span class="text-danger">*</span> Nama Suami</label>
                            <input type="text" class="form-control" id="name_suami" name="name_suami" required placeholder="Masukkan nama suami">
                        </div>
                        
                        <div class="form-group">
                            <label for="tmp_lahir"><span class="text-danger">*</span>Tempat Lahir</label>
                            <input type="text" class="form-control" id="tmp_lahir" name="tempat_lahir" required placeholder="Masukkan tempat lahir">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir"><span class="text-danger">*</span>Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tanggal_lahir" required placeholder="Masukkan tanggal lahir">
                        </div>
                        <div class="form-group">
                            <label for="alamat"><span class="text-danger">*</span>Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Masukkan alamat">
                        </div>
                        <div class="form-group">
                            <label for="no_hp"><span class="text-danger">*</span>No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required placeholder="Masukkan no hp">
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan"><span class="text-danger">*</span>Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required placeholder="Masukkan pekerjaan">
                        </div>
                        <div class="form-group">
                            <label for="pek_suami"><span class="text-danger">*</span>Pekerjaan Suami</label>
                            <input type="text" class="form-control" id="pek_suami" name="pek_suami" required placeholder="Masukkan pekerjaan suami">
                        </div>
                        <div class="form-group">
                            <label for="username"><span class="text-danger">*</span>Username</label>
                            <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan username">
                        </div>
                        <div class="form-group">
                            <label for="password"><span class="text-danger">*</span>Password</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-ban"></span> Batal</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="javascript:void(0)" id="formUpdate" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="id" required>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Ubah Data Ibu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nikupdate"><span class="text-danger">*</span> NIK</label>
                            <input type="text" readonly class="form-control" id="nikupdate" name="nik" required placeholder="Masukkan NIK">
                        </div>
                        <div class="form-group">
                            <label for="nameupdate"><span class="text-danger">*</span> Nama Ibu</label>
                            <input type="text" class="form-control" id="nameupdate" name="name" required placeholder="Masukkan nama ibu">
                        </div>
                        <div class="form-group">
                            <label for="namesuamiupdate"><span class="text-danger">*</span> Nama Suami</label>
                            <input type="text" class="form-control" id="namesuamiupdate" name="name_suami" required placeholder="Masukkan nama suami">
                        </div>
                        <div class="form-group">
                            <label for="tmp_lahirupdate"><span class="text-danger">*</span>Tempat Lahir</label>
                            <input type="text" class="form-control" id="tmp_lahirupdate" name="tempat_lahir" required placeholder="Masukkan tempat lahir">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahirupdate"><span class="text-danger">*</span>Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahirupdate" name="tanggal_lahir" required placeholder="Masukkan tanggal lahir">
                        </div>
                        <div class="form-group">
                            <label for="alamatupdate"><span class="text-danger">*</span>Alamat</label>
                            <input type="text" class="form-control" id="alamatupdate" name="alamat" required placeholder="Masukkan alamat">
                        </div>
                        <div class="form-group">
                            <label for="no_hpupdate"><span class="text-danger">*</span>No HP</label>
                            <input type="text" class="form-control" id="no_hpupdate" name="no_hp" required placeholder="Masukkan no hp">
                        </div>
                        <div class="form-group">
                            <label for="pekerjaanupdate"><span class="text-danger">*</span>Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaanupdate" name="pekerjaan" required placeholder="Masukkan pekerjaan">
                        </div>
                        <div class="form-group">
                            <label for="pek_suamiupdate"><span class="text-danger">*</span>Pekerjaan Suami</label>
                            <input type="text" class="form-control" id="pek_suamiupdate" name="pek_suami" required placeholder="Masukkan Pekerjaan Suami">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-ban"></span> Batal</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                order: [
                    [0, "asc"]
                ],
                columnDefs: [{
                    "targets": 3,
                    "orderable": false
                }]
            });

            $('#formInsert').on('submit', (function(e) {
                $.LoadingOverlay("show");
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.dataibu.insert') }}",
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
                                    location.reload();
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

            $('#formUpdate').on('submit', (function(e) {
                $.LoadingOverlay("show");
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.dataibu.update') }}",
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
                                    location.reload();
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

        function hapusData(id) {
            swal({
                title: "Apakah anda yakin ?",
                text: "Ketika data telah dihapus, tidak bisa dikembalikan lagi!",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        method: 'DELETE',
                        url: "{{ route('admin.dataibu.delete') }}",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data: {
                            id
                        },
                        success: function(data, status, xhr) {
                            $.LoadingOverlay("hide");
                            try {
                                var result = JSON.parse(xhr.responseText);
                                if (result.status) {
                                    swal(result.message, {
                                        icon: "success",
                                    }).then((acc) => {
                                        location.reload();
                                    });
                                } else {
                                    swal("Warning!", "Terjadi kesalahan sistem", "warning");
                                }
                            } catch (e) {
                                swal("Warning!", "Terjadi kesalahan sistem", "error");
                            }
                        },
                        error: function(data) {
                            $.LoadingOverlay("hide");
                            swal("Warning!", "Terjadi kesalahan sistem", "error");
                        }
                    });
                }
            });
        }

        function aktivasiData(id) {
            swal({
                title: "Apakah anda yakin ?",
                text: "Ketika data telah diaktifkan, user akan bisa masuk!",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('admin.dataibu.aktivasi') }}",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data: {
                            'id': id,
                            'status': 1
                        },
                        success: function(data, status, xhr) {
                            $.LoadingOverlay("hide");
                            try {
                                var result = JSON.parse(xhr.responseText);
                                if (result.status) {
                                    swal(result.message, {
                                        icon: "success",
                                    }).then((acc) => {
                                        location.reload();
                                    });
                                } else {
                                    swal("Warning!", "Terjadi kesalahan sistem", "warning");
                                }
                            } catch (e) {
                                swal("Warning!", "Terjadi kesalahan sistem", "error");
                            }
                        },
                        error: function(data) {
                            $.LoadingOverlay("hide");
                            swal("Warning!", "Terjadi kesalahan sistem", "error");
                        }
                    });
                }
            });
        }

        function nonaktivasiData(id) {
            swal({
                title: "Apakah anda yakin ?",
                text: "Ketika data telah dinonaktifkan, user tidak bisa masuk!",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.LoadingOverlay("show");
                    $.ajax({
                        method: 'PUT',
                        url: "{{ route('admin.dataibu.aktivasi') }}",
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data: {
                            'id': id,
                            'status': 0
                        },
                        success: function(data, status, xhr) {
                            $.LoadingOverlay("hide");
                            try {
                                var result = JSON.parse(xhr.responseText);
                                if (result.status) {
                                    swal(result.message, {
                                        icon: "success",
                                    }).then((acc) => {
                                        location.reload();
                                    });
                                } else {
                                    swal("Warning!", "Terjadi kesalahan sistem", "warning");
                                }
                            } catch (e) {
                                swal("Warning!", "Terjadi kesalahan sistem", "error");
                            }
                        },
                        error: function(data) {
                            $.LoadingOverlay("hide");
                            swal("Warning!", "Terjadi kesalahan sistem", "error");
                        }
                    });
                }
            });
        }
        
        function ubahData(item) {
            $('#id').val(item.id_ibu);
            $('#nikupdate').val(item.nik);
            $('#nameupdate').val(item.nama_ibu);
            $('#namesuamiupdate').val(item.nama_suami);
            $('#tmp_lahirupdate').val(item.tmp_lhr);
            $('#tgl_lahirupdate').val(item.tgl_lhr);
            $('#alamatupdate').val(item.alamat);
            $('#no_hpupdate').val(item.no_hp);
            $('#pekerjaanupdate').val(item.pekerjaan);
            $('#pek_suamiupdate').val(item.pekerjaan_suami);
            $('#updateModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    </script>
@endsection


                        