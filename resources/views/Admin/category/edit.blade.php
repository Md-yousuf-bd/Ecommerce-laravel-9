@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit category
                        <a href="{{ url('/other/category') }}" class="btn btn-danger btn-sm text-white  float-end ">Back
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    @if ($errors->all())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger mb-2">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form action="{{ url('other/category/' . $record->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $record->name }}" class="form-control" />
                            </div>
                            <div class="mb-3 col-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" value="{{ $record->slug }}" class="form-control" />
                            </div>
                            <div class="mb-3 col-12">
                                <label for="">description</label>
                                <input type="text" name="description" value="{{ $record->description }}"
                                    class="form-control" />
                            </div>
                            <div class="mb-3 col-6">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control" />
                                <img src="{{ asset('/uploads/category/' . $record->image) }}" width="60px" height="60px"
                                    alt="">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="">Status</label><br>
                                <input type="checkbox" name="status" {{ $record->status == '1' ? 'checked' : '' }} />
                            </div>
                            <div class="col-md-12 mb-3">
                                <h4 class="text-info">SEO Tages</h4>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" value="{{ $record->meta_title }}"
                                    class="form-control" />
                            </div>
                            <div class="mb-3 col-12">
                                <label for="">Meta Keyword</label>
                                <textarea name="meta_keyword" class="form-control" rows="3">{{ $record->meta_keyword }} </textarea>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="">Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3">{{ $record->meta_description }}</textarea>
                            </div>
                            <div class="mb-3 col-12">
                                <button type="submit" class="btn btn-primary float-end">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
