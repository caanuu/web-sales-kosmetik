<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingArea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = request()->user();

        $carts = Cart::with(['product.primaryImage'])
            ->where('user_id', $user->id)
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong. Tambahkan produk terlebih dahulu.');
        }

        $shippingAreas = ShippingArea::where('is_active', true)->orderBy('name')->get();
        $subtotal = $carts->sum(fn ($cart) => $cart->subtotal);

        return view('checkout.index', compact('carts', 'subtotal', 'shippingAreas', 'user'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'shipping_area_id' => 'required|exists:shipping_areas,id',
            'shipping_address' => 'required|string|max:1000',
            'payment_method' => 'required|in:cod,bank_transfer,e_wallet',
            'notes' => 'nullable|string|max:1000',
        ]);

        /** @var \App\Models\User $user */
        $user = $request->user();

        $carts = Cart::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        // Validate stock availability
        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->stock) {
                return back()->with('error', "Stok {$cart->product->name} tidak mencukupi. Tersisa {$cart->product->stock}.")->withInput();
            }
        }

        $shippingArea = ShippingArea::where('is_active', true)->findOrFail($request->shipping_area_id);

        try {
            DB::beginTransaction();

            $subtotal = $carts->sum(fn ($cart) => $cart->subtotal);
            $shippingCost = $shippingArea->cost;
            $total = $subtotal + $shippingCost;

            $order = Order::create([
                'user_id' => $user->id,
                'shipping_area_id' => $shippingArea->id,
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
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat! Nomor pesanan: ' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.')->withInput();
        }
    }
}
