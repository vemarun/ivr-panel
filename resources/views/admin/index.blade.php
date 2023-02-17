@extends('admin_layouts.app')


@section('title')
    Admin Dashboard
@endsection

@section('menu')
    Admin Dashboard
@endsection

@section('content')
    

                
              <div class="col-md-12  col-xs-12 col-sm-12">
			<div class="row">
			<div class="col-md-4 col-sm-4 " style="padding-right:10px;">
			<center><img src="/images/clients.png" class="recolor"></center>
			<h4 align="center" id="total_users"></h4>
			<h4 align="center">Total Users</h4>
			
			</div>
			<div class="col-md-4 col-sm-4 ">
			<center><img src="/images/msg.png" class="recolor"></center>
			<h4 align="center" id="total_sms"></h4>
			<h4 align="center">Total Messages Sent</h4>
			
			</div>
			<div class="col-md-4 col-sm-4 ">
			<center><img src="/images/call.png" class="recolor"></center>
			<h4 align="center" id="total_calls"></h4>
			<h4 align="center">Total Phone Calls</h4>
			
			</div>
			
			</div>
            <br>
            
			<div class="row">
            <div class="col-md-6">
                <table class="table live_call_table">
                    <thead>
                        <tr>
                            <th id="ongoing_calls"></th>
                        </tr>
                    </thead>
                    <tbody class='live_call_table_body' style='display: block; border: 1px solid #140F6D; height: 360px; overflow-y: scroll'>
                            
                    </tbody>
                    <center><img src="/images/loader.gif" class="loader">  </center>	
                </table>
            </div>

			<div class="col-md-6">
			<div id="piechart"></div>
@endsection

@section('scripts')
    

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

$.ajax({
	'url':'/adminDashboardData',
	'type':'post',
	headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
	success:function(response){
		$("#total_sms").html(response.total_sms);
		$("#total_calls").html(response.total_calls);
		$("#total_users").html(response.total_users);
		
	

// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(function(){
	drawChart(response.client_count,response.seller_count,response.reseller_count,response.admin_count);
});

// Draw the chart and set the chart values
function drawChart(clients=0,sellers=0,resellers=0,admins=0) {
  var data = google.visualization.arrayToDataTable([
  ['Clients', 'No of Clients in Total'],
  ['Admins', admins],
  ['Resellers', resellers],
  ['Sellers',sellers],
  ['Clients', clients]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Total No Of Clients', 'width':550, 'height':400};

  // Display the chart inside the div element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}

}
})
</script>

            <script>
            function getLiveAgents(){ 
            $.ajax({
                'url':'/getLiveAgents',
                'type':'post',
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                            },
                success:function(response){

                    $(".live_call_table_body").html("");
                    $(".loader").hide();
                    var ongoing_calls=response.length;
                    $("#ongoing_calls").html(`<i class='fa fa-circle' style='color:green'></i>  Ongoing Calls : ${ongoing_calls}`);

                    $.each(response,function(index,element){
                        $(".live_call_table_body").append(`
                        <tr>
                            <td>Client: ${element.username}</td>
                            <td>S: ${element.source_number}</td>
                            <td>A: <i class='fa fa-circle' style='color:green'></i> 
                                ${element.agent_destination}<br>
                                &nbsp;&nbsp;${element.agent_name}</td>
                            <td>C: ${element.assigned_to_caller}</td>
                        </tr>
                        `);
                    });
                }
                });
            }
            getLiveAgents();
            setInterval(getLiveAgents,5000);
            </script>
            
@endsection