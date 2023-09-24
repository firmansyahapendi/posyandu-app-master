@extends('admin.layout.index', ['title' => 'Data Timbangan'])

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
                        <h1 class="m-0">Data Timbangan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Data Timbangan</li>
                        </ol>
                    </div> 
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                              <!-- Custom Tabs -->
                              <div class="card">
                                <div class="card-header d-flex p-0">
                                  <h3 class="card-title p-3">Hasil Timbang Anak</h3>
                                  <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Data Timbangan Bulan Ini</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Data Timbangan</a></li>
                                  </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                  <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <table class="table table-bordered table-striped table-hover dataTable no-footer" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Anak</th>
                                                    <th>Umur</th>
                                                    <th>BB/TB</th>
                                                    <th>Tanggal Timbang</th>
                                                    <th>Status Gizi</th>
                                                    <th>Keterangan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list as $key => $item)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $item->Dataanak->nama_anak }}</td>
                                                        <td>
                                                        @php
                                                            $birthDt = new DateTime($item->Dataanak->tgl_lhr);
                                                            $today = new DateTime($item->tanggal_pencatatan);
                                                            $y = $today->diff($birthDt)->y;
                                                            $m = $today->diff($birthDt)->m;
                                                            $d = $today->diff($birthDt)->d;
                                                        @endphp
                                                        @if ($today != null)
                                                            @if ($y == 0)
                                                                @if ($m < 1)
                                                                    {{ $m }} Bulan ({{ $d }} Hari)
                                                                @else
                                                                    {{ $m }} Bulan
                                                                @endif
                                                            @elseif ($y == 1)
                                                                {{ $m+12 }} Bulan
                                                            @elseif ($y == 2)
                                                                {{ $m+24 }} Bulan
                                                            @elseif ($y == 3)
                                                                {{ $m+36 }} Bulan
                                                            @elseif ($y == 4)
                                                                {{ $m+48 }} Bulan
                                                            @elseif ($y == 5)
                                                                {{ $m+60 }} Bulan
                                                            @else
                                                                Bayi Lulus
                                                            @endif
                                                        @endif 
                                                        </td>
                                                        <td>{{ $item->berat_badan }} Kg / {{ $item->tinggi_badan }} cm</td>
                                                        <td>{{ Tgl_Indo($item->tanggal_pencatatan) }}</td>
                                                        <td>{{ $item->status_gizi }}</td>
                                                        <td>{{ $item->ket_timbangan }}</td>
                                                        <td>
                                                           
                                                            <button class="btn btn-primary btn-sm" onclick="ubahData({{ $item }})"><span class="fa fa-pencil-alt"></span></button>
                                                            {{-- <button class="btn btn-danger btn-sm" onclick="hapusData({{ $item }})"><span class="fa fa-trash"></span></button> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <table class="table table-bordered table-striped table-hover dataTable no-footer" id="datatable2">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Anak</th>
                                                    <th>Umur</th>
                                                    <th>BB/TB</th>
                                                    <th>Tanggal Timbang</th>
                                                    <th>Status Gizi</th>
                                                    <th>Keterangan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list2 as $key => $item)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $item->Dataanak->nama_anak }}</td>
                                                        <td>
                                                        @php
                                                            $birthDt = new DateTime($item->Dataanak->tgl_lhr);
                                                            $today = new DateTime($item->tanggal_pencatatan);
                                                            $y = $today->diff($birthDt)->y;
                                                            $m = $today->diff($birthDt)->m;
                                                            $d = $today->diff($birthDt)->d;
                                                        @endphp
                                                        @if ($today != null)
                                                            @if ($y == 0)
                                                                @if ($m < 1)
                                                                    {{ $m }} Bulan ({{ $d }} Hari)
                                                                @else
                                                                    {{ $m }} Bulan
                                                                @endif
                                                            @elseif ($y == 1)
                                                                {{ $m+12 }} Bulan
                                                            @elseif ($y == 2)
                                                                {{ $m+24 }} Bulan
                                                            @elseif ($y == 3)
                                                                {{ $m+36 }} Bulan
                                                            @elseif ($y == 4)
                                                                {{ $m+48 }} Bulan
                                                            @elseif ($y == 5)
                                                                {{ $m+60 }} Bulan
                                                            @else
                                                                Bayi Lulus
                                                            @endif
                                                        @endif 
                                                        </td>
                                                        <td>{{ $item->berat_badan }} Kg / {{ $item->tinggi_badan }} cm</td>
                                                        <td>{{ Tgl_Indo($item->tanggal_pencatatan) }}</td>
                                                        <td>{{ $item->status_gizi }}</td>
                                                        <td>{{ $item->ket_timbangan }}</td>
                                                        <td>
                                                           
                                                            <button class="btn btn-primary btn-sm" onclick="ubahData({{ $item }})"><span class="fa fa-pencil-alt"></span></button>
                                                            {{-- <button class="btn btn-danger btn-sm" onclick="hapusData({{ $item }})"><span class="fa fa-trash"></span></button> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.tab-pane -->                                    
                                  </div>
                                  <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                              </div>
                              <!-- ./card -->
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
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
                        <h5 class="modal-title" id="addModalLabel">Tambah Timbangan</h5>
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
                                    @foreach ($Anak as $item)
                                        <option value="{{ $item->id_anak }}">{{ $item->nama_anak }} ({{ $item->nik }})</option>
                                    @endforeach
                              </select>
                            </div>
                          
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="jenkel"><span class="text-danger">*</span> Berat Badan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-balance-scale"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="berat_badan" name="berat_badan" required placeholder="Isi Berat Badan">
                                        <div class="input-group-append">
                                            <div class="input-group-text">Kg</div>
                                        </div id="tinggi_badan" name="tinggi_badan" required placeholder="Isi Tinngi Badan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="jenkel"><span class="text-danger">*</span> Tinggi Badan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-arrow-up"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control"  id="tinggi_badan" name="tinggi_badan" required placeholder="Isi Tinngi Badan">
                                        <div class="input-group-append">
                                            <div class="input-group-text">cm</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p style="color: grey">Note : Gunakan (.) sebagai pengganti (,)</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="tgl_lahir"><span class="text-danger">*</span>Tanggal Proses</label>
                            <input type="date" class="form-control" id="tanggal_pencatatan" name="tanggal_pencatatan" required placeholder="Proses">
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
                        <h5 class="modal-title" id="updateModalLabel">Ubah Data Timbangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name"><span class="text-danger">*</span>Tinggi Badan</label>
                            <input type="text" class="form-control" id="tinggi_badanupdate" name="tinggi_badan" required placeholder="Isi Tinngi Badan">
                        </div>
                        <div class="form-group">
                            <label for="tmp_lahir"><span class="text-danger">*</span>Berat Badan</label>
                            <input type="text" class="form-control" id="berat_badanupdate" name="berat_badan" required placeholder="Isi Berat Badan">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir"><span class="text-danger">*</span>Tanggal Proses</label>
                            <input type="date" class="form-control" id="tanggal_pencatatanupdate" name="tanggal_pencatatan" required placeholder="Proses">
                        </div>
                        <label for="dataanakupdate"><span class="text-danger">*</span> Data Anak</label>
                          <select name="dataanak" id= "dataanakupdate" required class="form-control select2">
                                <option value="">-- Pilih Anak Ibu --</option>
                                @foreach ($Anak as $item)
                                    <option value="{{ $item->id_anak }}">{{ $item->nama_anak }} ({{ $item->nik }})</option>
                                @endforeach
                          </select>
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
            $('#datatable2').DataTable({
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
                    url: "{{ route('admin.timbangan.insert') }}",
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
                    url: "{{ route('admin.timbangan.update') }}",
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
                        url: "{{ route('admin.timbangan.delete') }}",
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
            $('#tanggal_pencatatanupdate').val(item.tanggal_pencatatan);
            $('#tinggi_badanupdate').val(item.tinggi_badan);
            $('#berat_badanupdate').val(item.berat_badan);
            $('#dataanakupdate').val(item.id_anak).trigger('change');
            $('#updateModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    </script>
@endsection


                        