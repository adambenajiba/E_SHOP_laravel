<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\OrderItem;
use Barryvdh\DomPDF\PDF;
use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{


    public function shop()
    {
        $categories = ProductCategory::all();
        $products = Product::all();
        return view('pages.shop', compact('categories', 'products'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product', compact("product"));
    }

    public function shopingCart()
    {
        $cart = json_decode(request()->cookie('cart'), true);
        $products = [];
        $total = 0;

        if ($cart) {
            foreach ($cart as $item) {
                $product = Product::find($item['product_id']);

                if ($product) {
                    $price = $product->price;
                    $quantity = $item['quantity'];
                    $subtotal = $price * $quantity;
                    $total += $subtotal;

                    $products[] = [
                        'product' => $product,
                        'quantity' => $item['quantity']
                    ];
                }
            }
            $total = number_format($total, 2);
        }
        return view('pages.cartP', compact('products', 'total'));
    }


    public function checkout()
    {
        $cart = session()->get('cart', []);
        $products = [];
        $total = 0;

        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product = Product::find($item['price']);

                if ($product) {
                    $price = $product->price;
                    $quantity = $item['quantity'];
                    $subtotal = $price * $quantity;
                    $total += $subtotal;

                    $products[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal
                    ];
                }
            }
            $total = number_format($total, 2);
            return view('pages.checkout', compact('products', 'total'));

        }
        // return redirect('/cart');
    }

    // public function about()
    // {
    //     return view('pages.about');
    // }

    // public function contact()
    // {
    //     return view('pages.contact');
    // }

    // public function register()
    // {
    //     return view('pages.auth.register');
    // }

    // public function login()
    // {
    //     return view('pages.auth.login');
    // }

    // public function mail(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //     ]);

    //     // Check if the validation fails
    //     if ($validator->fails()) {
    //         // Handle the failed validation
    //         return response()->json(['message' => 'Please enter a valid email address.'], 400);
    //     }

    //     $mailData = [
    //         'title' => 'Mail from Male Fashion',
    //         'body' => 'Newsletter Subscription'
    //     ];

    //     try {
    //         Mail::to($request->email)->send(new NewsletterMail($mailData));
    //         return response()->json(['message' => 'Check your email'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Something went wrong. Please try again.'], 500);
    //     }
    // }




    public function searchProduct(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        return response()->json($products);
    }

    function addProductToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = $request->cookie('cart') ? json_decode($request->cookie('cart'), true) : [];

        $productExists = false;
        foreach ($cart as &$item) {
            if ($item['product_id'] === $productId) {
                $item['quantity'] += $quantity;
                $productExists = true;
                break;
            }
        }

        if (!$productExists) {
            $cart[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
            ];
        }

        $productName = Product::find($productId)->name;

        $response = new Response();
        $response->cookie('cart', json_encode($cart));

        if (!$productExists) {
            $response->setContent($productName . ' added to the cart successfully!');
        } else {
            $response->setContent($productName . ' quantity is updated.');
        }

        return $response;
    }

    public function emptyCart()
    {
        $cookie = Cookie::forget('cart');

        return Redirect::to('/cart')->withCookie($cookie)->with('cart-emptied', true);
    }



    public function deleteProductFromCart($id)
    {
        $cart = request()->cookie('cart') ? json_decode(request()->cookie('cart'), true) : [];

        $productIndex = null;
        foreach ($cart as $index => $item) {
            if ($item['product_id'] === $id) {
                $productIndex = $index;
                break;
            }
        }

        if ($productIndex !== null) {
            array_splice($cart, $productIndex, 1);
        }

        $cookie = Cookie::make('cart', json_encode($cart));

        return Redirect::to('/cart')->withCookie($cookie)->with('product-delete-cart', true);
    }

    public function updateProductQuantityInCart(Request $request, $id)
    {
        $quantity = $request->input('product_quantity');

        $cart = request()->cookie('cart') ? json_decode(request()->cookie('cart'), true) : [];

        $productIndex = null;
        foreach ($cart as $index => $item) {
            if ($item['product_id'] === $id) {
                $productIndex = $index;
                break;
            }
        }

        if ($productIndex !== null) {
            if ($quantity > 0) {
                $cart[$productIndex]['quantity'] = $quantity;
            } else {
                array_splice($cart, $productIndex, 1);
            }
        }

        $cookie = Cookie::make('cart', json_encode($cart));

        return Redirect::to('/cart')->withCookie($cookie)->with('product-update-cart', true);
    }





}
