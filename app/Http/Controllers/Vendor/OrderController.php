<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // show only vendor orders
    public function index()
    {
        $orders = Order::with('items.product', 'user')
            ->where('vendor_id', auth()->id())
            ->latest()
            ->get();

        return view('vendor.orders.index', compact('orders'));
    }

    // update order status
    public function updateStatus(Request $request, Order $order)
    {
        // security check
        if ($order->vendor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:paid,shipped,delivered'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Order status updated');
    }
}
