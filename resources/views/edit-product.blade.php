@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="text-center mb-5 mt-3">Edit product</h1>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$product->name}}</div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data"
                            action="{{ route('edit-product', ['id' => $product->id]) }}">
                            @csrf

                            <div class="row mb-3">
                                <img src="../images/{{ $product->image }}" class="img-thumbnail mb-2 mx-auto" alt={{ $product->name }} style="width: 18rem;">
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') ? old('name') : $product->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
                                        <option {{$product->category_id == null ? "selected" : ""}}>--- Choose a category ---</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == $product->category_id ? "selected" : ""}}>
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" row="10" required autocomplete="description" autofocus rows="6">{{ old('description') ? old('description') : $product->description }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>

                                        <input type="text" id="price" type="text"
                                            class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ? old('price') : $product->price }}" required autocomplete="price" autofocus
                                            placeholder="{{ $product->price }}">

                                        <span class="input-group-text">.00</span>

                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-end">{{ __('New image') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror" autofocus>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
