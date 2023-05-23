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

class CustomerOrder extends Controller
{
    public function order()
    {
        $myPendingOrders = Order::where("user_id", Auth::id())->where('status', 'pending')->get();
        $myFinishedOrders = Order::where("user_id", Auth::id())->where('status', '!=', 'pending')->get();
        return view('orders.show', compact('myPendingOrders', 'myFinishedOrders'));
    }

    public function sendOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => ['required', 'email'],
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $user = Auth::user();
                    if (!Auth::validate(['email' => $user->email, 'password' => $value])) {
                        $fail('The provided password does not match your account password.');
                    }
                },
            ],
        ]);

        $cart = session()->get('cart', []);

        $totalPrice = 0;
        foreach ($cart as $item) {
            $product = Product::find($item['name']);
            if ($product) {
                $price = $product->price;
                $quantity = $item['quantity'];
                $subtotal = $price * $quantity;
                $totalPrice += $subtotal;
            }
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_price = $totalPrice;
        $order->status = 'pending';
        $order->save();

        foreach ($cart as $item) {
            $product = Product::find($item['name']);
            if ($product) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product->id;
                $orderItem->quantity = $item['quantity'];
                $orderItem->save();
            }
        }

        $cookie = Cookie::forget('cart');
        $myPendingOrders = Order::where("user_id", Auth::id())->where('status', 'pending')->get();
        $myFinishedOrders = Order::where("user_id", Auth::id())->where('status', '!=', 'pending')->get();
        return view('orders.show', compact('myPendingOrders', 'myFinishedOrders'));
        //return Redirect::to('client/orders')->withCookie($cookie)->with('order-success', true);
    }



    public function updateOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id !== Auth::user()->id) {
            return redirect()->route('orders-show');
        }

        $orderedItems = OrderItem::where('order_id', $order->id)->get();

        return view('orders.update', compact('orderedItems'));
    }
    public function cancelOrderItem($orderItemId)
    {
        $orderItem = OrderItem::findOrFail($orderItemId);
        $order = Order::findOrFail($orderItem->id);

        if ($order->user_id !== Auth::user()->id) {
            return redirect()->route('orders-show');
        }

        $orderItem->delete();

        return redirect()->route('orders-show')->with('order-cancell-item-sucess');
    }

    public function cancelOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id !== Auth::user()->id) {
            return redirect()->route('orders-show');
        }

        $order->status = "cancelled";
        $order->save();

        return redirect()->route('orders-show')->with('order-cancell-sucess');
    }


    public function adress()
    {
        return view('pages.dashboards.client.adresses.show');
    }

    public function createAdress()
    {
        return view('pages.dashboards.client.adresses.create');
    }

    public function updateAdress()
    {
        return view('pages.dashboards.client.adresses.update');
    }

}
