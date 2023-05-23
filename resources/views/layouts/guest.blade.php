{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">{{ \App\Models\Setting::where('setting_key', 'shop_name')->first()->setting_value }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    @yield('content')
</body>
</html>
 --}}
 <!DOCTYPE html>
 <html>
     <head>
         <title>Laravel Add To Cart Function - ItSolutionStuff.com</title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
         <script src="{{ asset('js/bootstrap.bundle.js') }}" defer></script>
         
         <link href="{{ asset('css/style.css') }}" rel="stylesheet">
 </head>
 <body>

  @yield('partials.header')
  {{-- <div class="container">
    <div class="p-5 mt-5 mb-4 bg-light border rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">{{ \App\Models\Setting::where('setting_key', 'shop_name')->first()->setting_value }}</h1>
          <p class="col-md-8 fs-4">Make running your retail business a breeze!</p>
          <a class="btn btn-primary btn-lg" href="{{ route('login') }}">Login</a>
          <a class="btn btn-primary btn-lg" href="{{ route('register') }}">Register</a>
        </div>
    </div>
</div> --}}
 <div class="container">
     <div class="row">
         <div class="col-lg-12 col-sm-12 col-12 main-section">
             <div class="dropdown">
                 <button type="button" class="btn btn-info" data-toggle="dropdown">
                     <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                 </button>
                 <div class="dropdown-menu">
                     <div class="row total-header-section">
                         <div class="col-lg-6 col-sm-6 col-6">
                             <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                         </div>
                         @php $total = 0 @endphp
                         @foreach((array) session('cart') as $id => $details)
                             @php $total += $details['price'] * $details['quantity'] @endphp
                         @endforeach
                         <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                             <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                         </div>
                     </div>
                     @if(session('cart'))
                         @foreach(session('cart') as $id => $details)
                             <div class="row cart-detail">
                                 <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                     <img src="{{ asset('storage/images/products/' . $details['image']) }}" />
                                 </div>
                                 <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                     <p>{{ $details['name'] }}</p>
                                     <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                 </div>
                             </div>
                         @endforeach
                     @endif
                     <div class="row">
                         <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                             <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
   
 <br/>
 <div class="container">
   
     @if(session('success'))
         <div class="alert alert-success">
           {{ session('success') }}
         </div> 
     @endif
   
     @yield('content')
 </div>
   
 @yield('scripts')
      
 </body>
 </html>
 
