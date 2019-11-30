<?php

namespace App\Model;
use App\Model\Order;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Get the order orders for the customer.
     *
     * @access public
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
