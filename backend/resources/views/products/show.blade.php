@extends('layouts.app')

@section('title', 'Detail Product')
    
@section('content')
    <div class="row">
        <div class="col-8">
            <span class="text-muted small">Product ID: {{ $product->id }}</span>
            <h1 class="h3 mt-2">
                {{ $product->name }}
            </h1>
            <h2 class="h5">
                $ {{ $product->price }}
            </h2>
            <p>{!! nl2br(e($product->description)) !!}</p>

            @if ($product->section_id == null)
                <div class="text-muted small">Uncategorized</div>
            @else
                <div class="text-muted small">{{ $product->section->name }}</div>
            @endif
        </div>
        <div class="col-4">
            @if ($product->image)
                <img src="{{ asset('storage/images/'. $product->image) }}" alt="{{ $product->image }}" class="img-thumbnail">
            @else
                <img src="https://cdn11.bigcommerce.com/s-1812kprzl2/images/stencil/original/products/582/5042/no-image__63632.1665666729.jpg?c=2" class="card-img-top" alt="{{ $product->image }}" style="object-fit: contain; witdth: 200px; height: 300px;">       
            @endif
        </div>
    </div>

    <div class="row mt-3">
        <div class="col text-end">
            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-secondary">
                <i class="fa-solid fa-pen"></i> Edit
            </a>

            <!-- Button trigger modal -->
            <a data-bs-toggle="modal" data-bs-target="#delete-product-{{ $product->id }}" class="btn btn-danger">
                <i class="fa-solid fa-trash-can"></i> Delete
            </a>
        </div>

        @include('products.modal.delete') 
        
    </div>
@endsection

