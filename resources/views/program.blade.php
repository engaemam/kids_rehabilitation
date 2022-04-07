@extends('layouts.master')

@section('content')
	

			<div class="clearfix"></div>


           <section class="list-detail">
				<div class="container">
					<div class="row">

						<div class="col-md-8 col-sm-8">
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
							<div class="detail-wrapper">
								<div class="detail-wrapper-body">
									<div class="listing-title-bar">
										<h3>{{$program->title}} </h3>
										<div>
											<a href="" class="listing-address">
												<i class="ti-location-pin mrg-r-5"></i>
												{{App\Institue::where('sub_id',$program->sub_id)->first()->address}}.
											</a>
											<img src="/assets/img/{{$program->img}}" width="100%">
											<div class="rating-box">
												<div class="review-comment-stars">
													<?php $rate=App\Comment::where('program_id',$program->id)->count()!=0?App\Comment::where('program_id',$program->id)->sum('rate')/App\Comment::where('program_id',$program->id)->count():0;?>
													<?php for ($i=0; $i < 5; $i++) {
			                                        if($i<$rate){ ?> 
														<i class="fa fa-star"></i>
														<?php }else{ ?>
														<i class="fa fa-star empty"></i>
														<?php } } ?>
													
												</div>
												<a href="#" class="detail-rating-count">({{App\Comment::where('program_id',$program->id)->count()}}) Ratings</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>	
							
							<div class="detail-wrapper">
								<div class="detail-wrapper-header">
									<h4>Description</h4>
								</div>
								<div class="detail-wrapper-body">
									<p>{{$program->description}}.</p>
								</div>
							</div>
							
							
							<div class="detail-wrapper">
								<div class="detail-wrapper-header">
									<h4>{{App\Comment::where('program_id',$program->id)->count()}} Comments</h4>
								</div>
								<div class="detail-wrapper-body">
									<ul class="review-list">
										@foreach(App\Comment::where('program_id',$program->id)->get() as $comment)
										<li>
											<div class="reviews-box">
												<div class="review-body">
													<div class="review-avatar">
														<img alt="" src="/assets/img/{{App\Uparent::find($comment->parent_id)->img}}" class="avatar avatar-140 photo">
													</div>
													<div class="review-content">
														<div class="review-info">
															<div class="review-comment">
																<div class="review-author">
																	{{App\Uparent::find($comment->parent_id)->name}}																			
																</div>
																<div class="review-comment-stars">

																	<?php for ($i=0; $i < 5; $i++) {
						                                             if($i<$comment->rate){ ?> 
						                                            <i class="fa fa-star"></i>
						                                            <?php }else{ ?>
						                                            <i class="fa fa-star empty"></i>
						                                            <?php } } ?>
																	
																</div>
															</div>
															<div class="review-comment-date">
																<div class="review-date">
																	<span>{{$comment->created_at}}</span>
																</div>
															</div>
														</div>
														<p>{{$comment->comment}}</p>
													</div>
												</div>
											</div>
										</li>
										@endforeach
										


									</ul>
								</div>
							</div>
							@if(auth()->guard('parent')->user())
							<div class="detail-wrapper">
								<div class="detail-wrapper-header">
									<h4>Rate & Write Comments</h4>
								</div>
								<form method="post" action="{{url('/comment/add')}}">
                                        {{csrf_field()}}
								<div class="detail-wrapper-body">
								<input type="hidden" name="program_id" value="{{$program->id}}">
									<div class="row mrg-bot-10">
										<div class="col-md-12">
											<label>Rate Now</label>
										<select class="form-control chosen-select" name="rate" tabindex="2">
											<option value="5">5 Stars</option>
											<option value="4">4 Stars</option>
											<option value="3">3 Stars</option>
											<option value="2">2 Stars</option>
											<option value="1">1 Stars</option>
										</select>
										</div>
									</div>
									
									<div class="row">
										
										<div class="col-sm-12">
											<textarea class="form-control height-110" name="comment" placeholder="Write UR Comment..."></textarea>
										</div>
										<div class="col-sm-12">
											<button type="submit" class="btn theme-btn">Submit your Comment</button>
										</div>
									</div>
								</div>
								</form>
							</div>

							@endif
						</div>

						<div class="col-md-4 col-sm-12">
							<div class="sidebar">
								<div class="widget-boxed">
									<div class="widget-boxed-header">
										<h4><i class="ti-calendar padd-r-10"></i>Book A Program</h4>
									</div>
									<div class="widget-boxed-body">
										<div class="row">
											
											<div class="col-lg-6 col-md-12">
												Price: <span class="btn btn-warning" style="margin-left: 100px;">2000$</span>
											</div>
										</div>
										@if(auth()->guard('parent')->user())

										<a href="{{url('book/program',['id'=>$program->id])}}" class="btn reservation btn-radius theme-btn full-width mrg-top-10">Book Now</a>
										@endif
									</div>
								</div>




								<div class="widget-boxed">
									<div class="widget-boxed-header">
										<h4><i class="ti-briefcase padd-r-10"></i>Programs Categories</h4>
									</div>
									<div class="widget-boxed-body padd-top-10 padd-bot-0">
										<div class="side-list">
											<ul class="category-list">
												 
                                        @foreach(App\Category::all() as $cat)
												<li><a href="{{url('/programs/cat',['id'=>$cat->id])}}">{{$cat->name}}  <span class="badge bg-g">{{App\Program::where('category_id',$cat->id)->count()}}</span></a></li>
												@endforeach
											</ul>
										</div>
									</div>
								</div>


							</div>
						</div>

					</div>
				</div>
			</section>

@endsection