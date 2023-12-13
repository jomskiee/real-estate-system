@extends('layouts.navbar')

@section('style')
@endsection

@section('content')
<section class="d-flex align-items-center" style="background-color: #21243D !important;">
    <div class="container-fluid" style=" margin-top: 200px;">
        <div class="container-fluid py-5" >
            <div class="row ftco-animate d-flex justify-content-center">
                <h2 class="text-white">Dashboard</h2>
            </div>
        </div>
    </div>
</section>
<div class="content-area blog-page padding-top-40" style="background-color: #FCFCFC; padding-bottom: 55px;">
    <div class="container">
        <div class="row">
            <div class="blog-lst col-md-12 pl0">
                <section id="id-100" class="post single">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mt-5">
                            <div class="card bg-dark">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3 class="text-white">{{ $prop }}<sup style="font-size: 20px"></sup></h3>
                                            <p class="text-white" >Overall Properties</p>
                                        </div>
                                        <div class="col-sm-6 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-home fa-5x text-white" aria-hidden="true"></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer  d-flex  justify-content-center">
                                    <a href="{{ route('properties.index') }}" class="text-white text-center">More info
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mt-5">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3 class="text-white">{{ $fav }}<sup style="font-size: 20px"></sup></h3>
                                            <p class="text-white" >Overall Favourite</p>
                                        </div>
                                        <div class="col-sm-6 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-star fa-5x text-white" aria-hidden="true"></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer  d-flex  justify-content-center">
                                    <a href="{{ route('favAge')}}" class="text-white text-center">More info
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mt-5">
                            <div class="card bg-danger">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3 class="text-white">{{ $props }}<sup style="font-size: 20px"></sup></h3>
                                            <p class="text-white" >Reported Property</p>
                                        </div>
                                        <div class="col-sm-6 d-flex align-items-center justify-content-center">
                                            <i class="fa fa-home fa-5x text-white" aria-hidden="true"></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer  d-flex  justify-content-center">
                                    <a href="{{ route('report')}}" class="text-white text-center">More info
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(count($properties) > 0)
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <div class="card bg-light mt-5">
                                <div class="card-header">
                                    <h6><strong>PROPERTY STATISTICAL VIEWS</strong> </h6>
                                </div>
                                <div class="card-body">
                                    <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif
                </section>
            </div>
        </div>

    </div>
</div>


@endsection

@section('script')
<!-- ChartJS -->
<script src="{{url('/')}}/plugins/chart.js/Chart.min.js"></script>

<script type="text/javascript">
    <?php
       $labels = array();
       $counting = array();
       foreach($properties as $property){
           $label =  $property['proj_name'];
           $count = $property['stat_view'];
           array_push($counting, $count);
           array_push($labels, $label);
       }
   ?>

    var ctx = document.getElementById("myChart");

        const labels = <?php echo json_encode($labels); ?>;
        const counts = <?php echo json_encode($counting); ?>;
         var myChart = new Chart(ctx, {
           type: 'bar',
           data: {
             labels: labels,
             datasets: [{
               data: counts,
               lineTension: 0,
               backgroundColor: '#007bff',
               borderColor: '#007bff',
               borderWidth: 2,
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
