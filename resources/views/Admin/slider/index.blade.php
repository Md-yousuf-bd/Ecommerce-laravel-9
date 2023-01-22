@extends('layouts.admin')
@section('content')
    <div class="row">
        @if (session('massage'))
            <div class="alert alert-success">{{ session('massage') }}</div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="card-header">
                    <h3>Colors List
                        <a href="{{ route('slider.create') }}" class="btn btn-primary btn-sm text-white  float-end ">Add
                            Slider
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Derscription</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($sliderData as $Data)
                                    <tr>
                                        <td>{{ $Data->id }}</td>
                                        <td>{{ $Data->title }}</td>
                                        <td>{{ $Data->description }}</td>
                                        <td><img src="{{ asset($Data->image) }}" alt="" height="50px" width="50px"></td>
                                        <td>{{ $Data->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                        <td>
                                            {{-- <a href="{{ route('') }}" class="btn btn-sm btn-primary">Edit</a> --}}
                                            <a href="{{ route('slider.edit', $Data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ route('slider.delete', $Data->id) }}" onclick="return confirm('Are you sure, you want to delete ')" class="btn btn-sm btn-danger">delete</a>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Colors Available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- <div>
                            {{ $categories->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
