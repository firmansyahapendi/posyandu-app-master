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
                        @if(Session::get('info_imun'))
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-info"></i> Info!</h4>
                                <p>Jadwal Tepat Imunisasi Lengkap : </p>
                                <ul>
                                    @foreach(Session::get('info_imun') as $key)
                                        <li>{{ $key }}</li>
                                    @endforeach
                                </ul>
                                <a href="" class="btn btn-danger" style="text-decoration: none"><span class="fas fa-syringe"></span> Imunisasi</a>
                            </div>
                        @endif
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">Masukkan Data Timbang</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <form action="javascript:void(0)" id="formInsert" method="POST">
                                            @csrf
                                            <div class="form-group ">
                                                <label for="dataanak"><span class="text-danger">*</span> Nama Anak</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-child"></i>
                                                        </span>
                                                    </div>
                                                    <select name="dataanak" id= "data-anak" required class="form-control select2">
                                                        <option value="">-- Pilih Anak --</option>
                                                        @foreach ($Anak as $item)
                                                            <option value="{{ $item->id_anak }}">{{ $item->nama_anak }} - (Ibu: {{ $item->dataibu->nama_ibu }})</option>
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
                                                            <input type="text" class="form-control"  id="tinggi_badan" name="tinggi_badan" required placeholder="Isi Tinggi Badan">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">cm</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p style="color: grey">Note : Gunakan (.) sebagai pengganti (,)</p>
                                            </div>

                                            <div class="form-group float-right">
                                                <input type="submit" value="Simpan" class="btn btn-primary">
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
  
                    </div>
                    <div class="col-12">
                                                
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                
                                            @if (Session::has('dataKelamin'))
                                                @if(Session::get('dataKelamin') == "P")
                                                    <div id="grafik_female" style="height: 700px">
                                                        <!-- view grafik -->
                                                    </div>
                                                @else
                                                    <div id="grafik_male" style="height: 700px">
                                                        <!-- view grafik -->
                                                    </div>
                                                @endif
                                                {!! Session::get('chart_timbangan') !!}
                                            @else
                                                <div style="text-align: center;">
                                                    <p>Grafik Tumbuh Kembang Anak</p>
                                                </div>
                                            @endif
                                                            
                            </div>
                        </div>
                    </div>

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
        });
    </script>
    <script type="text/javascript">
        // GRAFIK MALE
        $(function() {
            var data_viewer1 = {!! Session::get('grafik') !!};
    
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
        })
    </script>
    <script type="text/javascript">
        // GRAFIK FEMALE
        $(function() {
            var data_viewer = {!! Session::get('grafik') !!};
    
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


                        