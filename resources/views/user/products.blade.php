@extends('layouts.master')

@section('content')
    
    <div class="container">
        <h1 class="d-flex justify-content-center m-5">{{$user->username}} Posts: {{$products->total()}}</h1>
        @if (session('success'))
                            <x-flash-msg msg="{{ session('success') }}" bg="success" />
                        @elseif (session('Delete'))
                            <x-flash-msg msg="{{ session('fail') }}" bg="danger" />
                        @endif
        <div class="row">
            @foreach ($products as $item)
                <x-product_card :item="$item" />
            @endforeach
        </div>
        {{$products->links()}}
    </div>
@endsection
