@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('header')
<link rel="stylesheet" href="assets/vendor/morris/morris.css" />
<script src="assets/vendor/morris/morris.js"></script>
<script src="assets/vendor/raphael/raphael.js"></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"> --}}

    <style>

        /*
        img{
            filter: hue-rotate(180deg);
        } */

        /* .content-body{
            background: #0F0B50;
        } */

        @media only screen and (min-width: 1450px) {
  .col-width{
      width:510px;
    }
}

    </style>
@endsection

@section('menu')
Dashboard |
@if(Auth::user()->ivr_credit>200)
<span class="label label-success"> IVR Credit: {{Auth::user()->ivr_credit}}  |   SMS Credit: {{Auth::user()->sms_credit}}</span>
@else
<span class="label label-danger"> IVR Credit: {{Auth::user()->ivr_credit}}  |   SMS Credit: {{Auth::user()->sms_credit}}</span>
@endif
@endsection

@section('content')



            <section>
                <div class="row">

        {{-- First Grid from here --}}

                    <div class="col-md-8 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="date_range_picker">
                                    <form class="form form_source_number">
                                            <div class="form-group">
                                            <label class="col-md-12 control-label date_range">Date range : Today</label>
                                                    <div class="col-md-8">
                                                        <div class="input-daterange input-group" data-plugin-datepicker>
                                                            <input type="text" class="form-control" name="start_date">
                                                            <span class="input-group-addon">to</span>
                                                            <input type="text" class="form-control" name="end_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button class="btn btn-default submit">Go</button>
                                                    </div>
                                                </div>
                                    </form>
                                </div>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-4">
                                <br>
								<section class="panel">
                                    {{-- <header class="panel-heading panel-heading-transparent">
									<div class="panel-actions">
										<a href="#" class="fa fa-caret-down"></a>
										<a href="#" class="fa fa-times"></a>
									</div>

									<h2 class="panel-title"><i class="fa fa-circle" style="color:green"></i> &nbsp; Recent Calls</h2>
								</header> --}}
									<div class="panel-body">
										<div class="chart chart-md" id="morrisDonut"></div>
                                    </div>
								</section>
                            </div>

                    <div class="col-md-8 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
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
															<h4>Total</h4>
															<div class="info">
																<strong class="amount" id="total_calls"></strong>
															</div>
														</div>
												</div>
                                            </div>
										</div>
								</section>

                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                               <section class="panel">
											<div class="panel-body bg-primary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-life-ring"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4>Received</h4>
															<div class="info">
																<strong class="amount" id="total_received_calls"></strong>
															</div>
														</div>
												</div>
                                            </div>
											</div>
										</section>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                               <section class="panel">
											<div class="panel-body bg-secondary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-life-ring"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4>Missed</h4>
															<div class="info">
																<strong class="amount" id="total_missed_calls"></strong>
															</div>
														</div>
												</div>
                                            </div>
											</div>
										</section>

                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12">
                                   <section class="panel">
											<div class="panel-body bg-primary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-level-down"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4>Inbound</h4>
															<div class="info">
																<strong class="amount" id="inbound_calls"></strong>
															</div>
														</div>
												</div>
                                            </div>
											</div>
                                        </section>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                               <section class="panel">
											<div class="panel-body bg-quartenary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-level-up"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4>Outb.</h4>
															<div class="info">
																<strong class="amount" id="outbound_calls"></strong>
															</div>
														</div>
												</div>
                                            </div>
											</div>
										</section>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                               <section class="panel">
											<div class="panel-body bg-secondary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-user-secret"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4>Agents</h4>
															<div class="info">
																<strong class="amount" id="agent_count"></strong>
															</div>
														</div>
												</div>
                                            </div>
											</div>
										</section>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
        {{-- Second Grid from here --}}


                        <div class="col-md-4 col-xs-12 col-sm-12">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
								<section class="panel">
								<header class="panel-heading panel-heading-transparent">
									<div class="panel-actions">
										<a href="#" class="fa fa-caret-down"></a>
										<a href="#" class="fa fa-times"></a>
									</div>

									<h2 class="panel-title"><i class="fa fa-circle" style="color:green"></i> &nbsp; Recent Calls</h2>
								</header>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped mb-none table-responsive">
											<thead>
												<tr>
													{{-- <th>Type</th> --}}
													<th>Caller</th>
													<th>Agent</th>
                                                    <th>Status</th>
                                                    <th>Time</th>
												</tr>
											</thead>
											<tbody class="recent-calls">

											</tbody>
										</table>
									</div>
								</div>
							</section>
                        </div>
                        </div>
                        </div>
                </div>

                        <div class="col-md-12">
                            <section class="panel">
                                {{-- <header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Duration Wise Call distribution</h2>
										<p class="panel-subtitle">Charting done on basis of call duration (in secs)</p>
									</header> --}}
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">

												<div id="salesSelectorItems" class="chart-data-selector-items mt-sm">

                                                    <div class="chart chart-md" id="morrisBar"></div>
                                                </div>

											</div>
										</div>

                                    </div>
                                    </section>
                        </div>

                        <div class="col-md-12">
                                <section class="panel panel-featured panel-featured-primary">

                                        <div class="panel-body">
                                            <!-- Morris: Bar -->
                                            <div class="chart chart-sm" id="flotDashSales1"></div>

                                        </div>
                                </section>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">

                    </div>
                </div>
            </section>



<script src="assets/vendor/flot/jquery.flot.js"></script>
		<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="assets/vendor/flot/jquery.flot.categories.js"></script>
        <script src="assets/vendor/flot/jquery.flot.resize.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script> --}}
            <script>

                loadDashboardData();
                function loadDashboardData(start_date='',end_date=''){
                var source_number={{session('source_number')}};
                var received_calls=[];
                var missed_calls=[];
                var date=[];

                $("#morrisDonut").html("");
                $("#morrisBar").html("");

                $.ajax({
                            url: '/dashboardSourceNumberDetail',
                            type: 'post',

							headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    								},
                            data:'start_date='+start_date+'&end_date='+end_date,

                            success: function(response) {
                                $.each(response,function(index,element){
                                    if(element.source_number==source_number){
                                        $('#table_sno').html(element.source_number);
                                         $('#table_agent_count').html(element.agent_count);
                                        $("#agent_count").html(element.agent_count);
                                        $("#inbound_calls").html(element.inbound_calls);
                                        $("#outbound_calls").html(element.outbound_calls);
                                    $('#total_calls').html(element.total_calls);
                                    $('#total_received_calls').html(element.received_calls);
                                    $('#total_missed_calls').html(element.missed_calls);
                                    $('#total_unique_calls').html(element.unique_calls);


                        var morrisDonutData = [{
												label: "Received Calls",
												value: element.received_calls
											}, {
												label: "Failed / Missed Calls",
												value: element.missed_calls
											}];

                                            Morris.Donut({
                                                resize: true,
                                                element: 'morrisDonut',
                                                data: morrisDonutData,
                                                colors: ['#0088cc', '#734ba9', '#E36159'],
                                                height:'200px',
                                                width:'200px'
                                            });

                                            var morrisBarData = element.last_seven_days_data;

                                    /*
                                Morris: Bar
                                */
                                Morris.Bar({
                                    resize: true,
                                    element: 'morrisBar',
                                    data: morrisBarData,
                                    xkey: 'date',
                                    ykeys: ['received_call', 'missed_call'],
                                    labels: ['Received', 'Missed'],
                                    hideHover: true,
                                    barColors: ['#0088cc', '#734BA9']
                                });



                                    }

                                    var parsed=new Array();
                                                    for(var i in element.groups)
                                                    {
                                                    var k=[`${i}`,element.groups[i]];
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

                                });




                                $(".submit").html(`Go`);
                            },
                        });
                }

            </script>


        <script>
        $.ajax({
                            url: '/getRecentCalls',
                            type: 'post',

							headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    								},

                            success: function(response) {
                                var response_length=Object.keys(response).length;
                                console.log(response_length);

                                $.each(response,function(index,element){
                                    if(element.call_type=='Inbound'){
                                        var call_type=`<i class="fa fa-level-down"></i>`;
                                    }
                                    else if(element.call_type=='Outbound'){
                                        var call_type=`<i class="fa fa-level-up"></i>`;
                                    }
                                    else{
                                        var call_type=``;
                                    }
                                    if(element.call_status=='ANSWER'){
                                        var call_status=`<span class="label label-success">${element.call_status}</span>`;
                                    }
                                    else if(element.call_status=='CANCEL'){
                                        var call_status=`<span class="label label-warning">${element.call_status}</span>`;
                                    }
                                    else{
                                        var call_status=`<span class="label label-danger">${element.call_status}</span>`;
                                    }
                                    $(".recent-calls").append(`
                                    <tr>

                                                    <td>${element.caller_number}</td>
                                                    <td>${element.agent_number}<br>${element.agent_name==null||element.agent_name==''?'Agent':element.agent_name}</td>
													<td>${call_status}</td>
                                                    <td>${element.start_time}</td>
                                                </tr>
                                    `);
                                });
                                if(response_length<7){
                                    var required_td=7-response_length;
                                    for(var i=0; i<required_td;i++){
                                        $(".recent-calls").append(`
                                    <tr>

                                                    <td></td>
                                                    <td><br></td>
													<td></td>
                                                    <td></td>
                                                </tr>
                                    `);
                                    }
                                }

                            }
        });
        </script>

        <script>
        $(".submit").on("click",function(e){
            e.preventDefault();
            $(this).html(`<i class='fa fa-circle-o-notch fa-spin'></i>`)
            var end_date=$(this).val();
            var start_date=$("input[name=start_date]").val();
                loadDashboardData(start_date,end_date);
                $(".date_range").html(`Date range : ${start_date} to ${end_date}` )

        });
        </script>

@endsection
