<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    // ✅ Show checkout page
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('customer.checkout.index', compact('cart'));
    }

    // ✅ Place order (SAVE TO DATABASE)
    public function store()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back();
        }

        $grouped = [];

        // Group products by vendor
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            $grouped[$product->vendor_id][] = [
                'product' => $product,
                'quantity' => $item['quantity']
            ];
        }

        foreach ($grouped as $vendorId => $items) {

            $total = 0;

            foreach ($items as $i) {
                $total += $i['product']->price * $i['quantity'];
            }

            $commission = $total * 0.10; // 10% admin commission

            $order = Order::create([
                'user_id' => auth()->id(),
                'vendor_id' => $vendorId,
                'total' => $total,
                'commission' => $commission,
                'status' => 'paid'
            ]);

            foreach ($items as $i) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $i['product']->id,
                    'quantity' => $i['quantity'],
                    'price' => $i['product']->price,
                ]);
            }
        }

        session()->forget('cart');

        return redirect()->route('products.index')
            ->with('success', 'Order placed successfully!');
    }
}
