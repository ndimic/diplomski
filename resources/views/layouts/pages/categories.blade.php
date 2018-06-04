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
			
			@if ( Session::has( 'alert-' . $msg ) )
				
				<p class="alert alert-{{ $msg }}">{{ Session::get( 'alert-' . $msg ) }}
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				</p>
		
		@endif
	
	@endforeach
	
	<!-- Page Heading -->
		<div class="row">
			
			<div align="center">
				
				<h1 class="page-header">
					<small>Kategorije</small>
				</h1>
			
			</div>
		
		</div>
		<!-- /.row -->
		
		<!-- Project One -->
		<div class="row">
			
			@foreach ( $categories as $category )
				
				<div align="center" class="col-md-6">
					
					<h1 class="page-header">
						<small>{{ $category->name }}</small>
					</h1>
					
					@if ( $category->default === 0 )
						<img class="img-responsive" style="width: 70px;"
						     src="{{ url( '/storage/car_uploads/' . $category->logo ) }}"
						     alt="">
					@else
						<img class="img-responsive" style="width: 70px;"
						     src="{{ url( '/images/' . $category->logo ) }}"
						     alt="">
					@endif
					
					<br>
					
					<a href="{{ route( 'edit_category', $category->id ) }}">
						<button type="submit" class="form-control" style="color:darkgoldenrod;">Izmeni kategoriju
						</button>
					</a>
				</div>
			
			@endforeach
			
			<div class="col-md-12">
				
				<h1 class="page-header">
					
					<small>Nova kategorija</small>
				
				</h1>
			
			</div>
			<br>
			
			<div class="col-md-6">
				
				<form method="post" action="{{ route( 'add_category' ) }}" enctype="multipart/form-data">
					
					{!! csrf_field() !!}
					
					<div class="form-group required">
						
						<label>Naziv kategorije: </label>
						<input type="text" name="category_name" class="form-control"
						       value="{{ old( 'category_name' )}}"/><br>
					
					</div>
					
					<div class="form-group required">
						
						<label>Logo kategorije: </label>
						<input type="file" name="category_logo" class="form-control"/><br>
					
					</div>
					
					<button type="submit" class="form-control" style="color: green;">Dodaj kategoriju</button>
				
				</form>
			
			</div>
		
		</div>
		<!-- /.row -->
		<hr>
	
	</div>
	
	<!-- Footer -->
	@include('layouts.partials.footer')

@endsection
