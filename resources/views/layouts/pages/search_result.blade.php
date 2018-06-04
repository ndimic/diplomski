@extends( 'layouts.master' )

@section( 'content' )
	
	<!-- Page Content -->
	<div class="container">
	
	@if ( count($cars) )
		<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Oglasi
						<small>Polovni automobili</small>
					</h1>
				</div>
			</div>
			<!-- /.row -->
			
			
			
			<!-- Car -->
			<div class="row">
				
				<div class="col-md-4">
					
					@foreach ( $cars as $car )
						
						<a href="{{ route( 'car_details', $car->id ) }}">
							
							@if ( $car->default == 0 )
								<img class="img-responsive" src="{{ url( '/storage/car_uploads/' . $car->image ) }}"
								     alt="">
							@else
								<img class="img-responsive" src="{{ url( '/images/' . $car[ 'image' ] ) }}"
								     alt="">
							@endif
						
						</a>
						
						<br><br><br>
					
					@endforeach
				
				</div>
				
				<div class="col-md-4">
					
					@foreach ( $cars as $car )
						
						<h3 align="center" class="border">{{ $car->name }}</h3>
						<h3 align="center" class="border"
						    style="background-color: orange; color: #fff;">{{ $car->price }}
							€</h3>
						<h3 align="center" class="border" style="background: #5aa700; color: #fff;">{{ $car->year }}.
							godište</h3>
						<div align="center">
							<img class="img-responsive" style="width: 70px;"
							     src="{{ url( '/images/' . $car->category[ 'logo' ] ) }}" alt="">
						</div>
						
						<br><br><br>
					
					@endforeach
				
				</div>
				
				<div class="col-md-4">
					
					<h3 align="center" class="border">Filter</h3>
					
					<form method="post" action="{{ '/cars-results' }}">
						
						{!! csrf_field() !!}
						
						<select class="form-control" id="search_category_id" name="category">
							
							<option value="0">Izaberite katergoriju...</option>
							
							@foreach ( $categories as $category )
								
								<option value="{{ $category->id }}">
									{{ $category->name }}
								</option>
							
							@endforeach
						
						</select><br>
						
						<input class="form-control" placeholder="Cena do" type="number" name="price"/><br>
						
						<select class="form-control" name="car_year_from">
							
							<option value="">Godiste od</option>
							
							@for ( $i = 1980; $i <= 2018; $i++ )
								<option value="{{ $i }}">{{ $i }} god.</option>
							@endfor
						
						</select><br>
						
						<select class="form-control" name="car_year_to">
							
							<option value="">Godiste do</option>
							
							@for ( $i = 1980; $i <= 2018; $i++ )
								<option value="{{ $i }}">{{ $i }} god.</option>
							@endfor
						
						</select><br>
						
						<button type="submit" id="searchCar" class="form-control">Pretraži</button>
					
					</form>
				
				</div>
			
			</div>
			
			<hr>
	
	
	@else
		
		<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 align="center" class="page-header">
						<small>Nema pronadjenih oglasa.</small>
					</h1>
					<h4 align="center"><a href="{{ route('cars') }}">Vratite se na oglase</a></h4>
				</div>
			</div>
			<!-- /.row -->
		
		@endif
	</div>
	
	<!-- Footer -->
	@include( 'layouts.partials.footer' )

@endsection