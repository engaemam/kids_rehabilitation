         <nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
				<div class="container-fluid">         
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
						<i class="ti-align-left"></i>
					</button>
					
					<div class="navbar-header">
						<a class="navbar-brand" href="">
							<img src="/assets/img/logo.png" class="logo logo-display" alt="">
							<img src="/assets/img/logo.png" class="logo logo-scrolled" alt="">
						</a>
					</div>

					<div class="collapse navbar-collapse" id="navbar-menu">
						<ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
							
							<li><a  href="{{url('/')}}"  >Home</a></li>
							<li><a  href="{{url('/programs')}}"  >Programs</a></li>

							@if(!auth()->guard('admin')->user()&&!auth()->guard('sub')->user())
                             <li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">Categories</a>
                                    <ul class="dropdown-menu animated fadeOutUp">
                                        @foreach(App\Category::all() as $cat)
                                        <li><a href="{{url('/programs/cat',['id'=>$cat->id])}}">{{$cat->name}} </a></li>
                                        @endforeach
                                    </ul>
                            </li>
                            @endif
							@if(auth()->guard('sub')->user())
							<li><a  href="{{url('/sub/requests')}}">Requests</a></li>
							@endif

							@if(auth()->guard('admin')->user())
							<li><a  href="{{url('/admin/contact')}}">Public Messages</a></li>
							@endif
							<li><a  href="{{url('/institues')}}">Institues</a></li>

							<li><a  href="{{url('/about')}}">About Us</a></li>
							@if(!auth()->guard('parent')->user()&&!auth()->guard('sub')->user()&&!auth()->guard('admin')->user())
							<li><a  href="{{url('/contact')}}">Contact Us</a></li>
							<li><a  href="{{url('/parent/register')}}">Register</a></li>
							<li><a  href="{{url('/parent/login')}}">Login</a></li>
							@endif
							@if(auth()->guard('parent')->user())
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">{{auth()->guard('parent')->user()->name}}</a>
								<ul class="dropdown-menu animated fadeOutUp">
									<li><a href="{{url('/parent/profile')}}">My Profile</a></li>
									<li><a href="{{url('/history/programs')}}">Bookings</a></li>
									<li><a href="{{url('/parent/messages')}}">Messages</a></li>
									<li><a href="{{url('/parent/sent')}}">Sent</a></li>
									<li><a href="{{url('/parent/logout')}}">Logout</a></li>
								</ul>
							</li>
							@endif


							@if(auth()->guard('sub')->user())
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">{{auth()->guard('sub')->user()->name}}</a>
								<ul class="dropdown-menu animated fadeOutUp">
									<li><a href="{{url('/sub/profile')}}">My Profile</a></li>
									<li><a href="{{url('/sub/programs')}}">Our Programs</a></li>
									<li><a href="{{url('/sub/institue')}}">My Institue</a></li>
									<li><a href="{{url('/sub/messages')}}">Messages</a></li>
									<li><a href="{{url('/sub/sent')}}">Sent</a></li>
									<li><a href="{{url('/sub/logout')}}">Logout</a></li>
								</ul>
							</li>
							@endif

							@if(auth()->guard('admin')->user())
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">{{auth()->guard('admin')->user()->name}}</a>
								<ul class="dropdown-menu animated fadeOutUp">
									<li><a href="{{url('/admin/profile')}}">My Profile</a></li>
									<li><a href="{{url('/add/institue')}}">Add Institue</a></li>
									<li><a href="{{url('/admin/messages')}}">Messages</a></li>
									<li><a href="{{url('/admin/sent')}}">Sent</a></li>
									<li><a href="{{url('/admin/logout')}}">Logout</a></li>
								</ul>
							</li>
							@endif


						</ul>
						@if(auth()->guard('sub')->user())
						<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
							<li class="no-pd"><a href="{{url('/add/program')}}" class="addlist"><i class="fa fa-tasks" aria-hidden="true"></i>Add Program</a></li>
						</ul>
						@endif
					</div>
				</div>   
			</nav>
			<div class="clearfix"></div>