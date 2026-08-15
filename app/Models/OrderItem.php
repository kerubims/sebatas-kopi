<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    /**
     * Get the order that owns the order item
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product for this order item
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all extras for this order item
     */
    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'order_item_extras')
            ->withPivot('price')
            ->withTimestamps();
    }

    /**
     * Get all order item extras
     */
    public function orderItemExtras()
    {
        return $this->hasMany(OrderItemExtra::class);
    }
}
