@extends('admin.layout.main')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">

            <!--Start Dashboard Content-->
            <!--End Row-->
            <div class="row mt-3">
                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="card border-info border-left-sm">
                        <a href="#">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body text-left">
                                        <h4 class="text-info mb-0">{{ $memes }}</h4>
                                        <span>New Memes Today</span>
                                    </div>
                                    <div class="align-self-center w-circle-icon rounded-circle gradient-scooter">
                                        <i class="icon-basket-loaded text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="card border-danger border-left-sm">
                        <a href="#">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body text-left">
                                        <h4 class="text-danger mb-0">{{ $users }}</h4>
                                        <span>New Users Today</span>
                                    </div>
                                    <div class="align-self-center w-circle-icon rounded-circle gradient-bloody">
                                        <i class="icon-wallet text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="card border-success border-left-sm">
                        <a href="#">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body text-left">
                                        <h4 class="text-success mb-0">{{ $onlineusers }}</h4>
                                        <span>Online Users Today</span>
                                    </div>
                                    <div class="align-self-center w-circle-icon rounded-circle gradient-quepal">
                                        <i class="icon-pie-chart text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card border-info border-left-sm">
                    <a href="#">
                        <div class="card-body">
                            <div class="media align-items-center">
                                <div class="media-body text-left">
                                    <h4 class="text-info mb-0">{{ $users_posted_today }}</h4>
                                    <span>Users That Posted Today</span>
                                </div>
                                <div class="align-self-center w-circle-icon rounded-circle gradient-scooter">
                                    <i class="icon-basket-loaded text-white"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!--End Row-->





        </div>
        <!--End Row-->


        <!--End Row-->




        <!--End Dashboard Content-->
        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->
    </div>
    <!-- End container-fluid-->

    </div>
    <!--End content-wrapper-->
    <script>
        var url = "{{ url('/order/chart') }}";





        var Years = new Array();
        var Labels = new Array();
        var Prices = new Array();
        $(document).ready(function() {
            $.get(url, function(response) {
                response.forEach(function(data) {
                    Years.push(data.stockYear);
                    Labels.push(data.stockName);
                    Prices.push(data.stockPrice);
                });
                var ctx = document.getElementById("canvas").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Years,
                        datasets: [{
                            label: 'Infosys Price',
                            data: Prices,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            });
        });
























        // var Years = new Array();
        //         var Labels = new Array();
        //         var Prices = new Array();
        //         $(document).ready(function(){
        //           $.get(url, function(response){
        //             response.forEach(function(data){
        //                 Years.push(data.stockYear);
        //                 Labels.push(data.stockName);
        //                 Prices.push(data.stockPrice);
        //             });
        //             var ctx = document.getElementById("dashboard-chart-1").getContext('2d');

        //    var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
        //        gradientStroke1.addColorStop(0, '#6078ea');
        //        gradientStroke1.addColorStop(1, '#17c5ea');

        //    var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
        //        gradientStroke2.addColorStop(0, '#ff8359');
        //        gradientStroke2.addColorStop(1, '#ffdf40');

        //        var myChart = new Chart(ctx, {
        //          type: 'bar',
        //          data: {
        //            labels: ['January','February', 'March','April','May', 'June', 'July', 'August','September','October','November','December'],
        //            datasets: [{
        //              label: 'Laptops',
        //              data: [Amount],
        //              borderColor: gradientStroke1,
        //              backgroundColor: gradientStroke1,
        //              hoverBackgroundColor: gradientStroke1,
        //              pointRadius: 0,
        //              fill: false,
        //              borderWidth: 0
        //            },
        //            {
        //              label: 'Mobiles',
        //              data: [28, 48, 40, 19,28, 48, 40, 19,40, 19,28, 48],
        //              borderColor: gradientStroke2,
        //              backgroundColor: gradientStroke2,
        //              hoverBackgroundColor: gradientStroke2,
        //              pointRadius: 0,
        //              fill: false,
        //              borderWidth: 0
        //            }]
        //          },

        //      options:{
        //        maintainAspectRatio: false,
        //        legend: {
        //          position: 'bottom',
        //                display: true,
        //          labels: {
        //                  boxWidth:8
        //                }
        //              },
        //        tooltips: {
        //          displayColors:false,
        //        },
        //        scales: {
        //          xAxes: [{
        //          barPercentage: .5
        //          }]
        //           }
        //      }
        //        });


        //           });
        //         });

    </script>

@endsection
