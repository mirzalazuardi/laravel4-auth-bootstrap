@extends('layouts.index')

@section('content')
	@if( Auth::check() )
		{{ Redirect::route('authorized.users.index') }}
	@endif

	<fieldset><h1>Login</h1></fieldset>

	<div id="pesan" class="panel panel-danger">
		<div class="panel-heading"> <h3 class="panel-title">Errors</h3> </div> <div class="panel-body">	
			@if($errors->has('email'))
				{{ $errors->first('email').'<br />' }}
			@endif
			@if ($errors->has('password'))
				{{ $errors->first('password').'<br />' }}
			@endif
			{{ Session::get('pesan') }}
		</div>
	</div>

	{{ Form::open(['url'=>'login','id'=>'myForm']) }}
		<div class="col-xs-6">
			{{ '<div id="emailGroup">'.Form::label('email', 'Email', ['class'=>'control-label']) }}
			{{ Form::text('email', null, ['class'=>'form-control','placeholder'=>'email']).'</div>' }}
			{{ '<div id="passwordGroup">'.Form::label('password', 'Password', ['class'=>'control-label']) }}
			{{ Form::password('password', ['class'=>'form-control','placeholder'=>'password']).'</div>' }}
			<br>
			{{ Form::token() }}
			{{ Form::submit('Submit', ['class'=>'btn btn-success']) }}
			{{ Form::reset('Reset', ['class'=>'btn btn-default']) }}
		</div>
	{{ Form::close() }}

@stop

@section('script')
	<!-- library -->
	{{-- HTML::script('bootstrap/javascripts/bootstrap/tooltip.js') --}}
	{{-- HTML::script('bootstrap/javascripts/bootstrap/popover.js') --}}
	<!-- END library -->

	<script type="text/javascript">
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
/* 
		// AJAX MODE
			$(document).ready(function() {
				$(':submit').click(function() {
					$.ajax({
						url: $('form').attr('action'),
						type: 'POST',
						dataType: 'json',
						data: $('form').serialize(),
						success: function(data)
						{
							$.each(data, function(fld, msg) {
								if(msg){ 
									errValidation(fld,msg); 
								} 
							});

							// yang bener ini bukan each yg diatas
							// if(data.email){ errLabel('email',data.email); } else { errLabel('email',null); }
							// if(data.password){ errLabel('password',data.password); } else { errLabel('password',null); }

							if (data.pesan=='Password Salah') {
								errAuth('pesan',data.pesan);
								resetValidation();
							} else if(data.pesan=='sukses'){
								window.location.assign('{{ URL::to("authorized/users") }}');
							}						
						}
					});
					// end ajax
					return false;
				});
				// end submit clicked 
			});
			// end doc ready
		// END AJAX MODE
*/
	</script>
@stop