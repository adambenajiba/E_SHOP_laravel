
@extends('layouts.guest')
@section('content')


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="/">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form id="search-form">
                            <div class="input-group">
                                <input type="text" id="search-input" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary"><i class="icon_search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div id="suggestions-container"></div>
                    </div>

                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Categories
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="list-group">
                                                <li class="list-group-item"><a class="category-button"
                                                        data-category="All">All ({{ count($products) }})</a></li>
                                                @foreach ($categories as $category)
                                                <li class="list-group-item"><a class="category-button"
                                                        data-category="{{ $category->name }}">{{ $category->name }}
                                                        ({{ count($category->products) }})</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select id="sort-select" class="form-control">
                                    <option value="low-to-high">Low To High</option>
                                    <option value="high-to-low">High To Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-evenly product-container">
                    @if (count($products) == 0)
                    <div class="col-12">
                        <h1>No products available</h1>
                    </div>
                    @else
                    @foreach ($products as $product)
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->


@endsection
