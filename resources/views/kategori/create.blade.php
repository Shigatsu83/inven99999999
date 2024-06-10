@extends('layouts.master')
@section('h1-title', 'Kategori')
@section('content')

    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="category">Kategori</label>
            <select name="category" id="category" class="form-control" @error('category') is-invalid @enderror>
                <option value="">-- Select Category --</option>
                <option value="A">Alat</option>
                <option value="M">Modal</option>
                <option value="BHP">Barang Habis Pakai</option>
                <option value="BTHP">Barang Tidak Habis Pakai</option>
            </select>
            @error('category')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" @error('description') is-invalid @enderror></textarea>
            @error('description')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


@endsection
