
@extends('layouts.master')

@section('content')

<div class="clearfix"></div>

			<section class="padd-0" style="margin-top: 150px;">
				<div class="container">
					<center>
					<div class="add-listing-box translateY-60 edit-info mrg-bot-25 padd-bot-30 padd-top-25" style="width: 700px;">
						<div class="listing-box-header">
							<center>
							<img src="/assets/img/{{$institue->img}}" class="img-responsive" alt="" width="90%" />
							<h3>{{$institue->name}}</h3>
							</center>
						</div>

					</div>
					</center>
				</div>
			</section>
			
			<section class="padd-top-0">
				<div class="container">
					<div class="col-md-6 col-sm-12 mob-padd-0">

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
						<div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-5">
							<div class="preview-info-header">
								<h4>Manager Info</h4>
							</div>
							<div class="preview-info-body">
								<ul class="info-list">
									<li>
										<label>Manager(Admin):</label>
										<span>{{App\Sub::find($institue->sub_id)->name}}</span>
									</li>
									<li>
										<label>Phone:</label>
										<span>{{App\Sub::find($institue->sub_id)->phone}}</span>
									</li>
									<li>
										<label>Email:</label>
										<span>{{App\Sub::find($institue->sub_id)->email}}</span>
									</li>
									<li>
										<label>Country:</label>
										<span>{{App\Sub::find($institue->sub_id)->country}}</span>
									</li>
								</ul>
							</div>
						</div>
					</div>

					
					<div class="col-md-6 col-sm-12 mob-padd-0">
						<div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-5">
							<div class="preview-info-header">
								<h4>Institue Summary</h4>
							</div>
							<div class="preview-info-body">
								<p>{{$institue->summary}}</p>
							</div>

						</div>
						@if(auth()->guard('parent')->user())
						<a href="" onclick="document.getElementById('sub_id').value='{{$institue->sub_id}}';" class="btn reservation btn-radius theme-btn full-width mrg-top-10" data-toggle="modal"  data-target="#reply_sub">Send Message </a>
						@endif
						
					</div>
					
					<div class="modal fade" id="reply_sub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Send message</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form id="sub_rep" method="post" enctype="multipart/form-data" action="{{url('/reply/sub')}}">
			                                                  {{csrf_field()}}
                  <input type="hidden" name="sub_id" id="sub_id">
			          <div class="form-group">
			          	<div class="col-md-12">
				            <label for="" class="col-form-label">Subject:</label>
				            <input type="text" name="subject" class="form-control"  >
			             </div>
			          </div>


			          <div class="form-group">
			          	<div class="col-md-12">
				            <label for="message-text" class="col-form-label">Body:</label>
				            <textarea class="form-control" name="body" rows="4" ></textarea>
			             </div>
			          </div>
			        </form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" onclick="document.getElementById('sub_rep').submit();"  class="btn btn-danger" >Save</button>
			      </div>
			    </div>
			  </div>
			</div>
			</section>


@endsection