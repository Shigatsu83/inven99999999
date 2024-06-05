@extends('layouts.master')
@section('content')

<form action="{{ route('category.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="category">Kategori</label>
        <select name="category" id="category" class="form-control">
            <option value="">-- Select Category --</option>
            <option value="A">Alat</option>
            <option value="M">Modal</option>
            <option value="BHP">Barang Habis Pakai</option>
            <option value="BTHP">Barang Tidak Habis Pakai</option>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
    

@endsection