@extends('layouts.app')
@section('title', 'All categores')
@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4 text-primary">Our Categories</h4>
                </div>

                @forelse ($categories as $categorieData)
                    <div class="col-6 col-md-3">
                        <div class="category-card">
                            <a href="{{ url('/collections/'.$categorieData->slug) }}">
                                <div class="category-card-img">
                                    <img src="{{ asset($categorieData->image) }}" style="border-radius: 10px" class="w-100" height="250px" alt="Laptop">
                                </div>
                                <div class="category-card-body">
                                    <h5 class="text-primary">{{ $categorieData->name }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <h4>No Category Fount..!!!</h4>
                @endforelse
            </div>
        </div>
    </div>
@endsection
