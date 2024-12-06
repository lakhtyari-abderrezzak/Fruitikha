@extends('layouts.master')

@section('content')
<div class="single-product mt-150 mb-150">
<div class="container">
    <div class="row">

        <div class="col-lg-8 col-md-12">
            <div class="order-details-wrap">
                <table class="order-details">
                    <thead>
                        <tr>
                            <th>Your order Details</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody class="order-details-body">
                        <tr>
                            <td>Product</td>
                            <td>Total</td>
                        </tr>
                        @foreach ($carts as $cart)
                           <tr>
                            <td>{{$cart->product->name}}</td>
                            <td>${{number_format($cart->product->price * $cart->quantity, 2 )}}</td>
                        </tr> 
                        @endforeach
                        
                        
                    </tbody>
                    <tbody class="checkout-details">
                        <tr>
                            <td>Subtotal</td>
                            <td>${{number_format($totalPrice,2)}}</td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td>$45</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>${{number_format($totalPrice + 45, 2)}}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{url('stripe', $totalPrice + 45)}}" class="cart-btn">
                    <i class="fas fa-credit-card"></i>
                    Card Order</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection