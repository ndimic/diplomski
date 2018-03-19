@extends('layouts.master')

@section('content')
	
	<!-- Page Content -->
	<div class="container">
		
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
			
			<div class="col-md-6">
				<a href="#">
					
					@if ( $car->default == 0 )
						<img class="img-responsive" src="{{ url( '/storage/car_uploads/' .$car->image ) }}"
						     alt="">
					@else
						<img class="img-responsive" src="{{ url( '/images/' .$car['image'] ) }}"
						     alt="">
					@endif
				
				</a>
			</div>
			
			<div class="col-md-6">
				<h3 align="center" class="border" style="background-color: orange; color: #fff;">{{ $car->price }}€</h3>
				<h3 align="center" class="border" style="background: #5aa700; color: #fff;">{{ $car->year }}.
					godište</h3>
				<h3 align="center" class="border" style="background-color: #29aade; color: #fff;">{{ $car->km }}km.</h3>
				
				@if ( $car->created_at->diffInMinutes() > 60 && $car->created_at->diffInHours() < 24 )
					
					<h3 align="center" class="border" style="background-color: #2a91af; color: #fff;">Postavljeno:
						pre {{ $car->created_at->diffInHours() }} sata.</h3>
				
				@elseif ( $car->created_at->diffInHours() > 24 )
					
					<h3 align="center" class="border" style="background-color: #2a91af; color: #fff;">Postavljeno:
						pre {{ $car->created_at->diffInDays() }} dana.</h3>
				
				@else
					
					<h3 align="center" class="border" style="background-color: #2a91af; color: #fff;">Postavljeno:
						pre {{ $car->created_at->diffInMinutes() }} minuta.</h3>
				
				@endif
				
				<h3 align="center" class="border" style="background-color: #575757; color: #fff;">Broj
					oglasa: {{ $car->id }}</h3>
				<h3 align="center" class="border" style="background-color: #fff; color: black;">Oglas
					postavio: {{ $car->user->name }} </h3>
				<h3 align="center" class="border" style="background-color: #fff; color: black;">Kontakt:
					<i> {{ $car->user->email }} </i></h3>
				
				<div align="center"><img align="center" class="img-responsive"
				                         src="{{ url( '/storage/car_uploads/' .$car->category->logo ) }}" alt=""></div>
			</div>
		
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