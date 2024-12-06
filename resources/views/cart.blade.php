@extends('layouts.master')

@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                @if (!$carts->isEmpty())
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-total">Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session('Delete'))
                                    <x-flash-msg msg="{{ session('Delete') }}" bg="danger" />
                                @endif

                                @foreach ($carts as $cart)
                                    <tr class="table-body-row">
                                        <td class="product-remove">
                                            <form action="{{ route('cart.destroy', $cart) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this resource?');">
                                                @csrf
                                                <button type="submit" class="cart-btn">&times;</button>
                                            </form>
                                        </td>
                                        <td class="product-image"><img
                                                src="{{ asset('storage/' . $cart->product->img_url) }}" alt=""></td>
                                        <td class="product-name ">{{ $cart->product->name }}</td>
                                        <td class="product-price" id="product-price ">${{ $cart->product->price }}</td>
                                        <td class="product-quantity" name="quantity" id="product-quantity">
                                            <form action="{{ route('cart.update', $cart) }}" method="POST">
                                                @csrf
                                                <input name="quantity" type="number" placeholder="0"
                                                    value="{{ $cart->quantity }}">
                                        <td class="product-total" id="product-total">
                                            ${{ number_format($cart->quantity * $cart->product->price, 2) }}
                                        </td>
                                        <td><button type="submit" class="cart-btn balck">Update</button></td>
                                        </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (session('success'))
                            <x-flash-msg msg="{{ session('success') }}" bg="success" />
                        @endif
                    </div>
                </div>

                    <div class="col-lg-4">
                        <div class="total-section">
                            <table class="total-table">
                                <thead class="total-table-head">
                                    <tr class="table-total-row">
                                        <th>Total</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="total-data">
                                        <td><strong>Subtotal: </strong></td>
                                        <td>${{ number_format($totalPrice) }}</td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Shipping: </strong></td>
                                        <td>$45</td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Total: </strong></td>
                                        <td>${{ number_format($totalPrice + 45, 2) }}</td>
                                    </tr>
    
                                </tbody>
                            </table>
                            <div class="cart-buttons">
                                <a href="{{ route('checkout.index') }}" class="boxed-btn black">Check Out</a>
                            </div>
                        </div>
                        @else
                        <div class="d-flex justify-content-center">Cart Is Em</div>
                @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->
@endsection
