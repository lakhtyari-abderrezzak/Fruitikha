@extends('layouts.master')


@section('content')
    <!-- Login form -->
    <div class="contact-from-section mt-150 mb-150">
        <div class="container">
            <h1 class="d-flex justify-content-center "> Welcome 
                <span style="color: #da8b45" class="ml-2">{{auth()->user()->username}}</span>
            </h1>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="form-title d-flex justify-content-center align-items-center m-4">
                        <h2>Add New Category</h2>
                    </div>

                    <div class="contact-form">
                        @if (session('success'))
                            <x-flash-msg msg="{{ session('success') }}" bg="success" />
                        @elseif (session('Delete'))
                            <x-flash-msg msg="{{ session('Delete') }}" bg="danger" />
                        @endif
                        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <p>
                                <input type="text" class=" @error('name') border-danger @enderror"
                                    style="width: 98% !important" id="name" name="name"
                                    placeholder="Enter Name of The Product">
                            </p>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <p>
                                <textarea name="description" id="description" cols="30" rows="8" placeholder="Description"
                                    class=" @error('description') border-danger @enderror"></textarea>
                            </p>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <p>
                                <label for="img_path">Upload Image</label>
                                <input type="file" name="img_path" id="img_path">
                            </p>
                            @error('img_path')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <p><input type="submit" value="New Category"></p>
                        </form>

                    </div>

                </div>
            </div>
            <h3 class="d-flex justify-content-center  mb-6"> List of Categories
            </h3>
            <div class="row">
                @foreach ($categories as $category)
                   <x-category_card  :category="$category">
                        {{-- Delete Slot --}}
                        <form action="{{route('categories.destroy', $category)}}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this resource?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                        {{-- Update Slot --}}
                        <a  href="{{route('categories.edit', $category)}}"
                            class="btn btn-success">
                            Update
                        </a>
                   </x-category_card>
                @endforeach

            </div>

        </div>
    </div>
    <!-- end Categories form -->
        <!-- cart -->
        <div class="cart-section mt-150 mb-150">
            <h3 class="title d-flex justify-content-center mb-6"> Latest Added Carts</h3>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="cart-table-wrap">
                            <table class="cart-table">
                                <thead class="cart-table-head">
                                    <tr class="table-head-row">
                                        <th class="product-remove"></th>
                                        <th class="product-image">Product Image</th>
                                        <th class="product-total">Product Name</th>
                                        <th class="product-name">Customer Name</th>
                                        <th class="product-user">Email</th>
                                        <th class="product-price">Phone</th>
                                        <th class="product-quantity">Address</th>
                                        <th class="product-quantity">Status</th>
                                        <th class="product-quantity">Change Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="table-body-row">
                                            <td class="product-remove">
                                                <form action="{{ route('order.destroy', $order) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this resource?');">
                                                    @csrf
                                                    <button type="submit" class="cart-btn">&times;</button>
                                                </form>
                                            </td>
                                            <td class="product-image"><img
                                                    src="{{ asset('storage/' . $order->product->img_url) }}" alt=""></td>
                                            <td class="product-name ">{{ $order->product->name }}</td>
                                            <td class="product-user ">{{ $order->name }}</td>
                                            <td class="product-price" id="product-price ">{{ $order->email }}</td>
                                            <td class="product-quantity">{{ $order->phone }}</td>   
                                            <td class="product-total" id="product-total">
                                                {{$order->address}}
                                            </td>
                                            <td class="product-price" id="product-price ">{{ $order->status }}</td>
                                            <td class="product-price" id="product-price ">
                                                <form action="{{ route('order.change', $order) }}" method="POST">
                                                    @csrf
                                                    <Select name="status">
                                                        <option value="In Progress">In Progress</option>
                                                        <option value="Delivered">Delivered</option>
                                                        <option value="Pending">Pending</option>
                                                    </Select>
                                                    <button class="cart-btn" type="submit">Change</button>
                                                </form>
                                            </td>
                                            
                                        </tr>
                                                
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    
        
@endsection
