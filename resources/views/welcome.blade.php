@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mt-5">Our products</h1>

        <div class="row">
            <h4 class="mt-3">Categories</h4>
            <div>
                @foreach ($categories as $category)
                    <a class="me-3" href="{{route('get-category-products', [$category->id, 'welcome'])}}">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>

        <div class="row justify-content-around mt-5 mb-5">
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
                    <p class="m-3 fw-bold">${{ $product->price }}</p>
                </div>
            @endforeach
        </div>

    </div>
@endsection
