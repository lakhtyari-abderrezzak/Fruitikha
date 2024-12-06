@extends('layouts.master')


@section('content')
    <!-- Login form -->
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="form-title">
                        <h2>Login</h2>

                    </div>
                    
                    <div class="contact-form">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text"
                                    class="form-control @error('email') border-danger 
                            @enderror"
                                    id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Passowrd</label>
                                <input type="password"
                                    class="form-control @error('password') border-danger
                             @enderror"
                                    name="password" id="password" placeholder="Enter Strong Password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" class="" name="remember" id="remember">
                                <label for="remember" class="form-label">Remember Me</label>
                            </div>
                            @error('failed')
                                    <p class="text-danger">{{ $message }}</>
                                    @enderror
                            <p><input type="submit" value="Login"></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact form -->
@endsection
