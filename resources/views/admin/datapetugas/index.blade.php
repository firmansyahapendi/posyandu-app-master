@extends('admin.layout.index', ['title' => 'Data Petugas'])

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
                        <h1 class="m-0">Data Petugas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Data Petugas</li>
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
                                <button class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-keyboard="false"><span class="fa fa-plus"></span> Tambah Data Petugas</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover dataTable no-footer" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIP</th>
                                            <th>Nama Petugas</th>
                                            <th>No. Hp</th>
                                            <!-- <th>Jabatan</th> -->
                                            <th>Username</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>{{ $item->nama_petugas }}</td>
                                                <td>{{ $item->no_hp }}</td>
                                                <!-- <td>{{ $item->jabatan}}</td> -->
                                                <td>{{ $item->User->username }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" onclick="ubahData({{ $item }})"><span class="fa fa-pencil-alt"></span></button>
                                                    <button class="btn btn-danger btn-sm" onclick="hapusData({{ $item->id_petugas }})"><span class="fa fa-trash"></span></button>
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
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nip"><span class="text-danger">*</span> NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" required placeholder="Masukkan NIP">
                        </div>
                        <div class="form-group">
                            <label for="name"><span class="text-danger">*</span> Nama Petugas</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan nama Petugas">
                        </div>
                        <div class="form-group">
                            <label for="jabatan"><span class="text-danger">*</span> Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required placeholder="Masukkan Jabatan">
                        </div>
                        <div class="form-group">
                            <label for="no_hp"><span class="text-danger">*</span>No. Hp</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required placeholder="Masukkan No. Hp">
                        </div>
                        <div class="form-group">
                            <label for="alamat"><span class="text-danger">*</span>Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Masukkan alamat">
                        </div>
                        <div class="form-group">
                            <label for="username"><span class="text-danger">*</span>Username</label>
                            <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan Username">
                        </div>
                        <div class="form-group">
                            <label for="Password"><span class="text-danger">*</span>Password</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan Password">
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
                        <h5 class="modal-title" id="updateModalLabel">Ubah Data Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nip"><span class="text-danger">*</span> NIP</label>
                            <input type="text" class="form-control" id="nipupdate" name="nip"  placeholder="Masukkan NIP">
                        </div>
                        <div class="form-group">
                            <label for="name"><span class="text-danger">*</span> Nama Petugas</label>
                            <input type="text" class="form-control" id="nameupdate" name="name"  placeholder="Masukkan nama ibu">
                        </div>
                        <div class="form-group">
                            <label for="jabatanupdate"><span class="text-danger">*</span> Jabatan</label>
                            <input type="text" class="form-control" id="jabatanupdate" name="jabatan" required placeholder="Masukkan Jabatan">
                        </div>
                        <div class="form-group">
                            <label for="no_hp"><span class="text-danger">*</span>No. Hp</label>
                            <input type="text" class="form-control" id="no_hpupdate" name="no_hp"  placeholder="Masukkan No. Hp">
                        </div>
                        <div class="form-group">
                            <label for="alamat"><span class="text-danger">*</span>Alamat</label>
                            <input type="text" class="form-control" id="alamatupdate" name="alamat"  placeholder="Masukkan alamat">
                        </div>
                        <div class="form-group">
                            <label for="username"><span class="text-danger">*</span>No HP</label>
                            <input type="text" class="form-control" id="usernameupdate" name="username"  placeholder="Masukkan Username">
                        </div>
                        <div class="form-group">
                            <label for="Password"><span class="text-danger">*</span>Password</label>
                            <input type="password" class="form-control" id="passwordupdate" name="password"">
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
                    url: "{{ route('admin.datapetugas.insert') }}",
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
                    url: "{{ route('admin.datapetugas.update') }}",
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
                        url: "{{ route('admin.datapetugas.delete') }}",
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

        function ubahData(item) {
            $('#id').val(item.id_petugas);
            $('#nipupdate').val(item.nip);
            $('#nameupdate').val(item.nama_petugas);
            $('#alamatupdate').val(item.alamat);
            $('#no_hpupdate').val(item.no_hp);
            $('#jabatanupdate').val(item.jabatan);
            $('#usernameupdate').val(item.user.username);
            $('#updateModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    </script>
@endsection


                        