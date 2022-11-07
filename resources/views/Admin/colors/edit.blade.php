@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Colors
                        <a href="{{ url('other/colors') }}" class="btn btn-danger btn-sm text-white  float-end ">Back
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('other/colors/' . $colors->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Color Name</label>
                            <input type="text" name="name" value="{{ $colors->name }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Color Code</label>
                            <input type="text" name="code" value="{{ $colors->code }}"  class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Status</label> <br/>
                            <input type="checkbox" name="status" {{ $colors->status ? 'checked':'' }}  style="width:50px; height:50px" > checked=hidden,Unchecked=Visible
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
