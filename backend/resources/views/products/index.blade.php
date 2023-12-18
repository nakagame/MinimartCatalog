@extends('layouts.app')

@section('title', 'Products')
    
@section('content')
    <div class="row">
        <div class="col text-center">
            <img src="https://i0.wp.com/m-mart.co.id/wp-content/uploads/2022/09/New-Logo-M-Mart-Circle.png?resize=200%2C200&ssl=1" alt="Logo">
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        @forelse ($all_products as $product)
            <div class="col">
                <div class="card bg-white">
                    @if ($product->image)
                        <img src="{{ asset('storage/images/'. $product->image) }}" id="hcOverHc" class="card-img-top" alt="{{ $product->image }}" style="object-fit: contain; witdth: 200px; height: 300px;">
                        @if (Carbon\Carbon::parse($product->created_at)->diffInDays(Carbon\Carbon::now()) <= 3)
                            <div class="card-img-overlay">
                                <h1 class="card-title text-primary h4 fw-bold">New</h1>
                            </div>
                        @endif
                    @else
                        <img src="https://cdn11.bigcommerce.com/s-1812kprzl2/images/stencil/original/products/582/5042/no-image__63632.1665666729.jpg?c=2" class="card-img-top" alt="{{ $product->image }}" style="object-fit: contain; witdth: 200px; height: 300px;">       
                    @endif
                </div>

                <div class="card-body">
                    <h5 class="card-title text-truncate">
                        <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">{{ $product->name }}</a>
                    </h5>
                    <p class="card-text text-primary">
                        $ {{ $product->price }}
                    </p>
                </div>
            </div>
        @empty
            
        @endforelse        
    </div>

@endsection



