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
					<small>Novi oglas</small>
				</h1>
			
			</div>
			<br>
			
			<div class="col-md-6">
				
				<form method="post" action="{{ '/saveCar' }}" enctype="multipart/form-data">
					
					{!! csrf_field() !!}
					
					<div class="form-group required">
						
						<label>Kategorija: </label>
						<select class="form-control" name="car_category_id">
							<option value="">Izaberite kategoriju...</option>
							
							@foreach ( $categories as $category )
								
								@if ( \Illuminate\Support\Facades\Input::old('car_category_id') == $category->id )
									
									<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
								
								@else
									
									<option value="{{ $category->id }}">{{ $category->name }}</option>
								
								@endif
							
							@endforeach
						</select><br>
					
					</div>
					
					<div class="form-group required">
						
						<label>Naziv automobila: </label>
						<input type="text" class="form-control" name="car_name"
						       placeholder="Unesite naziv automobila..." value="{{ old( 'car_name' ) }}"/><br>
					
					</div>
					
					<div class="form-group required">
						
						<label>Cena (u evrima): </label>
						<input type="text" class="form-control" name="car_price"
						       placeholder="Unesite cenu automobila..." value="{{ old( 'car_price' ) }}"/><br>
					
					</div>
					
					<div class="form-group required">
						
						<label>Godište: </label>
						<select class="form-control" name="car_year_id">
							<option name="car_year" value="">Izaberite godinu proizvodnje...</option>
							@for ( $i = 1980; $i <= 2018; $i++ )
								
								@if ( \Illuminate\Support\Facades\Input::old('car_year_id') == $i )
									
									<option value="{{ $i }}" selected>{{ $i }}</option>
								
								@else
									
									<option value="{{ $i }}">{{ $i }}</option>
								
								@endif
							
							@endfor
						</select><br>
					
					</div>
					
					<div class="form-group required">
						
						<label>Kilometraza: </label>
						<input type="text" class="form-control" name="car_km"
						       placeholder="Unesite pređenu kilometražu..." value="{{ old( 'car_km' ) }}"/><br>
					
					</div>
					
					<div class="form-group required">
						
						<label>Slika: </label>
						<input type="file" class="form-control" name="car_image" value="{{ old( 'car_image' ) }}"/><br>
					
					</div>
					
					<div class="form-group">
						
						<label>Opis:</label>
						<textarea class="form-control" name="car_description" rows="5" placeholder="Upisite opis..."
						          maxlength="300">{{ \Illuminate\Support\Facades\Input::old( 'car_description' ) }}</textarea><br>
					
					</div>
					
					<button type="submit" class="form-control btn btn-success">Postavi oglas</button>
				
				</form>
			
			</div>
			
			<div class="col-md-6">
				<br><br><br>
				
				@foreach ( $categories as $key => $category )
					
					<div class="col-md-{{ 12 / $loop->count }}">
						
						@if ( $category ->default == 0 )
							<a href="#" class="disableCoverPhoto">
								<img class="img-responsive"
								     src="{{ url( '/storage/car_uploads/' .$category->logo ) }}"
								     alt="">
							</a>
						@else
							<a href="#" class="disableCoverPhoto">
								<img class="img-responsive"
								     src="{{ url('/images/' . $category->logo) }}"
								     alt="">
							</a>
						@endif
					
					</div>
				
				@endforeach
			</div>
		
		</div>
		<!-- /.row -->
		
		<hr>
	</div>
	
	<!-- Footer -->
	@include('layouts.partials.footer')

@endsection