<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Resellers IVR | Credit Allocation</title>
    
    @include('resellerivr.layouts.header')
        <!-- START SIDEBAR-->
    @include('resellerivr.layouts.side-header')
        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
			     <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Credit Allocation Details</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/resellerivr"><i class="la la-home font-20"></i></a>
                    </li>
					 <li class="breadcrumb-item">
                        <a href="#">Reports</a>
                    </li>
                    <li class="breadcrumb-item">Credit Allocation Details</li>
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
                                            <th>Profile ID</th>
                                            <th>User</th>
                                            <th>Customer Name</th>
											<th>Company</th>
                                            <th>Balance</th>
                                            <th>Transaction Count</th>
											<th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>416636</td>
                                            <td>Nidhi524</td>
                                            <td>Nidhi Gaur</td>
											<td></td>
                                            <td>0</td>
                                            <td>1</td>
                                            <td><a href="/resellerivr/transaction-details">Show Detials</a></td>
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