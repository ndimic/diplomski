@extends( 'layouts.master' )

@section( 'content' )
	<!-- Page Content -->
	<div class="container">
		
		
		<!-- Project One -->
		
		@foreach ( [ 'danger', 'warning', 'success', 'info' ] as $msg )
			@if(Session::has('alert-' . $msg))
				<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				</p>
			@endif
		@endforeach
		
		<div class="col-md-12">
			<div align="left">
				<h1 class="page-header">Korisnici
					<small>Polovni automobili</small>
					<div align="right">
						<a href="{{ route( 'admin_new_user' ) }}"><input type="button" class="btn btn-success"
						                                                 value="Dodaj novog korisnika"></a>
					</div>
				</h1>
			</div>
		</div>
		<br>
		
		@if ( count( $users ) )
			
			<div class="table-responsive col-md-12">
				
				<table class="table">
					<thead>
					<tr>
						<th>#</th>
						<th>Ime</th>
						<th>Email</th>
						<th>Telefon</th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					
					@foreach( $users as $user )
						
						<tbody>
						<tr>
							<td>{{ $user->id }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->phone }}</td>
							<td><a href="{{ '/adminEditUser/' . $user->id }}"><input type="button" class="btn btn-info"
							                                                         value="Izmeni"></a></td>
							<td><a href="{{ '/deleteUser/' . $user->id }}"><input type="button" class="btn btn-danger"
							                                                      value="Izbrisi"></a></td>
						</tr>
						</tbody>
					
					@endforeach
				
				</table>
			
			</div>
			<!-- /.row -->
			
			<!-- Pagination -->
			{{--<div class="row text-center">
				
				<div class="col-lg-12">
					
					{{ $users->links() }}
				
				</div>
			
			</div>--}}
		<!-- /.row -->
		
		@endif
		
		<hr>
	</div>
	
	<!-- Footer -->
	@include( 'layouts.partials.footer' )


@endsection