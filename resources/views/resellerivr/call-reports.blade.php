<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width initial-scale=1.0">


    <title>Reseller IVR | In Call Reports</title>
    <style>
	table {
    counter-reset: tableCount;     
    }
	.counter::before {              
    content: counter(tableCount); 
    counter-increment: tableCount; 
    }
	</style>

    @include('resellerivr.layouts.header')
    <!-- START SIDEBAR-->
    @include('resellerivr.layouts.side-header')
    <!-- END SIDEBAR-->
    <!-- END SIDEBAR-->
    <div class="wrapper content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <!-- START PAGE CONTENT-->
            <div class="page-heading" style="display:inline-block">
                <h1 class="page-title" style="display:inline-block;">In Call Reports</h1>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.blade.php"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">In Call Reports</li>
                </ol>

            </div><br>

            <div class="row">


                <div class="col-xl-12">
                    <div class="ibox">
                        <div class="ibox-body">
                           
                           <!-- form-search   -->
                           
                            <form method="post" class="form-generate-report" action="/resellerivr/generate_report">
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
                            
                            <!--form search report ends -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="ibox">
                <div class="ibox-body">
                   
                    <div class="table-responsive">
                        <table class="table table-head-purple mb-5">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Caller No</th>
                                    <th>Source No</th>
                                    <th>Agent No.</th>
                                    <th>Start Time</th>
                                    {{-- <th>Answer Time</th> --}}
                                    <th>End Time</th>
                                    <th>Duration (sec)</th>
                                    {{-- <th>Conversation<br>Duration</th> --}}
                                    <th>Caller Circle</th>
                                    <th>Caller Operator</th>
                                    <th>Recording</th>
                                    <th>Action</th>
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
                               {{-- <td>{{$report->answer_time}}</td> --}}
                               <td>{{$report->end_time}}</td>
                               <td>{{$report->duration}}</td>
                                {{-- <td>{{$report->conv_duration}}</td> --}}
                                <td>{{$report->circle}}</td>
                                <td>{{$report->operator}}</td>
                               <td><audio src='/call_recordings/{{$report->conv_recordings}}' controls></audio></td>
                               {{-- <td>Add to contact</td> --}}
                               </tr>
                               @endforeach
                              
                            </tbody>
                           
                            
                            
                        </table>
                       {{$reports->links()}}
                       @endisset 
                    </div>

                </div>
            </div>


           
            @include('resellerivr.layouts.footer')
            
            
            
            
            <script>

                    $(document).ready(function() {
                        $('select[name=user_id]').select2();
                    });

                    $( function() {
                        $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    } );

            $.ajax({
                    type:'post',
                    url:'/reseller/listUsers',
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

</body>
</html>
