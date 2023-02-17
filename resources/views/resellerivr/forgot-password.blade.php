<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width initial-scale=1.0">
		<meta name="_token" content="{{ csrf_token() }}">
    <title>Resellers IVR | Dashboard</title>
    
        @include('layouts.header1')
        <!-- START SIDEBAR-->
        @include('layouts.side-header1')

        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
			     <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 align="center" class="page-title" style="color:#dd6a39;">Forgot Password</h1>
                
            </div>
			<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form class="form-horizontal" method="post">
				<div class="form-group">
				  <label class="control-label col-sm-4" for="userid">Registered User Name/ID:</label>
				  <div class="col-sm-8">
					<input type="text" class="form-control" id="userid" placeholder="Enter User Id" name="userid">
				  </div>
				</div>
				
				<div class="form-group">
				  <label class="control-label col-sm-4" for="userid">Authentication:</label>
				  <div class="col-sm-8">
					<label class="radio-inline">
					  <input type="radio" name="email">By Email
					</label>
					<label class="radio-inline">
					  <input type="radio" name="number">By Number
					</label>
				  </div>
				</div>
				<br>
				<div class="form-group">        
				  <div class="col-md-offset-4 col-md-8">
					<button class="btn btn-info btn-icon-only btn-circle btn-lg btn-air"><i class="fa fa-paper-plane" title="Submit"></i></button>
                                    
                           <!-- <button class="btn btn-primary mr-2" type="button">Submit</button>-->
                             <button class="btn btn-danger btn-icon-only btn-circle btn-lg btn-air"><i class="fa fa-remove" title="Cancel"></i></button><br>
							 <div style="padding-top: 15px;">
							 <a href="/login" style="color:#dd6a39;">Click here to login</a>
							 </div>
				  </div>
				  
				</div>
			  </form>
			  </div>
			  
			<div class="col-md-2"></div>
			</div>
			  
				
				    @include('layouts.footer')
</body>


</html>