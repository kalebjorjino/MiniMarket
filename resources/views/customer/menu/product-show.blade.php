@extends('layouts.app')

@section('content')
<div>
    <product-details product-data="{{ $product }}" uid="{{Auth::user()->id}}"></product-details>
</div>
@endsection