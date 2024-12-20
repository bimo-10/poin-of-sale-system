@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ $product->price }}"
                    step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" id="stock" name="stock" class="form-control" value="{{ $product->stock }}"
                    required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
