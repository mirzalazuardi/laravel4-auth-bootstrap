@extends('layouts.index')

@section('content')
	<h1>Data Users </h1>
	{{ link_to_route('authorized.users.create','tambah',null,['class'=>'btn btn-info','role'=>'button']) }}
	<br><br>
	{{ '<p>Hallo,'.Auth::user()->username.' !</p>' }}
	@if (count($users)===0)
		<p>Data kosong</p>
	@else
		<div class="table-responsive">
		<table class="table">
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th></th>
		</tr>
		@foreach ($users as $user) 
			<tr>
				<td>{{ $user->username }}</td>
				<td>{{ $user->email }}</td>
				<td>		
					{{ Form::open( ['route'=>['authorized.users.destroy',$user->id],'method'=>'DELETE'] ) }} 
						{{ Form::submit('Hapus', ['class'=>'btn btn-danger']).
						link_to_route('authorized.users.edit','Rubah',$user->id,['class'=>'btn btn-primary']) }} 
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach		
		</table>
		</div>
	@endif

	{{ $users->links() }}
@stop

@section('script')
	<script type="text/javascript">
		//nothing
	</script>
@stop