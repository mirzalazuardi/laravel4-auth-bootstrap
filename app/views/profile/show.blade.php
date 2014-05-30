@extends('layouts.index')

@section('content')
	<h1>Data User </h1>
	<div id="pesan" class="panel panel-info">
		<div class="panel-heading"> <h3 class="panel-title">Info</h3> </div> <div class="panel-body">	
			{{ Session::get('pesan') }}
		</div>
	</div>
	
	{{ Form::model( $user ) }}
			{{ Form::label('username', 'Username') }}
			{{ '<p class="form-control-static">'.$user->username.'</p><br />' }}
			{{ Form::label('email', 'Email') }}
			{{ '<p class="form-control-static">'.$user->email.'</p><br />' }}
			<br>
	{{ Form::close() }}
			{{ link_to('profile/edit','Rubah',['role'=>'button','class'=>'btn btn-primary']) }} 
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