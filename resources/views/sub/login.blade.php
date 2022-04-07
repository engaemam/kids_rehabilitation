@extends('layouts.master')

@section('content')

            <section class="log-wrapper">
				<div class="container">
					<div class="col-md-6 col-sm-10 col-md-offset-3 col-sm-offset-1">
						@if ($errors->any())
                    <div class=" alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> <i class="fa fa-exclamation-triangle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                 @if (session()->has('error'))
                         
                                <div class=" alert alert-warning">
                                    <i class="fa fa-exclamation-triangle"></i> {{session()->get('error')}}
                                </div>
                    @endif
                    @if (session()->has('success'))
                         
                                <div class=" alert alert-success">
                                    <i class="fa fa-check"></i> {{session()->get('success')}}
                                </div>
                    @endif
						<div class="log-box">
							<h2>Sub Admin <span class="theme-cl">Login</span></h2>
							<form action="{{url('check/sub')}}" method="post">
					              {{csrf_field()}}
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope theme-cl"></i></span>
									<input type="text" name="email" class="form-control" placeholder="Email">
								</div>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock theme-cl"></i></span>
									<input type="password" name="password" class="form-control" placeholder="Password">
								</div>
								<div class="remember">
			                        <div class="checkbox">
			                            <label><input name="remmberme"  type="checkbox"> Remember Me</label>
			                        </div>
			                        <a href="{{url('sforget/password')}}" class="forgot"> Forgot my Password</a>
			                    </div>
								<div class="text-center">
									<button type="submit" class="btn theme-btn width-200 btn-radius">Login</button>
								</div>

							</form>
						</div>
					</div>
				</div>
			</section>



@endsection