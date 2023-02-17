@extends('admin_layouts.app')


@section('title')
    User Permissions
@endsection

@section('menu')
User Permissions @isset($permission) for user {{$permission->user->username}}@endisset</h1>
@endsection

@section('content')
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>

        <h2 class="panel-title">User Permissions</h2>
        <p class="panel-subtitle">Control what user sees</p>
    </header>
    <div class="panel-body">

                        <table class="table table-head-purple mb-5">
                            <thead>
                                <tr>
                                    <th>Permissions</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class='permissions_body'>
                               @isset($permission)
                            <input type="hidden" name="user_id" value="{{$permission->user->id}}">

                               <tr>
                                    <td>Can add source number</td>
                                    <td>
                                        <div class="switch switch-sm switch-primary">
                                            <input type="checkbox" data-plugin-ios-switch name="can_add_source_number" class="form-control" @if($permission->can_add_source_number==1)checked @endif>
                                        </div>
                                    </td>
                               </tr>
                               <tr>
                                    <td>Can change dialing strategy</td>
                                    <td><div class="switch switch-sm switch-primary">
                                        <input type="checkbox" data-plugin-ios-switch name="can_change_dialing_strategy" class="form-control" @if($permission->can_change_dialing_strategy==1)checked @endif>
                                        </div>
                                    </td>
                               </tr>
                               <tr>
                                    <td>Can see call answer time</td>
                                    <td><div class="switch switch-sm switch-primary">
                                        <input type="checkbox" data-plugin-ios-switch name="can_see_call_answer_time" class="form-control" @if($permission->can_see_call_answer_time==1)checked @endif>

                                    </td>

                               </tr>
                               <tr>
                                    <td>Can see Conversation duration</td>
                                    <td><div class="switch switch-sm switch-primary">
                                        <input type="checkbox" data-plugin-ios-switch name="can_see_conv_duration" class="form-control" @if($permission->can_see_conv_duration==1)checked @endif>
                                    </div>
                                    </td>

                               </tr>
                               <tr>
                                    <td>Can see caller circle</td>
                                    <td><div class="switch switch-sm switch-primary">
                                        <input type="checkbox" data-plugin-ios-switch name="can_see_caller_circle" class="form-control" @if($permission->can_see_caller_circle==1)checked @endif>
                                    </div>
                                    </td>

                               </tr>
                               <tr>
                                    <td>Can see caller operator</td>
                                    <td><div class="switch switch-sm switch-primary">
                                        <input type="checkbox" data-plugin-ios-switch name="can_see_caller_operator" class="form-control" @if($permission->can_see_caller_operator==1)checked @endif>
                                    </div>
                                    </td>

                               </tr>
                               <tr>
                                    <td>Can see caller mobile</td>
                                    <td><div class="switch switch-sm switch-primary">
                                        <input type="checkbox" data-plugin-ios-switch name="can_see_caller_mobile" class="form-control" @if($permission->can_see_caller_mobile==1)checked @endif>
                                    </div>
                                    </td>

                               </tr>
                               <tr>
                                    <td>Can receive call report email</td>
                                    <td><div class="switch switch-sm switch-primary">
                                        <input type="checkbox" data-plugin-ios-switch name="can_receive_call_report_email" class="form-control" @if($permission->can_receive_call_report_email==1)checked @endif>
                                    </div>
                                    </td>

                               </tr>
                               <tr>
                                    <td>Can listen recording</td>
                                    <td><div class="switch switch-sm switch-primary">
                                        <input type="checkbox" data-plugin-ios-switch name="can_listen_recording" class="form-control" @if($permission->can_listen_recording==1)checked @endif>
                                    </div>
                                    </td>

                               </tr>
                               <tr>
                                    <td>Recording keyword mapping</td>
                                    <td><div class="switch switch-sm switch-primary">
                                        <input type="checkbox" data-plugin-ios-switch name="recording_keyword_mapping" class="form-control" @if($permission->recording_keyword_mapping==1)checked @endif>
                                    </div>
                                    </td>

                               </tr>
                               <tr>
                                    <td>Send Recording text to url</td>
                                    <td><div class="switch switch-sm switch-primary">
                                        <input type="checkbox" data-plugin-ios-switch name="send_recording_text_to_url" class="form-control" @if($permission->send_recording_text_to_url==1)checked @endif>
                                    </div>
                                    </td>

                               </tr>



                               @endisset



                            </tbody>
                        </table>
    </div>
</section>
 @endsection

 @section('scripts')

            <script>
            $(".switch").on('click',function(){
                var data=$(this).find('input').attr("name");
                if($(this).find('.ios-switch').hasClass('on')){
                    var status=1;
                }
                else{
                    var status=0;
                }
                var user_id=$("input[name=user_id]").val();
                $.ajax({
                    'url':'/edit-permission',
                    'type':'post',
                    headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                    'data':data+'='+status+"&user_id="+user_id,
                    'success':function(result) {
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
                });
            });
            </script>

@endsection
