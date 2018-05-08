@extends('layouts.master')

@section('content')
	
	<!-- Page Content -->
	<div class="container">
		
		@foreach ( [ 'danger', 'warning', 'success', 'info' ] as $msg )
			
			@if( Session::has( 'alert-' . $msg ) )
				
				<p class="alert alert-{{ $msg }}">{{ Session::get( 'alert-' . $msg ) }}
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				</p>
			
			@endif
		
		@endforeach
	
	<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">{{ $car->name }}
					<small></small>
				</h1>
			</div>
		</div>
		<!-- /.row -->
		
		<!-- Project One -->
		<div class="row">
			
			<div class="col-md-5">
				<a href="#">
					
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
			
			<div class="col-md-4">
				<h3 align="center" class="border" style="background-color: orange; color: #fff;">{{ $car->price }}€</h3>
				<h3 align="center" class="border" style="background: #5aa700; color: #fff;">{{ $car->year }}.
					godište</h3>
				<h3 align="center" class="border" style="background-color: #29aade; color: #fff;">{{ $car->km }}km.</h3>
				
				<h3 align="center" class="border" style="background-color: #2a91af; color: #fff;">Postavljeno:
					
					@if ( $car->created_at->diffInMinutes() > 60 && $car->created_at->diffInHours() < 24 )
						
						pre {{ $car->created_at->diffInHours() }} sata.
					
					@elseif ( $car->created_at->diffInHours() > 24 )
						
						pre {{ $car->created_at->diffInDays() }} dana.
					
					@else
						
						pre {{ $car->created_at->diffInMinutes() }} minuta.
					
					@endif
				
				</h3>
				
				<h3 align="center" class="border" style="background-color: #575757; color: #fff;">Broj
					oglasa: #{{ $car->id }}</h3>
				<h3 align="center" class="border" style="background-color: #fff; color: black;">Oglas
					postavio: {{ $car->user->name }} </h3>
				@if ( $car->user->phone )
					<h3 align="center" class="border" style="background-color: #fff; color: black;">Kontakt telefon:
						<i> {{ $car->user->phone }} </i></h3>
				@endif
				<div align="center"><img align="center" class="img-responsive"
				                         src="{{ url( '/storage/car_uploads/' .$car->category['logo'] ) }}"
				                         alt="">
				</div>
			</div>
			
			@if ( auth()->user() )
				
				<div class="col-md-3">
					
					<h4 align="center">Prijavite se na oglas i posaljite poruku vlasniku oglasa</h4>
					
					<form method="post" action="{{ route( 'send-email' ) }}">
						
						{!! csrf_field() !!}
						
						<textarea required rows="5" class="form-control" name="email_content"></textarea>
						
						<br>
						
						<input type="hidden" name="car_details" value="{{ $car }}">
						<input type="hidden" name="user_sender" value="{{ auth()->user() }}">
						
						<button type="submit" class="form-control">Posaljite poruku</button>
					</form>
				
				</div>
			
			@endif
		
		</div>
		<!-- /.row -->
		
		@if ( $car->description )
		
		<!-- Project One -->
			<div class="row">
				
				<div class="col-md-12">
					
					<h1 class="page-header">Opis
						<small>{{ $car->description }}</small>
					</h1>
				
				</div>
			
			</div>
			<!-- /.row -->
		@endif
	
	</div>
	
	<!-- Footer -->
	@include( 'layouts.partials.footer' )

@endsection