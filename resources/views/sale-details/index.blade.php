@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sale Details</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sale ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saleDetails as $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->sale_id }}</td>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>${{ number_format($detail->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
