@extends('layouts.app')

@section('title')
Inbound Call Logs
@endsection

            @section('menu')
            Inbound Call Logs  |<sub>@isset($count_results)

             Total Results : {{$count_results}}@endisset</sub>
             @endsection


@section('content')

                            <form method="get" class="form-generate-report" action="/generateReport">
                               @csrf
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>Source No:</label>
                                            <select class="form-control source_number" name="source_number" style="height:34px;">
                                            <option value="">All</option>

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
                                            <option value="MISSCALL">Missed Call</option>
										  </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-3 col-xs-12">
                                        <div class="form-group mb-4">
                                            <label>Duration > : (in secs)</label>
                                            <input type="text" class="form-control" name="duration" placeholder="Duration in seconds" value="0">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-xs-12">
                                            <div class="form-group mb-4">
                                                <label>Agent Number:</label>
                                                <input type="text" class="form-control" name="agent_number" maxlength="10" placeholder="10 digit mobile number">
                                            </div>
                                        </div>

                                    <div class="col-md-3 col-xs-12">
                                        <div class="form-group mb-4">
                                            <label>Caller Number:</label>
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
                                        <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air report-search" type="submit" name="search" value="search"><i class="fa fa-search" title="Search"></i></button>

                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div style="float:right;">
                                            <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air download-data" type="submit" name="download" value="download"><i class="fa fa-download"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </form>

                            <section class="panel panel-featured panel-featured-primary">
                                <header class="panel-heading">
                                    <div class="panel-actions">
                                        <a href="#" class="fa fa-caret-down"></a>
                                        <a href="#" class="fa fa-times"></a>
                                    </div>

                                    <h2 class="panel-title">Call Details</h2>
                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped table-responsive mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                        <thead>
                                                <tr>
                                                        <th>Sr.</th>
                                                        <th>Caller No</th>
                                                        <th>Source No</th>
                                                        <th>Agent No.</th>
                                                        <th>Start Time</th>
                                                        @if(Auth::user()->permission->can_see_call_answer_time==1)
                                                        <th>Answer Time</th>
                                                        @endif
                                                        <th>End Time</th>
                                                        <th>Duration (sec)</th>
                                                        @if(Auth::user()->permission->can_see_conv_duration==1)
                                                        <th>Conversation<br>Duration</th>
                                                        @endif
                                                        <th>Call Status</th>
                                                        @if(Auth::user()->permission->can_see_caller_circle==1)
                                                        <th>Caller Circle</th>
                                                        @endif
                                                        @if(Auth::user()->permission->can_see_caller_operator==1)
                                                        <th>Caller Operator</th>
                                                        @endif
                                                        @if(Auth::user()->permission->can_listen_recording==1)
                                                        <th>Recording</th>
                                                        @endif
                                                        <th>Remarks</th>
                                                        <th>Priority</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class='reports_body'>

                                                        @foreach ($reports as $report)
                                                      <tr>
                                                       <td>{{$report->id}}</td>
                                                       @if(Auth::user()->permission->can_see_caller_mobile==1)
                                                       <td>{{$report->caller_number}}</td>
                                                       @else
                                                        <td>{{substr($report->caller_number, 0, -4) . 'xxxx'}}</td>
                                                       @endif
                                                       <td>{{$report->source_number}}</td>
                                                      <td>{{$report->agent_number}} <br>
                                                        @isset($report->agent->agent_name)
                                                        {{$report->agent->agent_name}}
                                                        @endisset
                                                        </td>
                                                       <td>{{$report->start_time}}</td>
                                                       @if(Auth::user()->permission->can_see_call_answer_time==1)
                                                       <td>{{$report->answer_time}}</td>
                                                       @endif
                                                       <td>{{$report->end_time}}</td>
                                                       <td>{{$report->duration}}</td>
                                                       @if(Auth::user()->permission->can_see_conv_duration==1)
                                                        <td>{{$report->conv_duration}}</td>
                                                        @endif
                                                        <td>{{$report->call_status}}</td>
                                                        @if(Auth::user()->permission->can_see_caller_circle==1)
                                                        <td>{{$report->circle}}</td>
                                                        @endif
                                                        @if(Auth::user()->permission->can_see_caller_operator==1)
                                                        <td>{{$report->operator}}</td>
                                                        @endif

                                                        @if(Auth::user()->permission->can_listen_recording==1)
                                                        <td>
                                                            <audio src="/call_recordings/{{$report->conv_recordings}}" id="{{$report->conv_recordings}}"></audio>
                                                            <i class="fa fa-play play" data-src="{{$report->conv_recordings}}"></i>
                                                            <i class="fa fa-download download" data-src="/call_recordings/{{$report->conv_recordings}}"></i>

                                                        </td>
                                                        @endif

                                                        <td>{{$report->add_remark}}</td>
                                                        <td>{{$report->priority}}</td>
                                                         <td>
                                                         <button class='btn btn-default c2c_btn_report' title="Click To Call" data-agent_destination="{{$report->agent_number}}" data-caller_number="{{$report->caller_number}}"><i class='fa fa-phone'></i></button>
                                                            <button class="btn btn-default showmodal" title="Save/Blacklist Caller in phonebook" data-target="#phonebookModal{{$report->id}}"><i class="fa fa-save"></i></button>
                                                            <button class="btn btn-default showmodal" title="Set Priority" data-target="#priorityModal{{$report->id}}"><i class="fa fa-star"></i></button>
                                                        </td>

                                                    </tr>

                                                       @endforeach

                                                    </tbody>
                                                 </table>
                        <?php
                        if(isset($_GET['source_number'])){
                            $source_number=$_GET['source_number'];
                        }
                        else
                        $source_number='';
                        if(isset($_GET['from_date'])){
                            $from_date=$_GET['from_date'];
                        }
                        else
                        $from_date='';
                        if(isset($_GET['to_date'])){
                            $to_date=$_GET['to_date'];
                        }
                        else
                        $to_date='';
                        if(isset($_GET['status'])){
                            $status=$_GET['status'];
                        }
                        else
                        $status='';
                        if(isset($_GET['duration'])){
                            $duration=$_GET['duration'];
                        }
                        else
                        $duration='';
                        if(isset($_GET['mobile'])){
                            $mobile=$_GET['mobile'];
                        }
                        else
                        $mobile='';
                        if(isset($_GET['no_of_records'])){
                            $no_of_records=$_GET['no_of_records'];
                        }
                        else
                        $no_of_records='';

                        ?>
                       {{$reports->appends([
                           'source_number'=>$source_number,
                           'from_date'=>$from_date,
                           'to_date'=>$to_date,
                           'status'=>$status,
                           'duration'=>$duration,
                           'mobile'=>$mobile,
                           'no_of_records'=>$no_of_records
                       ])->links()}}

                                </div>

                       @foreach ($reports as $report)


                               <!-- Modal -->
                               <div class="modal fade" id="phonebookModal{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="phonebookModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background:#140F6D;color:white !important">
                                        <h5 class="modal-title">Save Caller or blacklist caller</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    <form class="form phonebbok_form" id="phonebook_form{{$report->id}}">
                                        <div class="modal-body">

                                                @csrf
                                                <input type="hidden" name="report_id" value="{{$report->id}}">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="text" class="form-control" name="caller_number" placeholder="Caller Mobile (optional)" value="{{$report->caller_number}}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="caller_name" placeholder="Caller Name (optional)">
                                            </div>

                                        </div>
                                        <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <input type="text" class="form-control" name="caller_email" placeholder="Caller Email (optional)">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <input type="text" class="form-control" name="caller_address" placeholder="Caller Address (optional)">
                                                </div>
                                        </div>
                                        <div class="row">
                                                {{-- <div class="col-md-12 mt-2">
                                                    <input type="text" class="form-control" name="remarks" placeholder="Remarks (optional)">
                                                </div> --}}

                                        </div>
                                        <div class="row">
                                                <div class="col-md-4 mt-4" style="margin: 0 auto; text-align:center">
                                                    Blacklist Caller : <input type="checkbox" class="form-control" name="caller_blacklist">
                                                </div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-default save-caller" type="submit" data-id="#phonebook_form{{$report->id}}">Save</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                               <div class="modal fade" id="priorityModal{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="phonebookModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background:#140F6D;color:white !important">
                                        <h5 class="modal-title">Set Priority</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    <form class="form phonebbok_form" id="priority_form{{$report->id}}">
                                        <div class="modal-body">

                                                @csrf
                                                <input type="hidden" name="report_id" value="{{$report->id}}">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="text" class="form-control" placeholder="Caller Mobile (optional)" @if(Auth::user()->permission->can_see_caller_mobile==1) value="{{$report->caller_number}}" @else value="{{substr($report->caller_number, 0, -4) . 'xxxx'}}" @endif disabled>
                                            </div>
                                            <div class="col-md-6">
                                                    <select class="form-control" name="priority">
                                                    <option selected disabled>Select Priority</option>
                                                    <option>Normal</option>
                                                    <option>Premium</option>
                                                    <option>Interested</option>
                                                    <option>Not Interested</option>
                                                    </select>

                                        </div>

                                        </div>
                                        <div class="row">
                                                <div class="col-md-12 mt-2">
                                                    <textarea class="form-control" name="remarks" placeholder="Remarks (optional)"></textarea>
                                                </div>

                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-default save-caller" type="submit" data-id="#priority_form{{$report->id}}">Save</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                       @endforeach

            <script>
                $( function() {
                        $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    } );
                    $(".save-caller").on('click',function(e){
                        e.preventDefault();
                        var formid=$(this).attr('data-id');
                        var data=$(formid).serialize();
                        $.ajax({
                            'url':'/saveCaller',
                            'type':'post',
                            'data':data,
                            headers: {
                                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                },
                            'success':function(result){
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
                    </script>

            <script>
            $(".showmodal").on('click',function(e){
                e.preventDefault();
                var modal= $(this).attr('data-target');
                $(modal).modal('show');
            });

            </script>


            <script>

                    $.ajax({
                        type:'post',
                        url:'/getClientSourceNumberDetail',
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
            </script>

            <script>


            $(".reports_body").on('click','.play',function(){
                var src=$(this).attr("data-src");
                var x = document.getElementById(src);
                x.play();
                $(this).removeClass("fa-play").addClass("fa-pause");
                $(this).removeClass("play").addClass("pause");
            });
            $(".reports_body").on('click','.pause',function(){
                var src=$(this).attr("data-src");
                var x = document.getElementById(src);
                x.pause();
                $(this).removeClass("fa-pause").addClass("fa-play");
                $(this).removeClass("pause").addClass("play");
            });
            $(".reports_body").on('click','.download',function(){
                var src=$(this).attr("data-src");
                window.location.href=src;
            })
            </script>

            <script>

            $(".c2c_btn_report").on("click",function(){
                var agent_destination=$(this).attr("data-agent_destination");
                var caller_number=$(this).attr("data-caller_number");
                // if($("html").hasClass("sidebar-right-opened")){
                //     $("html").removeClass("sidebar-right-opened");
                // }

                    $("#c2c_mobile").val(caller_number);
                    $("select[name=c2c_agent]").val(agent_destination);
                    clickToCallUi();
                   $("html").addClass("sidebar-right-opened");

            });
            </script>
@endsection
