@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/oneforall.css') }}">
@endsection
@section('main')
<div>
    @livewire('product-category.product-category-list')
</div>
@endsection

  
