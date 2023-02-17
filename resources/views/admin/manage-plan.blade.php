<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Admin | Manage Plan</title>
    		
    @include('admin.layouts.header')
        <!-- START SIDEBAR-->		
    @include('admin.layouts.side-header')
        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
			     <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Manage Plan</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Manage Plan</li>
                </ol>
            </div><br>
			
			
             <div class="ibox">
                        <div class="ibox-body">
							<form method="post" class="form-plan">
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Title:</label>
                                        <input class="form-control" type="text" name="plan_title" placeholder="Enter Plan Title" required>
                                    </div>
									</div>
									<div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>IVR Rate:</label>
                                        <input class="form-control" type="text" name="ivr_rate" placeholder="Enter IVR Rate" required>
                                    </div>
                                    </div>
                                    
									 <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label>SMS Rate:</label>
                                            <input class="form-control" type="text" name="sms_rate" placeholder="Enter SMS Rate" required>
                                        
                                        </div>
                                        </div>
                                </div>
								
								<div class="row">
                               
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Max Agent:</label>
                                        <input class="form-control" type="text" name="max_agent" placeholder="Enter Maximum Agent" required>
                                    </div>
                                    </div>
                                    
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>OBD Pulse(in sec):</label>
										 <select class="form-control" name="obd_pulse" style="height: 35px;">
											<option value="">--select OBD Pulse--</option>
											<option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
											<option value="30">30</option>
											<option value="45">45</option>
											<option value="60">60</option>
										  </select>
									</div>
                                    </div>
                                    
                                </div>
								
								<div class="ibox-footer">
						<center>
                                    <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air form-plan-submit" type="submit"><i class="fa fa-paper-plane"  title="Submit"></i></button>
                                    
                           <!-- <button class="btn btn-primary mr-2" type="button">Submit</button>-->
                             <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air" type="reset"><i class="fa fa-remove" title="Cancel"></i></button>
						</center>
                        </div>
                    </form>
								</div>
                        
                        
						 </div>
               
	 			  <div class="row">
				  
               
                    <div class="col-xl-12">
                        <div class="ibox">
						 
                            <div class="ibox-body">
							<div style="display:inline-block;">
							<h4 style="display:inline-block;" >Plan List</h4>
							
							</div>
							<div class="table-responsive">
								<table class="table table-head-purple mb-5">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>IVR Rate</th>
                                            <th>SMS Rate</th>
                                            <th>OBD Pulse</th>
                                            <th>Max Agents</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="plan_list">
                                        
                                        
                                    </tbody>
                                </table>
                                <center><img src="/images/loader.gif" id="loader">  </center>

                                </div>
                                
                            </div>
                        </div>
                    </div>
					</div>
               
					
    @include('admin.layouts.footer')
    <script>
        function loadPlans(){
    $.ajax({
                        type:'post',
                        url:'/getPlans',
                        headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                        success:function(response){
                            $("#loader").hide();
                            $.each(response,function(index,element){
                                $(".plan_list").append(`
                                <tr>
                                    <td>${element.title}</td>
                                    <td>${element.ivr_rate}</td>
                                    <td>${element.sms_rate}</td>
                                    <td>${element.obd_pulse}</td>
                                    <td>${element.max_agents}</td>
                                    </tr>
                                `)
                            })
                        }

                    });
                }
                loadPlans();
    </script>

<script>
				
    $(function() {
    
        $('.form-plan-submit').click(function(e) {
            e.preventDefault;
            var data = $('.form-plan').serialize();
            
            
            $.ajax({
                url: '/create-plan',
                method: 'post',   
                headers: {
                             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                            },
                data: data,

                success: function(result) {
                    $.each(result, function(index, element) {
                        spop({
                            template: element,
                            autoclose: 10000,
                            style: 'success'
                        });
                    });
                    $(".plan_list").empty();
                    $("#loader").show();
                    loadPlans();
                },
                error: function(xhr, status, error) {
                        
                    var err=$.parseJSON(xhr.responseText);
                    console.log(err);
                    if(err.errors !== undefined){
                        $.each(err.errors, function(index, element) {
                        spop({
                            template: element,
                            autoclose: 10000,
                            style: 'error'
                        });
                       
                   });
                }
                    else {
                        $.each(err, function(index, element) {
                        spop({
                            template: err.message,
                            autoclose: 10000,
                            style: 'error'
                        });
                       
                        });
                    }
                        
                }
                               
            });
            return false;
        });
    });

</script>
<script>
    
    function updateDiv()
    { 
        $( "#reload" ).load(window.location.href + " #reload" );
    }
    </script>
</body>


</html>