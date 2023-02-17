<!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13" style="bottom:0;position:fixed">2018 © <b>Arun</b></div>

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
    <script src="../assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendors/popper.js/dist/umd/popper.min.js"></script>
	{{-- <script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script> --}}
	{{-- <script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> --}}
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <script src="../assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/vendors/jquery-idletimer/dist/idle-timer.min.js"></script>
    <script src="../assets/vendors/toastr/toastr.min.js"></script>
    <script src="../assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="../assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="../assets/vendors/chart.js/dist/Chart.min.js"></script>
    <script src="../assets/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- CORE SCRIPTS-->


	<script src="../assets/vendors/select2/dist/js/select2.full.min.js"></script>
	<script src="../assets/vendors/jquery-ui/jquery-ui.min.js"></script>
	<script src="../assets/js/app.min.js"></script>
	<script src="../assets/vendors/spop/spop.min.js"></script>





    <script src="pass.js"></script>

    <!-- PAGE LEVEL SCRIPTS-->
    <script src="../assets/js/scripts/dashboard_visitors.js"></script>


	<!--obd credit-->
		<script>
		$(document).ready(function(){
			$(".tab-content").on('click','a#obdpulse',function(){
				let modalid=$(this).attr('data-target');
				$(modalid).modal();
			});
		});
		</script>
	<!--obd credit-->

	<!--sms credit-->
		<script>
		$(document).ready(function(){
			$(".tab-content").on('click','a#smscredit',function(){
				let modalid=$(this).attr('data-target');
				$(modalid).modal();
			});
		});
		</script>
	<!--sms credit-->
	<!--add validity-->
		<script>
		$(document).ready(function(){
			$(".tab-content").on('click','a#addvalidity',function(){
				let modalid=$(this).attr('data-target');
				$(modalid).modal();
			});
		});
		</script>
	<!--add validity-->
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
	<!--hold user account-->
<!--add credit-->
		<script>
		$(document).ready(function(){
			$("#append").on('click','a#credit',function(e){
                e.preventDefault();
                let modalid=$(this).attr('data-target');
				$(modalid).modal();
			});
		});
		</script>
	<!--add credit-->
	<!--add validity in list did-->
		<script>
		$(document).ready(function(){
			$("#append").on('click','a#validity',function(e){
                e.preventDefault();
                let modalid=$(this).attr('data-target');
				$(modalid).modal();
			});
		});
		</script>
	<!--add validity in list did-->

			<!--renew plan-->
		<script>
		$(document).ready(function(){
			$("#append").on('click','a#renewplan',function(e){
                e.preventDefault();
                let modalid=$(this).attr('data-target');
				$(modalid).modal();
			});
		});
		</script>
	<!--renew plan-->

	<!--hold user account-->
		<script>
		$(document).ready(function(){
			$("#append").on('click','a#didhold',function(e){
                e.preventDefault();
                let modalid=$(this).attr('data-target');
				$(modalid).modal();
			});
		});
		</script>
	<!--hold user account-->

	<!-- tooltip -->
	<script>
        $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

