@extends('layouts.app')

@section('title')
    Add / View Agents
@endsection

@section('menu')
    Add / View Agents
@endsection

@section('content')

<div class="btn-group">
<button type="button" class="mb-xs mt-xs mr-xs btn btn-primary add-agent">Add Agent</button>
<button type="button" class="mb-xs mt-xs mr-xs btn btn-primary add-group">Create Group</button>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="phonebookModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#140F6D;color:white !important">
            <h5 class="modal-title">Add Agent</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <form class="form manage-agent-form">
            <div class="modal-body">
               @csrf
               <div class="row">

                    <div class="col-md-6 mt-2"  style="margin: 0 auto;">
                            <label>Source Number</label>
                        <select name="source_number" class="form-control">
                        <option value="{{Session::get('source_number')}}">{{Session::get('source_number')}}</option>
                        </select>
                    </div>

                    <div class="col-md-6 mt-2"  style="margin: 0 auto;">
                            <label>Group</label>
                        <select name="group" class="form-control">
                            <option selected disabled>Select Group</option>
                        </select>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <input type="hidden" name="agent_id">
                <label>Agent Name</label>
                <input type="text" class="form-control" name="agent_name" placeholder="Agent Name" value="">
                </div>


                <div class="col-md-6">
                    <label>Agent Number</label>
                    <input type="text" class="form-control" data-plugin-maxlength="" maxlength="10" name="agent_destination" placeholder="Agent Number">
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                <label>Extension</label>
                <input type="text" class="form-control" name="ext" placeholder="Extension" value="">
                </div>
            </div>


            </div>
            <div class="modal-footer">
            <button class="btn btn-default manage-agent-form-submit" type="submit">Add</button>
            </div>
        </form>
        </div>
        </div>
    </div>

    <!-- create new group modal-->
    <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="phonebookModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#140F6D;color:white !important">
            <h5 class="modal-title">Create New Group</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <form class="form create-group-form">
            <div class="modal-body">
               @csrf
            <div class="row">
                <div class="col-md-6">
                <label class="col-md-3 control-label">Name</label>
                <input class="form-control" data-plugin-maxlength="" maxlength="30" name="group" placeholder="Group Name" value="">
                </div>

                <div class="form-group">
                        <label class="col-md-3 control-label">Weekly Holidays</label>
                        <div class="col-md-6">
                            <select multiple data-plugin-selectTwo class="form-control populate" name="holidays[]">
                                <optgroup label="Days">
                                    <option value="sunday" selected>Sunday</option>
                                    <option value="saturday" selected>Saturday</option>
                                    <option value="friday">Friday</option>
                                    <option value="thursday">Thursday</option>
                                    <option value="wednesday">Wednesday</option>
                                    <option value="tuesday">Tuesday</option>
                                    <option value="monday">Monday</option>
                                </optgroup>
                            </select>
                        </div>
                </div>
            </div>
            <hr>
            <h5>Office Timing</h5>
            <div class="row">
                        <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-clock-o"> From</i>
                                    </span>
                                    <input type="text" name="office_start_time" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' value="09:00">
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-clock-o"> To</i>
                                        </span>
                                        <input type="text" name="office_end_time" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' value="06:00">
                                    </div>
                            </div>
            </div>




            </div>
            <div class="modal-footer">
            <button class="btn btn-default create-group" type="submit">Create</button>
            </div>
        </form>
        </div>
        </div>
    </div>


    <!-- edit group modal -->
    <div class="modal fade" id="editGroup" tabindex="-1" role="dialog" aria-labelledby="phonebookModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#140F6D;color:white !important">
                <h5 class="modal-title">Edit Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <form class="form edit-group-form">
                <div class="modal-body">
                   @csrf
                   <input type="hidden" name="group_id">
                <div class="row">
                    <div class="col-md-6">
                    <label class="col-md-3 control-label">Name</label>
                    <input class="form-control" data-plugin-maxlength="" maxlength="30" name="group" placeholder="Group Name" value="">
                    </div>

                    <div class="form-group">
                            <label class="col-md-3 control-label">Weekly Holidays</label>
                            <div class="col-md-6">
                                <select multiple data-plugin-selectTwo class="form-control populate" name="holidays[]">
                                    <optgroup label="Days">
                                        <option value="sunday">Sunday</option>
                                        <option value="saturday">Saturday</option>
                                        <option value="friday">Friday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="monday">Monday</option>
                                    </optgroup>
                                </select>
                            </div>
                    </div>
                </div>
                <hr>
                <h5>Office Timing</h5>
                <div class="row">
                            <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-clock-o"> From</i>
                                        </span>
                                        <input type="text" name="office_start_time" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"> To</i>
                                            </span>
                                            <input type="text" name="office_end_time" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }' value="">
                                        </div>
                                </div>
                </div>




                </div>
                <div class="modal-footer">
                <button class="btn btn-default create-group" type="submit">Save</button>
                </div>
            </form>
            </div>
            </div>
        </div>

    <div class="row">
    <div class="col-md-12">
        <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#agents" data-toggle="tab"></i>Agents</a>
                </li>
                <li>
                    <a href="#groups" data-toggle="tab">Groups</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="agents" class="tab-pane active">

                    <section class="panel-featured panel-featured-primary">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>

                                <h2 class="panel-title">Agent Details</h2>
                            </header>
                            <div class="panel-body">
                                <table class="table table-bordered table-striped mb-none source_table" id="datatable-default">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Group</th>
                                            <th>Source Number</th>
                                            <th>Ext</th>
                                            <th>Agent Name</th>
                                            <th>Agent Destination</th>
                                            <th>Calls Attended</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="source_body">

                                    </tbody>
                                </table>
                                <center><img src="../images/loader.gif" class="loader"></center>
                                <!-- pagination -->
                                <nav aria-label="..." class="navigaton">
                                    <ul class="pagination pagination-lg">

                                    </ul>
                                  </nav>
                            </div>

                    </section>
                </div>
                <div id="groups" class="tab-pane">
                    <section class="panel-featured panel-featured-primary">
                        <header class="panel-heading">
                            <div class="panel-actions">
                                <a href="#" class="fa fa-caret-down"></a>
                                <a href="#" class="fa fa-times"></a>
                            </div>

                            <h2 class="panel-title">Group Details</h2>
                        </header>
                        <div class="panel-body">
                            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Group</th>
                                        <th>Office Hours</th>
                                        <th>Weekly Holidays on</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="group_tbody">

                                </tbody>
                            </table>
                            <center><img src="../images/loader.gif" class="loader"></center>
                            <!-- pagination -->
                            <nav aria-label="..." class="navigaton">
                                <ul class="pagination pagination-lg">

                                </ul>
                              </nav>
                        </div>

                </section>
                </div>
            </div>
        </div>
    </div>
    </div>

            <!-- Modals -->
            <div class="row">
                    <div class="col-xl-12">
                        <div class="ibox">
                            <div class="ibox-body">

                                <div class="copy_modal fade-in-up">
                                    <!--copy  Modal -->
                               <div class="modal fade" id="copyModal" tabindex="-1" role="dialog" aria-labelledby="phonebookModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background:#140F6D;color:white !important">
                                        <h5 class="modal-title">Copy Agent to Another Source Number</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    <form class="form copy_form">
                                        <center><img src="../images/loader.gif" class="loader" style="margin:0 auto;"></center>
                                        <div class="modal-body" style="display:none">
                                           @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="hidden" name="agent_id">

                                            <input type="text" class="form-control" name="agent_destination" placeholder="Agent Number" value="" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="agent_name" placeholder="Agent Name" readonly>
                                            </div>

                                        </div>
                                        <div class="row">

                                                <div class="col-md-6 mt-2"  style="margin: 0 auto; text-align:center">
                                                        <label>Copy to Source Number:</label>
                                                    <select name="source_number" class="form-control">
                                                        <option selected disabled>Select Source Number</option>
                                                    </select>
                                                </div>
                                        </div>

                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-default save-agent" type="submit">Save</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                </div>


                                <div class="move_modal">
                                      <!-- Move Modal -->
                               <div class="modal fade" id="moveModal" tabindex="-1" role="dialog" aria-labelledby="phonebookModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background:#140F6D;color:white !important">
                                        <h5 class="modal-title">Move Agent to Another Source Number</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    <form class="form move_form">
                                        <center><img src="../images/loader.gif" class="loader" style="margin:0 auto;"></center>
                                        <div class="modal-body" style="display:none">
                                           @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="hidden" name="agent_id">

                                            <input type="text" class="form-control" name="agent_destination" placeholder="Agent Number" value="" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="agent_name" placeholder="Agent Name" readonly>
                                            </div>

                                        </div>
                                        <div class="row">

                                                <div class="col-md-6 mt-2"  style="margin: 0 auto; text-align:center">
                                                        <label>Move to Source Number:</label>
                                                    <select name="source_number" class="form-control">
                                                        <option selected disabled>Select Source Number</option>
                                                    </select>
                                                </div>
                                        </div>

                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-default save-agent" type="submit">Save</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                </div>


                                <div class="edit_modal">
                                      <!-- Edit Modal -->
                               <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="phonebookModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background:#140F6D;color:white !important">
                                        <h5 class="modal-title">Edit Agent Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    <form class="form edit_form">
                                        <center><img src="../images/loader.gif" class="loader" style="margin:0 auto;"></center>
                                        <div class="modal-body" style="display:none">
                                           @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="hidden" name="agent_id">
                                            <label class="control-label">Agent Number</label>
                                            <input type="text" class="form-control" data-plugin-maxlength="" maxlength="10" name="agent_destination" placeholder="Agent Number" value="">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">Agent Name</label>
                                                <input type="text" class="form-control" name="agent_name" placeholder="Agent Name">
                                            </div>

                                        </div>
                                        <div class="row">

                                                <div class="col-md-6 mt-2"  style="margin: 0 auto;">
                                                        <label>Source Number:</label>
                                                    <input name="source_number" type="text" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-6 mt-2"  style="margin: 0 auto;">
                                                        <label>Change Group:</label>
                                                        <select name="group" class="form-control">
                                                            <option selected disabled>Change group</option>
                                                        </select>
                                                </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mt-2"  style="margin: 0 auto;">
                                                        <label>Extension:</label>
                                                    <input name="ext" type="text" class="form-control">
                                                </div>
                                        </div>

                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-default save-agent" type="submit">Save</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                <!-- delete confirmation -->

                                        <div class="dialog" title="Modify Agent Status" style="display:none;text-align:center">
                                            <p>Are you sure</p>
                                            <button class='btn delete-agent' data-toggle="tooltip" data-id=''>Confirm</button>
                                        </div>

                                        <div class="delete-dialog" title="Warning" style="display:none;text-align:center">
                                            <p>Deleting will delete this agent along with agent's call count. In case you are not sure, disable the agent.<br>Are you Sure you want to delete</p>
                                            <button class='btn hard-delete-agent' data-toggle="tooltip" data-id=''>Confirm</button>
                                        </div>


                                </div>

                            </div>
                        </div>
                    </div>
            </div>
@endsection
@section('scripts')

  <!--Ajax Post and capture api response-->
           <script>
                $(function() {
                    $('.manage-agent-form-submit').click(function(e) {
                        e.preventDefault;
                        var data = $('.manage-agent-form').serialize();

                        $.ajax({
                            url: '/add-agents',
                            method: 'post',

							headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                            data: data,

                            success: function(result) {

                                $("input[name=agent_name]").val('');
                                $('input[name=agent_destination]').val('');
                                loadDiv();

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
                var stopInterval=setInterval(loadDiv, 5000);


                function refreshDiv(div){

                        $(div).load(location.href+ " "+div+">*","");
                        }

            function loadDiv(search='',page=''){
            $.ajax({
                url:'/manage-agents',
                type:'post',
                headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    								},
                data:'search='+search+'&page='+page,
                success:function(response){
                    $('.loader').hide();
                    $(".pagination").html("");
                    $(".source_table > tbody").html("");


                    $.each(response.data,function(index,element){

                        if(element.call_status==1)
                        {
                            var online="<i class='fa fa-circle' style='color:green'></i>"
                        }
                        else{
                            var online="";
                        }
                        if(element.assigned_to_caller){
                            var assigned_to_caller="<br>Talking to :"+element.assigned_to_caller;
                        }
                        else{
                            var assigned_to_caller="";
                        }
                        if(element.is_active==1){
                            var enable=`<button class='btn btn-info delete-agent-dialog' data-toggle="tooltip" title="Disable" data-id='${element.id}' data-name='${element.agent_name}'>Disable</button>`;
                        }
                        else{
                            var enable=`<button class='btn delete-agent-dialog' data-toggle="tooltip" title="Enable" data-id='${element.id}' data-name='${element.agent_name}'>Enable</i></button>`;
                        }
                        if(element.group){
                            var group=element.group.group_name;
                        }
                        else{
                            var group="";
                        }
                    $(".source_body").append(`
                        <tr>
                        <td>${element.id}</td>
                        <td>${group}</td>
                        <td>${element.source_number}</td>
                        <td>${element.ext}</td>
                        <td>${element.agent_name}</td>
                        <td>${online} &nbsp;${element.agent_destination}${assigned_to_caller}</td>
                        <td>Today Inbound : <span style="color:#269ABC;font-weight:bold">${element.today_inbound_calls}</span></br>
                        Total Inbound: <span style="color:#269ABC;font-weight:bold"">${element.total_outbound_calls}</span></td>
                        <td>${element.created_at}</td>
                        <td>
                        <button class='btn edit-agent' data-toggle="tooltip" title="Edit" data-id='${element.id}' data-source_number='${element.source_number}' data-agent_destination='${element.agent_destination}' data-agent_name=${element.agent_name} data-target="editModal"><i class="fa fa-edit"></i></button>
                        <button class='btn copy-agent' data-toggle="tooltip" title="Copy" data-id='${element.id}' data-source_number='${element.source_number}' data-agent_destination='${element.agent_destination}' data-agent_name=${element.agent_name} data-target="copyModal"><i class="fa fa-clone"></i></button>
                        <button class='btn move-agent' data-toggle="tooltip" title="Move" data-id='${element.id}' data-source_number='${element.source_number}' data-agent_destination='${element.agent_destination}' data-agent_name=${element.agent_name} data-target="moveModal"><i class="fa fa-scissors"></i></button>
                        <button class='btn hard-delete hard-delete-agent-dialog' data-toggle="tooltip" title='delete' data-id='${element.id}' data-name='${element.agent_name}'><i class="fa fa-trash"></i></button>
                        ${enable}
                        </td></tr>
                    `);

                });
                for(var i=1;i<=response.last_page;i++){
                    if(i==response.current_page){
                       $(".pagination").append(`<li class="page-item"><button class='btn btn-default' data-page='${i}' disabled>${i}</button></li>`);
                    }
                    else{
                        $(".pagination").append(`<li class="page-item"><button class='btn btn-default btn-pagination' data-page='${i}'>${i}</button></li>`);
                    }

                    }
                }
            });
            }

            loadDiv();

            $(".add-agent").click(function(){
                $("#addModal").modal('show');
            });

            $(".add-group").click(function(){
                $("#addGroup").modal('show');
            });

            $(".group_tbody").on('click','button.edit-group',function(){
                var group_id=$(this).attr('data-group-id');
                var group_name=$(this).attr('data-group-name');
                var office_start_time=$(this).attr('data-office_start_time');
                var office_end_time=$(this).attr("data-office_end_time");
                var holidays=$.parseJSON($(this).attr('data-holidays'));
                $.each(holidays,function(index,element){
                   var t=$(".edit-group-form").find(`select[name="holidays[]"] option[value="${element}"]`);
                   t.attr('selected');
                });
                $(".edit-group-form").find(`input[name='group']`).val(group_name);
                $(".edit-group-form").find(`input[name=group_id]`).val(group_id);
                $(".edit-group-form").find(`input[name=office_start_time]`).val(office_start_time);
                $(".edit-group-form").find(`input[name=office_end_time]`).val(office_end_time);
                $("#editGroup").modal('show');
            });

            $(".source_table").on('click','button.delete-agent-dialog',function(e){
                var agent_id=$(this).attr('data-id');
                var agent_name=$(this).attr('data-name');
                $(".dialog").dialog();
                $(".dialog").find(".delete-agent").attr('data-id',agent_id);
                $(".dialog").find(".delete-agent").html("Modify Status of "+ agent_name);
            });

            $(".source_table").on('click','button.hard-delete-agent-dialog',function(e){
                var agent_id=$(this).attr('data-id');
                var agent_name=$(this).attr('data-name');
                $(".delete-dialog").dialog();
                $(".delete-dialog").find(".hard-delete-agent").attr('data-id',agent_id);
                $(".delete-dialog").find(".hard-delete-agent").html("Delete "+ agent_name);
            });

            $(".dialog").on('click','button.delete-agent',function(e){
                e.preventDefault();
                clearInterval(stopInterval);
                var agent_id=$(this).attr('data-id');
            $.ajax({
                url:'/delete-agent',
                type:'post',
                headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                data:'agent_id='+agent_id,
                success:
                    function(result) {
                        $('.dialog').dialog('close');
                              $(".pagination").html("");
                                spop({
                                    template: result.message,
                                    autoclose: 5000,
                                    style: 'success'
                                });


                        },
                         //////////////////////// reload div after ajax success
                         complete:function(){


                             loadDiv();

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

            });

            $(".delete-dialog").on('click','button.hard-delete-agent',function(e){
                e.preventDefault();
                clearInterval(stopInterval);
                var agent_id=$(this).attr('data-id');
            $.ajax({
                url:'/hard-delete-agent',
                type:'post',
                headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                data:'agent_id='+agent_id,
                success:
                    function(result) {
                        $('.delete-dialog').dialog('close');
                              $(".pagination").html("");
                                spop({
                                    template: result.message,
                                    autoclose: 5000,
                                    style: 'success'
                                });


                        },
                         //////////////////////// reload div after ajax success
                         complete:function(){


                             loadDiv();

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

            });

            $('input[name=search]').on('keyup paste',function(){
                clearInterval(stopInterval);
                var search=$(this).val();
                $(".source_table > tbody").html("");
                $(".pagination").html("");
                loadDiv(search);
            });

            $('.pagination').on('click','button.btn-pagination',function(){
                clearInterval(stopInterval);
                var search=$(this).val();
                var page=$(this).attr('data-page');
                $(".source_table > tbody").html("");
                $(".pagination").html("");
                loadDiv(search,page);
            });


            $('.source_body').on('click','button.copy-agent',function(e){
                e.preventDefault();
                clearInterval(stopInterval);
                $("#copyModal").modal('show');
                var agent_id=$(this).attr('data-id');
                var agent_destination=$(this).attr('data-agent_destination');
                var agent_name=$(this).attr('data-agent_name');
                var source_number=$(this).attr('data-source_number');

                $("#copyModal").find('select[name=source_number]').children('option').show();
                $("#copyModal").find('option[value='+source_number+']').hide();
                $("#copyModal").find('input[name=agent_id]').val(agent_id);
                $("#copyModal").find('input[name=agent_destination]').val(agent_destination);
                $("#copyModal").find('input[name=agent_name]').val(agent_name);
                $("#copyModal").find(".loader").hide();
                $("#copyModal").find('.modal-body').show();

            });

            $('.source_body').on('click','button.move-agent',function(e){
                e.preventDefault();
                clearInterval(stopInterval);
                $("#moveModal").modal('show');
                var agent_id=$(this).attr('data-id');
                var agent_destination=$(this).attr('data-agent_destination');
                var agent_name=$(this).attr('data-agent_name');
                var source_number=$(this).attr('data-source_number');

                $("#moveModal").find('select[name=source_number]').children('option').show();
                $("#moveModal").find('option[value='+source_number+']').hide();
                $("#moveModal").find('input[name=agent_id]').val(agent_id);
                $("#moveModal").find('input[name=agent_destination]').val(agent_destination);
                $("#moveModal").find('input[name=agent_name]').val(agent_name);
                $("#moveModal").find(".loader").hide();
                $("#moveModal").find('.modal-body').show();

            });

            $('.source_body').on('click','button.edit-agent',function(e){
                e.preventDefault();
                clearInterval(stopInterval);
                $("#editModal").modal('show');
                var agent_id=$(this).attr('data-id');
                var agent_destination=$(this).attr('data-agent_destination');
                var agent_name=$(this).attr('data-agent_name');
                var source_number=$(this).attr('data-source_number');
                $("#editModal").find('input[name=agent_id]').val(agent_id);
                $("#editModal").find('input[name=agent_destination]').val(agent_destination);
                $("#editModal").find('input[name=agent_name]').val(agent_name);
                $("#editModal").find('input[name=source_number]').val(source_number);
                $("#editModal").find(".loader").hide();
                $("#editModal").find('.modal-body').show();

            });

            </script>

            <script>
            $("#copyModal").on('click','button.save-agent',function(e){
                e.preventDefault();

                var data=$(".copy_form").serialize();

                $.ajax({
                        type:'post',
                        url:'/copy_agent',
                        data:data,
                        headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                        success:function(result) {

                                spop({
                                    template: result.message,
                                    autoclose: 5000,
                                    style: 'success'
                                });


                        },
                         //////////////////////// reload div after ajax success
                         complete:function(){


                             loadDiv();

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
            });
            </script>

<script>
        $("#moveModal").on('click','button.save-agent',function(e){
            e.preventDefault();
            var data=$(".move_form").serialize();

            $.ajax({
                    type:'post',
                    url:'/move_agent',
                    data:data,
                    headers: {
                                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                    },
                    success:function(result) {

                            spop({
                                template: result.message,
                                autoclose: 5000,
                                style: 'success'
                            });


                    },
                     //////////////////////// reload div after ajax success
                     complete:function(){


                         loadDiv();

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
        });
        </script>

<script>
        $("#editModal").on('click','button.save-agent',function(e){
            e.preventDefault();
            var data=$(".edit_form").serialize();

            $.ajax({
                    type:'post',
                    url:'/edit_agent',
                    data:data,
                    headers: {
                                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                    },
                    success:function(result) {

                            spop({
                                template: result.message,
                                autoclose: 5000,
                                style: 'success'
                            });


                    },
                     //////////////////////// reload div after ajax success
                     complete:function(){


                         loadDiv();

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
        });
        </script>

        <script>
        $(".create-group").on('click',function(e){
            e.preventDefault();

            var data=$(".create-group-form").serialize();

            $.ajax({
                'url':'/createGroup',
                'type':'post',
                headers: {
                                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                    },
                data:data,
                success:function(result){
                    spop({
                                template: result.message,
                                autoclose: 5000,
                                style: 'success'
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

    <script>
        function getGroups(){
            $(".group_tbody").html("");
        $.ajax({
            'url':'/getGroups',
            'type':'post',
            headers: {
                                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                                },
            success:function(response){
                $.each(response,function(index,result){

                $(".group_tbody").append(`
                    <tr>
                    <td>${result.id}</td>
                    <td>${result.group_name}</td>
                    <td>Open:${result.office_start_time}<br>Close: ${result.office_end_time}</td>
                    <td>${result.holidays}</td>
                    <td>${result.created_at}</td>
                    <td>
                    <button class='btn btn-default edit-group' data-group-id='${result.id}' data-group-name='${result.group_name}' data-office-start-time='${result.office_start_time}' data-office-end-time='${result.office_end_time}' data-holidays='${result.holidays}'>
                    <i class='fa fa-edit'></i>
                    </button>
                    </td>
                    </tr>
                `);

                $("select[name=group]").append(`
                    <option value='${result.id}'>${result.group_name}</option>
                `);

            });
            }

        });
        }
        getGroups();
    </script>

@endsection
