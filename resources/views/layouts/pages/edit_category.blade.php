@extends( 'layouts.master' )

@section( 'content' )
	<!-- Page Content -->
	<div class="container">
		
		@foreach ( [ 'danger', 'warning', 'success', 'info' ] as $msg )
			
			@if( Session::has( 'alert-' . $msg ) )
				
				<p class="alert alert-{{ $msg }}">{{ Session::get( 'alert-' . $msg ) }}
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				</p>
		
		@endif
	
	@endforeach
	
	<!-- Project One -->
		<div class="row">
			
			<div align="center" class="col-md-12">
				
				<h1 class="page-header">
					<small>{{ $category->name }}</small>
				</h1>
				@if ( $category->default === 1)
					
					<img class="img-responsive" src="{{ url('/images/' . $category->logo) }}" alt=""><br>
				
				@else
					
					<img class="img-responsive" src="{{ url('/storage/car_uploads/' . $category->logo) }}" alt=""><br>
				
				@endif
				
				
				<form method="post" action="{{ '/editCategory' }}" enctype="multipart/form-data">
					
					{!! csrf_field() !!}
					<input type="text" class="form-control" name="category_name" value="{{ $category->name }}"/><br>
					<input type="file" class="form-control" name="category_logo"/><br>
					<input type="hidden" name="category_id" value="{{ $category->id }}"/>
					<button type="submit" class="form-control btn btn-success">Izmeni kategoriju</button>
				
				</form>
				<br>
				
				<a href="{{ route( 'categories' ) }}"><input type="button" class="form-control btn btn-info"
				                                             value="Nazad na kategorije"></a>
			
			</div>
		
		</div>
		<!-- /.row -->
		<hr>
	
	</div>
	
	<!-- Footer -->
	@include( 'layouts.partials.footer' )

@endsection
