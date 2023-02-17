<style>
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
</style>


<div class="card-container">
 <div class="card" style="width: 30rem;">
     <div class="card-img-caption">
     <div class="card-text card-text-header"><i class="fa fa-users"></i><br>31</div>
      <img class="card-img-top" src="../images/sub1.jpeg" alt="Card image cap">
     </div>
  <div class="card-body">
   <h2 class="card-title">Total Clients</h2>
    <a href="#" class="card-link">View More <i class="fa fa-arrow-right" aria-hidden="true"></i>
</a>
  </div>
</div>
<div class="card" style="width: 30rem;">
        <div class="card-img-caption">
            <div class="card-text card-text-header"><i class="fa fa-envelope"></i><br>6432</div>
            <img class="card-img-top" src="../images/sub3.jpeg" alt="Card image cap">
        </div>
  <div class="card-body">
    <h2 class="card-title">Messages sent</h2>
    <a href="#" class="card-link">View More <i class="fa fa-arrow-right" aria-hidden="true"></i>
</a>
  </div>
</div>
<div class="card" style="width: 30rem;">
    <div class="card-img-caption">
            <div class="card-text card-text-header"><i class="fa fa-phone"></i><br>987</div>
            <img class="card-img-top" src="../images/sub2.jpg" alt="Card image cap">
    </div>
  <div class="card-body">
    <h2 class="card-title">Phone calls made</h2>
    <a href="#" class="card-link">View More <i class="fa fa-arrow-right" aria-hidden="true"></i>
</a>
  </div>
</div>
</div>
<div class="chart-container">
    <div style="width:100%; height:50%">
		<canvas id="canvas"></canvas>
	</div>
</div>
<div class="msg-container">
    <div class="msg-box">
        <span><h3><i class="fa fa-hand-o-right"></i> Unsolved Tickets</h3>
        </span>
   <ul>
       <li><a href="#">#OX005 | Not getting calls</a></li>
       <li><a href="#">#OX007 | Login Not Working</a></li>
       <li><a href="#">#OX012 | Can't create client</a></li>
       <li><a href="#">#OX015 | Credit still not updated</a></li>
       <li><a href="#">#OX035 | Login Not Working</a></li>
       <li><a href="#">#OX005 | Not getting calls</a></li>
       <li><a href="#">#OX007 | Login Not Working</a></li>
       <li><a href="#">#OX012 | Can't create client</a></li>
       <li><a href="#">#OX015 | Credit still not updated</a></li>
       <li><a href="#">#OX035 | Login Not Working</a></li>
       <br><a href="#">View More...</a>
   </ul>
    </div>
    <div class="msg-box">
        <span><h3><i class="fa fa-hand-o-right"></i> Recent Messages</h3>
        </span>
        <ul>
       
       
   </ul>
    </div>
</div>