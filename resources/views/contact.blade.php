@extends('layouts.master')

@section('content')

	<section class="title-transparent page-title" style="background:url(/assets/img/slider.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Contact US</h1>
						<div class="breadcrumbs">
							<a href="#">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Contact US</span>
						</div>
					</div>
				</div>
			</section>

			<div class="clearfix"></div>

			<section class="padd-0">
				<div class="container">
					<div class="col-md-10 col-md-offset-1 col-sm-12 translateY-60">
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
						<div class="col-md-6 col-sm-6">
							<div class="detail-wrapper text-center padd-top-40 mrg-bot-10 padd-bot-40 light-bg">
								<i class="theme-cl font-30 ti-location-pin"></i>
								<h4>KSA Office</h4>
								Jaddah, KSA <br>
								(025412122)
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="detail-wrapper text-center padd-top-40 mrg-bot-10 padd-bot-40 light-bg">
								<i class="theme-cl font-30 ti-location-pin"></i>
								<h4>Contact US</h4>
								info@kids-rehab<br>
								(01026220967)
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="padd-top-0">
				<div class="container">
					<div class="col-md-6 col-sm-6">
						<form method="post" action="{{url('/send/message')}}">
                          {{csrf_field()}}
							<div class="form-group">
								<label>Name:</label>
								<input type="text" name="name" class="form-control" placeholder="Name" />
							</div>
							<div class="form-group">
								<label>Email:</label>
								<input type="email" name="email" class="form-control" placeholder="Email" />
							</div>
							<div class="form-group">
								<label>Message:</label>
								<textarea class="form-control height-120" name="body" placeholder="Message"></textarea>
							</div>
							<div class="form-group">
								<button class="btn theme-btn" type="submit">Send Message</button>
							</div>
						</form>
					</div>
					<div class="col-md-6 col-sm-6">
						<iframe src="https://maps.google.com/maps?q=jaddah&hl=es;z=14&amp;output=embed" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
			</section>

			<script type="text/javascript" src="http://maps.google.com/maps/api/js?key="></script>

@endsection