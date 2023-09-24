@extends('ibu.layout.index', ['title' => 'Detail Ibu'])

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Data Ibu</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Detail Data Ibu</li>
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
            
                            <a href="{{route('ibu.dataibu.update')}}" class="btn btn-primary btn-block"><b>Ubah Data</b></a>
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
                              <li class="nav-item"><a class="nav-link active" href="#detail" data-toggle="tab">Detail Ibu</a></li>
                            </ul>
                          </div><!-- /.card-header -->
                          <div class="card-body">
                            <div class="tab-content">
                              <div class="active tab-pane" id="detail">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                  <!-- timeline time label -->
                                  <div class="time-label">
                                    <span class="bg-danger">
                                        Terdaftar Pada {{Tgl_Indo($list->created_at)}}
                                    </span>
                                  </div>
                                  <!-- /.timeline-label -->
                                  <!-- timeline item -->
                                  <div>
                                    <i class="fa fa-mars bg-primary"></i>
            
                                    <div class="timeline-item">
                                      <h3 class="timeline-header border-0"><a href="#">Nama Suami :</a> {{$list->nama_suami}}
                                      </h3>
                                    </div>
                                  </div>
                                  <!-- END timeline item -->
                                  <!-- timeline item -->
                                  <div>
                                    <i class="fa fa-address-card bg-yellow"></i>
            
                                    <div class="timeline-item">
                                      <h3 class="timeline-header border-0"><a href="#">Alamat :</a> {{$list->alamat}}
                                      </h3>
                                    </div>
                                  </div>
                                  <!-- END timeline item -->
                                  <!-- timeline item -->
                                  <div>
                                    <i class="fas fa-briefcase bg-lightblue"></i>
            
                                    <div class="timeline-item">
                                      <h3 class="timeline-header border-0"><a href="#">Pekerjaan :</a> {{$list->pekerjaan}}  
                                      </h3>
                                    </div>
                                  </div>
                                  <div>
                                    <i class="fas fa-briefcase bg-lightblue"></i>
            
                                    <div class="timeline-item">
                                      <h3 class="timeline-header border-0"><a href="#">Pekerjaan Suami :</a> {{$list->pekerjaan_suami}} 
                                      </h3>
                                    </div>
                                  </div>
                                  <div>
                                    <i class="fa fa-check bg-gray"></i>
                                  </div>
                                </div>
                              </div>
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
