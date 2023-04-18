@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <div class="container my-5">
            <shop-products product-datas="{{ $products }}"></shop-products>
        </div>
    </div>
@endsection
