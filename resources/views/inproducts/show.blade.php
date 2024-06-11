@extends('layouts.master')
@section('h1-title', 'Product Masuk')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
                <h1>Show Product</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product Details</h5>
                            <p><strong>Quantity:</strong> {{ $item->qty }}</p>
                            <p><strong>Date:</strong> {{ $item->tgl_masuk }}</p>
                            <p><strong>Product:</strong> {{ $item->product->title }}</p>
                            <p><strong>Description:</strong> {{ $item->product->description }}</p>
                    <p><a href="{{ route('outproducts.index') }}" class="btn btn-primary">Back</a></p>
                </div>
        </div>
    </div>
</div>
@endsection