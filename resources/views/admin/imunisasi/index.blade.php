@extends('admin.layout.index', ['title' => 'Data Imunisasi'])

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
                        <h1 class="m-0">Data Imunisasi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Data Imunisasi</li>
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
                                <button class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-keyboard="false"><span class="fa fa-plus"></span> Tambah Data Imunisasi</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover dataTable no-footer " id="datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Anak</th>
                                            <th>Nama Imunisasi</th>
                                            <th>Tanggal Imunisasi</th>
                                            <th>Booster</th>
                                            <th>Keterangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->data_anak->nama_anak }}</td>
                                                <td>{{ $item->vaksin->nama_vaksin }} </td>
                                                <td>{{ Tgl_Indo($item->tanggal_imunisasi) }}</td>
                                                <td>{{ $item->booster }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" onclick='ubahData({!! $item !!})'><span class="fa fa-pencil-alt"></span></button>
                                                    <button class="btn btn-danger btn-sm" onclick="hapusData({{ $item->id }})"><span class="fa fa-trash"></span></button>
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
    
    <div class="modal fade" id="addModal" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="javascript:void(0)" id="formInsert" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Imunisasi Anak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="dataanak"><span class="text-danger">*</span> Nama Anak</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-child"></i>
                                    </span>
                                </div>
                                <select name="dataanak" id= "dataanak" required class="form-control select2">
                                    <option value="">-- Pilih Anak --</option>
                                    @foreach ($anak as $item)
                                        <option value="{{ $item->id_anak }}">{{ $item->nama_anak }} - (ibu: {{ $item->Dataibu->nama_ibu }})</option>
                                    @endforeach
                              </select>
                            </div>
                          
                        </div>
                        <div class="form-group">
                            <label for="imunisasi"><span class="text-danger">*</span> Imunisasi </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-list-ol"></i>
                                    </span>
                                </div>
                                <select class="select2" name="imunisasi[]" multiple="multiple" data-placeholder="Pilih Imunisasi">
                                    @foreach ($vaksin as $item)
                                        <option value="{{ $item->id_vaksin }}">{{ $item->nama_vaksin }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p style="color: grey">Note : Dapat diisi lebih dari satu</p>
                        </div>
                        <div class="row">
                            <div class="form-group col-7">
                                <label for="tgl_imun"><span class="text-danger">*</span> Tanggal Imunisasi </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-list-ol"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="tgl_imunisasi" id="tgl_imunisasi" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="booster"><span class="text-danger">*</span> Booster </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div>&nbsp;&nbsp;
                                    &nbsp;&nbsp;<input type="radio" name="booster" value="Ya"> Ya &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="booster" value="Tidak"> Tidak
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="keterangan"><span class="text-danger">*</span> Keterangan </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                            </div>
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

    <div class="modal fade" id="updateModal" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="javascript:void(0)" id="formUpdate" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="id" required>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Ubah Data Vaksin/Imunisasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="dataanakupdate"><span class="text-danger">*</span> Nama Anak</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-child"></i>
                                    </span>
                                </div>
                                <select name="dataanak" id= "dataanakupdate" required class="form-control select2">
                                    <option value="">-- Pilih Anak --</option>
                                    @foreach ($anak as $item)
                                        <option value="{{ $item->id_anak }}">{{ $item->nama_anak }} - (ibu: {{ $item->Dataibu->nama_ibu }})</option>
                                    @endforeach
                              </select>
                            </div>
                          
                        </div>
                        <div class="form-group">
                            <label for="imunisasiupdate"><span class="text-danger">*</span> Imunisasi </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-list-ol"></i>
                                    </span>
                                </div>
                                <select class="select2" name="imunisasi" id="imunisasiupdate"  data-placeholder="Pilih Imunisasi">
                                    @foreach ($vaksin as $item)
                                        <option value="{{ $item->id_vaksin }}">{{ $item->nama_vaksin }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p style="color: grey">Note : Dapat diisi lebih dari satu</p>
                        </div>
                        <div class="row">
                            <div class="form-group col-7">
                                <label for="tgl_imunisasiupdate"><span class="text-danger">*</span> Tanggal Imunisasi </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-list-ol"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="tgl_imunisasi" id="tgl_imunisasiupdate" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="booster"><span class="text-danger">*</span> Booster </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div>&nbsp;&nbsp;
                                    &nbsp;&nbsp;<input type="radio" name="booster" id="boosterupdateya" value="Ya"> Ya &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="booster" id="boosterupdateno" value="Tidak"> Tidak
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="keteranganupdate"><span class="text-danger">*</span> Keterangan </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <textarea name="keterangan" id="keteranganupdate" class="form-control" required></textarea>
                            </div>
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
            $('.select2').select2({
                theme: 'bootstrap4',
            })
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
                    url: "{{ route('admin.imunisasi.insert') }}",
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
                    url: "{{ route('admin.imunisasi.update') }}",
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
                        url: "{{ route('admin.imunisasi.delete') }}",
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
            $('#id').val(item.id);
            $('#dataanakupdate').val(item.id_anak).trigger('change');
            $('#imunisasiupdate').val(item.id_vaksin).trigger('change');
            $('#tgl_imunisasiupdate').val(item.tanggal_imunisasi);
            if(item.booster == "Ya"){
                $('#boosterupdateya').prop('checked', true);
            }else{
                $('#boosterupdateno').prop('checked', true);
            }
            $('#keteranganupdate').val(item.keterangan);
            $('#updateModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    </script>
@endsection


                        