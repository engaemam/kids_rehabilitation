@extends('layouts.master')

@section('content')

<section class="title-transparent page-title" style="background:url(/assets/img/slider.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Messages</h1>
						<div class="breadcrumbs">
							<a href="#">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Messages</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>

			<center style="margin-top: 100px;">
            <div class=" col-md-offset-2 col-md-8  col-sm-8 " style="text-align: left;">
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
              <div class="panel-body " style="padding-top:0px;">
                <ul class="list-group">
                	 @foreach($messages as $message)
                 <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-2">
                                <img src="/assets/img/{{$message->from_status==1?App\Admin::find($message->admin_id)->img : App\Uparent::find($message->parent_id)->img}}" height="100" width="100" alt="user" class="rounded-circle" /></div>
                            <div class="col-xs-8 col-md-8">
                                <div>
                                    
                                    <label style="color: red;">Subject: </label>  {{$message->subject}}
                                    <div class="mic-info">
                                       <label style="color: red;"> By: </label> <a href="#">{{$message->from_status==1?'Admin\ '.App\Admin::find($message->admin_id)->name:'Parent\  '.App\Uparent::find($message->parent_id)->name}} </a><label style="color: red;"> on </label>{{$message->created_at}}
                                    </div>
                                </div>
                                <div class="comment-text">
                                 <label style="color: red;"> Body: </label>   {{$message->body}}
                                </div>
                               
                        @if($message->from_status==3)
					    <a  href="#"  class="btn btn-sm btn-hover btn-info" onclick="document.getElementById('parent_id').value='{{$message->parent_id}}';" data-toggle="modal" data-target="#reply_parent" ><span class="icon-reply" style="padding-right:3px;"></span>Reply to message</a>
					    @endif
					    @if($message->from_status==1)

					    <a  href="#" onclick="document.getElementById('admin_id').value='{{$message->admin_id}}';"  class="btn btn-sm btn-hover btn-info" href="#" data-toggle="modal" data-target="#reply_admin" ><span class="icon-reply" style="padding-right:3px;"></span>Reply to message</a>
					      @endif
      
                              
                            </div>
                        </div>
                    </li>
                    @endforeach
                                       
                                        
                </ul>
                
            </div>

        </div>
        </center>
        
         <div class="modal fade" id="reply_parent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Replay to message</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form id="sub_rep" method="post" enctype="multipart/form-data" action="{{url('/sub/preply')}}">
			                                                  {{csrf_field()}}
                  <input type="hidden" name="parent_id" id="parent_id">
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


			<div class="modal fade" id="reply_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Replay to message</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form id="ad_rep"  method="post" enctype="multipart/form-data" action="{{url('/sub/areply')}}">
			                         {{csrf_field()}}
                  <input type="hidden" name="admin_id" id="admin_id">
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
			        <button type="submit" onclick="document.getElementById('ad_rep').submit();"  class="btn btn-danger" >Save</button>
			      </div>
			    </div>
			  </div>
			</div>
<div class="clearfix"></div>
					</div>
@endsection