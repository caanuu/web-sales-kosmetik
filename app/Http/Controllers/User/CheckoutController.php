<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $carts = Cart::with(['product.primaryImage'])
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong. Tambahkan produk terlebih dahulu.');
        }

        $subtotal = $carts->sum(fn ($cart) => $cart->subtotal);
        $shippingCost = 15000;
        $total = $subtotal + $shippingCost;
        $user = auth()->user();

        return view('checkout.index', compact('carts', 'subtotal', 'shippingCost', 'total', 'user'));
    }

    public function store(CheckoutRequest $request): RedirectResponse
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        // Validate stock availability
        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->stock) {
                return back()->with('error', "Stok {$cart->product->name} tidak mencukupi. Tersisa {$cart->product->stock}.");
            }
        }

        try {
            DB::beginTransaction();

            $subtotal = $carts->sum(fn ($cart) => $cart->subtotal);
            $shippingCost = 15000;
            $total = $subtotal + $shippingCost;

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'recipient_name' => $request->recipient_name,
                'recipient_phone' => $request->recipient_phone,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->effective_price,
                    'subtotal' => $cart->subtotal,
                ]);

                // Reduce stock
                $cart->product->decrement('stock', $cart->quantity);
            }

            // Clear cart
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat! Nomor pesanan: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
        }
    }
}
