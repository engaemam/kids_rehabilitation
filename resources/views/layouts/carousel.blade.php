<div class="banner dark-opacity" style="background-image:url(assets/img/1.jpg); max-height: 300px;" >  
				<div class="container">
					<div class="banner-caption">
						<div class="col-md-12 col-sm-12 banner-text">
							<h2 style="color: white;">Top & Popular <span style="color: skyblue;">Programs</span></h2>
							<p>Kids Rehab is first and the biggest foundation in the middle east that rehabitate the kids in high level methodology.</p>

							<form class="form-verticle" method="post" action="{{url('/programs/search')}}">
                            {{csrf_field()}}
								<div class="col-md-4 col-sm-4 no-padd">
									<i class="banner-icon icon-pencil"></i>
									<input type="text" name="title" class="form-control left-radius right-br" placeholder="Keywords..">
								</div>
								<div class="col-md-3 col-sm-3 no-padd">
									<div class="form-box">
										<i class="banner-icon icon-map-pin"></i>
										<input type="text" name="country" class="form-control right-br" placeholder="Country..">
									</div>
								</div>
								<div class="col-md-3 col-sm-3 no-padd">
									<div class="form-box">
										<i class="banner-icon icon-layers"></i>
										<select class="form-control" name="cat_id">
											<option value="0">All Categories </option>
											@foreach(App\Category::all() as $cat)
											
											<option value="{{$cat->id}}">{{$cat->name}} </option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-md-2 col-sm-2 no-padd">
									<div class="form-box">
										<button type="submit" class="btn theme-btn btn-default">Search Now</button>
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>