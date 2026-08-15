<?php

namespace App\Services;

class CartService
{
    /**
     * Get all cart items from session
     */
    public function getItems(): array
    {
        return session()->get('cart', []);
    }

    /**
     * Add item to cart
     */
    public function addItem(int $productId, string $productName, int $price, array $extras = [], int $quantity = 1, ?string $image = null): void
    {
        $cart = $this->getItems();
        
        // Create unique key based on product and extras
        $itemKey = $this->generateItemKey($productId, $extras);
        
        // Calculate extras total
        $extrasTotal = 0;
        foreach ($extras as $extra) {
            $extrasTotal += $extra['price'];
        }
        
        // If item already exists, update quantity
        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] += $quantity;
            $cart[$itemKey]['subtotal'] = ($cart[$itemKey]['price'] + $cart[$itemKey]['extras_total']) * $cart[$itemKey]['quantity'];
        } else {
            // Add new item
            $cart[$itemKey] = [
                'product_id' => $productId,
                'product_name' => $productName,
                'price' => $price,
                'image' => $image,
                'extras' => $extras,
                'extras_total' => $extrasTotal,
                'quantity' => $quantity,
                'subtotal' => ($price + $extrasTotal) * $quantity,
            ];
        }
        
        session()->put('cart', $cart);
    }

    /**
     * Update item quantity
     */
    public function updateQuantity(string $itemKey, int $quantity): bool
    {
        $cart = $this->getItems();
        
        if (!isset($cart[$itemKey])) {
            return false;
        }
        
        if ($quantity <= 0) {
            return $this->removeItem($itemKey);
        }
        
        $cart[$itemKey]['quantity'] = $quantity;
        $cart[$itemKey]['subtotal'] = ($cart[$itemKey]['price'] + $cart[$itemKey]['extras_total']) * $quantity;
        
        session()->put('cart', $cart);
        return true;
    }

    /**
     * Remove item from cart
     */
    public function removeItem(string $itemKey): bool
    {
        $cart = $this->getItems();
        
        if (!isset($cart[$itemKey])) {
            return false;
        }
        
        unset($cart[$itemKey]);
        session()->put('cart', $cart);
        return true;
    }

    /**
     * Clear entire cart
     */
    public function clearCart(): void
    {
        session()->forget('cart');
    }

    /**
     * Get cart total
     */
    public function getTotal(): int
    {
        $cart = $this->getItems();
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['subtotal'];
        }
        
        return $total;
    }

    /**
     * Get cart item count
     */
    public function getItemCount(): int
    {
        $cart = $this->getItems();
        $count = 0;
        
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        
        return $count;
    }

    /**
     * Generate unique key for cart item
     */
    private function generateItemKey(int $productId, array $extras): string
    {
        $extraIds = array_map(fn($extra) => $extra['id'], $extras);
        sort($extraIds);
        
        return $productId . '_' . md5(json_encode($extraIds));
    }
}
