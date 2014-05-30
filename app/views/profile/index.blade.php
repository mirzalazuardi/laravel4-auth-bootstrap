@extends('layouts.index')

@section('content')
	<h1>Profile Area</h1>
	<p>Hallo ,{{ Auth::user()->username }} !</p>
	

	<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	    Menu <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" role="menu">
	    <li>{{ link_to('profile/change_password','ganti password') }} </li>
		<li>{{ link_to('profile/edit','ganti data profil') }}</li>	    
	  </ul>
	</div>
	<br> <br> <br> <br>
@stop

@section('script')
	<script type="text/javascript">
		//nothing
	</script>
@stop