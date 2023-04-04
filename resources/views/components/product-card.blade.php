@props(['product'])

{{-- <x-card> --}}
<div class="flex">
    <img class=""
        src="{{ $product->product_cover ? url('storage/' . $record->product_cover) : asset('/images/products/no-image.png') }}"
        alt="" />
    <div>
        <h3 class="text-2xl">
            <a href="/products/{{ $product->id }}">{{ $product->title }}</a>
        </h3>
        <div class="text-xl font-bold mb-4">{{ $product->price }}</div>
        {{-- <x-product-tags :tagsCsv="$product->tags" />
        <div class="text-lg mt-4">
            <i class="fa-solid fa-location-dot"></i> {{ $product->location }}
        </div> --}}
    </div>
</div>
{{-- </x-card> --}}
