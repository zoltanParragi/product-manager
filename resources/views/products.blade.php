@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mt-5">Products</h1>

        
        <div class="row">
            <h4 class="mt-3">Categories</h4>
            <div>
                @foreach ($categories as $category)
                    <a class="me-3" href="{{route('get-category-products', [$category->id, 'products'])}}">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>

        <a class="nav-link mt-4" href="{{ route('add-product') }}">
            <button class="btn btn-success">
                {{ __('Add a new product') }}
            </button>
        </a>

        <div class="row justify-content-around mt-4 mb-4">
            @foreach ($products as $product)
                <div class="card m-3 p-0" style="width: 18rem;">
                    <img src="/images/{{ $product->image }}" class="card-img-top" alt={{ $product->name }}>
                    <div class="card-body">
                        <h4 class="card-title fw-bold">{{ $product->name }}</h4>
                        
                        @foreach ( $categories as $category)
                            @if($category->id == $product->category_id) 
                                    <p class="fst-italic text-end">{{ $category->name }}</p>
                                
                            @endif
                        @endforeach

                        <p class="card-text">{{ $product->description }}</p>
                    </div>
    
                    <div class="m-3">
                        <p class="fw-bold">${{ $product->price }}</p>
                        @auth
                        
                            <a href="{{route('edit-product-form', ['id' => $product->id])}}" class="btn btn-primary">Edit product</a>
                            <a href="{{route('delete-product', ['id' => $product->id])}}" class="btn btn-danger">Delete</a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
