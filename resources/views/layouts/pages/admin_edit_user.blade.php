@extends( 'layouts.master' )

@section( 'content' )
	<!-- Page Content -->
	<div class="container">
		
		@if ( $errors->any() )
			
			<div class="alert alert-danger">
				
				<ul>
					
					@foreach ( $errors->all() as $error )
						<li>{{ $error }}</li>
					@endforeach
				
				</ul>
			
			</div>
		
		@endif
		
		@foreach ( [ 'danger', 'warning', 'success', 'info' ] as $msg )
			
			@if( Session::has( 'alert-' . $msg ) )
				
				<p class="alert alert-{{ $msg }}">{{ Session::get( 'alert-' . $msg ) }}
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				</p>
		
		@endif
	
	@endforeach
	
	<!-- Add car form -->
		<div class="row">
			
			<div class="col-md-12">
				
				<h1 class="page-header">
					<small>Profil</small>
				</h1>
			
			</div>
			<br>
			
			<div class="col-md-6">
				
				<form method="post" action="{{ '/editUser' }}" enctype="multipart/form-data">
					
					{!! csrf_field() !!}
					
					<div class="form-group required">
						
						<label>Ime: </label>
						<input type="text" class="form-control" name="name"
						       placeholder="Unesite Vase ime" required value="{{ $user->name }}"/><br>
					
					</div>
					
					<div class="form-group required">
						
						<label>Email: </label>
						<input type="text" class="form-control" name="email"
						       placeholder="Unesite Vas email" required value="{{ $user->email }}"/><br>
					
					</div>
					
					<div class="form-group">
						
						<label>Broj telefona: </label>
						<input type="text" class="form-control" name="phone"
						       placeholder="Unesite broj telefona" value="{{ $user->phone }}"/><br>
					
					</div>
					
					<input type="hidden" name="user_id" value="{{ $user->id }}">
					
					<button type="submit" class="form-control btn btn-success">Sačuvaj</button>
				
				</form>
			
			</div>
		
		</div>
		<!-- /.row -->
		
		<hr>
	</div>
	
	<!-- Footer -->
	@include('layouts.partials.footer')

@endsection