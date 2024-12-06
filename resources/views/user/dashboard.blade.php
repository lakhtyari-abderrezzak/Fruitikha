@extends('layouts.master')


@section('content')
    <!-- create Product form -->
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <h1 class="d-flex justify-content-center "  > Welcome
                <span style="color: #da8b45" class="ml-2">{{auth()->user()->username}}</span>
            </h1>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10 mb-5 mb-lg-0">
                    <div class="form-title d-flex justify-content-center align-items-center m-4">
                        <h2>Add New Product</h2>
                    </div>

                    <div class="contact-form">
                        @if (session('success'))
                                <x-flash-msg   msg="{{session('success')}}" bg="success"/>
                        @elseif (session('Delete'))
                                <x-flash-msg  msg="{{session('Delete')}}" bg="danger"/>
                        @endif
                        
                        <form action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <p>
                                <input type="text"
                                    class=" @error('name') border-danger @enderror" style="width: 98% !important"
                                    id="name" name="name" placeholder="Enter Name of The Product" >
                            </p>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                
                            <p>
                                <input type="text" placeholder="price" name="price" id="price" 
                                       class="@error('price') border-danger @enderror">
                                <input type="text" placeholder="quantity" name="quntity" id="quantity"
                                       class="@error('price') border-danger @enderror">
                            </p>
                            @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            @error('quntity')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            <div class="mb-3">
                                <label for="img_url">Upload Image</label>
                                <input type="file" name="img_url" id="img_url"  class="w-25">
                                @error('img_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            
                                <label for="categories_id" class="form-label">Select Categories</label>
                                <select name="categories_id" class="form-select w-25" >
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p><input type="submit" value="New Item"></p>
                        </form>

                    </div>
                    
                </div>
            </div>
            @if ($products->isNotEmpty())
                <div class="title d-flex justify-content-center align-items-center m-4">
                            <h2>Latest Posts</h2>
                        </div>
                <div class="row">
                    @foreach ($products as $item)
                    <x-product_card  :item="$item" :dash=true>
                            {{-- Delete Slot --}}
                            <form action="{{route('products.destroy', $item)}}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this resource?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                            {{-- Update Slot --}}
                            <a  href="{{route('products.edit', $item)}}"
                                class="btn btn-success">
                                Update
                            </a>
                    </x-product_card>
                    @endforeach

                </div>
            {{ $products->links() }}
            @endif
        </div>
    </div>
    <!-- end contact form -->
@endsection
