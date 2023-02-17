<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Client IVR | Manage Profile</title>
    @include('clientivr.layout.header')
    <!-- START SIDEBAR-->
    @include('clientivr.layout.side-header')
    <!-- END SIDEBAR-->
    <div class="wrapper content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Manage Profile</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.blade.php"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Manage Profile</li>
                </ol>
            </div><br>
            
            
            <!------------------------------errors if any will be displayed here ------------------------------->
            @include('layouts.errors')
            
            <!------------------------------------------------------------------------------------------->
            
            
            
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home" style="color:#dd6a39;">Account Details</a></li>
                <li><a data-toggle="tab" href="#menu1" style="color:#dd6a39;">Personal Details</a></li>
            </ul>

            <div class="tab-content">
                <!--account details-->
                <div id="home" class="tab-pane fade in active">


                    <!--when client type="client"-->
                    <div class="ibox" name="client_form" id="client_form">


                        <form>
                            @csrf
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label>User Name:</label>
                                            <input class="form-control" type="text" name="uname" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <div id="selected_form_code">
                                                <label>Client Type:</label>
                                                <select class="form-control" style="height: 35px;" name="clientselect" readonly>
											
											<!--<option value="client">RESELLER</option>
											<option value="seller">SELLER</option>-->
											<option value="reseller" >CLIENT</option>
										  </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label>Validity(Days):</label>
                                            <input class="form-control" type="text" name="validity" value="N/A" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label>Service</label>
                                            <input class="form-control" type="text" name="service" value="IVR" readonly>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="check-list ">
                                            <label class="checkbox checkbox-grey checkbox-primary " style="display:inline-block;">
                                                    <input type="checkbox" name="loginmethod[]" value="ip">
                                                    <span class="input-span"></span>IP Login</label>

                                            <label class="checkbox checkbox-grey checkbox-primary" style="display:inline-block;">
                                                    <input type="checkbox" name="loginmethod[]" value="multi">
                                                    <span class="input-span"></span>Multiple Login</label>
                                            <label class="checkbox checkbox-grey checkbox-primary" style="display:inline-block;">
                                                    <input type="checkbox" name="loginmethod[]" value="email">
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
                            <form class="form-personal">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label>Name:</label>
                                            <input class="form-control" type="text" name="name" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label>Email:</label>
                                            <input class="form-control" type="email" name="email" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label>Contact:</label>
                                            <input class="form-control" type="text" name="mobile" value="" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label>Std Code:</label>
                                            <input class="form-control" type="text" name="std_code" placeholder="Std Code">
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
                                <!-- These commented line might not be needed in client panel-->
                                <!-- <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="check-list">
                                            <label class="checkbox checkbox-grey checkbox-primary">
                                                    <input type="checkbox" name="ndnc" value="ndnc">
                                                    <span class="input-span"></span>NDNC Filter</label>

                                        </div>

                                        <label class="checkbox-inline">
									  <input type="checkbox" name="ip" value="ip"> IP Login<br>
									</label>
                        </div> 
                                <div class="col-md-4"></div>
                        </div>-->
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

            @include('clientivr.layout.footer')

            <!-------------------------------------------Ajax Post and capture api response---------------------------------------------->
          

            <script>
				
                $(function() {
                    
                    $.ajax({
                        type:'post',
                        url:'/getDetails',
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
                           // $('select[name=clientselect]').val(response.client_type);
                            $('input[name=validity]').val(response.validity);
                            //$('input[name=services]').val(response.services);
                        }
                    });
                    
                    
                    $('#form-personal-submit').click(function(e) {
                        e.preventDefault;
                        var data = $('.form-personal').serialize();

                        $.ajax({
                            url: '/manageprofile',
                            type: 'post',   
							
							headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
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
