@extends('layouts.app')

@section('title')
Call Reports
@endsection

@section('header')
<link rel="stylesheet" href="assets/vendor/morris/morris.css" />
<script src="assets/vendor/morris/morris.js"></script>
<script src="assets/vendor/raphael/raphael.js"></script>
@endsection

@section('menu')
    Call Report
@endsection


@section('content')
<div class="row">
  <form class="form form_source_number">
                                    <div class="form-group">
                                    <label class="col-md-12 control-label date_range">Date range : Today</label>
                                            <div class="col-md-12">
                                                <div class="input-daterange input-group" data-plugin-datepicker>
                                                    {{-- <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span> --}}
                                                    <input type="text" class="form-control" name="start_date">
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" class="form-control" name="end_date">
                                                </div>
                                            </div>
                                    </div>
    </form>
</div>
<div class="row">

    <div class="col-md-4 col-sm-12">
    <section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Summary</h2>

									</header>
									<div class="panel-body">
    <div class="row">
    <div class="col-md-12 col-sm-12">
										<section class="panel">
											<div class="panel-body bg-quartenary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-asterisk"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Total Calls</h4>
															<div class="info">
																<strong class="amount total_calls">1281</strong>
															</div>
														</div>
														{{-- <div class="summary-footer">
															{{-- <a class="text-uppercase">(view all)</a>
														</div> --}}
													</div>
												</div>
											</div>
										</section>
                                    </div>
    </div>

    <div class="row">
    <div class="col-md-12 col-sm-12">
										<section class="panel">
											<div class="panel-body bg-quartenary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-phone"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Answered Calls</h4>
															<div class="info">
																<strong class="amount total_received_calls">1281</strong>
															</div>
														</div>
														<div class="summary-footer">
															{{-- <a class="text-uppercase">(view all)</a> --}}
														</div>
													</div>
												</div>
											</div>
										</section>
                                    </div>
    </div>
    <div class="row">
    <div class="col-md-12 col-sm-12">
										<section class="panel">
											<div class="panel-body bg-quartenary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-users"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Unique Callers</h4>
															<div class="info">
																<strong class="amount total_unique_calls">1281</strong>
															</div>
														</div>
														<div class="summary-footer">
															{{-- <a class="text-uppercase">(view all)</a> --}}
														</div>
													</div>
												</div>
											</div>
										</section>
                                    </div>
    </div>
    </div>
    </section>
    </div>


<div class="col-md-4">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Region Wise Call distribution</h2>
										<p class="panel-subtitle">Pie Chart</p>
									</header>
									<div class="panel-body">

										<!-- Flot: Pie -->
										<div class="chart chart-md" id="flotPie"></div>

									</div>
								</section>
                            </div>
    <div class="col-md-4">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Operator Wise Call distribution</h2>
										<p class="panel-subtitle">Pie Chart</p>
									</header>
									<div class="panel-body">

										<!-- Flot: Pie -->
										<div class="chart chart-md" id="flotPie2"></div>


									</div>
								</section>
                            </div>
</div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6">
							<section class="panel">
                                <header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Duration Wise Call distribution</h2>
										<p class="panel-subtitle">Charting done on basis of call duration (in secs)</p>
									</header>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">

												<div id="salesSelectorItems" class="chart-data-selector-items mt-sm">
													<!-- Flot: Sales JSOFT Admin -->
													<div class="chart chart-sm" id="flotDashSales1"></div>

                                                </div>

											</div>
										</div>

                                    </div>
                                    </section>
								</div>



        <div class="col-md-6">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Monthly Call History</h2>
										<p class="panel-subtitle">Total Calls</p>
									</header>
									<div class="panel-body">

										<!-- Morris: Area -->
										<div class="chart chart-md" id="flotBars"></div>



									</div>
								</section>
		</div>

</div>
@endsection


@section('scripts')
  <script src="assets/vendor/flot/jquery.flot.js"></script>
		<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="assets/vendor/flot/jquery.flot.categories.js"></script>
        <script src="assets/vendor/flot/jquery.flot.resize.js"></script>

        <script>
        $("input[name=end_date]").on("change",function(){
            var end_date=$(this).val();
            if($("input[name=start_date]").val().length!=0){
                var start_date=$("input[name=start_date]").val();
                loadDashboardData(start_date,end_date);
                $(".date_range").html(`Date range : ${start_date} to ${end_date}` )
            }
        });
        </script>


        <script>
            function getRandomColor() {
                return '#'+Math.random().toString(16).slice(-6)
                }

                loadDashboardData();
                function loadDashboardData(start_date='',end_date=''){
                var source_number={{session('source_number')}};


                $.ajax({
                            url: '/CallSummaryReport',
                            type: 'post',

							headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    								},
                            data:'start_date='+start_date+'&end_date='+end_date,

                            success: function(response) {
                                $.each(response,function(index,element){
                                    if(element.source_number==source_number){
                                    $('.total_calls').html(element.total_calls);
                                    $('.total_received_calls').html(element.received_calls);
                                    $('.total_unique_calls').html(element.unique_calls);

                                    $.each(element.region_wise_calls,function(ind,ele){
                                        ele.color=getRandomColor();
                                    });

                                    $.each(element.operator_wise_calls,function(ind,ele){
                                        ele.color=getRandomColor();
                                    });

                                    // Graph 1

                                            var plot = $.plot('#flotPie', element.region_wise_calls, {
                                                        series: {
                                                            pie: {
                                                                show: true,
                                                                combine: {
                                                                    color: '#999',
                                                                    threshold: 0.1
                                                                },
                                                                // label: {
                                                                //     show: true,
                                                                //     radius: 2 / 3,
                                                                //     formatter: function (label, series) {
                                                                //         return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + series.data[0][1] + '</div>';

                                                                //     },
                                                                //     threshold: 0.1
                                                                // }

                                                            }
                                                        },
                                                        legend: {
                                                            show: false
                                                        },
                                                        grid: {
                                                            hoverable: true,
                                                            clickable: true
                                                        }
                                                    });
                                    //Graph 2
                                        var plot = $.plot('#flotPie2', element.operator_wise_calls, {
                                                        series: {
                                                            pie: {
                                                                show: true,
                                                                combine: {
                                                                    color: '#999',
                                                                    threshold: 0.1
                                                                }
                                                            }
                                                        },
                                                        legend: {
                                                            show: false
                                                        },
                                                        grid: {
                                                            hoverable: true,
                                                            clickable: true
                                                        }
                                                    });
                                    //Graph 3
                                                    var parsed=new Array();
                                                    for(var i in element.duration_wise_calls[0])
                                                    {
                                                    var k=[`${i}`,element.duration_wise_calls[0][i]];
                                                    parsed.push(k);
                                                    }


														var flotDashSales1Data = [{
														    data: parsed,
														    color: "#0088cc"
														}];
                                                        var flotDashSales1 = $.plot('#flotDashSales1', flotDashSales1Data, {
                                                                series: {
                                                                    lines: {
                                                                        show: true,
                                                                        lineWidth: 2
                                                                    },
                                                                    points: {
                                                                        show: true
                                                                    },
                                                                    shadowSize: 0
                                                                },
                                                                grid: {
                                                                    hoverable: true,
                                                                    clickable: true,
                                                                    borderColor: 'rgba(0,0,0,0.1)',
                                                                    borderWidth: 1,
                                                                    labelMargin: 15,
                                                                    backgroundColor: 'transparent'
                                                                },
                                                                yaxis: {
                                                                    min: 0,
                                                                    color: 'rgba(0,0,0,0.1)',
                                                                    tickDecimals: 0
                                                                },
                                                                xaxis: {
                                                                    mode: 'categories',
                                                                    color: 'rgba(0,0,0,0)'
                                                                },
                                                                legend: {
                                                                    show: false
                                                                },
                                                                tooltip: true,
                                                                tooltipOpts: {
                                                                    content: '%x: %y',
                                                                    shifts: {
                                                                        x: -30,
                                                                        y: 25
                                                                    },
                                                                    defaultTheme: false
                                                                }
                                                            });

                                    // graph 4
                                            var parsed2=new Array();
                                                    $.each(element.month_wise_data,function(i,e){

                                                    var k=[`${e.month}`,e.count];
                                                    parsed2.push(k);

                                                    });

                                             var plot4 = $.plot('#flotBars', [parsed2], {
                                                        colors: ['#8CC9E8'],
                                                        series: {
                                                            bars: {
                                                                show: true,
                                                                barWidth: 0.8,
                                                                align: 'center',

                                                            }
                                                        },
                                                        xaxis: {
                                                            mode: 'categories',
                                                            tickLength: 0,

                                                        },
                                                        yaxis:{
                                                            tickDecimals: 0
                                                        },
                                                        grid: {
                                                            hoverable: true,
                                                            clickable: true,
                                                            borderColor: 'rgba(0,0,0,0.1)',
                                                            borderWidth: 1,
                                                            labelMargin: 15,
                                                            backgroundColor: 'transparent'
                                                        },
                                                        tooltip: true,
                                                        tooltipOpts: {
                                                            content: '%y',
                                                            shifts: {
                                                                x: -10,
                                                                y: 20
                                                            },
                                                            defaultTheme: true
                                                        }
                                                    });

                                    }

                                });
                            }
                        });
                }

            </script>

@endsection
