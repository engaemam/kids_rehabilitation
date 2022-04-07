@extends('layouts.master')

@section('content')

			<section class="title-transparent page-title" style="background:url(/assets/img/slider.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Requests</h1>
						<div class="breadcrumbs">
							<a href="#">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Requests</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<div class="clearfix"></div>

			<section class="manage-listing padd-top-20"  style="margin: 100px;">
				<div class="container">
					<div class="col-md-12 col-sm-12">
						
						<div class="row">
							<div class="col-md-12">
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
								<div class="small-list-wrapper">
								<ul>
									@foreach($bookings as $book)
									<?php $program=App\Program::find($book->program_id); ?>
                                     @if($program->sub_id==auth()->guard('sub')->user()->id)
									<li>
										<div class="small-listing-box light-gray">
											<div class="small-list-img">
												<img src="/assets/img/{{App\Uparent::find($book->parent_id)->img}}" class="img-responsive" alt="" />
											</div>
											<div class="small-list-detail">
												<h4>{{App\Uparent::find($book->parent_id)->name}}</h4>
												<p><a href="#" title="Food & restaurant">{{App\Program::find($book->program_id)->title}}</a> | {{$book->created_at}}</p>
											</div>
											<div class="small-list-action">
												<a href="{{url('/accept/request',['id'=>$book->id])}}" class="light-gray-btn btn-square" data-placement="top" data-toggle="tooltip" title="Approve"><i class="fa fa-check"></i></a>
												<a href="{{url('/refuse/request',['id'=>$book->id])}}" class="btn-danger btn-square" data-toggle="tooltip" title="Refuse"><i class="fa fa-ban"></i></a>
											</div>
										</div>
									</li>
									@endif
									@endforeach
									


									
								</ul>

								</div>
							</div>
						</div>

 					</div>
				</div>
			</section>


@endsection