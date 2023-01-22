<div>
    @include('livewire.admin.brand.mode-form')
    <div class="row">
        <div class="col-md-12">
            @if (session('massage'))
                <div class="alert alert-success">{{ session('massage') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                        Brands List
                        <a class="btn btn-primary btn-sm float-end " data-bs-toggle="modal" data-bs-target="#brandModal"
                            href="#">Add Brands</a>
                    </h4>
                </div>
                <div>
                    <table class="table table-brodered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($brands as  $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        @if ($brand->category)
                                            {{ $brand->category->name }}
                                        @else
                                            No category
                                        @endif
                                    </td>
                                    <td>{{ $brand->slug }}</td>
                                    <td>{{ $brand->status == '1' ? 'hidden' : 'visible' }}</td>
                                    <td>
                                        <a wire:click="editBrand({{ $brand->id }})" data-bs-toggle="modal"
                                            data-bs-target="#brandUpdateModal" class="btn btn-sm btn-success">Edit</a>
                                        <a wire:click="deleteBrand({{ $brand->id }})" data-bs-toggle="modal"
                                            data-bs-target="#brandDeleteModal" class="btn btn-sm btn-danger">Delete</a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No Brands Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-2 ms-2">
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
