<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display cart page
     */
    public function index()
    {
        $cartItems = $this->cartService->getItems();
        $cartTotal = $this->cartService->getTotal();
        $itemCount = $this->cartService->getItemCount();

        return view('user.cart', compact('cartItems', 'cartTotal', 'itemCount'));
    }

    /**
     * Add item to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'product_name' => 'required|string',
            'price' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|string',
            'extras' => 'nullable|array',
        ]);

        $this->cartService->addItem(
            $request->product_id,
            $request->product_name,
            $request->price,
            $request->extras ?? [],
            $request->quantity,
            $request->image
        );

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully',
            'itemCount' => $this->cartService->getItemCount()
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, string $itemKey)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $success = $this->cartService->updateQuantity($itemKey, $request->quantity);

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'cartTotal' => $this->cartService->getTotal(),
                'itemCount' => $this->cartService->getItemCount()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item not found in cart'
        ], 404);
    }

    /**
     * Remove item from cart
     */
    public function remove(string $itemKey)
    {
        $success = $this->cartService->removeItem($itemKey);

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart',
                'cartTotal' => $this->cartService->getTotal(),
                'itemCount' => $this->cartService->getItemCount()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item not found in cart'
        ], 404);
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        $this->cartService->clearCart();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully'
        ]);
    }
}
