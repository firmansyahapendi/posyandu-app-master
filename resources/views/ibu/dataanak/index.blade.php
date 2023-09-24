@extends('ibu.layout.index', ['title' => 'Data Anak'])

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
                        <h1 class="m-0">Data Anak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Data Anak</li>
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
                                <button class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-keyboard="false"><span class="fa fa-plus"></span> Tambah Data Anak</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover dataTable no-footer" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIK</th>
                                            <th>Nama Anak</th>
                                            <th>Nama Ibu</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>KMS</th>
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama_anak }}</td>
                                                <td>{{ $item->Dataibu->nama_ibu }}</td>
                                                <td>
                                                    @if($item->jenkel == 'L')
                                                        Laki-laki
                                                    @else
                                                        Perempuan
                                                    @endif
                                                </td>
                                                <td>{{ $item->tmp_lhr.", ". Tgl_Indo($item->tgl_lhr) }}</td>
                                                <td>
                                                    @if ($item->kms == 0)
                                                        <i class="fas fa-check-circle fa-lg" aria-hidden="true" style="color: green"></i>
                                                    @else
                                                        <i class="fas fa-times-circle fa-lg" aria-hidden="true" style="color: red"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-primary btn-sm" onclick="ubahData({{ $item }})"><span class="fa fa-pencil-alt"></span></button>
                                                        <a href="{{route('ibu.dataanak.detailanak', $item->id_anak)}}" class="btn btn-success btn-sm" ><span class="fa fa-id-card"></span></a>
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
    
    {{-- Modal Tambah Data --}}
    <div class="modal fade" id="addModal" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form action="javascript:void(0)" id="formInsert" method="POST">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Anak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nik"><span class="text-danger">*</span> NIK</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-list-ol"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="nik" name="nik" required placeholder="Masukkan NIK">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_anak"><span class="text-danger">*</span> Nama Anak</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-child"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="nama_anak" name="nama_anak" required placeholder="Masukkan nama anak">
                    </div>
                </div>
                {{-- <div class="form-group ">
                    <label for="dataanak"><span class="text-danger">*</span> Nama Orangtua</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-venus-mars"></i>
                            </span>
                        </div>
                        <select name="dataibu" id= "dataibu" required class="form-control select2bs4">
                            <option value="" disabled>-- Pilih Data Orangtua --</option>
                            @foreach ($Ibu as $item)
                                <option value="{{ $item->id_ibu }}" @if (Auth::user()->id == $item->id_user) selected @endif @if(Auth::user()->id != $item->id_user) disabled @endif >{{ $item->nama_ibu }} - {{ $item->nama_suami }}</option>
                            @endforeach
                        </select>
                    </div>
                
                </div> --}}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="jenkel"><span class="text-danger">*</span> Tempat Lahir </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-home"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="tmp_lahir" name="tempat_lahir" required placeholder="Masukkan tempat lahir">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="jenkel"><span class="text-danger">*</span> Tanggal Lahir</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                <input type="date" class="form-control" id="tgl_lahir" name="tanggal_lahir" required placeholder="Masukkan tanggal lahir">
                            </div>
                        </div>
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
                                <input type="text" class="form-control" id="berat_badan" name="berat_badan" required placeholder="Berat Badan">
                                <div class="input-group-append">
                                    <div class="input-group-text">Kg</div>
                                </div>
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
                                <input type="text" class="form-control"  id="tinggi_badan" name="tinggi_badan" required placeholder="Tinggi Badan">
                                <div class="input-group-append">
                                    <div class="input-group-text">cm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p style="color: grey">Note : Gunakan (.) sebagai pengganti (,)</p>
                </div>

                <div class="form-group">
                    <label for="jenkel"><span class="text-danger">*</span> Jenis Kelamin</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-venus-mars"></i>
                            </span>
                        </div>
                        <select name="jenkel" id= "jenkel" required class="form-control">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="anak_ke"><span class="text-danger">*</span> Anak Ke</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-list-ol"></i>
                            </span>
                        </div>
                        <input type="number" class="form-control" id="anak_ke" name="anak_ke" required placeholder="Anak Ke" min="1">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"><span class="fa fa-ban"></span> Batal</button>
                <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
            </div>
          </div>
        </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


    {{-- Modal Update Data --}}
    <div class="modal fade" id="updateModal"  aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="javascript:void(0)" id="formUpdate" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="id" required>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Ubah Data Anak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nik"><span class="text-danger">*</span> NIK</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-list-ol"></i>
                                    </span>
                                </div>
                                <input type="text" readonly class="form-control" id="nikupdate" name="nik" required placeholder="Masukkan NIK">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_anak"><span class="text-danger">*</span> Nama Anak</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-child"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="nameupdate" name="name" required placeholder="Masukkan nama anak">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="jenkel"><span class="text-danger">*</span> Tempat Lahir </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-home"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="tmp_lahirupdate" name="tempat_lahir" required placeholder="Masukkan tempat lahir">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="jenkel"><span class="text-danger">*</span> Tanggal Lahir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input type="date" class="form-control" id="tgl_lahirupdate" name="tanggal_lahir" required placeholder="Masukkan tanggal lahir">
                                    </div>
                                </div>
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
                                        <input type="text" class="form-control" id="berat_badanupdate" name="berat_badan" required placeholder="Berat Badan">
                                        <div class="input-group-append">
                                            <div class="input-group-text">Kg</div>
                                        </div>
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
                                        <input type="text" class="form-control"  id="tinggi_badanupdate" name="tinggi_badan" required placeholder="Tinggi Badan">
                                        <div class="input-group-append">
                                            <div class="input-group-text">cm</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p style="color: grey">Note : Gunakan (.) sebagai pengganti (,)</p>
                        </div>
        
                        <div class="form-group">
                            <label for="jenkel"><span class="text-danger">*</span> Jenis Kelamin</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-venus-mars"></i>
                                    </span>
                                </div>
                                <select name="jenkel" id= "jenkelupdate" required class="form-control">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P" >Perempuan</option>       
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="anak_ke"><span class="text-danger">*</span> Anak Ke</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-list-ol"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control" id="anak_keupdate" name="anak_ke" required placeholder="Anak Ke" min="1">
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
        $('.select2bs4').select2({
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
                url: "{{ route('ibu.dataanak.insert') }}",
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
                url: "{{ route('ibu.dataanak.update') }}",
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
        $('#id').val(item.id_anak);
        $('#nikupdate').val(item.nik);
        $('#nameupdate').val(item.nama_anak);
        $('#tmp_lahirupdate').val(item.tmp_lhr);
        $('#tgl_lahirupdate').val(item.tgl_lhr);
        $('#jenkelupdate').val(item.jenkel).trigger('change');
        $('#berat_badanupdate').val(item.bb_lahir);
        $('#tinggi_badanupdate').val(item.tb_lahir);
        $('#anak_keupdate').val(item.anak_ke);
        
        $('#updateModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    }
    
</script>
<script type='text/javascript'>
        

    @if ($dataDiri == 0)
    setTimeout(function() {
        swal({
            title: "Data Belum Diisi",
            text: "Silahkan isi data terlebih dahulu",
            icon: "info",
            type: "danger",
            dangerMode: true,
            
        }).then(function() {
                window.location.href = "{{ route('ibu.dataibu.update') }}";
        });
    }, 500);
    @endif
    
</script>

@endsection

