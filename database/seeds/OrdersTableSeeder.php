<?php

use App\Model\OrderItem;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Order::class, 50)->create()
        ->each(function ($order) {

            // code to generate the random amount of item from 1 to 3
            $order->order_items()->saveMany(factory(OrderItem::class, rand(1, 3))->make());
        });
    }
}
