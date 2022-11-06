<!-- Modal -->
<div wire:ignore.self class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Brads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModel"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='storeBrand()' action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Brand Name</label>
                        <input wire:model.defer="name" type="text" class="form-control" placeholder="Brand Name">
                        @error('name')
                            <small class="text-danger">{{ $massage }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Brand slug</label>
                        <input wire:model.defer="slug" type="text" class="form-control" placeholder="Brand slug">
                        @error('slug')
                            <small class="text-danger">{{ $massage }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Status</label>
                        <input wire:model.defer="status" type="checkbox">
                        @error('slug')
                            <small class="text-danger">{{ $massage }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModel" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Update Modal -->
<div wire:ignore.self class="modal fade" id="brandUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Brads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModel"
                    aria-label="Close"></button>
            </div>
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent='updateBrand()'>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Brand Name</label>
                            <input wire:model.defer="name" type="text" class="form-control"
                                placeholder="Brand Name">
                            @error('name')
                                <small class="text-danger">{{ $massage }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Brand slug</label>
                            <input wire:model.defer="slug" type="text" class="form-control"
                                placeholder="Brand slug">
                            @error('slug')
                                <small class="text-danger">{{ $massage }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Status</label>
                            <input wire:model.defer="status" type="checkbox">
                            @error('slug')
                                <small class="text-danger">{{ $massage }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModel" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--Delete Modal -->
<div wire:ignore.self class="modal fade" id="brandDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Brads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModel"
                    aria-label="Close"></button>
            </div>
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent='destroyBrand'>
                    <div class="modal-body">
                        <h6 class="text-danger">Are you sure you want to delete this data ?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModel" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

