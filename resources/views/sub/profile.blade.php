@extends('layouts.master')

@section('content')

<div class="clearfix"></div>

			<section class="padd-0" style="margin-top: 150px;">
				<div class="container">
					<div class="add-listing-box translateY-60 edit-info mrg-bot-25 padd-bot-30 padd-top-25">
						<div class="listing-box-header">
							<div class="avater-box">
							<img src="/assets/img/{{$profile->img}}" width="100%" class="img-responsive img-circle edit-avater" alt="" />
							</div>
							<h3>{{$profile->name}}</h3>
						</div>

					</div>
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
								<h4>Basic Info</h4>
							</div>
							<div class="preview-info-body">
								<ul class="info-list">
									<li>
										<label>Name:</label>
										<span>{{$profile->name}}</span>
									</li>
									<li>
										<label>Phone:</label>
										<span>{{$profile->phone}}</span>
									</li>
									<li>
										<label>Email:</label>
										<span>{{$profile->email}}</span>
									</li>
									<li>
										<label>Country:</label>
										<span>{{$profile->country}}</span>
									</li>
									<li>
										<label>Address:</label>
										<span>{{$profile->address}}</span>
									</li>

									
								</ul>
							</div>
						</div>
					</div>

					
					<div class="col-md-6 col-sm-12 mob-padd-0">
						<div class="add-listing-box edit-info mrg-bot-25 padd-bot-30 padd-top-5">
							<div class="preview-info-header">
								<h4>Summary</h4>
							</div>
							<div class="preview-info-body">
								<p>{{$profile->summary}}</p>
							</div>

						</div>
						<a href="" class="btn reservation btn-radius theme-btn full-width mrg-top-10" data-toggle="modal"  data-target="#profile">Edit Profile</a>
					</div>
					
					
			</section>
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Edit profile</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form action="{{url('/sub/edit')}}" method="post" enctype="multipart/form-data">
             <input type="hidden" name="sub_id" value="{{$profile->id}}">
                
        	{{csrf_field()}}
             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="name">Name: </label>
                
                   <input class="form-control" value="{{$profile->name}}" requiblue=""  id="mo"  name="name" type="text">        
                 </div>
             </div>


             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="name">Email: </label>
                
                   <input class="form-control" value="{{$profile->email}}" requiblue="" id="mo"  name="email" type="text">        
                 </div>
             </div>
             

             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="password">Password: </label>
                
                   <input class="form-control" requiblue="" id="mo" name="password" type="password">        
                 </div>
             </div>

              <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="address">Country: </label>
                
                   <input class="form-control" value="{{$profile->country}}" requiblue="" id="mo"  name="country" type="text">        
                 </div>
             </div>

             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="address">Address: </label>
                
                   <input class="form-control" value="{{$profile->address}}" requiblue="" id="mo"  name="address" type="text">        
                 </div>
             </div>
             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="name">Phone: </label>
                
                   <input class="form-control" value="{{$profile->phone}}" requiblue="" id="mo"  name="phone" type="text">        
                 </div>
             </div>


             <div class="form-group"  style="padding-top:10px;">
                <div class="col-md-12">
                <label class="mm" for="img">Photo: </label>
                
                    <span class="btn btn-info btn-file" style="margin: 10px;">
                        <i class="fa fa-image"></i> Choose file <input type="file" style=" opacity:0; height: 10px; width: 50px;" name="img">
                    </span>
                 </div>
             </div>

             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="summary">Summary: </label>
                
                   <textarea class="form-control" requiblue="" id="details" rows="4" name="summary">{{$profile->summary}}</textarea>   

                 </div>
             </div>
             
             <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top:10px;">Close</button>
                <button type="submit" class="btn btn-info" style="margin-top:10px;">Save</button>
                
            </div>
            
         </form>
      </div>
      
    </div>
  </div>
</div>

@endsection