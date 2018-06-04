@extends( 'layouts.master' )

@section( 'content' )
	
	<!-- Page Content -->
	<div class="container">
	
	@if ( count( $cars ) )
		
		<!-- Page Heading -->
			<div class="row">
				
				<div class="col-lg-12">
					
					<h2 class="page-header">Moji oglasi
						<small></small>
					</h2>
				
				</div>
			
			</div>
			<!-- /.row -->
		
		@foreach ( $cars as $car )
			
			<!-- Project One -->
				<div class="row">
					
					<div class="col-md-6">
						
						<a href="{{ 'edit/ad/' .$car->id }}">
							
							@if ( $car->default == 0 )
								<img style="height: 275px !important;" class="img-responsive"
								     src="{{ url( '/storage/car_uploads/' .$car->image ) }}"
								     alt="">
							@else
								<img style="height: 275px !important;" class="img-responsive"
								     src="{{ url( '/images/' .$car['image'] ) }}"
								     alt="">
							@endif
						
						</a>
					
					</div>
					
					<div class="col-md-6">
						
						<h3 align="center">Naziv automobila: </h3><h5 align="center">{{ $car->name }}</h5>
						<h3 align="center">Cena: </h3><h5 align="center">{{ $car->price }} €</h5>
						<h3 align="center">Godište: </h3><h5 align="center">{{ $car->year }}. godište</h5>
						<h3 align="center">Kilometraza: </h3><h5 align="center">{{ $car->km }} km.</h5>
						
						@if ( $car->created_at->diffInMinutes() > 60 && $car->created_at->diffInHours() < 24 )
							
							<h3 align="center" class="border" style="background-color: #fff; color: black;">Postavljeno:
								pre {{ $car->created_at->diffInHours() }} sata.</h3>
						
						@elseif ( $car->created_at->diffInHours() > 24 )
							
							<h3 align="center" class="border" style="background-color: #fff; color: black;">Postavljeno:
								pre {{ $car->created_at->diffInDays() }} dana.</h3>
						
						@else
							
							<h3 align="center" class="border" style="background-color: #fff; color: black;">Postavljeno:
								pre {{ $car->created_at->diffInMinutes() }} minuta.</h3>
						
						@endif
						
						@if ( $car->status )
							
							<h3 align="center">Status: </h3><h5 align="center" style="color: forestgreen;">Odobren</h5>
						
						@else
							
							<h3 align="center">Status: </h3><h5 align="center" style="color: red;">Neodobren (čeka se
								obrada admina)</h5>
						
						@endif
					
					</div>
				
				</div>
				
				<!-- /.row -->
				
				<hr>
			
			@endforeach
		
		@else
			
			<div align="center" class="col-md-12">
				
				<h3>Nemate svojih oglasa. <a href="{{ route( 'add_car' ) }}">Postavite Vaš prvi oglas</a> i zaradite.
				</h3>
			
			</div>
		
		@endif
	
	</div>
	
	<!i-- Pagination -->
	<div class="row text-center">
		
		<div class="col-lg-12">
			
			{{ $cars->links() }}
		
		</div>
	
	</div>
	
	<!-- Footer -->
	@include( 'layouts.partials.footer' )

@endsection