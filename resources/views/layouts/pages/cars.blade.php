@extends( 'layouts.master' )

@section( 'content' )

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Oglasi
                    <small>Polovni automobili</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

    @foreach ( $cars as $car )

            <!-- Car -->
            <div class="row">

                <div class="col-md-6">

                    <a href="{{ 'car/' . $car->id }}">
                        <img class="img-responsive" src="{{ url( '/images/' .$car['image'] ) }}" alt="">
                    </a>

                </div>

                <div class="col-md-6">

                    <h3 align="center" class="border">{{ $car->name }}</h3>
                    <h3 align="center" class="border" style="background-color: orange; color: #fff;">{{ $car->price }} €</h3>
                    <h3 align="center" class="border" style="background: #5aa700; color: #fff;">{{ $car->year }}. godište</h3>
                    <div align="center">
                        <img class="img-responsive" src="{{ url( '/images/' . $car->category->logo ) }}" alt="">
                    </div>

                </div>

            </div>

            <hr>
        @endforeach

    </div>

    <!-- Pagination -->
    <div class="row text-center">

        <div class="col-lg-12">

            {{ $cars->links() }}

        </div>

    </div>

    <!-- Footer -->
    @include( 'layouts.partials.footer' )

@endsection