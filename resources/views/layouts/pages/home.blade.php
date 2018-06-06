@extends( 'layouts.master' )

@section( 'content' )
	
	<!-- Project Five -->
	<div class="row">
		
		<div align="center" class="col-md-12">
			
			<img class="img-responsive" width="850" src="{{ url( '/images/cover.jpg' ) }}"
			     alt="">
		
		</div>
	
	</div>
	
	<div class="row" style="margin-top: 50px;">
		<div align="center" class="col-md-12">
			<p style="width: 1000px; font-size: 16px;">Automobilizam je naziv za sve oblike sportskih takmičenja
				u kojima se koriste motorna vozila na četiri točka.
				Osnovni cilj u pojedinačnim trkama je da se za najkraće vreme pređe određen broj
				krugova ili da se za određeno vreme pređe što veći broj krugova.
				Lista na kraju trke se formira u zavisnosti od potrošenog vremena,
				gde prvo mesto zauzima takmičar sa najkraćim vremenom, drugo odmah posle njega i tako dalje.
				Vozači koji iz bilo kog razloga započnu, ali ne završe trku će takođe biti na finalnoj listi.
				Međutim, njihova mesta će biti na samom dnu tabele, i to poslednje mesto će zauzeti vozač koji se prvi
				povukao iz trke.
				Kod većine trke, nije neophodno proći kompletnu stazu, već će se računati da je vozač uspešno završio
				trku ukoliko pređe određenu takmičarsku distancu (na primer, u Formuli 1, dovoljno je da vozači pređu
				90% puno staze, te će se računati kao da su završili trku). Postoje brojne kategorije automobilskih
				takmičenja, svaki sa različitim pravilima i propisima, kao što su obavezna zaustavljanja radi tehničke
				provere i auto regulativa,
				kojih se svi takmičarski automobili i vozači moraju pridržavati.</p>
		</div>
	</div>
	
	<div class="row" style="margin-top: 100px;">
		
		<h3 align="center">Najposećeniji oglasi</h3>
		
		<div style="margin-top: 80px;" class="col-md-4" align="center">
			<a href="{{ 'car/' . $randomCars[0]->id }}" style="color: black;">
				<img align="center" class="img-responsive"
				     src="{{ url( '/images/' .$randomCars[0]->image ) }}"
				     alt="" width="200" height="200">
			</a>
			<h4>{{ $randomCars[0]->name }}</h4>
		
		</div>
		
		<div style="margin-top: 80px;" class="col-md-4" align="center">
			<a href="{{ 'car/' . $randomCars[1]->id }}" style="color: black;">
				<img align="center" class="img-responsive"
				     src="{{ url( '/images/' .$randomCars[1]->image ) }}"
				     alt="" width="200" height="200">
			</a>
			<h4>{{ $randomCars[1]->name }}</h4>
		
		</div>
		
		<div style="margin-top: 80px;" class="col-md-4" align="center">
			<a href="{{ 'car/' . $randomCars[2]->id }}" style="color: black;">
				<img align="center" class="img-responsive"
				     src="{{ url( '/images/' .$randomCars[2]->image ) }}"
				     alt="" width="200" height="200">
			</a>
			<h4>{{ $randomCars[2]->name }}</h4>
		
		</div>
	
	</div>
	
	<!-- Footer -->
	@include( 'layouts.partials.footer' )

@endsection