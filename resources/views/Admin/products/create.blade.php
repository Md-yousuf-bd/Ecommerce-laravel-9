@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Products
                        <a href="{{ url('other/products') }}" class="btn btn-danger btn-sm text-white  float-end ">Back
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    @if ($errors->all())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger mb-2">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form action="{{ url('other/products') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">SEO
                                    Tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image"
                                    type="button" role="tab" aria-controls="contact" aria-selected="false">Product
                                    Images</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="product-color-tab" data-bs-toggle="tab"
                                    data-bs-target="#productColor" type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Product Color</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="mb-3 mt-4">
                                    <label for="" class="fw-bold mb-2">Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="null">Select Category Name</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="fw-bold mb-2">Product Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="fw-bold mb-2">Product Slug</label>
                                    <input type="text" name="slug" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="fw-bold mb-2">Select Brand</label>
                                    <select name="brand" class="form-control">
                                        <option value="null">
                                            <--select Brand-->
                                        </option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="fw-bold mb-2">Small Description(500 Words)</label>
                                    <input type="text" name="small_description" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="" class="fw-bold mb-2">Description</label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="mb-3">
                                    <label for="" class="fw-bold mb-2">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="fw-bold mb-2">Meta Description</label>
                                    <input type="text" name="meta_description" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="fw-bold mb-2">Meta Keyword</label>
                                    <input type="text" name="meta_keyword" class="form-control">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3 mt-3">
                                            <label for="" class="fw-bold mb-2">Original Price</label>
                                            <input type="text" name="original_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3 mt-3">
                                            <label for="" class="fw-bold mb-2">Selling Price</label>
                                            <input type="text" name="selling_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3 mt-3">
                                            <label for="" class="fw-bold mb-2">Quantity</label>
                                            <input type="text" name="quantity" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3 mt-3">
                                            <label for=""  class="fw-bold mb-2">Trending</label> <br>
                                            <input type="checkbox" name="trending" style="width: 50px; height:50px;"
                                                >
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3 mt-3">
                                            <label for="" class="fw-bold mb-2">Status</label> <br>
                                            <input type="checkbox" name="status" style="width: 50px; height:50px;"
                                               >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="mb-3">
                                    <label>Upload Product Images</label>
                                    <input type="file" name="image[]" multiple class="form-control" />
                                </div>
                            </div>
                            <div class="tab-pane fade" id="productColor" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="m-4">
                                    <label for="" class="mb-3">Select Color</label>
                                    <div class="row">
                                        @forelse ($colors as $color)
                                            <div class="col-3 border m-2  p-2">
                                              Color:  <input class="mb-3" type="checkbox" name="colors[{{ $color->id }}]" value="{{ $color->id }}">
                                                {{ $color->name }}
                                                <br/>
                                              Quantity: <input type="number" name="colorQuantity[{{ $color->id }}]" style="width:70px; border:1px solid">
                                            </div>
                                        @empty
                                          <div class="col-md-12">
                                            <h1>No colors found..!!</h1>
                                          </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
