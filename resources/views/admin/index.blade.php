
@extends('layouts.admintheme.content')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />



<!-- /.card -->



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h3 class="m-0">User Dashboard</h3>
            <hr>
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item ">Dashboard </li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-6">


          </div><!-- /.col -->
        </div><!-- /.row -->

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $totalLogUser }}</h3>

                  <p>Total Customer Registered</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="{{ route("cus.index") }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $totalposition }}<sup style="font-size: 20px"></sup></h3>

                  <p>Open Position</p>
                </div>
                <div class="icon">
                  <i class="ion  ion-stats-bars"></i>
                </div>
                <a href="{{ route('transaction.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $totalpositioncut }}</h3>

                  <p>Cut Position</p>
                </div>
                <div class="icon">
                  <i class="ion ion-close"></i>
                </div>
                <a href="{{ route('transaction.cut') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalpositionphysical }}</h3>
                  <p>Physical Position</p>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark"></i>
                </div>
                <a href="{{ route("transaction.physical") }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>


    <div class="row">
        <div class="col-md-6">
        <div class="card">
        <div class="card-header">
        <h3 class="card-title">Top 5 Customers for Month of <?php echo date("F");?></h3>
        </div>
        <div class="card-body">
        <table class="table table-bordered">
        <thead>
        <tr>
        <th style="width: 10px">#</th>
        <th>Customer</th>
        <th>Gold</th>
        <th>Amount</th>
        </tr>
        </thead>
        <tbody>
            <?php $tcount=1;?>
            @foreach  (json_decode($Top5) as $key => $top)
            <tr>
                <td> {{ $tcount++}}</td>
                <td> {{ $top->Customer}}</td>
                <td> {{ number_format($top->qty)}}</td>
                <td> {{ number_format($top->price)}}</td>

            </tr>
            @endforeach

        </tbody>
        </table>
        </div>
        </div>
</div>
 <div class="col-md-6">
    <div class="card">
    <div class="card-header">
    <h3 class="card-title">Top 5 Customers for  <?php echo date("Y");?></h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
            <th style="width: 10px">#</th>
            <th>Customer</th>
            <th>Gold</th>
            <th>Amount</th>
            </tr>
            </thead>
            <tbody>
                <?php $tcount=1;?>
                @foreach  (json_decode($Top5year) as $key => $top)
                <tr>
                    <td> {{ $tcount++}}</td>
                    <td> {{ $top->Customer}}</td>
                    <td> {{ number_format($top->qty)}}</td>
                    <td> {{ number_format($top->price)}}</td>

                </tr>
                @endforeach

            </tbody>
            </table>
    </div>
 </div>
 </div>
 </div>



<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0">
            <div class="d-flex justify-content-between">
            <h3 class="card-title">Sales Bar Chart</h3>
            {{-- <a href="javascript:void(0);">View Report</a> --}}
            </div>
            </div>
            <div class="card-body">
            {{-- <div class="d-flex">
            <p class="d-flex flex-column">
            <span class="text-bold text-lg">$18,230.00</span>
            <span>Sales Over Time</span>
            </p>
            <p class="ml-auto d-flex flex-column text-right">
            <span class="text-success">
            <i class="fas fa-arrow-up"></i> 33.1%
            </span>
            <span class="text-muted">Since last month</span>
            </p>
            </div> --}}

            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="sales-chart" height="400" class="chartjs-render-monitor"></canvas>
            </div>
            <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
            <i class="fas fa-square text-primary"></i> This year
            </span>
            <span>
            <i class="fas fa-square text-gray"></i> Last year
            </span>
            </div>
            </div>
            </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Sales Line Chart </h3>
            </div>
            </div>
            <div class="card-body">


            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="visitors-chart" height="400" class="chartjs-render-monitor"></canvas>
            </div>
            <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
            <i class="fas fa-square text-primary"></i> This year
            </span>
            <span>
            <i class="fas fa-square text-gray"></i> Last year
            </span>
            </div>
            </div>
            </div>
    </div>
</div>
<script src="{{asset('admin-lte/plugins/chart.js/Chart.min.js')}}"></script>
<script>

$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['JAN', 'FEB', 'MAR', 'APRIL', 'MAY','JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [{{ $Jan }}, {{ $Feb }}, {{ $Mar }}, {{ $Apr }}, {{ $May }}, {{ $Jun }}, {{ $Jul }}, {{ $Aug }}, {{ $Sep }}, {{ $Oct }}, {{ $Nov }},{{ $Dec }}    ],
        },
        {
          backgroundColor: '#ced4da',
          borderColor: '#ced4da',
          data: [{{ $Jan1 }}, {{ $Feb1 }}, {{ $Mar1 }}, {{ $Apr1 }}, {{ $May1 }}, {{ $Jun1 }}, {{ $Jul1 }}, {{ $Aug1 }}, {{ $Sep1 }}, {{ $Oct1 }}, {{ $Nov1 }},{{ $Dec1 }}    ],
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                //value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

  var $visitorsChart = $('#visitors-chart')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
        labels: ['JAN', 'FEB', 'MAR', 'APRIL', 'MAY','JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [{
        type: 'line',
        data: [{{ $Jan }}, {{ $Feb }}, {{ $Mar }}, {{ $Apr }}, {{ $May }}, {{ $Jun }}, {{ $Jul }}, {{ $Aug }}, {{ $Sep }}, {{ $Oct }}, {{ $Nov }},{{ $Dec }}    ],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: [{{ $Jan1 }}, {{ $Feb1 }}, {{ $Mar1 }}, {{ $Apr1 }}, {{ $May1 }}, {{ $Jun1 }}, {{ $Jul1 }}, {{ $Aug1 }}, {{ $Sep1 }}, {{ $Oct1 }}, {{ $Nov1 }},{{ $Dec1 }}    ],

        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

});

</script>
{{-- <script src="{{asset('admin-lte/dist/js/pages/dashboard3.js')}}"></script> --}}



    {{-- <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>User Dashboard</b></h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">




                @foreach  (json_decode($TotalRev) as $key => $val)
                <?php
                    $av=number_format($val->AvPrice ,3);
                    $tt=number_format($val->totalkg ,3) ;
                    $selltotal=0;
                    $buytotal=0;
                    $customerbuy=0;
                    $customersell=0;
                    $totalPhysialGram=0;
                ?>
                @endforeach
                <br>

                <h4>1. Revenue ( USD )</h4>
                <i> {{ $Date1  }} to  {{ $Date2  }} </i>
                <hr class="card-outline card-warning">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            <h3 class="card-title">Revenue From Buy</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Port</th>
                            <th> Buy To Customer</th>
                            <th>Amount </th>
                        </tr>
                        </thead>
                            <tbody>
                                <?php $c=1;?>
                                @foreach  (json_decode($transbuy) as $key => $val1)
                                <?php

                                     $customerbuy= $customerbuy + $val1->customer;
                                     $sell1= $customerbuy +   $val1->totalbuy;
                                    $buytotal=$sell1-$customerbuy;
                                ?>
                                    <tr>
                                            <td>{{ $c++ }}</td>
                                            <td>{{ $val1->port }}</td>
                                            <td>{{ number_format($val1->customer,3) }} </td>
                                            <td>{{ number_format(($val1->totalbuy * 32.148),3) }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="card-header">
                                <h3 class="card-title">Revenue From Sell</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Port</th>
                                    <th> Sell To Customer</th>
                                    <th>Amount </th>
                                </tr>
                                </thead>
                                    <tbody>
                                        <?php $c=1;?>
                                        @foreach  (json_decode($transSell) as $key => $val2)
                                        <?php

                                        $customersell= $customersell + $val2->customer;
                                        $sell= $customersell +   $val2->totalbuy;
                                        $selltotal=$sell-$customersell;
                                      ?>
                                            <tr>
                                                    <td>{{ $c++ }}</td>
                                                    <td>{{ $val2->port }}</td>
                                                    <td>{{ number_format($val2->customer,3) }} </td>
                                                    <td>{{ number_format(($val2->totalbuy * 32.148),3) }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                        </div>

                </div>
                <hr class="mt-4 card-outline card-warning">
                <div class="row">
                    <div class="col-12">

                            <div class="card-header">
                                <h3 class="card-title">Revenue Summary</h3>
                            </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Average Price</th>
                            <th>Total Kilogram</th>
                            <th>Revenue for Buy</th>
                            <th>Revenue for Sell</th>
                            <th>Total Revenue</th>
                            <th>Percentage</th>
                        </tr>
                        </thead>
                            <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ ($av) }}</td>
                                        <td>{{ ($tt) }}</td>
                                        <td>{{ number_format($buytotal,3) }}</td>
                                        <td>{{ number_format($selltotal ,3)}}</td>
                                        <td>{{ number_format($selltotal + $buytotal,3) }}</td>
                                        @if (($selltotal + $buytotal) ==0)
                                        <td>
                                            0
                                        </td>
                                        @else
                                            <td>
                                                {{
                                                number_format( ($selltotal + $buytotal) / ($customerbuy + $customersell),3)
                                                }} %
                                            </td>
                                        @endif


                                    </tr>

                            </tbody>
                        </table>
                        </div>


                    </div>
                </div>
                <hr class="mb-3 card-outline card-warning">

                <h4>2. Open Position</h4>
                <hr class="card-outline card-warning">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            <h3 class="card-title"> Buy</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Port</th>
                            <th>Unit </th>
                        </tr>
                        </thead>
                            <tbody>
                                <?php $c=1;?>
                                @foreach  (json_decode($transbuyPhysical) as $key => $val1)
                                <?php
                                     $totalPhysialGram=$val1->unit + $totalPhysialGram;
                                ?>
                                    <tr>
                                            <td>{{ $c++ }}</td>
                                            <td>{{ $val1->port }}</td>
                                            <td>{{ number_format($val1->unit,3) }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="card-header">
                                <h3 class="card-title"> Sell</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Port</th>
                                    <th> Unit</th>
                                </tr>
                                </thead>
                                    <tbody>
                                        <?php $c=1;?>
                                        @foreach  (json_decode($transSellPhysical) as $key => $val2)
                                        <?php
                                                $totalPhysialGram=$val2->unit + $totalPhysialGram;
                                        ?>
                                            <tr>
                                                    <td>{{ $c++ }}</td>
                                                    <td>{{ $val2->port }}</td>
                                                    <td>{{ number_format($val2->unit,3) }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                        </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        Total Qty : <b>{{  $totalPhysialGram   }}</b>
                    </div>
                </div>

                <hr class="mb-3 card-outline card-warning">

                <h4>3. Cut Position</h4>
                <hr class="card-outline card-warning">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            <h3 class="card-title"> Buy</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Port</th>
                            <th>Unit </th>
                        </tr>
                        </thead>
                            <tbody>
                                <?php $c=1;
                                $totalcut=0;?>
                                @foreach  (json_decode($transbuyCancel) as $key => $val1)
                                <?php
                                   $totalcut=$val1->unit + $totalcut;
                                ?>
                                    <tr>
                                            <td>{{ $c++ }}</td>
                                            <td>{{ $val1->port }}</td>
                                            <td>{{ number_format($val1->unit,3) }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="card-header">
                                <h3 class="card-title"> Sell</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Port</th>
                                    <th> Unit</th>
                                </tr>
                                </thead>
                                    <tbody>
                                        <?php $c=1;?>
                                        @foreach  (json_decode($transSellCancel) as $key => $val2)
                                        <?php
                                                $totalcut=$val2->unit + $totalcut;
                                        ?>
                                            <tr>
                                                    <td>{{ $c++ }}</td>
                                                    <td>{{ $val2->port }}</td>
                                                    <td>{{ number_format($val2->unit,3) }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                        </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        Total Qty : <b>{{  $totalcut   }}</b>
                    </div>
                </div>

                <hr class="mb-3 card-outline card-warning">

                <h4>4. Release/Physical Position</h4>
                <hr class="card-outline card-warning">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            <h3 class="card-title"> Buy</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Port</th>
                            <th>Unit </th>
                        </tr>
                        </thead>
                            <tbody>
                                <?php $c=1;
                                $totalrelease=0;?>
                                @foreach  (json_decode($transbuyrelease) as $key => $val1)
                                <?php
                                   $totalrelease=$val1->unit + $totalrelease;
                                ?>
                                    <tr>
                                            <td>{{ $c++ }}</td>
                                            <td>{{ $val1->port }}</td>
                                            <td>{{ number_format($val1->unit,3) }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="card-header">
                                <h3 class="card-title"> Sell</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Port</th>
                                    <th> Unit</th>
                                </tr>
                                </thead>
                                    <tbody>
                                        <?php $c=1;?>
                                        @foreach  (json_decode($transSellrelease) as $key => $val2)
                                        <?php
                                                $totalrelease=$val2->unit + $totalrelease;
                                        ?>
                                            <tr>
                                                    <td>{{ $c++ }}</td>
                                                    <td>{{ $val2->port }}</td>
                                                    <td>{{ number_format($val2->unit,3) }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                        </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        Total Qty : <b>{{  $totalrelease   }}</b>
                    </div>
                </div>









            </div>
            <!-- /.card-body -->
        </div>
    </div> --}}
    </div>



      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection







