@extends('layouts.dashboard')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ count($users) }}</h3>
                                <p>Registered Users</p>
                             </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count($prop) }}<sup style="font-size: 20px"></sup></h3>
                                <p>Properties Posted</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-home"></i>
                            </div>
                            <a href="{{ route('all-properties.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ count($report) }}</h3>
                                <p>Report Abuse</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-exclamation-triangle"></i>
                            </div>
                            <a href="{{ route('rep') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-5">

                        <div class="card bg-light">
                            <div class="card-header">
                                <h6><strong>STATISTICAL VIEWS</strong> </h6>
                            </div>
                            <div class="card-body">
                                <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script> --}}
<script type="text/javascript">
 var ctx = document.getElementById("myChart");
<?php
    $labels = array();
    $counts = array();
    foreach($views as $view){
        $date = $view["date"];
        $label =  date('F d, Y', strtotime($date));
        $count = $view["visitors_cnt"];
        array_push($counts, $count);
        array_push($labels, $label);


    }


?>
 const labels = <?php echo json_encode($labels); ?>;
 const counts = <?php echo json_encode($counts); ?>;
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            data: counts,
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
</script>
@endsection
