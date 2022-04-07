
@extends('layouts.master')

@section('content')

<section class="title-transparent page-title" style="background:url(/assets/img/slider.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Sub Admin Reset password</h1>
						<div class="breadcrumbs">
							<a href="#">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Reset password</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>

	<div class="container" style="margin: 150px;">
		
		<div class="row">
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
			<div class=" col-md-offset-2 col-md-8  col-sm-8 ">
				<form  method="post">
					{{csrf_field()}}
					<div class="form-group label-floating">
						<label class="control-label">Your Email</label>
						<input class="form-control" name="email" value="{{$data->email}}" placeholder="" type="email">
					</div>
					<div class="form-group label-floating">
						<label class="control-label">Your Password</label>
						<input class="form-control" name="password" placeholder="" type="password">
					</div>
					<div class="form-group label-floating">
						<label class="control-label">Confirm Password</label>
						<input class="form-control" name="password_confirmation" placeholder="" type="password">
					</div>
					<button type="submit" class="btn btn-md btn-primary full-width">Reset Password</button>
				</form>
			</div>
		</div>
		<!--======= // log_in_page =======-->

	</div>

@endsection