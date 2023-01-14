@extends('layout')
@section('content')
    <h3>Products</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2, '.', ',') }}</td>
                    <td><a href="{{ route('detail', $product->id) }}" class="btn btn-primary">Buy</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$products->links()}} 
@endsection