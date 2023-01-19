@extends('layouts.app')
@section('title', 'home page')
@section('content')
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner " >
            @foreach ($sliders as $key => $sliderItem)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}  ">
                    @if ($sliderItem->image)
                        <img class="d-block w-100" src="{{ asset("$sliderItem->image") }}" alt="First slide" width="90%" height="300px">
                    @endif
                    <div class="carousel-caption d-none d-md-block " >
                        <div class="custom-carousel-content mt-4">
                            <h1>
                                {!! $sliderItem->title  !!}
                            </h1>
                            <p>
                               {!! $sliderItem->description !!}
                            </p>
                            <div>
                                <a href="#" class="btn btn-slider">
                                    Get Now
                                </a>

                            </div>
                        </div>
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
