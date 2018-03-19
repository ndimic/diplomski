@extends( 'layouts.master' )

@section( 'content' )
	<!-- Page Content -->
	<div class="container">
	
	@if ( count( $cars ) )
		
		<!-- Project One -->
			<div class="row">
				
				@foreach ( [ 'danger', 'warning', 'success', 'info' ] as $msg )
					@if(Session::has('alert-' . $msg))
						<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</p>
					@endif
				@endforeach
				
				<div class="col-md-12">
					<h1 class="page-header">Oglasi
						<small>Polovni automobili</small>
					</h1>
				</div>
				<br>
				
				@foreach( $cars as $car )
				
				<!-- Car item -->
					<div class="row">
						
						<div class="col-md-6">
							<a href="{{ 'car/' . $car->id }}">
								
								@if ( $car->default == 0 )
									<img class="img-responsive" src="{{ url( '/storage/car_uploads/' .$car->image ) }}"
									     alt="">
								@else
									<img class="img-responsive" src="{{ url( '/images/' .$car->image ) }}"
									     alt="">
								@endif
							
							</a>
						</div>
						
						<div class="col-md-6">
							<h3 align="center" class="border"
							    style="background-color: #fff; color: black;">{{ $car->price }} €</h3>
							<h3 align="center" class="border" style="background: #fff; color: black;">{{ $car->year }}.
								godište</h3>
							<h3 align="center" class="border"
							    style="background-color: #fff; color: black;">{{ $car->km }}
								km.</h3>
							
							@if ( $car->created_at->diffInMinutes() > 60 && $car->created_at->diffInHours() < 24 )
								
								<h3 align="center" class="border" style="background-color: #fff; color: black;">
									Postavljeno:
									pre {{ $car->created_at->diffInHours() }} sata.</h3>
							
							@elseif ( $car->created_at->diffInHours() > 24 )
								
								<h3 align="center" class="border" style="background-color: #fff; color: black;">
									Postavljeno:
									pre {{ $car->created_at->diffInDays() }} dana.</h3>
							
							@else
								
								<h3 align="center" class="border" style="background-color: #fff; color: black;">
									Postavljeno:
									pre {{ $car->created_at->diffInMinutes() }} minuta.</h3>
							
							@endif
							
							<h3 align="center" class="border" style="background-color: #fff; color: black;">Broj
								oglasa: {{ $car->id }}</h3>
							
							<h3 align="center" class="border" style="background-color: #fff; color: black;">Oglas
								postavio: {{ $car->user->name }} (ID: {{ $car->user->id }})</h3><br><br>
							
							@if ( $car->status == 0 )
								
								<form method="post" action="{{ '/approveCar' }}">
									{!! csrf_field() !!}
									<input type="hidden" name="approve_car_id" value="{{ $car->id }}"/>
									<button type="submit" class="form-control" style="color:#fff; background: #3c763d">
										Odobri oglas
									</button>
								</form>
							
							@else
								
								<br>
								<form method="post" action="{{ '/deleteCar' }}">
									{!! csrf_field() !!}
									<input type="hidden" name="delete_car_id" value="{{ $car->id }}"/>
									<button type="submit" class="form-control" style="color:#fff; background: #a94442">
										Ukloni oglas
									</button>
								</form>
							
							@endif
						</div>
					
					</div>
					<!-- /.row -->
					
					<hr>
				
				@endforeach
			</div>
			<!-- /.row -->
			
			<!-- Pagination -->
			<div class="row text-center">
				
				<div class="col-lg-12">
					
					{{ $cars->links() }}
				
				</div>
			
			</div>
			<!-- /.row -->
		
		@else
			
			<div class="col-md-12">
				<h1 class="page-header">
					<small>Trenutno nema dostupnih oglasa.</small>
				</h1>
			</div>
		
		@endif
		
		<hr>
	</div>
	
	<!-- Footer -->
	@include( 'layouts.partials.footer' )


@endsection