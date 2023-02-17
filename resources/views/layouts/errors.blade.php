@if($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach($errors->all() as $error )
 		<li>{{$error}}</li>
 		@endforeach
 	</ul>
 </div>
@endif

@if(session()->has('success'))
    <div style="background-color:#81c05d">
      <span><i class="fa fa-check" aria-hidden="true"></i>
          {{ session()->get('success') }}</span>
    </div>
@endif