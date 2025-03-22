<!-- resources/views/popup/quickView.blade.php -->
<div class="quickview-popup">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $product->name }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('template/assets/images/demos/demo-3/products/product-1.jpg') }}"
                         alt="{{ $product->name }}" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <p><strong>Category:</strong> {{ $product->category->name ?? 'Uncategorized' }}</p>
                    <div class="product-price">
                        @if ($product->after_sale_price)
                            <span class="old-price">{{ number_format($product->price, 2) }} EGP</span>
                            <span class="new-price">{{ number_format($product->after_sale_price, 2) }} EGP</span>
                        @else
                            <span class="price">{{ number_format($product->price, 2) }} EGP</span>
                        @endif
                    </div>
                    <p><strong>Stock:</strong> {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</p>
                    <p>{{ $product->description }}</p>
                    <a href="#" class="btn btn-primary btn-cart {{ $product->stock > 0 ? '' : 'disabled' }}"
                       title="Add to Cart" @if ($product->stock <= 0) onclick="return false;" @endif>
                        <span>Add to Cart</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .quickview-popup .old-price {
        color: red;
        text-decoration: line-through;
        font-size: 0.9rem;
    }

    .quickview-popup .new-price {
        font-weight: bold;
        color: #333;
    }

    .quickview-popup .price {
        color: #333;
    }

    .quickview-popup .product-price {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 10px 0;
    }
</style>