<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::query()
            ->where('user_id', Auth::id())
            ->with(['item.user'])
            ->get();

        $subtotal = $cartItems->sum(function ($cartItem) {
            if (!$cartItem->item) {
                return 0;
            }
            return ((int) $cartItem->item->price) * ((int) $cartItem->quantity);
        });

        $sellerCount = $cartItems
            ->map(fn ($ci) => $ci->item?->user_id)
            ->filter()
            ->unique()
            ->count();

        $deliveryFee = $cartItems->isEmpty() ? 0 : 15000;
        $total = $subtotal + $deliveryFee;

        return view('cart.checkout', compact('cartItems', 'subtotal', 'deliveryFee', 'total', 'sellerCount'));
    }

    public function add(Item $item)
    {
        $cartItem = CartItem::firstOrNew([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
        ]);

        $cartItem->quantity = ((int) ($cartItem->quantity ?? 0)) + 1;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }

    public function delta(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $delta = (int) $request->input('delta', 0);
        $newQty = ((int) $cartItem->quantity) + $delta;

        if ($newQty <= 0) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
        }

        $cartItem->update(['quantity' => $newQty]);

        return redirect()->route('cart.index');
    }

    public function remove(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
