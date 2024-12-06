@extends('layouts.master')

@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Check Out Product</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Billing Address
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        @if(session('success'))
                                            <div class="text-success">{{session('success')}}</div>
                                        @endif
                                        <div class="billing-address-form">
                                            <form action="{{route('checkout.order')}}" method="POST">
                                                @csrf
                                                <p><input type="text" placeholder="Name" name="name" class="@error('name') border-danger @enderror"></p>
                                                @error('name')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                                <p><input type="email" placeholder="Email" name="email" class="@error('email') border-danger @enderror"></p>
                                                @error('email')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                                <p><input type="text" placeholder="Address" name="address"class="@error('address') border-danger @enderror"></p>
                                                @error('address')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                                <p><input type="tel" placeholder="Phone" name="phone"class="@error('phone') border-danger @enderror"></p>
                                                @error('phone')
                                                    <p class="text-danger m-2">{{$message}}</p>
                                                @enderror
                                                <button type="submit" class="cart-btn">
                                                    <i class="fas fa-coins"></i>
                                                    save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->
@endsection
