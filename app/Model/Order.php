<?php

namespace App\Model;

use App\Model\Customer;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * Get the order items for the order.
     *
     * @access public
     */
    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * Get the customer that placed the order.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
