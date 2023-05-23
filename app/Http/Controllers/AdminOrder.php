<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use PDF;
class AdminOrder extends Controller
{
    public function order()
    {
        
        $pendingOrders = Order::where('status', "pending")->get();
        $finishedOrders = Order::where('status', '!=', "pending")->get();
        return view('ordersadmin.show', compact("pendingOrders", "finishedOrders"));
    }
    public function updateOrder($id)
    {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where("order_id", $order->id)->get();

        return view('ordersadmin.update', compact('orderItems'));
    }
    public function editOrderStatus($id)
    {
        request()->validate([
            'status' => 'required',
        ]);

        $order = Order::findOrFail($id);

        $order->status = request('status');
        $order->save();

        return redirect()->route('orders-show')->with('order-status-update-success');
    }
}
?>
