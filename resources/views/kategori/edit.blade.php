@extends('layouts.master')
@section('content')

<form action="{{ route('category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="category">Category</label>
        <select name="category" id="category" class="form-control">
            <option value="">-- Select Category --</option>
            <option value="A" {{ $category->category === 'A' ? 'selected' : '' }}>A</option>
            <option value="M" {{ $category->category === 'M' ? 'selected' : '' }}>M</option>
            <option value="BHP" {{ $category->category === 'BHP' ? 'selected' : '' }}>BHP</option>
            <option value="BTHP" {{ $category->category === 'BTHP' ? 'selected' : '' }}>BTHP</option>
        </select>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" name="description" id="description" class="form-control" value="{{ $category->description }}">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection