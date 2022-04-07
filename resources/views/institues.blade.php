@extends('layouts.master')

@section('content')

<section class="title-transparent page-title" style="background:url(/assets/img/slider.jpg);">
				<div class="container">
					<div class="title-content">
						<h1>Institues</h1>
						<div class="breadcrumbs">
							<a href="#">Home</a>
							<span class="gt3_breadcrumb_divider"></span>
							<span class="current">Institues</span>
						</div>
					</div>
				</div>
			</section>
			<div class="clearfix"></div>
			<section>
				<div class="container">

					

					
					<div class="row">
						@foreach($institues as $institue)
						<div class="col-md-4 col-sm-6">
							<div class="blog-box blog-grid-box">
								<div class="blog-grid-box-img">
									<img src="/assets/img/{{$institue->img}}" class="img-responsive" alt="" />
								</div>
								<div class="blog-grid-box-content">
									<div class="blog-avatar text-center">
										<img src="/assets/img/{{App\Sub::find($institue->sub_id)->img}}" class="img-responsive" alt="" />
										<p><strong>Manager</strong> <span class="theme-cl">{{App\Sub::find($institue->sub_id)->name}}</span></p>
									</div>
									<h4>{{$institue->name}}</h4>
									<p>You can easily rehabite your kid in our institue.</p>
									<a href="{{url('/institue/details',['id'=>$institue->id])}}" class="theme-cl" title="see More..">See more..</a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="bs-example">
								<div class="pagination">
									{{$institues}}
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>



@endsection