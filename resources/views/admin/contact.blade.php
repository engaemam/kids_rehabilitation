@extends('layouts.master')

@section('content')

<section class="title-transparent page-title" style="background:url(/assets/img/slider.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Geusts messages</h1>
						<div class="breadcrumbs">
							<a href="#">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Messages from guests</span>
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
                           
                            <div class="col-xs-8 col-md-8">
                                <div>
                                    
                                    <label style="color: blue;">Name: </label>  {{$message->name}}
                                    <div class="mic-info">
                                       <label style="color: blue;">Email: </label> <a href="#">{{$message->email}} </a><label style="color: blue;"> on </label>{{$message->created_at}}
                                    </div>
                                </div>
                                <div class="comment-text">
                                 <label style="color: blue;"> Body: </label>   <p>{{$message->body}}</p>
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