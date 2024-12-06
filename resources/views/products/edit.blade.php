@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 mb-5 mb-lg-0">
            <div class="form-title d-flex justify-content-center align-items-center m-4">
                <h2>Edit Product</h2>
            </div>

            <div class="contact-form">
                @if (session('success'))
                    <x-flash-msg msg="{{ session('success') }}" bg="success" />
                @elseif (session('Delete'))
                    <x-flash-msg msg="{{ session('Delete') }}" bg="danger" />
                @endif

                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <p>
                        <input type="text" class=" @error('name') border-danger @enderror" style="width: 98% !important"
                            id="name" name="name" value="{{ $product->name }}"
                            placeholder="Enter Name of The Product">
                    </p>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <p>
                        <input type="text" placeholder="price" name="price" id="price"
                            class="@error('price') border-danger @enderror" value="{{ $product->price }}">
                        <input type="text" placeholder="quantity" name="quntity" id="quantity"
                            class="@error('price') border-danger @enderror" value="{{ $product->quntity }}">
                    </p>
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @error('quntity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <label for="categories_id" class="form-label">Select Categories</label>
                        <select name="categories_id" class="form-select" >
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($product->img_url)
                        <div class="image h-25 w-25">
                            <img src="{{ asset('storage/' . $product->img_url) }}" alt="">
                        </div>
                    @endif
                    <p>
                        <label for="img_url">Uplode image</label>
                        <input type="file" id="img_url" name="img_url" value="{{ $product->img_url }}">
                    </p>
                    @error('img_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <p><input type="submit" value="New Item"></p>
                </form>

            </div>

        </div>
    </div>
@endsection
