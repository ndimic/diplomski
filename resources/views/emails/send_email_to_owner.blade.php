<div align="left">
	
	Primili ste novu poruku od <b><i>{{ $sender->name }} ( ID korisnika: {{ $sender->id }} )</i></b> vezano za vas oglas
	broj <b>#{{ $car->id }} - {{ $car->name }}</b>, postavljenog dana <b>{{ $car->created_at }}</b><br>
	
	<p>
		<i><q>{{ $request->email_content }}</q></i>
	</p>

</div>