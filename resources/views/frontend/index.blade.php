@extends('layouts.app')
@section('title', 'home page')
@section('content')
    {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $key => $sliderItem)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }} active">
                    @if ($sliderItem->image)
                        <img class="d-block w-100" src="{{ asset("$sliderItem->image") }}" alt="First slide">
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $sliderItem->title }}</h5>
                        <p>{{ $sliderItem->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> --}}
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $key => $sliderItem)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }} ">
                @if ($sliderItem->image)
                    <img class="d-block w-100" src="{{ asset("$sliderItem->image") }}" alt="First slide" width="90%" height="400px">
                @endif
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $sliderItem->title }}</h5>
                    <p>{{ $sliderItem->description }}</p>
                </div>
            </div>
        @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
@endsection
