@props(['product'])
<div class="col-lg-4 col-md-6 col-sm-6 product-card" data-category="{{ $product->category->name }}"
    data-price="{{ $product->price }}">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/images/' . $product->image) }}">
            <ul class="product__hover">
                <li><a href="/product/{{ $product->id }}"><img src="{{ asset('img/icon/search.png') }}"
                            alt="Product Image"></a></li>
            </ul>
        </div>
        <div class="product__item__text">
            <h6>{{ $product->name }}</h6>
            <a data-quantity="1" data-productId="{{ $product->id }}" class="add-cart">+ Add To Cart</a>
            <h5>{{ $product->price }} $</h5>
        </div>
    </div>
</div>
