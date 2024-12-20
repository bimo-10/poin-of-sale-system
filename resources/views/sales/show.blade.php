@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sale #{{ $sale->id }}</h1>
        <p><strong>Date:</strong> {{ $sale->sale_date }}</p>
        <p><strong>Total Price:</strong> ${{ number_format($sale->total_price, 2) }}</p>
        <h3>Products</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->details as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>${{ number_format($detail->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
