<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Admin | New User</title>
    @include('resellerivr.layouts.header')
        <!-- START SIDEBAR-->
    @include('resellerivr.layouts.side-header')
        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
			     <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Create New User</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/resellerivr"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">New User</li>
                </ol>
            </div><br>
			
			<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home" style="color:#dd6a39;">Account Details</a></li>
    
  </ul>

  <div class="tab-content">
  <!--account details-->
    <div id="home" class="tab-pane fade in active">
	
	
				<!--when client type="client"-->
			 <div class="ibox">
                        <div class="ibox-body" >

							<form method="post" class="form_new_user">
                          @csrf
                           
                           <!--- common fields -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label>User Name:<sup>*</sup></label>
                                        <input class="form-control" type="text" name="uname" placeholder="Enter User Name" required>
                                    </div>
									</div>
									<div class="col-md-3">
                                    <div class="form-group mb-4">
									<div id="selected_form_code">
                                        <label>Client Type:<sup>*</sup></label>
										 <select class="form-control clientselect" style="height: 35px;" name="clientselect" onchange="getFormAccordingly(this.value);">
											<option disabled selected="selected">Select Client Type</option>
											<option value="client"  >CLIENT</option>
											
											<option value="reseller">RESELLER</option>
											{{-- <option value="seller">SELLER</option> --}}
										
										  </select>
										  </div>
                                    </div>
									</div>
									<div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label>Validity(Days):</label>
                                        <input class="form-control" type="text" name="validity" placeholder="Enter Validity Days">
                                    </div>
									</div>
									{{-- <div class="col-md-3">
									<div class="form-group mb-4">
                                        <label>SMS Credit</label>
                                        <input class="form-control" type="text" name="sms_credit" placeholder="Enter Credit Value">
                                    </div>
                                    </div> --}}
                                    
                                    
									<div class="col-md-3">
                                            <div class="form-group mb-4">
                                                <label>Plan:<sup>*</sup></label>
                                                 <select class="form-control" name="select_plan" style="height: 35px;">
                                                 <option selected disabled>Select Plan</option>
                                                 
                                                  </select>
                                            </div>
                                            </div>
                                            
                                            
                                </div>
                                
									
                    <!-- client's extra fields -->
				                <div class="for-client">
								<div class="row">
								{{-- <div class="col-md-3">
									<div class="form-group mb-4">
                                        <label>IVR Credit</label>
                                        <input class="form-control" type="text" name="ivr_credit" placeholder="0">
                                    </div>
									</div> --}}
								
									<div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label>Industry Type:</label>
										 <select class="form-control" name="industry" style="height: 35px;">
											<option disabled selected>Select Industry</option>
											<option>Real State</option>
											<option>Astrology</option>
											<option>Insurance</option>
											<option>Education</option>
											<option>Hospitality</option>
											<option>Tourism</option>
											<option>Health Care</option>
											<option>Retail</option>
											<option>Banking</option>
											<option>Automobiles</option>
											<option>Logistics</option>
											<option>Entertainment</option>
											<option>NGO</option>
											<option>IT and Communication</option>
											<option>Other</option>
										  </select>
                                    </div>
									</div>
									
									<div class="col-md-3">
                                    <div class="form-group mb-4">
                                        <label>Product Type:</label>
										 <select class="form-control" name="product" style="height: 35px;">
											<option selected disabled> Select product type</option>
											<option>Residential</option>
											<option>Commercial</option>
											<option>Residential Plots</option>
											<option>Commercial Plots</option>
										  </select>
                                    </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                            <div class="form-group mb-4">
                                                <label>Price Slab:</label>
                                                 <select class="form-control" name="price" style="height: 35px;">
                                                    <option> &lt;5Lac </option>
                                                    <option>10-15 Lac</option>
                                                    <option>15-20 Lac</option>
                                                    <option>20-30 Lac</option>
                                                    <option>30-40 Lac</option>
                                                    <option>40-50 Lac</option>
                                                    <option> &lt;50Lac </option>
                                                  </select>
                                            </div>
                                            </div>

                                            
								
									<div class="col-md-3">
                                            <div class="form-group mb-4">
                                                <label>City:</label>
                                                 <select class="form-control" name="city" style="height: 35px;">
                                                        <option selected disabled>Select City</option>
                                                        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#000000"><i>-Top Metropolitan Cities-</i></font></option>
        <option>Ahmedabad</option>
        <option>Bangalore</option>
        <option>Chandigarh</option>
        <option>Chennai</option>
        <option>Delhi</option>
        <option>Gurgaon</option>
        <option>Hyderabad</option>
        <option>Kolkatta</option>
        <option>Mumbai</option>
        <option>Noida</option>
        <option>Pune</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Andhra Pradesh-</i></font></option>
        <option>Anantapur</option>
        <option>Guntakal</option>
        <option>Guntur</option>
        <option>Hyderabad</option>
        <option>kakinada</option>
        <option>kurnool</option>
        <option>Nellore</option>
        <option>Nizamabad</option>
        <option>Rajahmundry</option>
        <option>Tirupati</option>
        <option>Vijayawada</option>
        <option>Visakhapatnam</option>
        <option>Warangal</option>
        <option>Andra Pradesh-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Arunachal Pradesh-</i></font></option>
        <option>Itanagar</option>
        <option>Arunachal Pradesh-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Assam-</i></font></option>
        <option>Guwahati</option>
        <option>Silchar</option>
        <option>Assam-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Bihar-</i></font></option>
        <option>Bhagalpur</option>
        <option>Patna</option>
        <option>Bihar-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Chhattisgarh-</i></font></option>
        <option>Bhillai</option>
        <option>Bilaspur</option>
        <option>Raipur</option>
        <option>Chhattisgarh-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Goa-</i></font></option>
        <option>Panjim/Panaji</option>
        <option>Vasco Da Gama</option>
        <option>Goa-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Gujarat-</i></font></option>
        <option>Ahmedabad</option>
        <option>Anand</option>
        <option>Ankleshwar</option>
        <option>Bharuch</option>
        <option>Bhavnagar</option>
        <option>Bhuj</option>
        <option>Gandhinagar</option>
        <option>Gir</option>
        <option>Jamnagar</option>
        <option>Kandla</option>
        <option>Porbandar</option>
        <option>Rajkot</option>
        <option>Surat</option>
        <option>Vadodara/Baroda</option>
        <option>Valsad</option>
        <option>Vapi</option>
        <option>Gujarat-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Haryana-</i></font></option>
        <option>Ambala</option>
        <option>Chandigarh</option>
        <option>Faridabad</option>
        <option>Gurgaon</option>
        <option>Hisar</option>
        <option>Karnal</option>
        <option>Kurukshetra</option>
        <option>Panipat</option>
        <option>Rohtak</option>
        <option>Haryana-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Himachal Pradesh-</i></font></option>
        <option>Dalhousie</option>
        <option>Dharmasala</option>
        <option>Kulu/Manali</option>
        <option>Shimla</option>
        <option>Himachal Pradesh-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Jammu and Kashmir-</i></font></option>
        <option>Jammu</option>
        <option>Srinagar</option>
        <option>Jammu and Kashmir-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Jharkhand-</i></font></option>
        <option>Bokaro</option>
        <option>Dhanbad</option>
        <option>Jamshedpur</option>
        <option>Ranchi</option>
        <option>Jharkhand-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Karnataka-</i></font></option>
        <option>Bengaluru/Bangalore</option>
        <option>Belgaum</option>
        <option>Bellary</option>
        <option>Bidar</option>
        <option>Dharwad</option>
        <option>Gulbarga</option>
        <option>Hubli</option>
        <option>Kolar</option>
        <option>Mangalore</option>
        <option>Mysore</option>
        <option>Karnataka-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Kerala-</i></font></option>
        <option>Calicut</option>
        <option>Cochin</option>
        <option>Ernakulam</option>
        <option>Kannur</option>
        <option>Kochi</option>
        <option>Kollam</option>
        <option>Kottayam</option>
        <option>Kozhikode</option>
        <option>Palakkad</option>
        <option>Palghat</option>
        <option>Thrissur</option>
        <option>Trivandrum</option>
        <option>Kerela-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Madhya Pradesh-</i></font></option>
        <option>Bhopal</option>
        <option>Gwalior</option>
        <option>Indore</option>
        <option>Jabalpur</option>
        <option>Ujjain</option>
        <option>Madhya Pradesh-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Maharashtra-</i></font></option>
        <option>Ahmednagar</option>
        <option>Aurangabad</option>
        <option>Jalgaon</option>
        <option>Kolhapur</option>
        <option>Mumbai</option>
        <option>Mumbai Suburbs</option>
        <option>Nagpur</option>
        <option>Nasik</option>
        <option>Navi Mumbai</option>
        <option>Pune</option>
        <option>Solapur</option>
        <option>Maharashtra-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Manipur-</i></font></option>
        <option>Imphal</option>
        <option>Manipur-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Meghalaya-</i></font></option>
        <option>Shillong</option>
        <option>Meghalaya-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Mizoram-</i></font></option>
        <option>Aizawal</option>
        <option>Mizoram-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Nagaland-</i></font></option>
        <option>Dimapur</option>
        <option>Nagaland-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Orissa-</i></font></option>
        <option>Bhubaneshwar</option>
        <option>Cuttak</option>
        <option>Paradeep</option>
        <option>Puri</option>
        <option>Rourkela</option>
        <option>Orissa-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Punjab-</i></font></option>
        <option>Amritsar</option>
        <option>Bathinda</option>
        <option>Chandigarh</option>
        <option>Jalandhar</option>
        <option>Ludhiana</option>
        <option>Mohali</option>
        <option>Pathankot</option>
        <option>Patiala</option>
        <option>Punjab-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Rajasthan-</i></font></option>
        <option>Ajmer</option>
        <option>Jaipur</option>
        <option>Jaisalmer</option>
        <option>Jodhpur</option>
        <option>Kota</option>
        <option>Udaipur</option>
        <option>Rajasthan-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Sikkim-</i></font></option>
        <option>Gangtok</option>
        <option>Sikkim-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Tamil Nadu-</i></font></option>
        <option>Chennai</option>
        <option>Coimbatore</option>
        <option>Cuddalore</option>
        <option>Erode</option>
        <option>Hosur</option>
        <option>Madurai</option>
        <option>Nagerkoil</option>
        <option>Ooty</option>
        <option>Salem</option>
        <option>Thanjavur</option>
        <option>Tirunalveli</option>
        <option>Trichy</option>
        <option>Tuticorin</option>
        <option>Vellore</option>
        <option>Tamil Nadu-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Tripura-</i></font></option>
        <option>Agartala</option>
        <option>Tripura-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Union Territories-</i></font></option>
        <option>Chandigarh</option>
        <option>Dadra & Nagar Haveli-Silvassa</option>
        <option>Daman & Diu</option>
        <option>Delhi</option>
        <option>Pondichery</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Uttar Pradesh-</i></font></option>
        <option>Agra</option>
        <option>Aligarh</option>
        <option>Allahabad</option>
        <option>Ballia</option>
        <option>Bareilly</option>
        <option>Faizabad</option>
        <option>Ghaziabad</option>
        <option>Gorakhpur</option>
        <option>Kanpur</option>
        <option>Lucknow</option>
        <option>Mathura</option>
        <option>Meerut</option>
        <option>Moradabad</option>
        <option>Noida</option>
        <option>Varanasi</option>
        <option>Uttar Pradesh-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Uttaranchal-</i></font></option>
        <option>Dehradun</option>
        <option>Roorkee</option>
        <option>Uttaranchal-Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-West Bengal-</i></font></option>
        <option>Asansol</option>
        <option>Durgapur</option>
        <option>Haldia</option>
        <option>Kharagpur</option>
        <option>Kolkatta</option>
        <option>Siliguri</option>
        <option>West Bengal - Other</option>
        <option disabled="disabled" style="background-color:#3E3E3E"><font color="#FFFFFF"><i>-Other-</i></font></option>
        <option>Other</option>
        </select>
                                            </div>
                                            </div>
                                            
									
									
                                </div>
								
								<div class="row">
								
									<div class="col-md-3">
									<div class="form-group mb-4">
                                        <label>Locality:</label>
                                        <input class="form-control" type="text" name="locality" placeholder="Enter Locality">
                                    </div>
									</div>
									
									
									
                                </div>
                     </div>
                     
                    <!--- client part end-->
                            {{-- {{-- <!--reseller extra field -->  
                               <div class="for-reseller">
                                <div class="row">
									
									{{-- <div class="col-md-3">
									<div class="form-group mb-4">
                                        <label>IVR Credit:</label>
                                        <input class="form-control" type="text" name="ivr_credit" placeholder="0">
                                    </div>
									</div>
                               <div class="col-md-3">
									<div class="form-group mb-4">
                                        <label>Plan:</label>
                                        <select class="form-control" name="select_plan" style="height: 35px;">
                                                <option selected disabled>--no plan selected--</option>
                                        </select>
                                    </div>
									</div>
								
                                </div>
                                </div> --}}
									
					<!-- reseller part end  -->	
                             <hr>
                              <!-- Personal details part -->
                               <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Name:<sup>*</sup></label>
                                        <input class="form-control" type="text" name="name" placeholder="Enter Name">
                                    </div>
									</div>
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Email:<sup>*</sup></label>
                                        <input class="form-control" type="email" name="email" placeholder="Enter Email" required>
                                    </div>
									</div>
									 <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label>Contact:<sup>*</sup></label>
                                        <input class="form-control" type="text" name="mobile" placeholder="Enter Contact" required>
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
                            <!-- ###### -->		
                               
								<div class="ibox-footer">
						<center>
                                    <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air form-new-user-submit"><i class="fa fa-paper-plane" title="Submit" id="newuser-icon"></i></button>
                                    
                           <!-- <button class="btn btn-primary mr-2" type="button">Submit</button>-->
                             <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air"><i class="fa fa-remove" title="Cancel"></i></button>
						</center>
                        </div>
								
								</form>
								</div>
                        
                </div>
				</div>
				
	  <!--when client type="client" ends-->
    
  </div>
			
    @include('resellerivr.layouts.footer')
			
			<script>
				
                $(function() {
					
                    $('.form-new-user-submit').click(function(e) {
                        e.preventDefault;
                        $('#newuser-icon').removeClass('fa-paper-plane');
                        $('#newuser-icon').addClass('fa-spinner fa-spin');
                        var data = $('.form_new_user').serialize();
                        console.log(data);
                        
                        
                        $.ajax({
                            url: '/new-user',
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
                                           
                        }).always(function(){
                                  $('#newuser-icon').removeClass('fa-spinner fa-spin');
                                    $('#newuser-icon').addClass('fa-paper-plane');
                                  });
                        return false;
                    });
                });

            </script>
			
			 <script>
                                                                $('.for-client').show();
                                                                $('.for-reseller').css('display', 'none');         
                                                               
                                               
                                    
                                                function getFormAccordingly(value) {
                                                    if(value=='client'){
                                                                $('.for-client').show();
                                                                $('.for-reseller').css('display', 'none');
                                                    }
                                                         else if(value=='reseller'){
                                                                $('.for-client').css('display', 'none');
                                                                $('.for-reseller').show();
                                                         }
                                                        else if(value=='seller'){
                                                                $('.for-client').css('display', 'none');
                                                                $('.for-reseller').show();
                                                               
                                                        }
                                                        
                                                    }
                                               
                                   
               
            </script>
            <script>
                    function loadPlans(){
                $.ajax({
                                    type:'post',
                                    url:'/getPlans',
                                    headers: {
                                                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                                    },
                                    success:function(response){
                                        $.each(response,function(index,element){
                                            $("select[name=select_plan]").append(`
                                         
                                                <option value="${element.id}">${element.title}</option>
                                                
                                         
                                            `);
                                        });
                                    }
            
                                });
                            }
                            loadPlans();

                            $("select[name=industry]").select2();
                            $("select[name=city]").select2();
                </script>
			
			
</body>


</html>