<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $fillable = [
        'name',
        'price',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_available' => 'boolean',
        ];
    }

    /**
     * Get all order items that have this extra
     */
    public function orderItems()
    {
        return $this->belongsToMany(OrderItem::class, 'order_item_extras')
            ->withPivot('price')
            ->withTimestamps();
    }
}
