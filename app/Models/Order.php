<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'table_number',
        'order_number',
        'total_price',
        'status',
        'snap_token',
        'payment_type',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'decimal:2',
        ];
    }

    /**
     * Get all order items for this order
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get dynamic estimated time based on order items
     */
    public function getEstimatedTimeAttribute()
    {
        // If order is completed or cancelled, ETA is 0
        if (in_array($this->status, ['completed', 'cancelled', 'failed'])) {
            return 0;
        }

        // Base preparation time: 5 minutes
        $baseTime = 5;
        
        // Calculate total quantity of items
        $totalItems = 0;
        if ($this->relationLoaded('orderItems')) {
            $totalItems = $this->orderItems->sum('quantity');
        } else {
            $totalItems = $this->orderItems()->sum('quantity');
        }

        // Add 2 minutes per item
        $additionalTime = $totalItems * 2;

        return $baseTime + $additionalTime;
    }

    /**
     * Generate unique order number
     */
    public static function generateOrderNumber()
    {
        return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }
}
