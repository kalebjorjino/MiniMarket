@extends('layouts.app')

@section('content')
<section class="shopping-cart">
    <div class="container">
        <div class="row">
            <shopping-cart cartsdata="{{ $cart_items }}" uid="{{ Auth::user()->id }}"></shopping-cart>
        </div>
    </div>
</div>

@endsection
