<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Resellers IVR | Transaction Details</title>
    		
    @include('resellerivr.layouts.header')
        <!-- START SIDEBAR-->		
    @include('resellerivr.layouts.side-header')
        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
			     <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Transaction Details For 416636</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php"><i class="la la-home font-20"></i></a>
                    </li>
					 <li class="breadcrumb-item">
                        <a href="#">Reports</a>
                    </li>
					 <li class="breadcrumb-item">
                        <a href="#">Credit Allocation Details</a>
                    </li>
                    <li class="breadcrumb-item">Transaction Details</li>
                </ol>
            </div><br>
			
			 <div class="row">
				  
               
                    <div class="col-xl-12">
                        <div class="ibox">
						 
                            <div class="ibox-body">
							<div class="table-responsive">
								<table class="table table-head-purple mb-5">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction Time</th>
                                            <th>Transaction Credit</th>
                                            <th>Credit Type</th>
                                            <th>Source Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2018-05-15</td>
                                            <td>12:26:50</td>
                                            <td>0</td>
											<td>SMS</td>
                                            <td></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
					</div>
               
					
    @include('resellerivr.layouts.footer')	
</body>


</html>