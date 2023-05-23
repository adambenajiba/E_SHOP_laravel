@extends('layouts.guest')
   
@section('content')
    
<div class="row">
    @foreach($products as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="{{ asset('storage/images/products/' . $product->image) }}" class="card-img-top" alt="">
                <div class="caption">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <p><strong>Price: </strong> {{ $product->price }}$</p>
                    <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                    <p class="btn-holder"><a href="{{ route('shop', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Shop Now</a> </p>

                </div>
            </div>
        </div>
    @endforeach
</div>
    
@endsection