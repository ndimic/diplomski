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
				
				@if ( Auth::user() )
					
					@if ( Auth::user()->hasRole( 'admin' ) )
						
						<li>
							<a href="{{ route( 'categories' ) }}">Admin - Kategorije</a>
						</li>
						<li>
							<a href="{{ route( 'admin_cars' ) }}">Admin - Oglasi</a>
						</li>
						<li>
							<a href="{{ route( 'admin_users' ) }}">Admin - Korisnici</a>
						</li>
						<li>
							<a href="{{ route( 'add_car' ) }}">Admin - Postavi oglas</a>
						</li>
					
					@else
						
						<li>
							<a href="{{ route( 'add_car' ) }}">Postavi oglas</a>
						</li>
						<li>
							<a href="{{ route( 'my_ads' ) }}">Moji oglasi</a>
						</li>
					
					@endif
					
					<li>
						<a href="{{ route( 'profile' ) }}">Moj profil</a>
					</li>
					<li>
						<a href="{{ route( 'logout' ) }}">Odjavite se</a>
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