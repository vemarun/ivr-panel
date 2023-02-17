@extends('layouts.app')

@section('title')
    Call Settings
@endsection

@section('menu')
    Call Settings
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
            <section class="panel panel-primary">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                            <a href="#" class="fa fa-times"></a>
                        </div>

                        <h2 class="panel-title">IVR Setting</h2>
                    </header>
                    <div class="panel-body">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <form class="form form-recording-sequence form-inline">
                            <div class="form-group col-md-8">
                                <label>Change Template:</label>
                                <select class="form-control mb-md" name="template">
                                    <option disabled selected>Change Template</option>
                                </select>
                            </div>
                            <button class="btn btn-default disabled btn-template-validate">Save</button>
                        </form>
                            <table class="table clips text-center">
                                <thead>
                                    <tr>
                                        <th id='current_template' colspan='3' style="background-color:#EEEEEE">Template : </th>
                                    </tr>
                                    <tr>
                                        <th>Clip</th>
                                        <th>sequence</th>
                                        <th>Upload/Reupload</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                    </div>
                    <div class="col-md-3"></div>
                    </div>
            </section>
    </div>
</div>

<div class="tts-modal">


</div>


<div class="upload-modals"></div>

<div class="row">
    <div class="col-md-6">
            <input type="hidden" name="can_change_dialing_strategy" value="{{Auth::user()->permission->can_change_dialing_strategy}}">
            <section class="panel panel-featured panel-featured-primary">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                            <a href="#" class="fa fa-times"></a>
                        </div>

                        <h2 class="panel-title">Source Number Setting</h2>
                    </header>
                    <div class="panel-body source_body">

                    </div>
            </section>
            <center>
                <img src="../images/loader.gif" id="loader">
            </center>
                <div class="source_modals"></div>
    </div>
    <div class="col-md-6">
        <section class="panel panel-featured panel-featured-primary">
                                            <header class="panel-heading">
                                                <div class="panel-actions">
                                                    <a href="#" class="fa fa-caret-down"></a>
                                                    <a href="#" class="fa fa-times"></a>
                                                </div>

                                                <h2 class="panel-title">Send recording text to url</h2>
                                            </header>
                                            <div class="panel-body text-center">
                                                <div class="row">
                                                    <p>Call recording will be converted to text using artifical intelligence and will be sent to your url.</p>
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                    <form class="form recording_text_form">
                                                        <select class="form-control" name="recording_text_url_method">
                                                            <option selected disabled>Select request type</option>
                                                            <option>GET</option>
                                                            <option>POST</option>
                                                        </select><br><br>
                                                        <input class="form-control" type="text" placeholder="http://" value="" name="recording_text_url"><br>
                                                        <button class="btn btn-info mt-2 recording_text_form_save">Save</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
        </section>


    </div>
</div>

<div class="row">
    <div class="col-md-6">
            <section class="panel panel-primary">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                            <a href="#" class="fa fa-times"></a>
                        </div>

                        <h2 class="panel-title">SMS Configuration</h2>
                    </header>
                    <div class="panel-body text-center">
        <form method="post" class="form-configure-sms">

            @csrf
            <input value="" type="hidden" name="source_number">
             <div class="row">
                 <div class="col-md-6">
                     <div class="check-list ">
                         <label class="checkbox checkbox-grey checkbox-primary " style="display:inline-block;">
                                         <input type="checkbox" name="sms_to_owner_check">
                                         <span class="input-span"></span>SMS To Owner</label>
                     </div>
                     <div class="form-group">
                         <textarea maxlength="160" class="form-control" rows="5" id="comment" name="sms_to_owner"></textarea>
                     </div>

                 </div>
                 <div class="col-md-6">

                     <div class="check-list ">
                         <label class="checkbox checkbox-grey checkbox-primary " style="display:inline-block;">
                                         <input type="checkbox" name="sms_to_owner_missed_check">
                                         <span class="input-span" ></span>SMS To Owner When IVR Call Missed</label>
                     </div>
                     <div class="form-group">
                         <textarea maxlength="160" class="form-control" rows="5" id="comment" name="sms_to_owner_missed"></textarea>
                     </div>


                 </div>
             </div>

             <div class="row">
                 <div class="col-md-6">
                     <div class="check-list ">
                         <label class="checkbox checkbox-grey checkbox-primary " style="display:inline-block;">
                                         <input type="checkbox" name="sms_to_caller_check">
                                         <span class="input-span"></span>SMS To Caller</label>
                     </div>
                     <div class="form-group">
                         <textarea maxlength="160" class="form-control" rows="5" id="comment" name="sms_to_caller"></textarea>
                     </div>

                 </div>
                 <div class="col-md-6">

                     <div class="check-list ">
                         <label class="checkbox checkbox-grey checkbox-primary " style="display:inline-block;">
                                         <input type="checkbox" name="sms_to_caller_missed_check">
                                         <span class="input-span"></span>SMS To Caller When IVR Call Missed</label>
                     </div>
                     <div class="form-group">
                         <textarea maxlength="160" class="form-control" rows="5" id="comment" name="sms_to_caller_missed"></textarea>
                     </div>


                 </div>
             </div>

             <div class="row">
                 <div class="col-md-6">
                     <div class="check-list ">
                         <label class="checkbox checkbox-grey checkbox-primary " style="display:inline-block;">
                                         <input type="checkbox" name="sms_to_agent_check">
                                         <span class="input-span"></span>SMS To Agent</label>
                     </div>
                     <div class="form-group">
                         <textarea maxlength="160" class="form-control" rows="5" id="comment" name="sms_to_agent"></textarea>
                     </div>

                 </div>
                 <div class="col-md-6">
                     <div class="form-group" style="padding-top: 18px;">
                         <label for="sender_id">SMS Sender ID</label>
                         <input type="text" name="sender_id" class="form-control" value="">
                     </div>


                 </div>
             </div>
             <div class="row">
                 <div class="col-md-5"></div>
                 <div class="col-md-2">
                     <center><button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air" id="form-configure-sms-submit" type="submit"><i class="fa fa-save" title="Sent SMS Settings"></i></button></center>

                 </div>
                 <div class="col-md-5"></div>
             </div>


         </form>

         <div style="padding-left:20px;">

             <h4>Note: You can use following variables to send thier info in SMS.<br></h4>
             <p>#AGENTNAME# for Agent Name<br> #AGENTNUMBER# for Agent Number<br> #TIME# for Call Date Time<br> #CALLER# for Caller Number <br>#OTP# for One Time Password</p>

         </div>
        </div>
    </section>
</div>


<div class="col-md-6">
    <section class="panel panel-featured panel-featured-primary">
                                            <header class="panel-heading">
                                                <div class="panel-actions">
                                                    <a href="#" class="fa fa-caret-down"></a>
                                                    <a href="#" class="fa fa-times"></a>
                                                </div>

                                                <h2 class="panel-title">Set Recording keyword to track</h2>
                                            </header>
                                            <div class="panel-body text-center">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-8">
                                                  <p>Use comma separated values</p>
                                                  <form class="form recording_keywords_form">
                                                  <input id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" name="keywords" class="form-control" value="Good Support,overpriced" />
                                                  <button class="btn btn-info recording_keyword_save">Save</button>
                                                  </form>
                                                </div>
                                            </div>
                                    </section>

        <section class="panel panel-featured panel-featured-primary">
                                            <header class="panel-heading">
                                                <div class="panel-actions">
                                                    <a href="#" class="fa fa-caret-down"></a>
                                                    <a href="#" class="fa fa-times"></a>
                                                </div>

                                                <h2 class="panel-title">Call Summary Report Delivery</h2>
                                            </header>
                                            <div class="panel-body text-center">
                                                <div class="row">
                                                        <h4 class="title">Email me summary report:</h4>
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4">
                                                        <select class="form-control">
                                                        <option selected disabled>Select</option>
                                                        <option>Daily</option>
                                                        <option>Weekly</option>
                                                        <option>Monthly</option>
                                                        </select>
                                                        </div>


                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <h4 class="title">Low Credit Alert</h4>
                                                        <div class="switch switch-sm switch-primary">
                                                                Via SMS
                                                                <input type="checkbox" name="sms_credit_alert" data-plugin-ios-switch checked="checked" />
                                                            </div>
                                                            <div class="switch switch-sm switch-success">
                                                                Via Email<input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                                                            </div>
                                                </div>
                                            </div>
                                    </section>



        <section class="panel">
                <header class="panel-heading bg-primary">
                    <div class="panel-heading-icon">
                        <i class="fa fa-key"></i>
                    </div>
                </header>
                <div class="panel-body text-center">
                    <h3 class="text-semibold mt-sm text-center">API Key | <a href="#">API Docs</a></h3>
                    <h6>Your requested API Key will be displayed here</h6>
                <p class="text-center api_token" style="background-color:grey;color:grey !important">{{Auth::user()->api_token}}</p>
                </div>
            </section>

</div>
</div>

@endsection
  <!--Ajax Post and capture api response-->


@section('scripts')


<script>
Dropzone.autoDiscover = false;
$(document).ready(function() {
        $('.source_body').on('click','a#edit',function(){
            let modalid=$(this).attr('data-target');
            $(modalid).modal();
        });
    });
</script>
            <script>
                //refresh div on ajax complete
				function refreshDiv(div){

                        $(div).load(location.href+ " "+div+">*","");
                        }


                    var csrf_token=$('meta[name="_token"]').attr('content');


                    //enable/disable checkbox caller,agent, owner value    *Most important
                    $('.source_body').on('click','form input[type=checkbox]',function(){
                        var a=$(this).is(":checked");

                        if(a==true){

                            $(this).val('1');
                            }
                        else{

                            $(this).val('0');
                        }
                        var source_number=$(this.form).find('input[name=source_number]').val();

                        var checkboxname=$(this).attr('name');
                        var checkboxvalue=$(this).val();
                        var data='source_number='+source_number+'&'+checkboxname+'='+checkboxvalue;

                        $.ajax({
                                type:'post',
                                url:'/smsEnable',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                                data:data,
                                success:function(result) {

                                    spop({
                                        template: result.message,
                                        autoclose: 5000,
                                        style: 'success'
                                    });


                            },
                            error: function(xhr, status, error) {

                                var err=$.parseJSON(xhr.responseText);
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

                    });

                    //checkbox enable ajax ends


                    //ajax call function on page load
                    function loadpage(){

                    if($("input[name=can_change_dialing_strategy]").val()==1){
                        var can_change_dialing_strategy="";
                    }
                    else{
                        var can_change_dialing_strategy="disabled";
                    }
                    $.ajax({
                        type:'post',
                        url:'/getClientSourceNumberDetail',
                        headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                        success:function(response){
                            $.each(response,function(index,element){
                                if(element.source_number!==undefined){


                            $('.source_body').append(`
                             <form id='form${element.source_number}' method='post'>
                             <input type='hidden' name='_token' value='${csrf_token}'>
                             <div class='row'> <div class='col-md-5 ml-5'>
                             <div class='form-group mb-4'>
                             <label>Source Number:</label>
                             <input class='form-control' type='text' name='source_number' id='source_number' value=${element.source_number} readonly>
                             </div> </div>

                             <div class='col-md-5 ml-5'>
                             <div class='form-group mb-4'>
                             <label>Dialing Strategy: <span style='color:#140F6D'>${element.dialing_strategy}</span></label>
                            <select class='form-control' name='dialing_strategy' id='dialing-strategy' style='height:34px;' ${can_change_dialing_strategy}>
                            <option value='' selected disabled>Change Strategy</option>
                            <option value='parallel'>Parallel</option>
                            <option value='sequence'>Sequence</option>
                            <option value='round_robin'>Round Robin</option> </select>
                            </div> </div>
                            <div class='col-md-5'> <div class='form-group mb-4'>
                            <label>Enabled: <span style='color:#140F6D'>${element.enabled}</span></label>
                            <select class='form-control account_status' name='account_status' style='height:34px;'>
                            <option value='' disabled selected>Enable/Disable</option>
                            <option value='1'>True (1)</option><option value='0'>False (0)</option>
                            </select> </div> </div>
                            <div class='col-md-5 ml-5'> <div class='form-group mb-4'>
                            <label>Ring Time out: <span style='color:#140F6D'>${element.ring_time_out}</span></label>
                            <select class='form-control' name='ring_time_out' id='ring_time_out' style='height:34px;'>
                            <option value='' selected disabled>Change Ring Timeout</option>
                            <option value='20'>20</option>
                            <option value='25'>25</option>
                            <option value='30'>30</option>
                            </select>
                            </div>
                            </div>

                            </div>



                            <div class='row'> <div class='col-md-offset-4 col-md-4 col-md-offset-4'>
                            <center> </br>
                            <button class='btn btn-info btn-icon-only btn-circle btn-lg btn-air' type='submit' id='source-no-form-submit' data-target='#form${element.source_number}'>
                            <i class='fa fa-paper-plane' title='Save'></i></button>
                            <button class='btn btn-danger btn-icon-only btn-circle btn-lg btn-air' type='reset'><i class='fa fa-remove' title='Cancel'></i></button> </center>
                            </div> </div> </div>
                            </form>`);

                                }
                                else{
                                    $('.source_body').append("<tr><td>You do not have any source number registered. Contact our support to register new did.</td></tr>");
                                }

                            }); //.each close
                        }         //success function close
                    }).always(function(){
                        $('#loader').hide();
                    });
                    }

                   loadpage();

                   $('.source_body').on('click','button#source-no-form-submit',function(e) {
                       e.preventDefault();
                       let formid=$(this).attr('data-target');
                        var data=$(formid).serialize();

                         $.ajax({
                            url: '/forward-source-number',
                            type: 'post',

							headers: {
                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                            data: data,

                            success: function(result) {

                                    spop({
                                        template: result.message,
                                        autoclose: 5000,
                                        style: 'success'
                                    });


                            },
                             //////////////////////// reload div after ajax success
                             complete:function(){
                                 $('.modal').modal('hide');
                             },
                             ////////////////////////////////////

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



            </script>
            <script>

                    $(function() {

                        var data="source_number="+{{session('source_number')}};
                        //retrieve data from api
                        $.ajax({
                            url: '/getSourceNumberSmsTemplate',
                                method: 'post',

                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                            },
                                data:data,
                                success:function(response){

                                    if(response[0]==undefined){
                                        $('.form-configure-sms').html('<center><h3>Invalid Source Number</h3></center>');
                                        $('#loader').hide();
                                    }
                                    $('textarea[name=sms_to_owner]').val(response[0].sms_to_owner);
                                    if(response[0].sms_to_owner_enabled==1){
                                        $('input[name=sms_to_owner_check]').attr('checked','true');
                                    }
                                    $('input[name=sms_to_owner_check]').val(response[0].sms_to_owner_enabled);
                                    $('textarea[name=sms_to_owner_missed]').val(response[0].sms_to_owner_missed);
                                    if(response[0].sms_to_owner_missed_enabled==1){
                                        $('input[name=sms_to_owner_missed_check]').attr('checked','true');
                                    }
                                    $('input[name=sms_to_owner_missed_check]').val(response[0].sms_to_owner_missed_enabled);
                                    $('textarea[name=sms_to_caller]').val(response[0].sms_to_caller);
                                    if(response[0].sms_to_caller_enabled==1){
                                        $('input[name=sms_to_caller_check]').attr('checked','true');
                                    }
                                    $('input[name=sms_to_caller_check]').val(response[0].sms_to_caller_enabled);
                                    $('textarea[name=sms_to_caller_missed]').val(response[0].sms_to_caller_missed);
                                    if(response[0].sms_to_caller_missed_enabled==1){
                                        $('input[name=sms_to_caller_missed_check]').attr('checked','true');
                                    }

                                    $('input[name=sms_to_caller_missed_check]').val(response[0].sms_to_caller_missed_enabled);
                                    $('textarea[name=sms_to_agent]').val(response[0].sms_to_agent);
                                    if(response[0].sms_to_agent_enabled==1){
                                        $('input[name=sms_to_agent_check]').attr('checked','true');
                                    }
                                    $('input[name=sms_to_agent_check]').val(response[0].sms_to_agent_enabled);
                                    $('input[name=sender_id]').val(response[0].sms_sender_id);

                                },
                                complete:function(){
                                    $('#loader').hide();
                                }
                        });

                        $('input[type=checkbox]').click(function(){
                            var a=$(this).is(":checked");

                            if(a==true){

                                $(this).val('1');
                                }
                            else{

                                $(this).val('0') ;
                            }

                        });


                        $('#form-configure-sms-submit').click(function(e) {


                            var data = $('.form-configure-sms').serialize();
                            var sms_to_owner_check=$('input[name=sms_to_owner_check]').val();
                            var sms_to_owner_missed_check=$('input[name=sms_to_owner_missed_check]').val();
                            var sms_to_caller_check=$('input[name=sms_to_caller_check]').val();
                            var sms_to_caller_missed_check=$('input[name=sms_to_caller_missed_check]').val();
                            var sms_to_agent_check=$('input[name=sms_to_agent_check]').val();

                            data+='&sms_to_owner_check='+sms_to_owner_check+'&sms_to_owner_missed_check='+sms_to_owner_missed_check+'&sms_to_caller_check='+sms_to_caller_check+'&sms_to_caller_missed_check='+sms_to_caller_missed_check+'&sms_to_agent_check='+sms_to_agent_check;

                            $.ajax({
                                url: '/configure-sms',
                                method: 'post',

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

                <script>
                        $(".api_token").click(function(){
                            $(this).css('background-color','white');
                        });
                </script>

                    <script>
                        function getIvrTemplate(template=''){
                    $.ajax({
                            type: "post",
                            url: "/getIvrTemplate",
                            headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                            },
                            success: function (response) {

                                $(".upload-modals").html("");
                                $(".clips>tbody").html("");

                                if(!template)
                                {
                                    $.each(response,function(index,element){
                                        $("select[name=template]").append(`<option value='${element.id}'>${element.template_name}</option>`);

                                        if(element.status==1){
                                            if(element.no_of_recordings<=element.no_of_uploaded_recordings){
                                            $(".btn-template-validate").removeClass("disabled btn-default").addClass("btn-info");
                                        }
                                        else{
                                            $(".btn-template-validate").removeClass("btn-info").addClass("disabled btn-default");
                                        }
                                        $("#current_template").html(`Current Template : ${element.template_name}`);
                                                $.each(element.recordings,function(i,e){
                                                        $(".clips>tbody").append(`
                                                        <tr>
                                                        <td>`+(e.path?`<audio src='${e.path}' controls></audio>`:'Upload all required clips to enable save button')+`</td>
                                                        <td>${e.sequence}</td>
                                                        <td>
                                                        <a class="btn btn-sm modal-with-form upload-button" href="#modalForm${e.id}" data-template='${e.template_id}' data-sequence='${e.sequence}' title="Upload audio file"><i class='fa fa-upload'></i></a>
                                                        <a class="btn btn-sm modal-with-form upload-button" href="#tts-modal${e.id}" data-id="${e.id}" data-template='${e.template_id}' data-sequence='${e.sequence}' title="Text to Audio"><i class='fa fa-text-width'></i></a>
                                                        </tr>
                                                        `);

                                            $(".upload-modals").append(`
                                                <div id="modalForm${e.id}" class="modal-block modal-block-primary mfp-hide">
                                                        <section class="panel">
                                                            <header class="panel-heading">
                                                                <h2 class="panel-title upload-audio-title">Upload Audio</h2>
                                                            </header>
                                                            <div class="panel-body upload-audio-form">
                                                                    <form action="/upload_recording" class="dropzone dz-square" id="dropzone-example">@csrf
                                                                    <input type="hidden" name='id' value='${e.id}'>
                                                                    `+(e.path?`<input name='reupload' type='hidden'>`:'')+`
                                                                    <input type='hidden' name='template_id' value='${element.id}'>
                                                                    </form>
                                                            </div>
                                                            <footer class="panel-footer">
                                                                <div class="row">
                                                                    <div class="col-md-12 text-right">
                                                                        <button class="btn btn-default modal-dismiss">Close</button>
                                                                    </div>
                                                                </div>
                                                            </footer>
                                                        </section>
                                                </div>`);


                                        $(".tts-modal").append(`
                                        <div id="tts-modal${e.id}" class="modal-block modal-block-md mfp-hide">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Text to Audio</h2>
											</header>
											<div class="panel-body">
												<div class="modal-wrapper">
                                                <form id="form${e.id}">
                                                <input type='hidden' name='id' value='${e.id}'>
                                                <input type='hidden' name='template_id' value='${element.id}'>
													<div class="modal-text">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <select class="form-control" name="gender">
                                                                <option value="female">Female Voice</option>
                                                                <option value="female2">Female Voice 2</option>
                                                                <option value="male">Male Voice</option>
                                                            </select><br>
                                                            </div>
                                                            <div class="col-md-6 audio-result${e.id}">
                                                            </div>
                                                        </div>
														<textarea class="form-control" class="tts-text" name="text" placeholder="Enter text"></textarea>
                                                        </form>
                                                    </div>
												</div>
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-primary modal-confirm" id="${e.id}">Listen</button>
                                                        <button class="btn btn-info save-tts" id="${e.id}">Save</button>
														<button class="btn btn-default modal-dismiss">Close</button>
													</div>
												</div>
											</footer>
										</section>
									</div>
                                        `);
                                                    });

                                        }
                                    });
                                }
                                    else
                                    {
                                        $.each(response,function(index,element){
                                        if(element.id==template){
                                             if(element.no_of_recordings<=element.no_of_uploaded_recordings){
                                            $(".btn-template-validate").removeClass("disabled btn-default").addClass("btn-info");
                                        }
                                        else{
                                            $(".btn-template-validate").removeClass("btn-info").addClass("disabled btn-default");
                                        }
                                            $("#current_template").html(`Template : ${element.template_name}`);
                                            $.each(element.recordings,function(i,e){

                                                 $(".clips>tbody").append(`
                                                        <tr>
                                                        <td>`+(e.path?`<audio src='${e.path}' controls></audio>`:'Upload all required clips to enable save button')+`</td>
                                                        <td>${e.sequence}</td>
                                                        <td>
                                                        <a class="btn btn-sm modal-with-form upload-button" href="#modalForm${e.id}" data-template='${e.template_id}' data-sequence='${e.sequence}'><i class='fa fa-upload'></i></a>
                                                        <a class="btn btn-sm modal-with-form upload-button" href="#tts-modal${e.id}" data-id="${e.id}" data-template='${e.template_id}' data-sequence='${e.sequence}' title="text to audio"><i class='fa fa-text-width'></i></a>
                                                        </tr>
                                                        `);

                                       $(".upload-modals").append(`
                                        <div id="modalForm${e.id}" class="modal-block modal-block-primary mfp-hide">
                                                <section class="panel">
                                                    <header class="panel-heading">
                                                        <h2 class="panel-title upload-audio-title">Upload Audio</h2>
                                                    </header>
                                                    <div class="panel-body upload-audio-form">
                                                            <form action="/upload_recording" class="dropzone dz-square" id="dropzone-example">@csrf
                                                            <input type="hidden" name='id' value='${e.id}'>
                                                            <input type='hidden' name='template_id' value='${element.id}'>
                                                            </form>
                                                    </div>
                                                    <footer class="panel-footer">
                                                        <div class="row">
                                                            <div class="col-md-12 text-right">
                                                                <button class="btn btn-default modal-dismiss">Close</button>
                                                            </div>
                                                        </div>
                                                    </footer>
                                                </section>
                                        </div>`);

                                        $(".tts-modal").append(`
                                        <div id="tts-modal${e.id}" class="modal-block modal-block-md mfp-hide">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Text to Audio</h2>
											</header>
											<div class="panel-body">
												<div class="modal-wrapper">
                                                <form id="form${e.id}">
                                                <input type='hidden' name='id' value='${e.id}'>
                                                <input type='hidden' name='template_id' value='${element.id}'>
													<div class="modal-text">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <select class="form-control" name="gender">
                                                                <option value="female">Female Voice</option>
                                                                <option value="female2">Female Voice 2</option>
                                                                <option value="male">Male Voice</option>
                                                            </select><br>
                                                            </div>
                                                            <div class="col-md-6 audio-result${e.id}">
                                                            </div>
                                                        </div>
														<textarea class="form-control" class="tts-text" name="text" placeholder="Enter text"></textarea>
													</form>
                                                    </div>
												</div>
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-primary modal-confirm" id="${e.id}">Listen</button>
                                                        <button class="btn btn-info save-tts" id="${e.id}">Save</button>
														<button class="btn btn-default modal-dismiss">Close</button>
													</div>
												</div>
											</footer>
										</section>
									</div>
                                        `);

                                            });
                                        }
                                    });
                                }

                                $('.modal-with-form').magnificPopup({
                                                    type: 'inline',
                                                    preloader: false,
                                                    focus: '#name',
                                                    modal: true,
                                                    callbacks: {
                                                        beforeOpen: function() {
                                                            if($(window).width() < 700) {
                                                                this.st.focus = false;
                                                            } else {
                                                                this.st.focus = '#name';
                                                                    }
                                                                }
                                                            }
                                                });

                            Dropzone.discover();
                            }
                        });
                        }
                        getIvrTemplate();
                    </script>




        <script>
        $( function() {
          $( ".recordings" ).sortable({
                        cursor: "move",
                        items: 'tr:not(.unsortable)'
                        });
          $( ".recordings" ).disableSelection();
        } );
        </script>

        {{-- <script>
            var config = { attributes: true, childList: true, subtree: true };
            var callback = function(mutationsList, observer) {
            for(var mutation of mutationsList) {
                if (mutation.type == 'childList') {
                }
                else if (mutation.type == 'attributes') {
                    $(".tfoot").find(".save-sequence").removeAttr('disabled');
                }
            }
        };
            var observer = new MutationObserver(callback);
            var target=document.getElementById('recordings');
            $(function(){
            observer.observe(target, config);
            });
        </script> --}}

        <script>
        $("select[name=template]").on('change',function(){
            var template=$(this).val();
            getIvrTemplate(template);
        });
        </script>

        <script>
        $(".form-recording-sequence").on('click','button.btn-template-validate',function(e){
            e.preventDefault();
            var data=$('.form-recording-sequence').serialize();
            $.ajax({
                type: "post",
                url: "/saveRecordingSequence",
                data: data,
                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                            },
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
        })
        </script>

        <script>
        $(document).on("click","button.modal-confirm",function(){
        $(this).html(`<i class='fa fa-spinner fa-spin'></i>`)
        var id=$(this).attr("id");
        var data=$(`#form${id}`).serialize();
        fetch('polly?'+data)
        .then(function(response) {
            return response.json();
        })
        .then((src)=>{
            $(`.audio-result${id}`).html(`<audio src="aws/${src}" id="audio${id}" controls></audio>`);
            $(`#audio${id}`).trigger('play');
        })
        .then(()=>$(this).html(`Listen`))
        });

        $(document).on("click","button.save-tts",function(){
        $(this).html(`<i class='fa fa-spinner fa-spin'></i>`)
        var id=$(this).attr("id");
        var data=$(`#form${id}`).serialize();
        fetch('save-tts?'+data)
        .then(function(response) {
            return response.json();
        })
        .then((result)=>{
            $.each(result, function(index, element) {
                                        spop({
                                            template: element,
                                            autoclose: 5000,
                                            style: 'success'
                                        });

            $(`.audio-result${id}`).html(`<div class='alert alert-success'>${element}</div>`);
                                    });

        })
        .then(()=>$(this).html(`Save`))
        });
        </script>

        <script>
        $(".recording_keyword_save").click(function(e){
            e.preventDefault();
            var data=$(".recording_keywords_form").serialize();
            $.ajax({
                type: "post",
                url: "/save-recording-keywords",
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
        });


        $(".recording_text_form_save").click(function(e){
            e.preventDefault();
            var data=$(".recording_text_form").serialize();
            console.log(data);
            $.ajax({
                type: "post",
                url: "/save-recording-text-url",
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
        });
        </script>

@endsection
