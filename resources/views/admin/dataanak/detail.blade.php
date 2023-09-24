@extends('admin.layout.index', ['title' => 'Data Anak'])

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
                        <h1 class="m-0">Detail Data Anak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Detail Data Anak</li>
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
                                @if($list->jenkel=="L")
                                    <img class="profile-user-img img-fluid img-circle"
                                   src="{{asset('assets/dist/img/avatar5.png')}}"
                                   alt="User profile picture">
                                @else
                                      <img class="profile-user-img img-fluid img-circle"
                                      src="{{asset('assets/dist/img/avatar2.png')}}"
                                        alt="User profile picture">
                                @endif
                            </div>
            
                            <h3 class="profile-username text-center">{{$list->nama_anak}}</h3>
            
                            <p class="text-muted text-center">{{$list->nik}}</p>
            
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <b>Tempat Lahir</b> <a class="float-right">{{$list->tmp_lhr}}</a>
                              </li>
                              <li class="list-group-item">
                                <b>Tanggal Lahir</b> <a class="float-right">{{Tgl_Indo($list->tgl_lhr)}}</a>
                              </li>
                              <li class="list-group-item">
                                <b>Jenis Kelamin</b> <a class="float-right">@if($list->jenkel == "L") Laki-Laki  @else Perempuan @endif</a>
                              </li>
                            </ul>
            
                            <a href="{{route('admin.dataanak.index')}}" class="btn btn-primary btn-block"><b>Kembali</b></a>
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
                              <li class="nav-item"><a class="nav-link active" href="#detail" data-toggle="tab">Detail Anak</a></li>
                              <li class="nav-item"><a class="nav-link" href="#imunisasi" data-toggle="tab">Imunisasi</a></li>
                              <!-- <li class="nav-item"><a class="nav-link" href="#vitaminA" data-toggle="tab">Vitamin A</a></li> -->
                              <li class="nav-item"><a class="nav-link" href="#kms" data-toggle="tab">Tumbuh Kembang Anak (KMS)</a></li>
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
                                    <i class="fa fa-venus bg-primary"></i>
            
                                    <div class="timeline-item">
            
                                      <h3 class="timeline-header"><a href="#">Nama Ibu : </a> {{$list->Dataibu->nama_ibu}}</h3>
            
                                    </div>
                                  </div>
                                  <!-- END timeline item -->
                                  <!-- timeline item -->
                                  <div>
                                    <i class="fa fa-mars bg-primary"></i>
            
                                    <div class="timeline-item">
                                      <h3 class="timeline-header border-0"><a href="#">Nama Ayah :</a> {{$list->Dataibu->nama_suami}}
                                      </h3>
                                    </div>
                                  </div>
                                  <!-- END timeline item -->
                                  <!-- timeline item -->
                                  <div>
                                    <i class="fa fa-address-card bg-yellow"></i>
            
                                    <div class="timeline-item">
                                      <h3 class="timeline-header border-0"><a href="#">Alamat :</a> {{$list->Dataibu->alamat}}
                                      </h3>
                                    </div>
                                  </div>
                                  <!-- END timeline item -->
                                  <!-- timeline item -->
                                  <div>
                                    <i class="fa fa-balance-scale bg-lightblue"></i>
            
                                    <div class="timeline-item">
                                      <h3 class="timeline-header border-0"><a href="#">Berat Badan :</a> {{$list->bb_lahir}} Kg 
                                      </h3>
                                    </div>
                                  </div>
                                  <div>
                                    <i class="fas fa-arrow-up bg-lightblue"></i>
            
                                    <div class="timeline-item">
                                      <h3 class="timeline-header border-0"><a href="#">Tinggi Badan :</a> {{$list->tb_lahir}} cm
                                      </h3>
                                    </div>
                                  </div>
                                  <div>
                                    <i class="fa fa-list-ol bg-pink"></i>
            
                                    <div class="timeline-item">
                                      <h3 class="timeline-header border-0"><a href="#">Anak Ke :</a> {{$list->anak_ke}}
                                      </h3>
                                    </div>
                                  </div>
                                  <!-- END timeline item -->
                                  <div>
                                    <i class="fa fa-check bg-gray"></i>
                                  </div>
                                </div>
                              </div>
                              <!-- /.tab-pane -->

                              <div class="tab-pane" id="imunisasi">
                                <!-- Post -->
                                <table class="table table-bordered table-striped table-hover dataTable no-footer" id="imunisasitb">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Imunisasi</th>
                                            <th>Umur</th>
                                            <th>Tanggal Imunisasi</th>
                                            <th>Booster </th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($imun as $key => $item)
                                     <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->vaksin->nama_vaksin}}</td>
                                        <td>
                                            @php
                                                $birthDt = new DateTime($item->data_anak->tgl_lhr);
                                                $today = new DateTime($item->tanggal_imunisasi);
                                                $y = $today->diff($birthDt)->y;
                                                $m = $today->diff($birthDt)->m;
                                                $d = $today->diff($birthDt)->d;
                                            @endphp
                                            @if ($item->tanggal_imunisasi != null)
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
                                        <td>{{Tgl_Indo($item->tanggal_imunisasi)}}</td>
                                        <td>{{$item->booster}}</td>
                                        <td>{{$item->keterangan}}</td>
                                     </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                                <!-- /.post -->
                              </div>
                              <!-- /.tab-pane -->
            
                              <div class="tab-pane" id="vitaminA">
                                <table class="table table-bordered table-striped table-hover dataTable no-footer" id="vitaminAtb">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Umur</th>
                                            <th>Tanggal Pembelian</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vitA as $key => $item)
                                     <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            @php
                                                $birthDt = new DateTime($item->data_anak->tgl_lhr);
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
                                                    Bayi Lulus
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{Tgl_Indo($item->tgl_vitA)}}</td>
                                        <td>{{$item->keterangan}}</td>
                                     </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="kms">
                                <div style="text-align: center;">
                                    <div class="box-body">
                                        
                                        @if($list->jenkel == "L")
                                            <div id="grafik_male" style="height: 700px">
                                                <!-- view grafik -->
                                            </div>
                                        @else
                                            <div id="grafik_female" style="height: 700px">
                                                <!-- view grafik -->
                                            </div>
                                        @endif
                                        {!! $chart_timbangan !!}
                                    </div>
                                </div>
                              </div>
                                <!-- /.tab-pane -->
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
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    

<script>
    $(document).ready(function() {
            $('#imunisasitb').DataTable({
                order: [
                    [0, "asc"]
                ],
                columnDefs: [{
                    "targets": 3,
                    "orderable": false
                }]
            });
            $('#vitaminAtb').DataTable({
                order: [
                    [0, "asc"]
                ],
                columnDefs: [{
                    "targets": 3,
                    "orderable": false
                }]
            });
        });
</script>
<script type="text/javascript">
    // GRAFIK MALE
    $(function() {
        var data_viewer1 = {!! $grafik_timbangan !!};

        Highcharts.chart('grafik_male', {
            colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
            chart: {
                backgroundColor: null,
            },
            title: {
                text: 'KMS Laki-Laki',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    textTransform: 'uppercase'
                },
            },
            subtitle: {
                text: "Kartu Menuju Sehat (an:{{$list->nama_anak}} - ib:{{$list->Dataibu->nama_ibu}})"
            },
            xAxis: {
                title: {
                    text: 'Umur',
                    style: {
                        textTransform: 'uppercase'
                    },
                },
                gridLineWidth: 1,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                },
                tickInterval: 1
            },
            yAxis: {
                title: {
                    text: 'Berat Badan',
                    style: {
                        textTransform: 'uppercase'
                    },
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                },
                tickInterval: 1
            },
            tooltip: {
                borderWidth: 0,
                backgroundColor: 'rgba(219,219,216,0.8)',
                shadow: false
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 0,
                    marker: {
                        enabled: false,
                    },
                    enableMouseTracking: false
                },
                candlestick: {
                    lineColor: '#404048'
                },
                scatter: {
                    dataLabels: {
                        enabled: true
                    },
                }
            },
            background2: '#F0F0EA',

            series: [{
                name: 'BB Lebih',
                data: [
                    5.0,6.5,7.9,8.9,9.6,10.3,
                    10.9,11.3,11.8,12.2,12.5,
                    12.9,13.2,13.5,13.8,14.2,
                    14.5,14.8,15.1,15.4,15.7,
                    16.0,16.3,16.6,16.9,
                    17.2,17.5,17.9,18.2,18.4,18.8,
                    19.0,19.3,19.6,19.9,20.2,
                    20.4,20.7,21.0,21.2,21.5,
                    21.8,22.1,22.4,22.6,22.9,
                    23.2,23.5,23.8,24.1,24.3,
                    24.6,24.9,25.2,25.5,25.8,
                    26.1,26.4,26.7,27.0,27.3,
                ],
                color: '#f2f200',
            },{
                name: 'BB Normal',
                data: [
                    4.4,5.8,7.1,8.0,8.7,9.3,
                    9.8,10.3,10.7,11.0,11.4,
                    11.7,12.0,12.3,12.6,12.8,
                    13.1,13.4,13.6,13.9,14.2,
                    14.4,14.7,15.0,15.2,
                    15.6,15.8,16.1,16.3,16.6,16.9,
                    17.1,17.3,17.6,17.8,18.1,
                    18.3,18.5,18.8,19.0,19.2,
                    19.5,19.7,20.0,20.2,20.4,
                    20.7,21.0,21.2,21.4,21.7,
                    21.9,22.2,22.4,22.7,22.9,
                    23.2,23.4,23.7,23.9,24.1
                ],
                color: '#39b500',
            },{
                name: 'BB Kurang',
                data: [
                    2.5,3.4,4.3,5.0,5.5,6.0,
                    6.3,6.7,6.9,7.1,7.3,
                    7.6,7.7,7.9,8.1,8.3,
                    8.4,8.6,8.8,8.9,9.1,
                    9.2,9.4,9.5,9.7,
                    9.8,10.0,10.1,10.2,10.4,10.5,
                    10.6,10.8,10.9,11.0,11.2,
                    11.3,11.4,11.5,11.7,11.8,
                    11.9,12.0,12.1,12.2,12.4,
                    12.5,12.6,12.7,12.8,12.9,
                    13.0,13.2,13.3,13.4,13.5,
                    13.6,13.7,13.9,14.0,14.1
                ],
                color: '#39b500',
            },{
                name: 'BB Sangat Kurang',
                data: [
                    2.1,2.9,3.8,4.4,4.9,5.3,
                    5.7,5.9,6.2,6.4,6.6,
                    6.8,6.9,7.1,7.3,7.4,
                    7.6,7.7,7.8,8.0,8.1,
                    8.2,8.4,8.5,8.6,
                    8.8,8.9,9.0,9.1,9.2,9.4,
                    9.5,9.6,9.7,9.8,9.9,
                    10.0,10.1,10.2,10.3,10.4,
                    10.5,10.6,10.7,10.8,10.9,
                    11.0,11.1,11.2,11.3,11.4,
                    11.5,11.6,11.7,11.8,11.9,
                    12.0,12.1,12.2,12.3,12.4,
                ],
                color: '#ff0000',
            },{
                type: 'scatter',
                marker: {
                    enabled: true,
                    symbol: 'cross',
                    fillColor: '#000',
                    lineColor: '#FFF'
                },
                name: 'BB',
                data: data_viewer1
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    });
    // GRAFIK FEMALE
    $(function() {
        var data_viewer = {!! $grafik_timbangan !!};

        Highcharts.chart('grafik_female', {
            colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
            chart: {
                backgroundColor: null,
            },
            title: {
                text: 'KMS Perempuan',
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    textTransform: 'uppercase'
                },
            },
            subtitle: {
                text: 'Kartu Menuju Sehat'
            },
            xAxis: {
                title: {
                    text: 'Umur',
                    style: {
                        textTransform: 'uppercase'
                    },
                },
                gridLineWidth: 1,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                },
                tickInterval: 1
            },
            yAxis: {
                title: {
                    text: 'Berat Badan',
                    style: {
                        textTransform: 'uppercase'
                    },
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                },
                tickInterval: 1
            },
            tooltip: {
                borderWidth: 0,
                backgroundColor: 'rgba(219,219,216,0.8)',
                shadow: false
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 0,
                    marker: {
                        enabled: false,
                    },
                    enableMouseTracking: false
                },
                candlestick: {
                    lineColor: '#404048'
                },
                scatter: {
                    dataLabels: {
                        enabled: true
                    },
                }
            },
            background2: '#F0F0EA',

            series: [{
                name: 'BB Lebih',
                data: [
                    4.8,6.2,7.4,8.4,9.2,9.8,
                    10.4,10.9,11.4,11.8,12.2,
                    12.5,12.9,13.2,13.6,13.9,
                    14.2,14.5,14.8,15.1,15.4,
                    15.7,16.0,16.3,16.6,
                    17.0,17.3,17.6,17.9,18.3,18.6,
                    18.9,19.2,19.5,19.8,20.1,
                    20.4,20.8,21.1,21.4,21.8,
                    22.1,22.4,22.8,23.1,23.4,
                    23.8,24.1,24.5,24.8,25.2,
                    25.5,25.9,26.2,26.5,26.9,
                    27.3,27.6,27.9,28.3,28.6,
                ],
                color: '#f2f200',
            },{
                name: 'BB Normal',
                data: [
                    4.2,5.5,6.6,7.5,8.2,8.8,
                    9.3,9.8,10.2,10.5,10.9,
                    11.2,11.5,11.8,12.1,12.4,
                    12.6,12.9,13.2,13.5,13.7,
                    14.0,14.3,14.6,14.9,
                    15.1,15.4,15.7,16.0,16.2,16.5,
                    16.8,17.0,17.3,17.6,17.9,
                    18.1,18.4,18.7,19.0,19.2,
                    19.5,19.8,20.1,20.4,20.7,
                    20.9,21.2,21.5,21.8,22.1,
                    22.4,22.7,22.9,23.2,23.5,
                    23.8,24.1,24.4,24.6,24.9,
                ],
                color: '#39b500',
            },{
                name: 'BB Kurang',
                data: [
                    2.4,3.1,3.9,4.5,5.0,5.4,
                    5.7,6.0,6.2,6.5,6.7,
                    6.9,7.0,7.2,7.4,7.6,
                    7.7,7.9,8.1,8.2,8.4,
                    8.6,8.7,8.9,9.0,
                    9.2,9.3,9.5,9.7,9.8,10.0,
                    10.1,10.3,10.4,10.5,10.7,
                    10.8,10.9,11.1,11.2,11.3,
                    11.4,11.6,11.7,11.8,12.0,
                    12.1,12.2,12.3,12.4,12.6,
                    12.7,12.8,12.9,13.0,13.2,
                    13.3,13.4,13.5,13.6,13.7,
                ],
                color: '#39b500',
            },{
                name: 'BB Sangat Kurang',
                data: [
                    2.0,2.8,3.4,4.0,4.4,4.8, //0-5
                    5.1,5.3,5.6,5.8,6.0, //6-10
                    6.1,6.3,6.4,6.6,6.8, //11-15
                    6.9,7.0,7.2,7.3,7.5, //16-20
                    7.6,7.8,7.9,8.1,
                    8.2,8.3,8.5,8.6,8.8,8.9,
                    9.0,9.1,9.2,9.4,9.5,
                    9.6,9.7,9.8,10.0,10.1,
                    10.2,10.3,10.4,10.5,10.6,
                    10.7,10.8,10.9,11.0,11.1,
                    11.2,11.3,11.4,11.5,11.6,
                    11.7,11.8,11.9,12.0,12.1,
                ],
                color: '#ff0000',
            },{
                type: 'scatter',
                marker: {
                    enabled: true,
                    symbol: 'cross',
                    fillColor: '#000',
                    lineColor: '#FFF'
                },
                name: 'BB',
                data: data_viewer
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    })
</script>

@endsection

