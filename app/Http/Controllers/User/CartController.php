<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $carts = Cart::with(['product.primaryImage'])
            ->where('user_id', auth()->id())
            ->get();

        $subtotal = $carts->sum(fn ($cart) => $cart->subtotal);

        return view('cart.index', compact('carts', 'subtotal'));
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < 1) {
            return back()->with('error', 'Stok produk habis.');
        }

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        $quantity = $request->get('quantity', 1);

        if ($cart) {
            $newQty = $cart->quantity + $quantity;
            if ($newQty > $product->stock) {
                return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
            }
            $cart->update(['quantity' => $newQty]);
        } else {
            if ($quantity > $product->stock) {
                return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
            }
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $quantity,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, Cart $cart): RedirectResponse
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($request->quantity > $cart->product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove(Cart $cart): RedirectResponse
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
