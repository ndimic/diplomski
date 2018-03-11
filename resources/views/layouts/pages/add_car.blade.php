@extends( 'layouts.master' )

@section( 'content' )
    <!-- Page Content -->
    <div class="container">

        @foreach ( $errors->all() as $error )

            <strong style="display: block; margin: 0 0 4px; padding: 6px; background: lightcoral; color: darkred; border: 1px solid darkred">{{ $error }}</strong>

    @endforeach

    <!-- Add car form -->
        <div class="row">

            <div class="col-md-12">

                <h1 class="page-header">
                    <small>Novi oglas</small>
                </h1>

            </div>
            <br>

            <div class="col-md-6">

                <form method="post" action="{{ '/saveCar' }}" enctype="multipart/form-data">

                    {!! csrf_field() !!}

                    <div class="form-group required">

                        <label>Kategorija: </label>
                        <select class="form-control" name="car_category_id">
                            <option name="car_category_id" value="">Izaberite kategoriju...</option>
                            @foreach ( $categories as $category )
                                <option name="car_category_id"
                                        value="{{ $category->id }} {{ old( 'car_category_id', $category->id ) == $category->id ? 'selected' : '' }}">{{ $category->name }}</option>
                            @endforeach
                        </select><br>

                    </div>

                    <div class="form-group required">

                        <label>Naziv automobila: </label>
                        <input type="text" class="form-control" name="car_name"
                               placeholder="Unesite naziv automobila..." value="{{ old( 'car_name' ) }}"/><br>

                    </div>

                    <div class="form-group required">

                        <label>Cena (u evrima): </label>
                        <input type="text" class="form-control" name="car_price"
                               placeholder="Unesite cenu automobila..." value="{{ old( 'car_price' ) }}"/><br>

                    </div>

                    <div class="form-group required">

                        <label>Godište: </label>
                        <select class="form-control" name="car_year_id">
                            <option name="car_year" value="">Izaberite godinu proizvodnje...</option>
                            @for ( $i = 1980; $i <= 2017; $i++ )
                                <option name="car_year"
                                        value="{{ $i }} {{ $i == old('car_year_id') ? 'selected' : '' }}">{{ $i }}</option>
                            @endfor
                        </select><br>

                    </div>

                    <div class="form-group required">

                        <label>Kilometraza: </label>
                        <input type="text" class="form-control" name="car_km"
                               placeholder="Unesite pređenu kilometražu..." value="{{ old( 'car_km' ) }}"/><br>

                    </div>

                    <div class="form-group required">

                        <label>Slika: </label>
                        <input type="file" class="form-control" name="car_image" value="{{ old( 'car_image' ) }}"/><br>

                    </div>

                    <div class="form-group">

                        <label>Opis:</label>
                        <textarea class="form-control" name="car_description" rows="5" placeholder="Unisite opis..."
                                  maxlength="300" value="{{ old( 'car_image' ) }}"></textarea><br>

                    </div>

                    <button type="submit" class="form-control">Postavi oglas</button>

                </form>

            </div>

            <div class="col-md-6">
                <br><br><br>
                <a href="#" class="disableCoverPhoto">
                    <img class="img-responsive" src="http://buyersguide.caranddriver.com/media/assets/submodel/7715.jpg"
                         alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->

        <hr>
    </div>

    <!-- Footer -->
    @include('layouts.partials.footer')

@endsection