@extends('layouts.master')

@section('content')

@forelse ($resetcategory as $rowcategory)
    {{ $rowcategory->id }}
    {{ $rowcategory->deskripsi }}
    {{ $rowcategory->kategori }}
</br>
@empty
@endforelse

@endsection