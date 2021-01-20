<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
    $breadcrumb[0]['url'] = url('backend/dashboard');

?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title', 'Dashboard')

<!-- CONTENT -->
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Dashboard</h3>
    </div>
    <div class="title_right">
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-building"></i></div>
                    <div class="count">
                        {{$totalAsset}}<span style="font-size:13px"></span> </div>
                    <h3>TOTAL ASSET</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-building"></i></div>
                    <div class="count">
                        {{$totalPerbaikan}}<span style="font-size:13px"></span> </div>
                    <h3>MAINTENANCE</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-building"></i></div>
                    <div class="count">
                        <span style="font-size:13px"></span> </div>
                    <h3></h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-building"></i></div>
                    <div class="count">
                        <span style="font-size:13px"></span> </div>
                    <h3></h3>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
      <div class="col-sm6 col-xs-6">
        <div class="x_panel tile">
            <canvas id="mtPerKategori"></canvas>
        </div>
    </div>

    <div class="col-sm6 col-xs-6">
        <div class="x_panel tile">
            <canvas id="mtPerStatus"></canvas>
        </div>
    </div>

    <div class="col-sm12 col-xs-12" style="width:50%;">
        <div class="x_panel tile">
            <canvas id="mtPerBulan"></canvas>
        </div>
    </div>

    @if ($kodearea == 1)
        <div class="col-sm-12 col-xs-12" style="width:50%;">
            <div class="x_panel tile">
                <canvas id="mtPerCabang"></canvas>
            </div>
        </div>
    @endif




{{--
     <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2>Asset <small>Jatuh Tempo</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item One Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Two Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Two Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Two Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Three Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2>Asset <small>Dalam Pebaikan</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item One Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Two Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Two Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Two Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Three Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2>Asset <small>Rusak</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item One Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Two Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Two Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Two Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
                <article class="media event">
                    <a class="pull-left date">
                        <p class="month">April</p>
                        <p class="day">23</p>
                    </a>
                    <div class="media-body">
                        <a class="title" href="#">Item Three Title</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xs-6">
            <div class="x_panel tile">
                <div class="x_title">
                    <h2>Total Maintenance per Category</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h4>Category</h4>
                    <div class="widget_summary">
                        <div class="w_left w_55">
                            <b><span>UNDEFINED</span></b>
                        </div>
                        <div class="w_center w_25">
                            <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 6.25%;">
                                    <span class="sr-only">6.25% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span>
                                3 </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                        <div class="w_left w_55">
                            <b><span>TEKNIK - MECHANICAL</span></b>
                        </div>
                        <div class="w_center w_25">
                            <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 45.833333333333%;">
                                    <span class="sr-only">45.833333333333% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span>
                                22 </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                        <div class="w_left w_55">
                            <b><span>TEKNIK - ELECTRICITY</span></b>
                        </div>
                        <div class="w_center w_25">
                            <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 14.583333333333%;">
                                    <span class="sr-only">14.583333333333% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span>
                                7 </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                        <div class="w_left w_55">
                            <b><span>TEKNIK - UTILITY</span></b>
                        </div>
                        <div class="w_center w_25">
                            <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 4.1666666666667%;">
                                    <span class="sr-only">4.1666666666667% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span>
                                2 </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                        <div class="w_left w_55">
                            <b><span>TEKNIK - BUILDING</span></b>
                        </div>
                        <div class="w_center w_25">
                            <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 2.0833333333333%;">
                                    <span class="sr-only">2.0833333333333% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span>
                                1 </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                        <div class="w_left w_55">
                            <b><span>TEKNIK - PROJECT</span></b>
                        </div>
                        <div class="w_center w_25">
                            <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 22.916666666667%;">
                                    <span class="sr-only">22.916666666667% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span>
                                11 </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="widget_summary">
                        <div class="w_left w_55">
                            <b><span>TEKNIK - FORKLIFT/CAR</span></b>
                        </div>
                        <div class="w_center w_25">
                            <div class="progress">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 4.1666666666667%;">
                                    <span class="sr-only">4.1666666666667% Complete</span>
                                </div>
                            </div>
                        </div>
                        <div class="w_right w_20">
                            <span>
                                2 </span>
                        </div>
                        <div class="clearfix"></div>
                        <row>
                            <div class="row">

                            </div>
                        </row>
                    </div>
                </div>
            </div>
        </div>




    </div> --}}

</div>


@endsection

<!-- CSS -->
@section('css')

@endsection

<!-- JAVASCRIPT -->
@section('script')
<script>
      Chart.pluginService.register({
  beforeRender: function(chart) {
    if (chart.config.options.showAllTooltips) {
      // create an array of tooltips
      // we can't use the chart tooltip because there is only one tooltip per chart
      chart.pluginTooltips = [];
      chart.config.data.datasets.forEach(function(dataset, i) {
        chart.getDatasetMeta(i).data.forEach(function(sector, j) {
          chart.pluginTooltips.push(new Chart.Tooltip({
            _chart: chart.chart,
            _chartInstance: chart,
            _data: chart.data,
            _options: chart.options.tooltips,
            _active: [sector]
          }, chart));
        });
      });

      // turn off normal tooltips
      chart.options.tooltips.enabled = false;
    }
  },
  afterDraw: function(chart, easing) {
    if (chart.config.options.showAllTooltips) {
      // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
      if (!chart.allTooltipsOnce) {
        if (easing !== 1)
          return;
        chart.allTooltipsOnce = true;
      }

      // turn on tooltips
      chart.options.tooltips.enabled = true;
      Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
        tooltip.initialize();
        tooltip.update();
        // we don't actually need this since we are not animating tooltips
        tooltip.pivot();
        tooltip.transition(easing).draw();
      });
      chart.options.tooltips.enabled = false;
    }
  }
});

    //Asset di Maintenance per Kategori

    var ctx = document.getElementById("mtPerKategori").getContext('2d');
    var mtPerKategori = new Chart(ctx, {
        type: 'doughnut',

   data: {
    datasets: [{
                    data: @json($totalKategori),
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
     ],
     label: 'Dataset 1'
    }],
    labels: @json($namaKategori)
   },
   options: {
    tooltips: {
      callbacks: {
      	title: function(tooltipItems, data) {
          return '';
        },
        label: function(tooltipItem, data) {
          var datasetLabel = '';
          var label = data.labels[tooltipItem.index];
          return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
        }
      }
    },
    showAllTooltips: true,
    legend: {
     position: 'top',
    },
    title: {
     display: true,
     text: 'Asset di Maintenance per Kategori'
    },
    animation: {
     animateScale: true,
     animateRotate: true
    }
   }
    });

    //Asset yang sedang diproses maintenance & sudah selesai maintenance

    var ctx = document.getElementById("mtPerStatus").getContext('2d');
    var mtPerStatus = new Chart(ctx, {
        type: 'doughnut',

   data: {
    datasets: [{
                    data: [{{$ProsesMT}}, {{$SelesaiMT}}, {{$overdue}}, 0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
     ],
     label: 'Dataset 1'
    }],
    labels: [
     'Sedang di Maintenance',
     'Selesai Maintenance',
     'Overdue',
     'Failed (lewat tanggal)'
    ]
   },
   options: {
    tooltips: {
      callbacks: {
      	title: function(tooltipItems, data) {
          return '';
        },
        label: function(tooltipItem, data) {
          var datasetLabel = '';
          var label = data.labels[tooltipItem.index];
          return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
        }
      }
    },
    showAllTooltips: true,
    legend: {
     position: 'top',
    },
    title: {
     display: true,
     text: 'Laporan Asset'
    },
    animation: {
     animateScale: true,
     animateRotate: true
    }
   }
    });

    //Asset yang sedang diproses maintenance & sudah selesai maintenance per bulan

    var ctx = document.getElementById("mtPerBulan").getContext('2d');
    var mtPerBulan = new Chart(ctx, {
        type: 'bar',

   data: {
    datasets: [{
    data: @json($total),
    label: 'Selesai di Maintenance',
    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        '#E85F18'
     ],
    }],
    labels:  @json($bulan),
   },
   options: {
    tooltips: {
      callbacks: {
      	title: function(tooltipItems, data) {
          return '';
        },
        label: function(tooltipItem, data) {
          var datasetLabel = '';
          var label = data.labels[tooltipItem.index];
          return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
        }
      }
    },
    showAllTooltips: true,
    legend: {
        display: false,
     position: 'top',
    },
    title: {
     display: true,
     text: 'Total Asset yang sudah di Maintenance per Bulan'
    },
    animation: {
     animateScale: true,
     animateRotate: true
    }
   }
    });

    //Asset yang sedang diproses maintenance & sudah selesai maintenance per cabang

    var ctx = document.getElementById("mtPerCabang").getContext('2d');
    var mtPerBulan = new Chart(ctx, {

        type: 'bar',

   data: {
    datasets: [{
    data: @json($totalCabang),
    label: 'Selesai di Maintenance',
    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        '#E85F18'
     ],
    }],
    labels:  @json($cabang),
   },
   options: {
    tooltips: {
      callbacks: {
      	title: function(tooltipItems, data) {
          return '';
        },
        label: function(tooltipItem, data) {
          var datasetLabel = '';
          var label = data.labels[tooltipItem.index];
          return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
        }
      }
    },
    showAllTooltips: true,
    legend: {
        display: false,
     position: 'top',
    },
    title: {
     display: true,
     text: 'Total Asset yang sudah di Maintenance per Cabang'
    },
    animation: {
     animateScale: true,
     animateRotate: true
    }
   }
    });

    //Asset yang sedang diproses maintenance & sudah selesai maintenance

    var ctx = document.getElementById("mtPerTanggal").getContext('2d');
    var mtPerTanggal = new Chart(ctx, {
        type: 'bar',

        data: {
    datasets: [{
    data: @json($total),
    label: 'Selesai Maintenance',
     backgroundColor: "rgba(75, 192, 192, 1)",
    },
    {
    data: @json($total),
    label: 'Sedang Maintenance',
     backgroundColor: "rgba(153, 102, 255, 1)",

    }],
    labels:  @json($bulan),
   },
   options: {
    tooltips: {
      callbacks: {
      	title: function(tooltipItems, data) {
          return '';
        },
        label: function(tooltipItem, data) {
          var datasetLabel = '';
          var label = data.labels[tooltipItem.index];
          return data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
        }
      }
    },
    showAllTooltips: true,
    legend: {
     position: 'top',
    },
    title: {
     display: true,
     text: 'Total Asset yang sudah diperbaiki per Bulan'
    },
    animation: {
     animateScale: true,
     animateRotate: true
    }
   },
   options: {
    showAllTooltips: true,
    legend: {
     position: 'top',
    },
    title: {
     display: true,
     text: 'Status Asset di Maintenance per Bulan'
    },
    animation: {
     animateScale: true,
     animateRotate: true
    }
   }
    });




</script>

@endsection
