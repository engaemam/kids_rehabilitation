@extends('layouts.master')

@section('content')

            <section class="title-transparent page-title" style="background:url(/assets/img/slider.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Admin</h1>
						<div class="breadcrumbs">
							<a href="#">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Admin Register</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>

			<section>
				<div class="container">
					<div class="col-md-10 col-sm-12 col-md-offset-1 mob-padd-0">
						@if ($errors->any())
                    <div class=" alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> <i class="fa fa-exclamation-triangle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
					      @endif
					      @if (session()->has('success'))
					    
					            <div class="alert alert-success">
					              
					                <i class="fa fa-check-circle-o"></i> {{session()->get('success')}}
					              
					          </div>
					    @endif
						<div class="add-listing-box general-info mrg-bot-25 padd-bot-30 padd-top-25">
							<div class="listing-box-header">
								<i class="ti-files theme-cl"></i>
								<h3>Admin Registration</h3>
							</div>
							<form action="{{url('/admin/doregister')}}" method="post"  enctype="multipart/form-data">
					            {{csrf_field()}}
								<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-6">
										<label>Name</label>
										<input type="text" name="name" class="form-control">
									</div>

									<div class="col-sm-6">
										<label>Email</label>
										<input type="email" name="email" class="form-control">
									</div>

									<div class="col-sm-6">
										<label>Password</label>
										<input type="password" name="password" class="form-control">
									</div>

									<div class="col-sm-6">
										<label>Geder</label>
										<select class="form-control chosen-select" name="gender" tabindex="2">
											<option value="1">Male</option>
											<option value="2">Female</option>
										</select>
									</div>
									<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-6">
										<label>Country</label>
										<input type="text" name="country" class="form-control">
									</div>
									<div class="col-sm-6">
										<label>Address</label>
										<input type="text" name="address" class="form-control">
									</div>
									<div class="col-sm-6">
										<label>Phone</label>
										<input type="text" name="phone" class="form-control">
									</div>


									<div class="col-sm-12">
										<label>Summary</label>
										<textarea class="h-100 form-control" name="summary" rows="4"></textarea>
									</div>
									<div class="col-md-6 margin-bottom-10px">
				                        <label><i class="far fa-images margin-right-10px"></i> Photo </label><br>
							              <span class="btn btn-info btn-file" style="margin-bottom: 10px;">
							              <i class="fa fa-image"></i> Select Photo<input type="file" name="img" style=" opacity:0; height: 10px; width: 50px;">
							              </span>
			                        </div>

									
								</div>
									
								</div>
								<div class="text-center">
							<button type="submit" class="btn theme-btn" title="Submit Listing">Register Now!</button>
						</div>
							</form>
						</div>
						
						
						
					</div>
					
				</div>
			</section>




@endsection