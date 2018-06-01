<div align="left">
	
	Primili ste novu poruku od <i>{{ $sender->name }}</i> vezano za vas oglas broj <b>#{{ $car->id }}
		- {{ $car->name }}</b>,
	postavljenog dana <b>{{ $car->created_at }}</b>
	<br>
	
	<p>
		<i><q>{{ $request->email_content }}</q></i>
	</p>

</div>