@extends('layouts.master')

@section('content')

   

			<div class="clearfix"></div>
			<section class="gray-bg">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
						<div class="heading">
							<h2>Institue <span>Programs</span></h2>
							
						</div>
						</div>
					</div>
					
					<div class="row">
						@foreach($programs as $program)
						<div class="col-md-4 col-sm-6">
							<div class="listing-shot grid-style style-2">
								<a href="{{url('/program/details',['id'=>$program->id])}}">
									<div class="listing-shot-img">
										<img src="/assets/img/{{$program->img}}" class="img-responsive" alt="" width="100%" height="50%">
									</div>
									<div class="listing-shot-caption">
										<h4>{{$program->title}}</h4>
										
									</div>
								</a>
								<div class="listing-shot-info">
									<div class="row extra">
										<div class="col-md-12">
											<div class="listing-detail-info">
												<span><i class="fa fa-phone" aria-hidden="true"></i> {{App\Sub::find($program->sub_id)->phone}}</span>
												<span><i class="fa fa-map" aria-hidden="true"></i> {{App\Institue::where('sub_id',$program->sub_id)->first()->address}}</span>
											</div>
										</div>
									</div>
								</div>
								<div class="listing-shot-info rating">
									<?php $rate=App\Comment::where('program_id',$program->id)->count()!=0?App\Comment::where('program_id',$program->id)->sum('rate')/App\Comment::where('program_id',$program->id)->count():0;?>

									<div class="row extra">
										<div class="col-md-7 col-sm-7 col-xs-6">
											<?php for ($i=0; $i < 5; $i++) {
                                        if($i<$rate){ ?> 
											<i class="color fa fa-star" aria-hidden="true"></i>
											<?php }else{ ?>
											<i class="fa fa-star" aria-hidden="true"></i>
											<?php } } ?>
										</div>
										<div class="col-md-5 col-sm-5 col-xs-6 pull-right">
											<div class="listing-info">
												<ul>
													<li><i class="ti-comment-alt"></i>{{App\Comment::where('program_id',$program->id)->count()}}</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						
					</div>

					
					
				</div>
			</section>

@endsection