@extends( 'layouts.master' )

@section( 'content' )
	<!-- Page Content -->
	<div class="container">

		@foreach ( [ 'danger', 'warning', 'success', 'info' ] as $msg )

			@if ( Session::has( 'alert-' . $msg ) )

				<p class="alert alert-{{ $msg }}">{{ Session::get( 'alert-' . $msg ) }}
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				</p>

		@endif

	@endforeach

	<!-- Page Heading -->
		<div class="row">

			<div align="center">

				<h1 class="page-header">
					<small>Kategorije</small>
				</h1>

			</div>

		</div>
		<!-- /.row -->

		<!-- Project One -->
		<div class="row">

			@foreach ( $categories as $category )

				<div align="center" class="col-md-6">

					<h1 class="page-header">
						<small>{{ $category->name }}</small>
					</h1>

					@if ( ! strpos( $category->logo, '/' ) )
						<img class="img-responsive" src="{{ url( '/images/' . $category->logo ) }}" alt="">
					@else
						<img class="img-responsive" src="{{ $category->logo }}" alt="">
					@endif

					<form method="post" action="{{ '/deleteCategory' }}">
						{!! csrf_field() !!}
						<input type="hidden" name="category_id" value="{{ $category->id }}"/>
						<button type="submit" class="form-control" style="color:red;">Obriši kategoriju</button>
					</form>
					<br>

					<a href="{{ '/edit/category/' . $category->id }}">
						<button type="submit" class="form-control" style="color:darkgoldenrod;">Izmeni kategoriju
						</button>
					</a>
				</div>

			@endforeach

			<div class="col-md-12">

				<h1 class="page-header">

					<small>Nova kategorija</small>

				</h1>

			</div>
			<br>

			<div class="col-md-6">

				<form method="post" action="{{ '/addCategory' }}" enctype="multipart/form-data">

					{!! csrf_field() !!}

					<div class="form-group required">

						<label>Naziv kategorije: </label>
						<input type="text" name="category_name" class="form-control"/><br>

					</div>

					<label>Logo kategorije: </label>
					<input type="file" name="category_logo" class="form-control"/><br>
					<button type="submit" class="form-control" style="color: green;">Dodaj kategoriju</button>

				</form>

			</div>

		</div>
		<!-- /.row -->
		<hr>

	</div>

	<!-- Footer -->
	@include('layouts.partials.footer')

@endsection
