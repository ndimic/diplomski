@extends( 'layouts.master' )

@section( 'content' )

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">

            <div class="col-lg-12">

                <h1 class="page-header">
                    <small>Pretraga automobila</small>
                </h1>

            </div>

            <div class="col-md-4">

                <form method="post" action="{{ '/searchCar' }}">

                    {!! csrf_field() !!}

                    <label>Kategorija: </label>
                    <select class="form-control" id="search_category_id">
                        <option value="0">...</option>

                        @foreach ( $categories as $category )

                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select><br>

                    <button type="submit" id="searchCar" class="form-control">Pretraži</button>

                </form>

            </div>
            <br><br>

            <div class="col-md-12" id="search_result">

            </div>

        </div>
        <!-- /.row -->

    </div>

    <!-- Footer -->
    @include( 'layouts.partials.footer' )

@endsection

@section( 'scripts' )
    <script>

        $(document).ready(function () {

            $('#searchCar').on('click', function (e) {
                e.preventDefault();

                var token = $( 'meta[ name="csrf-token" ]' ).attr( 'content' );

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });

                var category_id = $( '#search_category_id' ).val();

                $.ajax({
                    url: '/search',
                    type: 'POST',
                    dataType: 'html',
                    data: { token: token, category_id: category_id }
                }).error(function ( xhr, response ) {
                    alert( 'error' );
                }).success(function ( response ) {
                    $( '#search_result' ).html( response );
                })
            });

        });
    </script>
@endsection