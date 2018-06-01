@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Logovanje</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{ route('login') }}">
							{{ csrf_field() }}
							
							{{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail</label>
	
								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
	
									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>
	
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-4 control-label">Lozinka</label>
	
								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required>
	
									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>
	
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Zapamti me
										</label>
									</div>
								</div>
							</div>
	
							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<button type="submit" class="btn btn-success">
										Uloguj se
									</button>
		
									<a style="color: #636b6f;" class="btn btn-link" href="{{ route('password.request') }}">
										Zaboravili ste lozinku?
									</a>
								</div>
							</div>--}}
							
							<div class="imgcontainer">
								<img src="{{ url( '/images/avatar.png' ) }}" alt="Avatar" class="avatar">
								<br><br>
								<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="email" class="control-label">E-Mail</label><br>
									
									<input id="email" type="email" class="form-control"
									       style="width: 35%; margin-left: 241px" name="email"
									       value="{{ old('email') }}" required autofocus>
									
									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
								
								<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="password" class="control-label">Lozinka</label><br>
									
									<input id="password" type="password" class="form-control" style="width: 35%"
									       name="password" required>
									
									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
								
								<div class="form-group">
									
									<button type="submit" class="btn" style="width: 15%; background-color: #4a8636">
										Uloguj se
									</button>
									<br>
									
									<a style="color: #636b6f;" class="btn btn-link"
									   href="{{ route('password.request') }}">
										Zaboravili ste lozinku?
									</a>
								</div>
								
								<div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox"
											       name="remember" {{ old('remember') ? 'checked' : '' }}> Zapamti me
										</label>
									</div>
								</div>
							
							</div>
						
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection