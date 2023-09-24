@extends('admin.layout.index', ['title' => 'Data Pemberian Vitamin A'])

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
                        <h1 class="m-0">Data Pemberian Vitamin A</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Data Pemberian Vitamin A</li>
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
                                {{-- <button class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-keyboard="false"><span class="fa fa-plus"></span> Tambah Data Vitamin A</button> --}}
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover dataTable no-footer " id="datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Anak</th>
                                            <th>Nama Ibu/Ayah</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Umur Anak</th>
                                            <th>Tanggal Pemberian</th>
                                            <th>Keterangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->nama_anak }}</td>
                                                <td>{{ $item->nama_ibu }} / {{ $item->nama_suami }}</td>
                                                <td>@if ($item->jenkel == 'L')
                                                        Laki-laki
                                                    @else
                                                        Perempuan
                                                    @endif</td>
                                                <td>
                                                    @php
                                                            $birthDt = new DateTime($item->tgl_lhr);
                                                            $today = new DateTime($item->tgl_vitA);
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
                                                                Bayi
                                                            @endif
                                                        @endif
                                                </td>
                                                <td>{{ Tgl_Indo($item->tgl_vitA) }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" onclick='ubahData({!! $item !!})'><span class="fa fa-pencil-alt"></span></button>
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
                                        <option value="{{ $item->id_anak }}">{{ $item->nama_anak }}</option>
                                    @endforeach

                              </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="tgl_vitAUpdate"><span class="text-danger">*</span> Tanggal Pemberian </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-list-ol"></i>
                                    </span>
                                </div>
                                <input type="date" name="tgl_vitA" id="tgl_vitAUpdate" class="form-control" required>

                            </div>
                            <p style="color: grey">Note : Dapat diisi lebih dari satu</p>
                        </div>

                        <div class="form-group">
                            <label for="keteranganupdate"><span class="text-danger">*</span> Nama Vitamin A</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-child"></i>
                                    </span>
                                </div>
                                <select name="vitamin" id= "keteranganupdate" required class="form-control select2">
                                    <option value="">-- Pilih Vitamin A --</option>
                                    <option value="Vitamin A Biru">Vitamin A Biru</option>
                                    <option value="Vitamin A Merah">Vitamin A Merah</option>
                              </select>
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

            $('#formUpdate').on('submit', (function(e) {
                $.LoadingOverlay("show");
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.vitamin.update') }}",
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

        function ubahData(item) {
            $('#id').val(item.id_vitA);
            $('#dataanakupdate').val(item.id_anak).trigger('change');
            $('#tgl_vitAUpdate').val(item.tgl_vitA);
            $('#keteranganupdate').val(item.keterangan).trigger('change');
            $('#updateModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
    </script>
@endsection


