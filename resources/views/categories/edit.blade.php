@extends('layouts.master')

@section('content')
    <div class="row d-felx justify-content-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="form-title d-flex justify-content-center align-items-center m-4">
                <h2>Edit <span>{{$categories->name}}</span></h2>
            </div>

            <div class="contact-form m-auto" >
                @if (session('success'))
                    <x-flash-msg msg="{{ session('success') }}" bg="success" />
                @elseif (session('Delete'))
                    <x-flash-msg msg="{{ session('Delete') }}" bg="danger" />
                @endif
                <form action="{{ route('categories.update', $categories)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <p>
                        <input type="text" class=" @error('name') border-danger @enderror"
                            style="width: 98% !important" id="name" name="name" value="{{$categories->name}}"
                            placeholder="Enter Name of The Product">
                    </p>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <p>
                        <textarea name="description" id="description" cols="30" rows="8" placeholder="Description"
                            class=" @error('description') border-danger @enderror" >{{$categories->description}}</textarea>
                    </p>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                     @if ($categories->img_path) 
                        <div class="image h-25 w-25">
                            <img src="{{ asset('storage/' . $categories->img_path ) }}" alt="">
                        </div>
                     @endif 
                    <p>
                        <label for="img_path">Edit Image</label>
                        <input type="file" name="img_path" id="img_path">
                    </p>
                    @error('img_path')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <p><input type="submit" value="Update Category"></p>
                </form>

            </div>

        </div>
    </div>
@endsection
