@extends('layouts/master')

@section('content')
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Categories</span></h3>
                        <p>Explore our diverse range of categories designed to meet all your needs. Discover what you love
                            today and find everything you need in one convenient place!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($categories as $category)
                    <x-category_card :category="$category " />
                @endforeach
            </div>
        </div>
    </div>
@endsection
