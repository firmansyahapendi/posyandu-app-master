@extends('ibu.layout.index', ['title' => 'Update Ibu'])

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update Data Ibu</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Update Data Ibu</li>
                        </ol>
                    </div> 
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                          <div class="card-body box-profile">
                            <div class="text-center">
                                      <img class="profile-user-img img-fluid img-circle"
                                      src="{{asset('assets/dist/img/avatar2.png')}}"
                                        alt="User profile picture">
                            </div>
            
                            <h3 class="profile-username text-center">{{$list->nama_ibu}}</h3>
            
                            <p class="text-muted text-center">{{$list->nik}}</p>
            
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <b>Tempat Lahir</b> <a class="float-right">{{$list->tmp_lhr}}</a>
                              </li>
                              <li class="list-group-item">
                                <b>Tanggal Lahir</b> <a class="float-right">{{Tgl_Indo($list->tgl_lhr)}}</a>
                              </li>
                              <li class="list-group-item">
                                <b>No. Hp</b> <a class="float-right">{{$list->no_hp}}</a>
                              </li>
                            </ul>
                            
                            <a href="{{route('ibu.dataibu.detailibu')}}" class="btn btn-primary btn-block"><b>Kembali</b></a>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-9">
                        <div class="card">
                          <div class="card-header p-2">
                            <ul class="nav nav-pills">
                              <li class="nav-item"><a class="nav-link active" href="#Update" data-toggle="tab">Update Ibu</a></li>
                            </ul>
                          </div><!-- /.card-header -->
                          <div class="card-body">
                            <div class="tab-content">
                              <div class="active tab-pane" id="Update">
                                <!-- The timeline -->
                                <span class="nav-link bg-danger">
                                  Terdaftar Pada {{Tgl_Indo($list->created_at)}}
                                </span>
                                <br>
                                  <!-- /.timeline-label -->
                                  <!-- timeline item -->
                                  
                                <form action="javascript:void(0)" id="formUpdate" method="POST" class="form-horizontal">
                                  <div class="form-group">
                                    <label for="nik"><span class="text-danger">*</span> NIK</label>
                                    <input type="hidden" name="id" value=" {{$list->id_ibu}}" >
                                    <input type="text" class="form-control" id="nik" name="nik" required placeholder="Masukkan NIK" value="{{$list->nik}}">
                                </div>
                                <div class="form-group">
                                    <label for="name"><span class="text-danger">*</span> Nama Ibu</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan nama ibu" value="{{$list->nama_ibu}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_suami"><span class="text-danger">*</span> Nama Suami</label>
                                    <input type="text" class="form-control" id="name_suami" name="name_suami" required placeholder="Masukkan nama suami" value="{{$list->nama_suami}}">
                                </div>
                                <div class="form-group">
                                  <label for="tmp_lahir"><span class="text-danger">*</span>Tempat Lahir</label>
                                  <input type="text" class="form-control" id="tmp_lahir" name="tempat_lahir" required placeholder="Masukkan tempat lahir" value="{{$list->tmp_lhr}}">
                              </div>
                              <div class="form-group">
                                  <label for="tgl_lahir"><span class="text-danger">*</span>Tanggal Lahir</label>
                                  <input type="date" class="form-control" id="tgl_lahir" name="tanggal_lahir" required placeholder="Masukkan tanggal lahir" value="{{$list->tgl_lhr}}">
                              </div>
                              <div class="form-group">
                                  <label for="alamat"><span class="text-danger">*</span>Alamat</label>
                                  <input type="text" class="form-control" id="alamat" name="alamat" required placeholder="Masukkan alamat" value="{{$list->alamat}}">
                              </div>
                              <div class="form-group">
                                  <label for="no_hp"><span class="text-danger">*</span>No HP</label>
                                  <input type="text" class="form-control" id="no_hp" name="no_hp" required placeholder="Masukkan no hp" value="{{$list->no_hp}}">
                              </div>
                              <div class="form-group">
                                  <label for="pekerjaan"><span class="text-danger">*</span>Pekerjaan</label>
                                  <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required placeholder="Masukkan pekerjaan" value="{{$list->pekerjaan}}">
                              </div>
                              <div class="form-group">
                                  <label for="pek_suami"><span class="text-danger">*</span>Pekerjaan Suami</label>
                                  <input type="text" class="form-control" id="pek_suami" name="pek_suami" required placeholder="Masukkan pekerjaan suami" value="{{$list->pekerjaan_suami}}">
                              </div>

                              <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>

                            <!-- /.tab-content -->
                          </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')

    <script>
    $('#formUpdate').on('submit', (function(e) {
      $.LoadingOverlay("show");
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
          type: 'POST',
          url: "{{ route('ibu.dataibu.updateprofile') }}",
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
                       window.location.href = "{{ route('ibu.dashboard') }}";
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

    </script>
@endsection
