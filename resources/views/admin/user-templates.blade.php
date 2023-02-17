@extends('admin_layouts.app')


@section('title')
    User Templates
@endsection

@section('header')

@endsection

@section('menu')
User Templates
@endsection

@section('content')

<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">New Template</button>

<section class="panel">

    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>

        <h2 class="panel-title">User Templates</h2>
        <p class="panel-subtitle">Assign templates and recordings</p>
    </header>
    <div class="panel-body">

                        <table class="table table-hover table-head-purple mb-5">
                            <thead>
                                <tr>
                                    <th>Template ID</th>
                                    <th>Template Name</th>
                                    <th>User</th>
                                    <th>Source Number</th>
                                    <th>No of recordings</th>
                                    <th>No of uploaded recordings</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody class='template_body'>
                            @isset($templates)
                                @foreach ($templates as $template)
                                    <tr class="templates" data-template-id="{{$template->id}}" onmouseover="this.style.cursor='pointer'">
                                        <td>{{$template->id}}</td>
                                        <td>{{$template->template_name}}</td>
                                        <td>{{$template->user->username}}</td>
                                        <td>{{$template->source_number}}</td>
                                        <td>{{$template->no_of_recordings}}</td>
                                        <td>{{$template->no_of_uploaded_recordings}}</td>
                                        <td>{{$template->status}}</td>
                                        <td>{{$template->created_at}}</td>
                                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".temp_{{$template->id}}"><i class="fa fa-edit"></i></button></td>
                                    </tr>

                                    <!-- Modals to edit template -->
                        <div class="modal fade temp_{{$template->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Template</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form class="form template_form_{{$template->id}}">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label>Template ID</label>
                                            <input class="form-control" type="text" value="{{$template->id}}" name="template_id" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label>No of recordings</label>
                                            <input class="form-control" type="text" value="{{$template->no_of_recordings}}" name="no_of_recordings">
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Template JSON</label>
                                                <textarea class="form-control" name="template_json" rows="12">
                                                    {{$template->templates}}
                                                </textarea>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save" data-template="{{$template->id}}">Save changes</button>
                                </div>
                                </div>
                            </div>
                            </div>

                                @endforeach
                             @endisset



                            </tbody>
                        </table>
    </div>
</section>

<section class="panel">

    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>

        <h2 class="panel-title">Recordings</h2>
        <p class="panel-subtitle">Click on template row to fetch recordings list</p>
    </header>
    <div class="panel-body">

                        <table class="table table-head-purple mb-5">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Source Number</th>
                                    <th>Path</th>
                                    <th>Original Filename</th>
                                    <th>Filesize</th>
                                    <th>Sequence</th>
                                </tr>
                            </thead>
                            <tbody class='recording_body'>

                            </tbody>
                        </table>
    </div>
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Template</h4>
      </div>
      <div class="modal-body">
          <form class="form template_form">
          <input type="hidden" name="user_id" value="{{$user_id}}">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control" type="text" placeholder="template name" name="template_name">
                </div>
                <div class="col-md-6">
                     <input class="form-control" type="text" placeholder="Source number" name="source_number">
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control" type="text" placeholder="No of recordings" name="no_of_recordings">
                </div>
            </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
        <button type="button" class="btn btn-info save">Save</button>

      </div>
    </div>

  </div>
</div>
 @endsection

 @section('scripts')

            <script>
            $("#myModal").on('click','button.save',function(){
                var data=$(".template_form").serialize();

                $.ajax({
                    'url':'/new-template',
                    'type':'post',
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    						},
                    'data':data,
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


            $(".template_body").on('click','tr.templates',function(e){
                var template_id=$(this).attr("data-template-id");
                $(".recording_body").html("");
                $.ajax({
                    type: "post",
                    url: "/template-recordings/"+template_id,
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    						},
                    success: function (response) {
                        $.each(response,function(i,e){
                            $(".recording_body").append(`
                            <tr>
                            <td>${e.id}</td>
                            <td>${e.source_number}</td>
                            <td>${e.path==null?'File not uploaded':e.path}</td>
                            <td>${e.original_filename==null?'File not uploaded':e.original_filename}</td>
                            <td>${e.file_size==null?'File not uploaded':e.file_size}</td>
                            <td>${e.sequence}</td>
                            </tr>
                            `)
                        })
                    }
                });
            });

            $(".panel-body").on('click','button.save',function(){
                 var id=$(this).attr('data-template');
                 var data=$(".template_form_"+id).serialize();
                 $.ajax({
                     type: "post",
                     url: "/edit-template/"+id,
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
                 });
            });
            </script>

@endsection
