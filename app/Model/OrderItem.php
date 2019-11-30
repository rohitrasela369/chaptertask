<?php

namespace App\Model;

use App\Model\Order;
use App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * Get the order of the item.
     *
     * @access public
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Get the product of the item.
     *
     * @access public
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
