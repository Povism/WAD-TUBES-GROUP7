<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        $orders = Auth::user()->orders()
            ->with(['orderItems'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // This would typically be handled by the cart/checkout process
        return redirect()->route('cart.checkout');
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|integer|min:1',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'nullable|numeric|min:0',
            'shipping_address' => 'nullable|string|max:500',
            'shipping_name' => 'nullable|string|max:255',
            'shipping_phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            DB::beginTransaction();

            // Calculate total
            $total = 0;
            $orderItems = [];

            foreach ($validated['items'] as $itemData) {
                // Try to get item from database if Item model exists
                $itemPrice = 0;
                $itemTitle = 'Item #' . $itemData['item_id'];
                
                if (class_exists(\App\Models\Item::class)) {
                    try {
                        $item = \App\Models\Item::findOrFail($itemData['item_id']);
                        $itemPrice = $item->price;
                        $itemTitle = $item->title ?? $itemTitle;
                    } catch (\Exception $e) {
                        // If item not found, use default price from request or calculate
                        $itemPrice = $itemData['price'] ?? 0;
                    }
                } else {
                    // If Item model doesn't exist, use price from request
                    $itemPrice = $itemData['price'] ?? 0;
                }
                
                $itemTotal = $itemPrice * $itemData['quantity'];
                $total += $itemTotal;

                $orderItems[] = [
                    'item_id' => $itemData['item_id'],
                    'quantity' => $itemData['quantity'],
                    'price' => $itemPrice,
                    'item_title' => $itemTitle,
                ];
            }

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'status' => 'pending',
                'total' => $total,
                'shipping_address' => $validated['shipping_address'] ?? null,
                'shipping_name' => $validated['shipping_name'] ?? null,
                'shipping_phone' => $validated['shipping_phone'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'ordered_at' => now(),
            ]);

            // Create order items
            foreach ($orderItems as $orderItemData) {
                $order->orderItems()->create($orderItemData);
            }

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create order: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        $order->load(['orderItems.item', 'user']);

        return view('orders.show', compact('order'));
    }

    /**
     * Cancel an order.
     */
    public function cancel(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        // Only allow cancellation if order is pending or processing
        if (!in_array($order->status, ['pending', 'processing'])) {
            return back()->withErrors(['error' => 'Order cannot be cancelled at this stage.']);
        }

        $order->update([
            'status' => 'cancelled',
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order has been cancelled.');
    }
}


