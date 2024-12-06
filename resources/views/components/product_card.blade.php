@props(['item', 'dash' => false])

<div class="col-lg-4 col-md-6 text-center">
    <div class="single-product-item">
        <div class="product-image" style="min-height:250px !important">
            <a href="{{route('products.show', $item)}}"><img
                    style="max-width: 300px !important; max-height:200px !important"
                    src="{{ asset('storage/' . $item->img_url) }}"></a>
        </div>
        <h3><a href="{{route('products.show', $item)}}">{{ $item->name }}</a></h3>
        <p class="product-price"> {{ $item->price }} $ </p>

        @if ($dash == false)
        <form action="{{route('cart.addToCart', $item)}}" method="POST">
            @csrf
            <p>
                <input type="hidden"  name="product_id" value="{{$item->id}}" >
                <input type="number"  name="quantity" value="1">
                @error('quantity')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </p>
            <button type="submit" class="cart-btn">
                <i class="fas fa-shopping-cart"></i> Add to cart
            </button>
        </form>
        @endif
        
        <p class="d-flex justify-content-around align-items-baseline mt-3" >
            <a href="{{ route('products.user', $item->user) }}" class="font-weight-bold" >{{$item->user->username}}</a>
            <small class="created-at font-weight-bold">{{$item->created_at->diffForHumans()}}</small>
        </p>
        <div class="d-flex justify-content-around">
            {{ $slot }}
        </div>
    </div>
</div>