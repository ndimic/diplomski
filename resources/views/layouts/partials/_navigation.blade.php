<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

	<div class="container">

		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">

			<button type="button" class="navbar-toggle" data-toggle="collapse"
			        data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a class="navbar-brand" href="{{ '/' }}">Polovni automobili</a>

		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<ul class="nav navbar-nav">

				<li>
					<a href="{{ '/cars' }}">Oglasi</a>
				</li>
				{{--<li>
					<a href="{{ '/searchCar' }}">Pretraga</a>
				</li>--}}

				@if ( Auth::user() )

					@if ( Auth::user()->hasRole( 'admin' ) )

						<li>
							<a href="{{ '/categories' }}">Admin - Kategorije</a>
						</li>
						<li>
							<a href="{{ '/adminListCars' }}">Admin - Oglasi</a>
						</li>
						<li>
							<a href="{{ '/adminUsers' }}">Admin - Korisnici</a>
						</li>
						<li>
							<a href="{{ '/addCar' }}">Admin - Postavi oglas</a>
						</li>

					@else
						
						<li>
							<a href="{{ '/addCar' }}">Postavi oglas</a>
						</li>
						<li>
							<a href="{{ '/myAds' }}">Moji oglasi</a>
						</li>
						<li>
							<a href="{{ '/profile' }}">Moj profil</a>
						</li>

					@endif

					<li>
						<a href="{{ url( '/logout' ) }}">Odjavite se</a>
					</li>

				@else

					<li>
						<a href="{{ '/login' }}">Prijavite se</a>
					</li>

				@endif

			</ul>

		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>