@extends('layouts.app')

@section('title')
    {{ $category->meta_title }}
@endsection

@section('meta_keyword')
    {{ $category->meta_keyword }}
@endsection

@section('meta_description')
    {{ $category->meta_description }}
@endsection

@section('content')

<div class="">
    <livewire:frontend.product.view :product="$product" :category="$category"/>
</div>

@endsection
