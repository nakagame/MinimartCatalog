@extends('layouts.app')

@section('title', 'Edit Product')
    
@section('content')
    <h1 class="mb-3">Edit Product</h1>

    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" autofocus>
            @error('name')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" rows="5" class="form-control">{{ old('description' , $product->description) }}</textarea>
            @error('description')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label fw-bold">Price</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" name="price" id="price" step="0.01" value="{{ old('price', $product->price) }}">
            </div>
            @error('price')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="section" class="form-label fw-bold">Section</label>
            <select name="section" id="section" class="form-select">
                <option value="" hidden>Select Section</option>
                @isset($all_sections)
                    @foreach($all_sections as $section)
                        @if ($section->id === $product->section_id)
                            <option value="{{ $section->id }}" selected>{{ $product->section->name }}</option>                    
                        @else
                            <option value="{{ $section->id }}">{{ $section->name }}</option>                        
                        @endif
                    @endforeach   
                @endisset
            </select>

            @if (count($all_sections) === 0)
                <a href="{{ route('section.index') }}" class="text-decoration-none">Add a new section</a>
            @endif

            @error('section')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
            <div id="image-info" class="form-text">
                Acceptable formats are jpeg, png, gif only.
                Maximum file size is 1048kb.
            </div>
            @error('image')
                <p class="text-danger small">{{ $message }}</p>
            @enderror
        </div>

        <a href="{{ route('index') }}" class="btn btn-outline-secondary">Cancel</a>
        <button type="submit" class="btn btn-secondary ms-1 px-5 fw-bold">
            <i class="fa-solid fa-check"></i> Save changes
        </button>
    </form>
@endsection