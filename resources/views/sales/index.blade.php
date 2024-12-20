@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sales</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">Add Sale</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->sale_date }}</td>
                        <td>${{ number_format($sale->total_price, 2) }}</td>
                        <td>
                            <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-info btn-sm">View</a>
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this sale?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
