<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Client IVR | Recordings</title>

    @include('clientivr.layout.header')
    <!-- START SIDEBAR-->
    @include('clientivr.layout.side-header')
    <!-- END SIDEBAR-->
    <div class="wrapper content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <!-- START PAGE CONTENT-->
            <div class="page-heading" style="display:inline-block">
                <h1 class="page-title" style="display:inline-block;"> Recordings</h1>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.blade.php"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Apps</li>
                    <li class="breadcrumb-item">Recordings</li>
                </ol>

            </div><br>
            <!--File uploading error will be shown here -->
            @include('layouts.errors')
            @include('layouts.success')

            <div class="row">


                <div class="col-xl-12">
                    <div class="ibox">
                        <div class="ibox-body">
                            <form method="post" name="upload_recording" action='/upload_recording' enctype="multipart/form-data">
                               @csrf


                                <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                                <div class="form-group mb-4">
                                                    <label>Source Number:</label>
                                                    <select class="form-control source_number" name="source_number" style="height:34px;">
                                                    
                                                  </select>
                                                </div>
                                            </div>

                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group mb-4">
                                            <label>Clip Type:</label>
                                            <select class="form-control" name="clip_type" style="height:34px;">
											<option>Welcome</option>
											<option>Agent Not Available</option>
											<option>Call Disconnect</option>
										  </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-xs-12">
                                        <div class="form-group mb-4">
                                            <label>Title:</label>
                                            <input type="text" class="form-control" name="clip_title">
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-3 col-xs-12">
                                        <div class="form-group mb-4">
                                            <label>File:</label>
                                            <input type="file" class="form-control" name="recording_file">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-2">
                                       
                                        <center>
                                           
                                           <button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air form-record-submit" type="submit">
                                           <i class="fa fa-paper-plane" title="Submit"></i></button>
                                            <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air" type="reset"><i class="fa fa-remove" title="Cancel"></i></button></center>

                                    </div>
                                    <div class="col-md-5"></div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--system recordings-->
            <div class="row">

                <div class="col-xl-12">
                    <div class="ibox">
                        <div class="ibox-body">


                            <h3 class="page-title">System Recordings</h3>
                            <div class="table-responsive">
                                <table class="table table-head-purple mb-5">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>File Name</th>
                                            <th>File Size</th>
                                            <th>Tools</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Welcome</td>
                                            <td>welcome.mp3</td>
                                            <td>747kb</td>
                                            <td>
                                                <audio controls>
											  <source src="audio/thnku.mp3" type="audio/mpeg">
											</audio>
                                            </td>
                                            <td>Welcome mp3</td>


                                        </tr>

                                        <tr>
                                            <td>Agent Not Available</td>
                                            <td>agent not available.mp3</td>
                                            <td>747kb</td>
                                            <td>
                                                <audio controls>
											  <source src="audio/thnku.mp3" type="audio/mpeg">
											</audio>
                                            </td>
                                            <td>agent not available mp3</td>


                                        </tr>

                                        <tr>
                                            <td>Call Disconnect</td>
                                            <td>call disconnect.mp3</td>
                                            <td>747kb</td>
                                            <td>
                                                <audio controls>
											  <source src="audio/thnku.mp3" type="audio/mpeg">
											</audio>
                                            </td>
                                            <td>call disconnect mp3</td>


                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!--client recordings-->
            <div class="row">

                <div class="col-xl-12">
                    <div class="ibox">
                        <div class="ibox-body">


                            <h3 class="page-title">Client Recordings</h3>
                            <div class="table-responsive recording-div">
                                <table class="table table-head-purple mb-5 client_recordings_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Source Number</th>
                                            <th>Clip Type</th>
                                            <th>File Name</th>
                                            <th>File Size</th>
                                            <th>Tools</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Delete</th>
                                        </tr>
                            <!-- data from recordings table -->
                                    </thead>
                                    @foreach($recordings as $recording)
                                    <tbody class="client_recordings">
                                        <tr>
                                            <td>{{$recording->id}}</td>
                                            <td>{{$recording->source_number}}</td>
                                            <td>{{$recording->default_recording_title}}</td>
                                            <td>{{$recording->original_filename}}</td>
                                            <td>{{round(($recording->file_size)/1024)}} KB</td>
                                            <td>
                                                <audio controls>
											  <source src={{$recording->path}} type="audio/mpeg">
											</audio>
                                            </td>
                                            <td>{{$recording->client_recording_title}}</td>
                                            @if($recording->status==0)
                                            <td>NOT ACTIVE</td>
                                            @elseif($recording->status==1)
                                            <td>ACTIVE</td>
                                            @endif
                                            <td><button class="btn delete-recording" data-id='{{$recording->id}}'><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                            <!-- foreach loop ends -->
                               
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            @include('clientivr.layout.footer')
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
                                    <option value="${element.source_number}">${element.source_number}</option>
                                    `);
                               
                                }
                                else{
                                    $(".source_number").append(`
                                    <option readonly selected>No source number found</option>
                                    `);   
                                    $(".form-record-submit").attr("disabled",true);                            
                                    }
                  
                            });
                        }        
                    });
            </script>
            <script>
                function refreshDiv(div){
                        $(div).load(location.href+ " "+div+">*","");
                        }

                $(".ibox").on('click','button.delete-recording',function(){
                 var recording_id=$(this).attr('data-id');
                $.ajax({
                        type:'post',
                        url:'/deleteRecording',
                        headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    									},
                        data:"recording_id="+recording_id,

                        success:function(result) {
                                refreshDiv('.recording-div');
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
        
            </body>


</html>
