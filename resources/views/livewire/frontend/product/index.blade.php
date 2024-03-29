<div>
    <div class="row">
        <div class="col-md-3">
            @if ($category->brands)
                <div class="card">
                    <div class="card-header">Brands</div>
                    <div class="card-body">
                        @foreach ($category->brands as $brandItem)
                            <label class="d-block">
                                <input type="checkbox" wire:model="brandInputs" value="{{ $brandItem->name }}">
                                {{ $brandItem->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="card mt-3">
                <div class="card-header">Price</div>
                <div class="card-body">
                    <label class="d-block">
                    <input type="radio" name="priceSort" wire:model="priceInputs" value="high-to-low"> High to low
                    <label class="d-block">
                    <input type="radio" name="priceSort" wire:model="priceInputs" value="low-to-high">
                            Low-to-high
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-4">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($product->quantity > 0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-success">Out of Stock</label>
                                @endif
                                @if ($product->productImages->count() > 0)
                                    <a
                                        href="{{ url('/collections/' . $product->category->slug . '/' . $product->slug) }}">
                                        <img src="{{ asset($product->productImages[0]->image) }}"
                                            alt="{{ $product->name }}">
                                    </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand " style="color: #ffb137">{{ $product->brands->name ?? '' }}</p>
                                <h5 class="product-name">
                                    <a
                                        href="{{ url('/collections/' . $product->category->slug . '/' . $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">${{ $product->selling_price }}</span>
                                    <span class="original-price">${{ $product->original_price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h4 class="text-danger">
                        No product available for {{ $category->name }}
                    </h4>
                @endforelse
            </div>
        </div>
    </div>
</div>
