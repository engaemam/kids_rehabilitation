@extends('layouts.master')

@section('content')

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
								<h3>General Information</h3>
								<p>Write general information about your program</p>
							</div>
							<form action="{{url('/save/program')}}" method="post"  enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="row mrg-r-10 mrg-l-10">
									<div class="col-sm-6">
										<label>Program Title</label>
										<input type="text" name="title" class="form-control">
									</div>
									
									<div class="col-sm-6">
										<label>Category</label>
										<select class="form-control chosen-select" name="category_id" tabindex="2">
											@foreach(App\Category::all() as $cat)
		                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
		                                    @endforeach
										</select>
									</div>
									
									
								</div>
						</div>
						
						
						<div class="add-listing-box full-detail mrg-bot-25 padd-bot-30 padd-top-25">
							<div class="listing-box-header">
								<i class="ti-write theme-cl"></i>
								<h3>Full Details</h3>
							</div>
								<div class="row mrg-r-10 mrg-l-10">
									
									<div class="col-sm-6">
										<label>Price</label>
										<input type="text" name="price" class="form-control">
									</div>
									
									<div class="col-sm-12">
										<label>Description</label>
										<textarea class="h-100 form-control" name="description" rows="4"></textarea>
									</div>
									<div class="col-md-6 margin-bottom-10px">
				                        <label><i class="far fa-images margin-right-10px"></i> Photo </label><br>
							              <span class="btn btn-info btn-file" style="margin-bottom: 10px;">
							              <i class="fa fa-image"></i> Select Photo<input type="file" name="img" style=" opacity:0; height: 10px; width: 50px;">
							              </span>
			                        </div>

									
								</div>
								<div class="text-center">
							<button  class="btn theme-btn" title="Submit Program">Save Program</button> 
						</div>
							</form>
						</div>
						
						
						
					</div>
					
				</div>
			</section>


@endsection