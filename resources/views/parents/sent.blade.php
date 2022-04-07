@extends('layouts.master')

@section('content')

<section class="title-transparent page-title" style="background:url(/assets/img/slider.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Sent</h1>
						<div class="breadcrumbs">
							<a href="#">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Sent</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>

			<center style="margin-top: 100px;">
            <div class=" col-md-offset-2 col-md-8  col-sm-8 " style="text-align: left;">
            	
              <div class="panel-body " style="padding-top:0px;">
                <ul class="list-group">
                	 @foreach($messages as $message)
                 <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-2">
                                <img src="/assets/img/{{$message->to_status==1?App\Admin::find($message->admin_id)->img : App\Sub::find($message->sub_id)->img}}" height="100" width="100" alt="user" class="rounded-circle" /></div>
                            <div class="col-xs-8 col-md-8">
                                <div>
                                    
                                    <label style="color: red;">Subject: </label>  {{$message->subject}}
                                    <div class="mic-info">
                                       <label style="color: red;"> By: </label> <a href="#">{{$message->to_status==1?'Admin\ '.App\Admin::find($message->admin_id)->name:'Sub Admin\  '.App\Sub::find($message->sub_id)->name}} </a><label style="color: red;"> on </label>{{$message->created_at}}
                                    </div>
                                </div>
                                <div class="comment-text">
                                 <label style="color: red;"> Body: </label>   {{$message->body}}
                                </div>
      
                              
                            </div>
                        </div>
                    </li>
                    @endforeach
                                       
                                        
                </ul>
                
            </div>

        </div>
        </center>

<div class="clearfix"></div>
					</div>
@endsection