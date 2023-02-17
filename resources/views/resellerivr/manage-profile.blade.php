<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>Resellers IVR | Manage Profile</title>
    @include('resellerivr.layouts.header')
        <!-- START SIDEBAR-->
    @include('resellerivr.layouts.side-header')
        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
			     <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Manage Profile</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/resellerivr"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Manage Profile</li>
                </ol>
            </div><br>
			
			<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home" style="color:#dd6a39;">Account Details</a></li>
    <li><a data-toggle="tab" href="#menu1" style="color:#dd6a39;">Personal Details</a></li>
  </ul>

  <div class="tab-content">
  <!--account details-->
    <div id="home" class="tab-pane fade in active">
	
	
				<!--when client type="client"-->
			 <div class="ibox" name="client_form" id="client_form">
			 

							<form method="post" >
                        <div class="ibox-body" >
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>User Name:</label>
                                        <input class="form-control" type="text" name="uname" placeholder="Enter User Name" value="">
                                    </div>
									</div>
									<div class="col-md-4">
                                    <div class="form-group mb-4">
									<div id="selected_form_code">
                                        <label>Client Type:</label>
										 <select class="form-control" style="height: 35px;" name="clientselect"  id="select_client" disabled>
											<option value='{{Auth::user()->client_type}} ' selected>{{Auth::user()->client_type}}</option>
											
											
										  </select>
										  </div>
                                    </div>
									</div>
									<div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Validity(Days):</label>
                                        <input class="form-control" type="text" name="validity" placeholder="Enter Validity Days">
                                    </div>
									</div>
									
                                </div>
								
								<div class="row">
								<div class="col-md-4">
									<div class="form-group mb-4">
                                        <label>SMS Credit</label>
                                        <input class="form-control" type="text" name="sms_credit" placeholder="Enter Credit Value">
                                    </div>
									</div>
								
									<div class="col-md-4">
									<div class="form-group mb-4">
                                        <label>IVR Credit:</label>
                                        <input class="form-control" type="text" name="ivr_credit" placeholder="Enter IVR Credit">
                                    </div>
									</div>
									
									
									<div class="col-md-4">
									<div class="form-group mb-4">
                                        <label>IVR Pulse:</label>
                                        <input class="form-control" type="text" name="ivr_pulse" placeholder="Enter IVR Pulse">
                                    </div>
									</div>
									
									
                                </div>
								
								<div class="row">
									
									<div class="col-md-4">
									<div class="form-group mb-4">
                                        <label>OBD Credit:</label>
                                        <input class="form-control" type="text" name="obd_credit" placeholder="Enter OBD Credit">
                                    </div>
									</div>
									
								
									<div class="col-md-4">
									<div class="form-group mb-4">
                                        <label>OBD Pulse:</label>
                                        <input class="form-control" type="text" name="obd_pulse" placeholder="Enter OBD Pulse">
                                    </div>
									</div>
										
									<div class="col-md-4">
									<div class="form-group mb-4">
                                        <label>MCS Credit:</label>
                                        <input class="form-control" type="text" name="mcs_credit" placeholder="Enter Mcs Credit">
                                    </div>
									</div>
									
                                </div>
								<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-4">
								 <div class="check-list ">
                                                <label class="checkbox checkbox-grey checkbox-primary " style="display:inline-block;">
                                                    <input type="checkbox">
                                                    <span class="input-span"></span>IP Login</label>
                                                
												<label class="checkbox checkbox-grey checkbox-primary" style="display:inline-block;">
                                                    <input type="checkbox">
                                                    <span class="input-span"></span>Multiple Login</label>
													<label class="checkbox checkbox-grey checkbox-primary" style="display:inline-block;">
                                                    <input type="checkbox">
                                                    <span class="input-span"></span>Login Email</label>
                                            </div>
								 
								</div>
								<div class="col-md-4"></div>
								</div>
								
							
								
								<div class="ibox-footer">
						<center>
                                    <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air"><i class="fa fa-paper-plane" title="Submit"></i></button>
                                    
                           <!-- <button class="btn btn-primary mr-2" type="button">Submit</button>-->
                             <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air"><i class="fa fa-remove" title="Cancel"></i></button>
						</center>
                        </div>
								</div>
								</form>
                        
                </div>
				
	  <!--when client type="client" ends-->
	  
    </div>
		
	
	
	
	<!--personal details-->
    <div id="menu1" class="tab-pane fade">
				<div class="ibox">
                        <div class="ibox-body">
							<form method="post" class="form-personal">
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Name:</label>
                                        <input class="form-control" type="text" name="name" placeholder="Enter Name">
                                    </div>
									</div>
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Email:</label>
                                        <input class="form-control" type="email" name="email" placeholder="Enter Email">
                                    </div>
									</div>
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Contact:</label>
                                        <input class="form-control" type="text" name="mobile" placeholder="Enter Contact">
                                    </div>
									</div>
                                </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Std Code:</label>
                                        <input class="form-control" type="text" name="std_code" placeholder="Enter Std Code">
                                    </div>
									</div>
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Land Line:</label>
                                        <input class="form-control" type="text" name="landline" placeholder="Enter Land Line">
                                    </div>
									</div>
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Company Name:</label>
                                        <input class="form-control" type="text" name="cname" placeholder="Enter Company Name">
                                    </div>
									</div>
                                </div>
								<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-4">
								<div class="check-list">
                                                <label class="checkbox checkbox-grey checkbox-primary">
                                                    <input type="checkbox">
                                                    <span class="input-span"></span>NDNC Filter</label>
                                                
                                            </div>
								
								<!--<label class="checkbox-inline">
									  <input type="checkbox" name="ip" value="ip"> IP Login<br>
									</label>-->
									</div>
								<div class="col-md-4"></div>
								</div>
								<div class="ibox-footer">
						<center>
                                    <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air" id="form-personal-submit"><i class="fa fa-paper-plane"  title="Submit"></i></button>
                                    
                           <!-- <button class="btn btn-primary mr-2" type="button">Submit</button>-->
                             <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air"><i class="fa fa-remove" title="Cancel"></i></button>
						</center>
                        </div>
                    </form>
								</div>
                        
                        
						 </div>
               
				
				
	
	
	
	
	
	
    </div>
    
  </div>
			
    @include('resellerivr.layouts.footer')
    
     <script>
				
                $(function() {
				
                    
                    $.ajax({
                        type:'post',
                        url:'/api/getDetails',
                        headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                        success:function(response){
                            $('input[name=name]').val(response.name);
                            $('input[name=email]').val(response.email);
                            $('input[name=mobile]').val(response.contact);
                            $('input[name=std_code]').val(response.stdcode);
                            $('input[name=landline]').val(response.landline);
                            $('input[name=cname]').val(response.companyname);
                            $('input[name=uname]').val(response.username);
                            $("#select_client option:first").val(response.client_type);
                            $('input[name=validity]').val(response.validity);
                            //$('input[name=services]').val(response.services);
                            $('input[name=sms_credit').val(response.sms_credit);
                            $('input[name=ivr_credit]').val(response.ivr_credit);
                            $('input[name=ivr_pulse]').val(response.ivr_pulse);
                            
                        }
                    });
                    
                    
                    $('#form-personal-submit').click(function(e) {
                        e.preventDefault;
                        var data = $('.form-personal').serialize();

                        $.ajax({
                            url: '/api/manageprofile',
                            type: 'post',   
							
							headers: {
        								'Authorization':'Bearer ' + token,
    									},
                            data: data,

                            success: function(result) {
                                $.each(result, function(index, element) {
                                    spop({
                                        template: element,
                                        autoclose: 5000,
                                        style: 'success'
                                    });
                                });
                            },
                            error: function(xhr, status, error) {
                                    
                                var err=$.parseJSON(xhr.responseText);
                                console.log(err);
                                if(err.errors !== undefined){
                                    $.each(err.errors, function(index, element) {
                                    spop({
                                        template: element,
                                        autoclose: 5000,
                                        style: 'error'
                                    });
                                   
                               });
                            }
                                else {
                                    $.each(err, function(index, element) {
                                    spop({
                                        template: err.message,
                                        autoclose: 5000,
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
    
</body>


</html>