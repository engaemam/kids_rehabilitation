
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
					      @if (session()->has('success'))
					    
					            <div class="alert alert-success">
					              
					                <i class="fa fa-check-circle-o"></i> {{session()->get('success')}}
					              
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
						<a href="" class="btn reservation btn-radius theme-btn full-width mrg-top-10" data-toggle="modal"  data-target="#profile">Edit Institue</a>
					</div>
					
					
			</section>
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Edit Institue</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form action="{{url('/institue/edit')}}" method="post" enctype="multipart/form-data">
             
                
        	{{csrf_field()}}
        	<input type="hidden" name="institue_id" value="{{$institue->id}}">
             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="name">Name: </label>
                
                   <input class="form-control" value="{{$institue->name}}" requiblue=""  id="mo"  name="name" type="text">        
                 </div>
             </div>

             
             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="address">Address: </label>
                
                   <input class="form-control" value="{{$institue->address}}" requiblue="" id="mo"  name="address" type="text">        
                 </div>
             </div>
             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="name">Country: </label>
                
                   <input class="form-control" value="{{$institue->country}}" requiblue="" id="mo"  name="country" type="text">        
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
                
                   <textarea class="form-control" requiblue="" id="details" rows="4" name="summary">{{$institue->summary}}</textarea>   

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