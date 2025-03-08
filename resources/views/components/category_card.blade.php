@props(['category'])

<div class="col-lg-4 col-md-6 text-center">
    <div class="single-product-item">
        <div class="product-image">
            <a href="{{route('categories.catProduct', $category)}}"><img
                    src="{{ asset('storage/' . $category->img_path  )}}"></a>
        </div>
        <div class="m-4" >
            <p style="height: 102px !important">{{Str::limit($category->description, 130, '...')}}
                <a href="{{route('categories.show', $category)}}">Read More</a></p> 
        </div>
        <div class="d-flex justify-content-around">
            {{ $slot }}
        </div>
    </div>
</div>