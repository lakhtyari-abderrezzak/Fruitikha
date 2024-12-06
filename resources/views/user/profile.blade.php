@extends('layouts.master')


@section('content')
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>See more Details</p>
						<h1>{{Auth()->user()->username}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->
    <!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
            <div id="form_status">
                @session('success')
                    <div class="alert alert-success" info="alert">{{$value}}</div>
                @endsession
            </div>
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="{{asset('storage/' . Auth()->user()->user_img)}}" alt="Profile Picture">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<p>Name: <span>{{Auth()->user()->username}}</span> </p>
						<p>Email: <span>{{Auth()->user()->email}}</span></p>
						<small>Status: <span>{{Auth()->user()->status}}</span></small>
                        <div class="cart-btn">
                            <a href="{{url('/user/edit')}}" class="boxed-btn" >
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                        </div>
						<h4>Share:</h4>
						<ul class="product-share">
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single product -->
    
@endsection