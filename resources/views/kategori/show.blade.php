@extends('layouts.master')
@section('content')
    <h1>{{ $category->category }}</h1>
    <p>{{ $category->description }}</p>
    <a href="{{ route('category.index') }}" class="btn btn-primary">Kembali</a>
    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('category.destroy', $category->id) }}" method="post" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>
@endsection