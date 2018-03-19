@extends( 'layouts.master' )

@section( 'content' )
	
	<!-- Project Five -->
	<div class="row">
		
		<div align="center" class="col-md-12">
			
			<img class="img-responsive" src="{{ url( '/images/' . $car->image ) }}"
			     alt="">
		
		</div>
	
	</div>
	
	<hr>
	
	<!-- Footer -->
	@include( 'layouts.partials.footer' )

@endsection