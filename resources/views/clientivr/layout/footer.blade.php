<!-- END PAGE CONTENT-->
<footer class="page-footer">
    <div class="font-13">© 2018 <b></b></div>

    <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
</footer>
</div>
</div>
<!-- START SEARCH PANEL-->
<!--<form class="search-top-bar" action="#">
        <input class="form-control search-input" type="text" placeholder="Search...">
        <button class="reset input-search-icon"><i class="ti-search"></i></button>
        <button class="reset input-search-close" type="button"><i class="ti-close"></i></button>
    </form>-->
<!-- END SEARCH PANEL-->



<!-- END PAGA BACKDROPS-->

<!-- CORE PLUGINS-->
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="assets/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/vendors/jquery/dist/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/vendors/spop/spop.min.js"></script>
<script src="assets/vendors/jquery-ui/jquery-ui.min.js"></script>



{{-- <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script> --}}
<script src="assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/vendors/jquery-idletimer/dist/idle-timer.min.js"></script>
<script src="assets/vendors/toastr/toastr.min.js"></script>
<script src="assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="assets/vendors/chart.js/dist/Chart.min.js"></script>
<script src="assets/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- CORE SCRIPTS-->
<script src="assets/js/app.min.js"></script>




<script src="pass.js"></script>

<!-- PAGE LEVEL SCRIPTS-->
<script src="assets/js/scripts/dashboard_visitors.js"></script>


<!--edit source no-->
<script>
    $(document).ready(function() {
        $('.source_body').on('click','a#edit',function(){
            let modalid=$(this).attr('data-target');
            $(modalid).modal();
        });
    });

</script>
<!--edit source no-->

<!--delete source no-->
<script>
    $(document).ready(function() {
        $('.source_body').on('click','a#deletesource',function(){
            let modalid=$(this).attr('data-target');
            $(modalid).modal();
        });
    });

</script>
<!--delete source no-->


<!--add remark-->
<script>
    /*$(document).ready(function() {
        var remarkId = $(e.relatedTarget).data('profile-id');
        var remarkmodalId = $(e.relatedTarget).data('profile-id');
        $(".addremark").click(function() {
            
            $(".addremarkModal").modal();
        });
    }); */

</script>
<!--add remark-->

<!--Save Contact-->
<script>
    $(document).ready(function() {
        $("#addcontact").click(function() {
            $("#addcontactModal").modal();
        });
    });

</script>
<!--Save Contact-->

<!--hold user account-->
<script>
		$(document).ready(function(){
			$("#holdaccount").click(function(){
				$("#holdaccountModal").modal();
			});
		});
		</script>
	<!--hold user account-->
	<!--hold user account-->
		<script>
		$(document).ready(function(){
			$("#holdaccount1").click(function(){
				$("#holdaccountModal").modal();
			});
		});
		</script>

<!--delete ring group-->
<script>
    $(document).ready(function() {
        $("#delringgroup").click(function() {
            $("#delringgroupModal").modal();
        });
    });

</script>
                    <script>
                            $(function() {
                            $('[data-toggle="tooltip"]').tooltip(); 
                                
                                
                            });
                            
                        
                    </script>

                    <script>
                    
                    function loadDiv(search='',page=''){
            $.ajax({
                url:'/manage-agents',
                type:'post',
                headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
    								},
                data:'search='+search+'&page='+page,
                success:function(response){
                    

                    $.each(response.data,function(index,element){

                        if(element.call_status==1)
                        {
                            spop({template:`<a href='/manage-agents'style="text-decoration:none"><h6 style="text-align:center">Incoming Call<sub>View More...</sub></h6></a>
                             </span><img src="images/call-icon2.gif" class="call-icon" style="height: 30px;"></th>
                             <div class="ml-1" style="padding:4px;border:2px solid white;display:inline-block">Caller : ${element.assigned_to_caller}<br>
                                        Source : ${element.source_number}<br>
                                        Agent : ${element.agent_destination}</div>
                                    
                          `,
                        position  : 'top-center',
                        autoclose: 10000,
                        });
                    clearInterval(stopInterval);
                    return false; 
                    }
                       
                });
                
                }
            });
            }
            if (window.location.pathname != '/manage-agents'){    
            var stopInterval=setInterval(loadDiv,4000);       
            }
               </script>

<!--delete ring group-->

<!--<script src="vendor/bootstrap/js/bootstrap.min1.js"></script> -->
