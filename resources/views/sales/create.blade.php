@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Sale</h1>
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="sale_date" class="form-label">Sale Date</label>
                <input type="date" id="sale_date" name="sale_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="products" class="form-label">Products</label>
                <div id="products">
                    @foreach ($products as $product)
                        <div class="form-check">
                            <input type="checkbox" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}"
                                class="form-check-input">
                            <label class="form-check-label">
                                {{ $product->name }} (${{ number_format($product->price, 2) }}) - Stock:
                                {{ $product->stock }}
                            </label>
                            <input type="number" name="products[{{ $loop->index }}][quantity]" placeholder="Quantity"
                                class="form-control mt-1" min="1">
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
