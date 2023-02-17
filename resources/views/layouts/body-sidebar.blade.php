<aside id="sidebar-right" class="sidebar-right">
    <div class="nano">
        <div class="nano-content">
            <a href="#" class="mobile-close visible-xs">
                Collapse <i class="fa fa-chevron-right"></i>
            </a>

            <div class="sidebar-right-wrapper">

                <div class="sidebar-widget widget-calendar" id="c2c">
                    <h6>Click to Call</h6><br>
                <input class="form-control" id="c2c_mobile" style="background-color:black;color:#006494;font-weight:bolder;letter-spacing:2px;" data-plugin-maxlength="" maxlength="12" required autofocus="autofocus"><br>
                    <div class="keypad" style="padding-left:6px;">
                        <div class="keys" v-on:click="keyvalue($event)">1</div>
                        <div class="keys" v-on:click="keyvalue($event)">2</div>
                        <div class="keys" v-on:click="keyvalue($event)">3</div>
                        <div class="keys" v-on:click="keyvalue($event)">4</div>
                        <div class="keys" v-on:click="keyvalue($event)">5</div>
                        <div class="keys" v-on:click="keyvalue($event)">6</div>
                        <div class="keys" v-on:click="keyvalue($event)">7</div>
                        <div class="keys" v-on:click="keyvalue($event)">8</div>
                        <div class="keys" v-on:click="keyvalue($event)">9</div>
                        <div class="keys" v-on:click="c2c_delete()">&larr;</div>
                        <div class="keys" v-on:click="keyvalue($event)">0</div>
                        <div class="keys" v-on:click="c2c_empty()">C</div>
                      </div><br>
                      <select class="form-control input-sm" style="color:white;background-color:#000000" name="c2c_agent" required>
                          <option value="" selected>Select Agent</option>
                      </select>
                      <br>
                      <button class="btn btn-success btn-lg c2c_button" style="width:90%;margin-left:5%"><i class="fa fa-phone"></i></button>


                </div>



            </div>
        </div>
    </div>
</aside>

<script>
var vm=new Vue({
  el: '#c2c',
  methods:{
      keyvalue:function(value){
          var keyvalue=value.target.innerHTML;
          document.getElementById('c2c_mobile').value+=keyvalue;
      },
      c2c_empty:function(){
        document.getElementById('c2c_mobile').value='';
      },
      c2c_delete:function(){
          var c2c_value=document.getElementById('c2c_mobile').value;
        document.getElementById("c2c_mobile").value=c2c_value.substring(0,c2c_value.length-1);
      }
  }
});
</script>

