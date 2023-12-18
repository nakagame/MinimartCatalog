@extends('layouts.app')

@section('title', 'Profile')
    
@section('content')
    <h1>{{ Auth::user()->name }}</h1>

    @forelse ($products as $product)
      <div class="row">
        <div class="col">
            <div class="card mb-3 p-3 bg-white">
              <h2 class="card-title h4">
                <a href="{{ route('product.edit', $product->id) }}" class="text-decoration-none">{{ $product->name }}</a>
              </h2>
              <p class="card-text">{{ $product->section->name }}</p>
              @if ($product->image)
                <img src="{{ asset('storage/images/'. $product->image) }}" alt="{{ $product->image }}" class="card-img-top" alt="{{ $product->image }}" style="object-fit: contain; witdth: 200px; height: 300px;">  
              @endif
                <div class="card-body">
                  <p class="card-text">{{ $product->description }}</p>
                  <p class="card-text">$ {{ $product->price }}</p>
                  <p class="card-text"><small class="text-body-secondary">The Latest updated is {{ $product->updated_at->diffForHumans() }}</small></p>
                </div>
            </div>
        </div>
      </div>       
    @empty
        
    @endforelse

@endsection

