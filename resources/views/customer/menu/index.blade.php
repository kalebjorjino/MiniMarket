@extends('layouts.app')

@section('content')
    {{-- just a code draft dump --}}
    <div>
        @unless(count($products) == 0)
            @foreach ($products as $product)
                <x-product-card :product="$product">
            @endforeach
        @else
            <p>No products found</p>
        @endunless
    </div>
@endsection
