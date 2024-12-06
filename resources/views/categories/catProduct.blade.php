@extends('layouts/master')

@section('content')
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">{{$categories->name}}</span></h3>
                        <p>{{$categories->description}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach ($products as $product)
                <x-product_card :item="$product" />
            @endforeach
        </div>
        </div>
    </div>
@endsection