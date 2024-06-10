@extends('layouts.master')
@section('h1-title', 'Product Keluar')
@section('content')

<form action="{{ route('outproducts.update', $barangKeluar->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Quantity:</label>
        <input type="numner" name="qty" id="qty" value="{{ old('qty', $barangKeluar->qty) }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="tgl_masuk">Tanggal Masuk:</label>
        <input type="date" name="tgl_masuk" id="tgl_masuk" value="{{ old('tgl_masuk', $barangKeluar->tgl_keluar) }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id" class="form-control" disabled>
            @foreach($productOption as $product)
                <option value="{{ old('product_id', $barangKeluar->id)}}">{{$product->title}}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection