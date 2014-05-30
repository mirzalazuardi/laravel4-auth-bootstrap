@extends('layouts.index')

@section('content')
	<h1>Rubah Password </h1>
	
	<div id="pesan" class="panel panel-danger">
		<div class="panel-heading"> <h3 class="panel-title">Errors</h3> </div> <div class="panel-body">	
			@if ($errors->has('password_old'))
				{{ $errors->first('password_old').'<br />' }}
			@endif
			@if ($errors->has('password'))
				{{ $errors->first('password').'<br />' }}
			@endif
			@if ($errors->has('password_again'))
				{{ $errors->first('password_again').'<br />' }}
			@endif
			{{ Session::get('pesan') }}
		</div>
	</div>

	
	{{ Form::model( $user, ['method' => 'POST','url' => 'profile/change_password' ] ) }}
			{{ Form::label('username', 'Username') }}
			{{ '<p class="form-control-static">'.$user->username.'</p><br />' }}
			{{ Form::label('password_old', 'Password lama') }}
			{{ Form::password('password_old', ['class'=>'form-control','placeholder'=>'password']) }}
			{{ Form::label('password', 'Password baru') }}
			{{ Form::password('password', ['class'=>'form-control','placeholder'=>'password']) }}
			{{ Form::label('password_again', 'Ketik lagi password baru nya ') }}
			{{ Form::password('password_again', ['class'=>'form-control','placeholder'=>'password']) }}
			<br>
			{{ Form::submit('Submit', ['class'=>'btn btn-success','id'=>'submit']) }}
			{{ Form::reset('Reset', ['class'=>'btn btn-default','id'=>'reset']) }}
	{{ Form::close() }}
	<br>
@stop

@section('script')
	<script type="text/javascript">
		//nothing
		//initiate var
		var txtFlds = $('.form-control');
		//END initiate var

		//intiate function
		function resetValidation(){
			$.each(txtFlds, function(idx, fattr) {
				errValidation(fattr.name,null); 
			});
		}
		function errAuth(divmsg,dataerr) {
			if(dataerr!=null)
			{
				$('#'+divmsg).show();
				$('.panel-body').html(dataerr);
			} else {
				$('#'+divmsg).hide();
				$('.panel-body').html('');
			}
		} 
		function errValidation(field,dataerr) {
			var Camelcase = field.replace(/^[a-z]/, function(m){ return m.toUpperCase() });
			var field = field.toLowerCase();
			if(dataerr!=null)
			{
				//// $('label[for='+field+']').html(Camelcase+'<label for="" class="label label-danger">'+dataerr+'</label>');
				// $('input[name='+field+']').popover({content:dataerr, trigger:'focus', delay: { show: 500, hide: 100 }});
				$('#'+field+'Group').addClass('form-group has-error');
			} else {
				//// $('label[for='+field+']').html(Camelcase);
				// $('input[name='+field+']').popover({content:''});
				$('#'+field+'Group').removeClass('form-group has-error');
			}
		}
		//END intiate function

		// NONAJAX MODE
			$('#pesan').hide();
			var isErr = $('.panel-body').html().trim();
			if(isErr!='') { $('#pesan').show(); }

			$(':reset').click(function(){
				resetValidation();
				errAuth('pesan',null);
				$('#pesan').hide();
			});
			// end reset clicked		
		// END NONAJAX MODE
	</script>
@stop