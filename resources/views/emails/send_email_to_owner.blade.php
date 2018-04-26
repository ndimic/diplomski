<div align="center">
	
	Primili ste novu poruku od {{ $sender->name }} vezano za vas oglas broj #{{ $car->id }} - {{ $car->name }},
	postavljenog dana {{ $car->created_at }}
	<br><br>
	
	<p>
		{{ $request->email_content }}
	</p>

</div>