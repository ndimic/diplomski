@extends('layouts.master')

@section('content')
    <!-- Page Content -->
    <div class="container">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </p>
        @endif
    @endforeach

    <!-- Project One -->
        <div class="row">
            <div align="center" class="col-md-12">
                <h1 class="page-header">
                    <small>{{ $car->name }}</small>
                </h1>
                <img class="img-responsive" src="{{ url('/images/' . $car->image) }}" alt=""><br>
                <form method="post" action="{{ '/updateAd' }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <label>Naziv:</label>
                    <input type="text" class="form-control editWidth" name="car_name" value="{{ $car->name }}"><br>
                    <label>Cena:</label>
                    <input type="text" class="form-control editWidth" name="car_price" value="{{ $car->price }}"><br>
                    <label>Godište:</label>
                    <input type="text" class="form-control editWidth" name="car_year" value="{{ $car->year }}"><br>
                    <label>Kilometraža:</label>
                    <input type="text" class="form-control editWidth" name="car_km" value="{{ $car->km }}"><br>
                    <label>Slika:</label> {{ $car->image }}
                    <input type="file" class="form-control editWidth" name="car_image" value="{{ $car->image }}"><br>
                    <label>Opis:</label>
                    <textarea class="form-control editWidth" name="car_description" rows="8" placeholder="Unisite opis..."
                              maxlength="300">{{ $car->description }}</textarea><br>

                    <button type="submit" class="form-control editWidth" style="color:darkgoldenrod;">Izmeni oglas</button>
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                </form>
                <br>
                <a href="{{ '/myAds' }}"><input type="button" class="form-control editWidth" value="Nazad na moje oglase"></a>
            </div>
        </div>
        <!-- /.row -->
        <hr>
    </div>

    <!-- Footer -->
    <footer class="footer_custom">
        <div align="center" class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Oglasi - Polovni automobili 2017</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

@endsection
