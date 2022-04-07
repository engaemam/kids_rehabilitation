@extends('layouts.master')

@section('content')

			<section class="title-transparent page-title" style="background:url(/assets/img/slider.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Bookings</h1>
						<div class="breadcrumbs">
							<a href="#">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Bookings</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<div class="clearfix"></div>

			<section class="manage-listing padd-top-20"  style="margin-top: 100px;">
				<div class="container">
					<div class="col-md-12 col-sm-12">
						
						<div class="row">
							<div class="col-md-12">
								<div class="small-list-wrapper">
								<ul>
									@foreach($programs as $program)
									<li >
										<div class="listing-box light-gray" style="height: 200px;">
											<div class="list-img">
												<img src="/assets/img/{{App\Program::find($program->id)->img}}" style="width: 200px;"  class="img-responsive" alt="" />
											</div>
											<div class="small-list-detail">
												<h4>{{App\Program::find($program->id)->title}}</h4>
												<p><a href="#" title="Food & restaurant">{{App\Program::find($program->id)->address}}</a> | {{$program->created_at}}</p>
											</div>
											<div class="small-list-action">
												@if($program->admin_status==1)
							                      <span class="btn btn-success" ><i class="fa fa-check"></i> Approved</span>
							                      
							                      
							                  @endif
												@if($program->admin_status==0)
							                      <span class="btn btn-info"><i class="fa fa-spinner fa-spin"></i> pending</span>
							                      
							                  @endif
							                  
							                   @if($program->admin_status==2)
							                      <span class="btn-danger btn-square"><i class="fa fa-ban fa-ban"></i> Refused</span>
							                  
							                  @endif

												
											</div>
										</div>
									</li>
									@endforeach

									


									
								</ul>

								</div>
							</div>
						</div>

 					</div>
				</div>
			</section>


@endsection