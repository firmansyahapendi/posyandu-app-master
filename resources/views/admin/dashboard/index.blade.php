@extends('admin.layout.index', ['title' => 'Dashboard'])

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-female"></i></span>
      
                            <div class="info-box-content">
                                <span class="info-box-text">Data Ibu</span>
                                <span class="info-box-number">{{ $dataibu }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-child" style="color:white;"></i></span>
      
                            <div class="info-box-content">
                                <span class="info-box-text">Data Anak</span>
                                <span class="info-box-number">{{ $dataanak }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
      
                    <div class="col-lg-3 col-sm-6 col-md-3" >
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class=" fas fa-users"></i></span>
      
                        <div class="info-box-content">
                            <span class="info-box-text">Data Petugas</span>
                            <span class="info-box-number">{{ $datapetugas }}</span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-lg-3 col-sm-6 col-md-3" >
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-md"></i></span>
      
                        <div class="info-box-content">
                            <span class="info-box-text">Data Bidan</span>
                            <span class="info-box-number">{{ $databidan }}</span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                        <section class="col-lg-4">
                            <!-- Calendar -->
                            <div class="card">
                            <div class="card-header border-0">

                                <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                                </h3>
                                <!-- tools card -->
                                <div class="card-tools">
                                <button type="button" class="btn btn-box-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-box-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pt-0">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%; height:100%;" ></div>
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.box -->
                        </section>
                        <!-- right col -->
                        
                        <!-- Left col --> 
                        <section class="col-lg-8">
                            <div class="card">
                                <div class="card-header with-border">
                                    <h3 class="card-title">
                                        Rekap Data Anak Tahun @php echo date("Y"); @endphp
                                    </h3>
                                    <div class="card-tools pull-right">
                                        
                                        <button type="button" class="btn btn-box-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="chart">
                                                <!-- Sales Chart Canvas -->
                                                <div id="chart1" style="height: 225px;"></div>
                                                {!! $chart1 !!}
                                            </div>
                                            <!-- /.chart-responsive -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- ./box-body -->
                            </div>
                            <!-- /.box -->
                        </section>
                        <!-- /.Left col -->
                </div>

                
            
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
<!-- highchart -->
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script type='text/javascript'>

              // The Calender
              $('#calendar').datetimepicker({
                format: 'L',
                inline: true
                })

        
    </script>
@endsection