@extends('admin_layouts.app')
                           

@section('title')
    Call Logs
@endsection

@section('menu')
    Call Logs
@endsection

@section('content')
    

                            <form method="post" class="form-generate-report" action="/admin/generate_report">
                               @csrf
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>User ID:</label>
                                            <select class="form-control user_id" name="user_id" style="height:34px;">
                                            <option value="">All</option>
             <!--user id here -->
										  </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-xs-12">
                                        <div class="form-group mb-4">
                                            <label>From:</label>
                                            <input type="text" class="form-control datepicker ui-widget-content" name="from_date">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-xs-12">
                                        <div class="form-group mb-4">
                                            <label>To:</label>
                                            <input type="text" class="form-control datepicker ui-widget-content" name="to_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>Status:</label>
                                            <select class="form-control" name="status" style="height:34px;">
											<option value="">All</option>
											<option value="ANSWER">Answered</option>
                                            <option value="NOANSWER">Not Answered</option>
                                            <option value="Network Congestion">Network Congestion</option>
                                            <option value="CANCEL">Cancelled</option>
										  </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                        <div class="col-md-3 col-sm-12">
                                                <div class="form-group mb-4">
                                                    <label>Source Number:</label>
                                                    <select class="form-control source_number" name="source_number" style="height:34px;">
                                                    <option value="">All</option>
                     <!--source number here -->
                                                  </select>
                                                </div>
                                            </div>

                                    <div class="col-md-3 col-xs-12">
                                        <div class="form-group mb-4">
                                            <label>Duration > : (in secs)</label>
                                            <input type="text" class="form-control" name="duration" placeholder="Duration in seconds" value="0">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-xs-12">
                                        <div class="form-group mb-4">
                                            <label>Mobile:</label>
                                            <input type="text" class="form-control" name="mobile" maxlength="10" placeholder="10 digit mobile number">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>Records:</label>
                                            <select class="form-control" name="no_of_records" style="height:34px;">
                                            <option selected disabled>All</option>
											<option value="10">10</option>
											<option value="15">15</option>
											<option value="20">20</option>
											<option value="25">25</option>
											<option value="50">50</option>
											<option value="100">100</option>
										  </select>
                                        </div>
                                    </div>

                                </div>

                                <!-------   add filter industry wise price wise  -->
                                <div class="row">

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
                                                                <option selected disabled>All</option>
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
                                    <div class="col-md-2">
                                        <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air report-search" type="submit" name="search" value="search"><i class="fa fa-search" title="Search"></i></button>

                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div style="float:right;">
                                            <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air download-data" type="submit" name="download" value="download"><i class="fa fa-download"></i></button> 
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </form>
                      
                            <section class="panel panel-primary">
                                <header class="panel-heading">
                                    <div class="panel-actions">
                                        <a href="#" class="fa fa-caret-down"></a>
                                        <a href="#" class="fa fa-times"></a>
                                    </div>
                            
                                    <h2 class="panel-title">Call Details</h2>
                                    <p class="panel-subtitle"></p>
                                </header>
                                <div class="panel-body">           
                   
                        <table class="table table-head-purple mb-5">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Caller No</th>
                                    <th>Source No</th>
                                    <th>Agent No.</th>
                                    <th>Start Time</th>
                                    <th>Answer Time</th>
                                    <th>End Time</th>
                                    <th>Duration (sec)</th>
                                    <th>Conversation<br>Duration</th>
                                    <th>Caller Circle</th>
                                    <th>Caller Operator</th>
                                    <th>Recording</th>
                                    <th>Remark</th>
                                    <th>Priority</th>
                                </tr>
                            </thead>
                            @isset($reports)
                            <tbody class='reports_body'>
                               
                                   
                               
                                @foreach ($reports as $report)
                                <tr>
                               <td>{{$report->id}}</td>
                               <td>{{$report->caller_number}}</td>
                               <td>{{$report->source_number}}</td>
                               <td>{{$report->agent_number}}</td>
                               <td>{{$report->start_time}}</td>
                               <td>{{$report->answer_time}}</td>
                               <td>{{$report->end_time}}</td>
                               <td>{{$report->duration}}</td>
                                <td>{{$report->conv_duration}}</td>
                                <td>{{$report->circle}}</td>
                                <td>{{$report->operator}}</td>
                               <td><audio src='/call_recordings/{{$report->conv_recordings}}' controls></audio></td>
                                <td>{{$report->add_remark}}</td>
                                <td>{{$report->priority}}</td>
                               </tr>
                               @endforeach
                              
                            </tbody>
                           
                            
                            
                        </table>
                       {{$reports->links()}}
                       @endisset 
                                </div>
                            </section>            

@endsection

@section('scripts')
    

            <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
            

            
            <script>
                    $(document).ready(function() {
                        $('select[name=user_id]').select2();
                        $('select[name=city]').select2();
                        $('select[name=industry]').select2();
                        $('select[name=product]').select2();
                    });

                    $( function() {
                        $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    } );
    
                $.ajax({
                        type:'post',
                        url:'/admin/listUsers',
                        headers: {
                                             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                            },
                        success:function(response){
                            
                            $.each(response,function(index,element){
                            $('select[name=user_id]').append(`
                            <option value='${element.id}'>${element.username}</option>`);
                           
                            
                            
                            });
                           
                            
                        }
                    });
                
                </script>
    
                <script>
                $("select[name=user_id]").on('change',function(){
    
                var user_id=$(this).val();
                        $.ajax({
                            type:'post',
                            url:'/getSourceNumberDetails/'+user_id,
                            headers: {
                                             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                    },
                            success:function(response){
                                $.each(response,function(index,element){
                                    if(element.source_number!==undefined){
                                $(".source_number").append(`
                                <option value='${element.source_number}'>${element.source_number}</option>
                                `);
                                
                                }      
                                    
                                    else{
                                        $('.source_number').append("<option readonly selected>No Source Numbers found</option>");
                                    }
                      
                                }); 
                            }   
                        });
    
                    });
                        
                
                </script>    
@endsection
