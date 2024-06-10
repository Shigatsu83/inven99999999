@extends('layouts.master')
@section('h1-title', 'Product')
@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">IMAGE</th>
            <th scope="col">TITLE</th>
            <th scope="col">PRICE</th>
            <th scope="col">STOCK</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td class="text-center">
                    <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded" style="width: 150px">
                </td>
                <td>{{ $product->title }}</td>
                <td>{{ "Rp " . number_format($product->price,2,',','.') }}</td>
                <td>{{ $product->stock }}</td>
            </tr>
    </tbody>
</table>
@endsection