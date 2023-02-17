@extends('layouts.app')

@section('title')
Agent Reports
@endsection

@section('header')
<link rel="stylesheet" href="assets/vendor/morris/morris.css" />
<script src="assets/vendor/morris/morris.js"></script>
<script src="assets/vendor/raphael/raphael.js"></script>
@endsection

@section('menu')
    Agent Reports
@endsection


@section('content')
<div class="row">
<form class="form agent_report_form form-inline">
       <div class="form-group">
                        <label class="col-md-12 control-label">Select Agent</label>
                            <div class="col-md-12">
                                <select name="agent" id="agent" class="form-control input-sm mb-md">
                                        <option selected disabled>Select Agent</option>
                                        <option value=''>All</option>
                                </select>
                            </div>
        </div>


        <div class="form-group">
        {{-- <label class="col-md-12 control-label date_range">Date range : Today</label> --}}
                <div class="col-md-12">
                    <div class="input-daterange input-group" data-plugin-datepicker>
                        <input type="text" class="form-control" name="start_date">
                        <span class="input-group-addon">to</span>
                        <input type="text" class="form-control" name="end_date">
                    </div>
                </div>
        </div>
        <button class="btn btn-info agent_report_form_submit" style="margin-left:12px;box-shadow: 2px 2px #888888;">Go</button>


</form>
</div>
<div class="row">

<div class="col-md-4 col-sm-6">
										<section class="panel">
											<div class="panel-body bg-quartenary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-user-secret"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title agent_detail_title"></h4>
															<div class="info">
																<strong class="agent_detail"><i class='fa fa-spinner fa-spin'></i></strong>
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

                                    <div class="col-md-4 col-sm-6">
										<section class="panel">
											<div class="panel-body bg-quartenary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-mobile"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Total Calls Attended</h4>
															<div class="info">
																<strong class="call_count"><i class='fa fa-spinner fa-spin'></i></strong>
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

                                    <div class="col-md-4 col-sm-6">
										<section class="panel">
											<div class="panel-body bg-quartenary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-life-ring"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Average Talk Time</h4>
															<div class="info">
																<strong class="average_call_duration"><i class='fa fa-spinner fa-spin'></i></strong>
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
<div class="col-md-6 col-xl-6">
										<section class="panel panel-featured panel-featured-primary">
											<div class="panel-body">
												<div class="chart chart-sm" id="flotWidgetsSales1"></div>

												<hr class="solid short mt-lg">
												<div class="row">
                                                    <div class="col-md-3">
														<div class="h4 text-bold mb-none mt-lg call_count"><i class="fa fa-ellipsis-h"></i></div>
														<p class="text-xs text-muted mb-none">Total Calls Handled</p>
                                                    </div>
													<div class="col-md-3">
														<div class="h4 text-bold mb-none mt-lg inbound_calls"><i class="fa fa-ellipsis-h"></i></div>
														<p class="text-xs text-muted mb-none">Inbound handled</p>
                                                    </div>
                                                    <div class="col-md-3">
														<div class="h4 text-bold mb-none mt-lg outbound_calls"><i class="fa fa-ellipsis-h"></i></div>
														<p class="text-xs text-muted mb-none">Outbound handled</p>
													</div>
													<div class="col-md-3">
														<div class="h4 text-bold mb-none mt-lg average_inbound_call_duration"><i class="fa fa-ellipsis-h"></i></div>
														<p class="text-xs text-muted mb-none">Average Inbound Talk time</p>
													</div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
														<div class="h4 text-bold mb-none mt-lg average_outbound_call_duration"><i class="fa fa-ellipsis-h"></i></div>
														<p class="text-xs text-muted mb-none">Average Outbound Talk time</p>
                                                    </div>
                                                    <div class="col-md-3">
														<div class="h4 text-bold mb-none mt-lg total_call_duration"><i class="fa fa-ellipsis-h"></i></div>
														<p class="text-xs text-muted mb-none">Total Talk time</p>
													</div>
                                                    <div class="col-md-3">
														<div class="h4 text-bold mb-none mt-lg total_inbound_call_duration"><i class="fa fa-ellipsis-h"></i></div>
														<p class="text-xs text-muted mb-none">Total Inbound Talk time</p>
													</div>
													<div class="col-md-3">
														<div class="h4 text-bold mb-none mt-lg total_outbound_call_duration"><i class="fa fa-ellipsis-h"></i></div>
														<p class="text-xs text-muted mb-none">Total Outbound Talk time</p>
													</div>
                                                </div>
											</div>
										</section>
                                    </div>

                                    <div class="col-md-6">
								<section class="panel">
									<div class="panel-body">

										<!-- Flot: Pie -->
										<div class="chart chart-md" id="flotPie"></div>

									</div>
								</section>
							</div>

</div>

<div class="row agent_calls">

    <section class="panel" style="display: none">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>

								<h2 class="panel-title">Recent Calls</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>

											<th>Source Number</th>
                                            <th>Agent Number</th>
                                            <th>Caller Number</th>
											<th>Call Time</th>
                                            <th>End time</th>
                                            <th>Duration</th>
                                            <th>Status</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</section>

</div>
<div class="row each_agent_report">

    <section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>

								<h2 class="panel-title">Agent Summary</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped table-responsive mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
											<th>Agent</th>
											<th>Total Calls</th>
                                            <th>Total Inbound</th>
                                            <th>Total Outbound</th>
											<th>Total Duration</th>
                                            <th>Agent Rating &nbsp; <i class='fa fa-info-circle' title="Ratings given by Callers"></i></th>
                                            <th>Added at</th>
                                            <th>Status</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</section>

</div>

@endsection

@section('scripts')
<script src="assets/vendor/flot/jquery.flot.js"></script>
		<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="assets/vendor/flot/jquery.flot.categories.js"></script>
		<script src="assets/vendor/flot/jquery.flot.resize.js"></script>
<script>
$("select[name=agent]").select2();
</script>
<script>
function loadDiv(){
            $.ajax({
                url:'/manage-agents',
                type:'post',
                headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    								},
                success:function(response){
                    $.each(response.data,function(index,element){
                    $("select[name=agent]").append(`
                    <option value="${element.id}">${element.agent_name} (${element.agent_destination})</option>
                    `);

                    });
                }
            });
}
loadDiv();
</script>

<script>
function loadData(data){
    $.ajax({
        type: "post",
        url: "/agent-report",
        data: data,
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    				},
        success: function (response) {

            if(!response.agent_number)
            {
                $(".agent_detail").html(
                response.agent_detail[0].active_agents+response.agent_detail[0].inactive_agents+
                `<sub> &nbsp;&nbsp;(Active : ${response.agent_detail[0].active_agents} |
                Inactive : ${response.agent_detail[0].inactive_agents})</sub>`
                );
                $(".agent_detail_title").html(
                `Total Agents`
                );
                $(".agent_calls").find('section').hide();
                $('.each_agent_report').find('section').show();
                $(".each_agent_report").find('tbody').html("");

                $.each(response.each_agent_report,function(index,element){
                    var agent_rating='';
                    for(var i=1;i<=Math.round(element.agent_rating);i++){
                        agent_rating+="<i class='fa fa-star' style='color:orange'></i>";
                    }
                    if($.isEmptyObject(element.created_at)){
                        var created_at='';
                    }
                    else{
                        var created_at=element.created_at.date;
                    }
                    $(".each_agent_report").find('tbody').append(`
                    <tr>
                    <td>${element.agent_name}<br>${element.agent_number}</td>
                    <td>${element.call_count}</td>
                    <td>${element.inbound_calls}</td>
                    <td>${element.outbound_calls}</td>
                    <td>${element.total_call_duration}</td>
                    <td title='${element.agent_rating}'>${agent_rating}</td>
                    <td>${created_at}</td>
                    <td>${element.is_active}</td>
                    </tr>
                    `);
                });
            }
            else
            {
                $(".agent_detail_title").html(
                `Agent : ${response.agent_detail.agent_name.toUpperCase()}`
                );
                $(".agent_detail").html(
                `${response.agent_detail.agent_destination}`
                );
                $(".agent_calls").find('section').show();
                $('.each_agent_report').find('section').hide();
                $(".agent_calls").find('tbody').html("");
                $.each(response.recent_calls.data,function(index,element){
                    $(".agent_calls").find('tbody').append(`
                    <tr>
                      <td>${element.source_number}</td>
                      <td>${element.agent_number}</td>
                      <td>${element.caller_number}</td>
                      <td>${element.start_time}</td>
                      <td>${element.end_time}</td>
                      <td>${element.duration}</td>
                      <td>${element.call_status}</td>
                    </tr>
                    `);
                });
            }

            $(".call_count").html(`${response.call_count}`);
            $(".average_call_duration").html(`${Math.round(response.average_call_duration)} secs`);
            $(".inbound_calls").html(`${response.inbound_calls}`);
            $(".outbound_calls").html(`${response.outbound_calls}`);
            $(".avergae_call_duration").html(`${Math.round(response.average_call_duration)}`);
            $(".average_inbound_call_duration").html(`${Math.round(response.average_inbound_call_duration)} secs`);
            $(".average_outbound_call_duration").html(`${Math.round(response.average_outbound_call_duration)} s`);
            $(".total_call_duration").html(`${response.total_call_duration} s`);
            $(".total_inbound_call_duration").html(`${response.total_inbound_call_duration} s`);
            $(".total_outbound_call_duration").html(`${response.total_outbound_call_duration} s`);


            // Graph 1
                                var flotPieData = [{
												label: "Inbound calls",
												data: [
													response.inbound_calls
												],
												color: '#0088cc'
											}, {
												label: "Outbound Calls",
												data: [
													response.outbound_calls
												],
												color: '#2baab1'
											}];
                                            var plot = $.plot('#flotPie', flotPieData, {
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

                //graph 2
                                                    var parsed2=new Array();
                                                    $.each(response.month_wise_data,function(i,e){

                                                    var k=[`${e.month}`,e.count];
                                                    parsed2.push(k);

                                                    });


													var flotWidgetsSales1Data = [{
													    data: parsed2,
													    color: "#0088cc"
													}];

                                                var plot = $.plot('#flotWidgetsSales1', flotWidgetsSales1Data, {
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
                                                        borderColor: 'transparent',
                                                        borderWidth: 1,
                                                        labelMargin: 15,
                                                        backgroundColor: 'transparent'
                                                    },
                                                    yaxis: {
                                                        min: 0,
                                                        color: 'transparent',
                                                        tickDecimals: 0
                                                    },
                                                    xaxis: {
                                                        mode: 'categories',
                                                        color: 'transparent',

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


        $(".agent_report_form_submit").html(`Go`);

        }
    });
}
loadData();
</script>


<script>
$(".agent_report_form_submit").on('click',function(e){
    e.preventDefault();
    $(this).html(`<i class='fa fa-circle-o-notch fa-spin'></i>`);
    let data=$(".agent_report_form").serialize();
    loadData(data);
});
$(".agent_report_form_submit").effect( "bounce", {times:3}, 2000);

</script>


@endsection
