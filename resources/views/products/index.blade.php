@extends('layouts.master')

@section('content')
    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Products</span></h3>
                        <p>Explore our diverse range of categories designed to meet all your needs. Discover what you love
                            today and find everything you need in one convenient place!</p>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <x-flash-msg msg="{{ session('success') }}" bg="success" />
            @elseif (session('fail'))
                <x-flash-msg msg="{{ session('fail') }}" bg="danger" />
            @endif
            <div class="row">
                @foreach ($products as $item)
                    {{-- Product Card Coming From Component Product_card  --}}
                    <x-product_card :item="$item" />
                @endforeach

            </div>
            {{ $products->links() }}
        </div>
    </div>
    <!-- end product section -->
@endsection
