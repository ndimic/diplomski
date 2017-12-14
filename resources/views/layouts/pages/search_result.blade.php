@if(count($cars))
    <br><br>
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
        @endif
    @endforeach

    @foreach($cars as $car)
        <!-- Project One -->
        <div class="row">
            <div class="col-md-6">
                <a href="{{ 'car/' . $car->id }}">
                    {{--@if ($car->external == 1)
                        <img class="img-responsive" src="{{ $car->image }}" alt="">
                    @else--}}
                    <img class="img-responsive" src="{{ url('/images/' .$car->image) }}" alt="">
                    {{--@endif--}}
                </a>
            </div>
            <div class="col-md-6">
                <h3 align="center" class="border">{{ $car->name }}</h3>
                <h3 align="center" class="border" style="background-color: orange; color: #fff;">{{ $car->price }} €</h3>
                <h3 align="center" class="border" style="background: #29aade; color: #fff;">{{ $car->year }}. godište</h3>
                <div align="center"><img class="img-responsive" src="{{ url('/images/' . $car->category->logo) }}" alt=""></div>
            </div>
        </div>
        <!-- /.row -->

        <hr>
    @endforeach
@else
    <br><br>
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
        @endif
    @endforeach
@endif