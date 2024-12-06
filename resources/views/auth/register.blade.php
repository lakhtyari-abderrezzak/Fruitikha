@extends('layouts.master')



@section('content')
    <!-- contact form -->
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>Register</h2>

                    </div>
                    <div id="form_status">
                        @session('success')
							<div class="alert alert-success" info="alert">{{$value}}</div>
						@endsession
                    </div>
                    <div class="contact-form">
                        <form action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">User Name</label>
                                <input type="text" class="form-control 
                                 @error('name') border-danger @enderror" name="username" id="name" placeholder="Enter username" value="{{old('username')}}">
                                @error('name')
                                    <p class="text-danger">{{$message}}</>
                                @enderror
                              </div>
                              <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') border-danger 
                                @enderror" id="email" name="email" placeholder="Enter Email" value="{{old('email')}}">
                                @error('email')
                                    <p class="text-danger">{{$message}}</>
                                @enderror
                              </div>
                              <div class="mb-3">
                                <label for="password" class="form-label">Passowrd</label>
                                <input type="password" class="form-control @error('password') border-danger
                                 @enderror" name="password" id="password" placeholder="Enter Strong Password" >
                                @error('password')
                                    <p class="text-danger">{{$message}}</>
                                @enderror
                              </div>
                              <div class="mb-3">
                                <label for="confirm-pass" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control 
                                @error('password') border-danger @enderror" id="confirm-pass" placeholder="Confirm password">
                              </div>
                              <p>
                                <label for="user_img">Upload Image</label>
                                <input type="file" name="user_img" id="user_img">
                            </p>
                            @error('user_img')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <p><input type="submit" value="submit"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact form -->
@endsection
