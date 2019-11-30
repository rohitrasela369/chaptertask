<?php

use Illuminate\Database\Seeder;

class OrderItemsTebleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\OrderItem::class, 100)->create();
    }
}
