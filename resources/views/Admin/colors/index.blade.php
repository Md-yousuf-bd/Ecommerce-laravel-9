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
                        <a href="{{ url('other/colors/create') }}" class="btn btn-primary btn-sm text-white  float-end ">Add
                            Colors
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Color Name</th>
                                    <th>Color Code</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($colors as $color)
                                    <tr>
                                        <td>{{ $color->id }}</td>
                                        <td>{{ $color->name }}</td>
                                        <td>{{ $color->code }}</td>
                                        <td>{{ $color->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                        <td>
                                            <a href="{{ url('other/colors/'.$color->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="{{ url('other/colors/'.$color->id.'/delete') }}" onclick="return confirm('Are you sure, you want to delete ')" class="btn btn-sm btn-danger">delete</a>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Colors Available</td>
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
