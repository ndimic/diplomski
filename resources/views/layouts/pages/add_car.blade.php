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
                        <option name="category_name" value="0">Izaberite kategoriju...</option>
                        @foreach ($categories as $category)
                            <option name="car_category" value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select><br>
                    </div>
                    <div class="form-group required">
                    <label>Naziv automobila: </label>
                    <input type="text" class="form-control" name="car_name" placeholder="Unesite naziv automobila..."/><br>
                    </div>
                    <div class="form-group required">
                    <label>Cena: </label>
                    <input type="text" class="form-control" name="car_price" placeholder="Unesite cenu automobila..."/><br>
                    </div>
                    <div class="form-group required">
                    <label>Godište: </label>
                    <select class="form-control" name="car_year_id">
                        <option name="car_year" value="0">Izaberite godinu proizvodnje...</option>
                        @for ($i = 1980; $i <= 2017; $i++)
                            <option name="car_year" value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select><br>
                    </div>
                    <div class="form-group required">
                    <label>Kilometraza: </label>
                    <input type="text" class="form-control" name="car_km" placeholder="Unesite pređenu kilometražu..."/><br>
                    </div>
                    <div class="form-group required">
                    <label>Slika: </label>
                    <input type="file" class="form-control" name="car_image"/><br>
                    </div>
                    <div class="form-group">
                        <label>Opis:</label>
                        <textarea class="form-control" name="car_description" rows="5" placeholder="Unisite opis..." maxlength="300"></textarea><br>
                    </div>

                    <button type="submit" class="form-control">Postavi oglas</button>
                </form>
            </div>
            <div class="col-md-6">
                <br><br><br>
                <a href="#" class="disableCoverPhoto">
                    <img class="img-responsive" src="http://buyersguide.caranddriver.com/media/assets/submodel/7715.jpg" alt="">
                </a>
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