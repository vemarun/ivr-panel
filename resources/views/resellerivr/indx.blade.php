<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Resellers IVR | Dashboard</title>
    <style>
        .card-container{
            display:flex;
            justify-content:space-around;
        }
        .card-img-caption {
                          border-top-left-radius: calc(.25rem - 1px);
                          border-top-right-radius: calc(.25rem - 1px);
                        }
  
        .card-img-caption .card-img-top {
                              z-index: 0;
                            }

            .card-img-caption .card-text {
              text-align: center;
              width: 100%;
              margin: 16% 0;
              position: absolute;
              z-index: 1;
            }
        .card-text{
            font-weight:bolder;
            color:white;
        }
        .card-text-header{
            font-weight:bolder;
            color:white;
            font-size:300%;
        }
        .card-body{
            background-color:#dd7722;
        }
        .chart-container{
            display:flex;
            justify-content:space-between;
        }
        .msg-container{
            display:flex;
            height:100%;
            justify-content:space-around;
        }
        .msg-box{
            color: white;
            width:40%;
            border:1px solid #dd7722;
            background-image:url(../images/sub1.jpeg);
            
        }
        .msg-box a{
            color: #f8b379;
            font-weight:bold;
        }
    </style>
    
	
    @include('resellerivr.layouts.header')
        <!-- START SIDEBAR-->
     @include('resellerivr.layouts.side-header')
        <!-- END SIDEBAR-->
        <div class="wrapper content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
			     <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Welcome To Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/resellerivr"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Dashboard</li>
                </ol>
            </div>
            @include('resellerivr.dashboard-body')
            
				
				
			@include('resellerivr.layouts.footer')
         <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
          <script>
           var speedCanvas = document.getElementById("canvas");

            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;

            var speedData = {
              labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July"],
              datasets: [{
                label: "Sales",
                data: [0, 59, 75, 20, 20, 55, 40],
                fill:true,
                backgroundColor:'#F68C34' ,
              }]
            };

            var chartOptions = {
              legend: {
                display: true,
                position: 'bottom',
                labels: {
                  boxWidth: 80,
                  fontColor: 'black'
                }
              },
                scales: {
                    xAxes: [{
                                gridLines: {
                                    display:false
                                }
                            }],
                    yAxes: [{
                                gridLines: {
                                    display:false,
                                    drawBorder: false,
                                },
                        ticks: {
                                    display: false
                                },
                            }]
                        },
            }

            var lineChart = new Chart(speedCanvas, {
              type: 'line',
              data: speedData,
              options: chartOptions
            });
              </script>	
            
</body>


</html>