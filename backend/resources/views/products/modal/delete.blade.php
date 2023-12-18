<div class="modal fade" id="delete-product-{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Product</h1>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h1 class="h4">{{ $product->name }}</h1>
                </div>
                <div class="mb-3">
                    @if ($product->section_id == null)
                        <p><span class="text-muted">Section: </span>Uncategorized</p>
                    @else
                        <p><span class="text-muted">Section: </span>{{ $product->section->name }}</p>
                    @endif
                </div>
                <div class="mb-3">
                    <p><span class="text-muted">Price: </span>${{ $product->price }}</p>
                </div>
                <div class="mb-3">
                    <p><span class="text-muted">Description: </span>{{ $product->description }}</p>
                </div>
            </div>
            <div class="modal-footer border border-0">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('product.destroy', $product->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div

