<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Model\Customer;
use App\Model\Product;
use App\Model\Order;
use App\Model\OrderItem;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

// Code to generate the Customer data
$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail
    ];
});

// Code to generate the Product data
$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat(2, 10, 100),
        'in_stock' => rand(0, 1),
    ];
});

// Code to generate the Order data
$factory->define(Order::class, function (Faker $faker) {
    $status = ['new', 'processed'];
    return [
        'customer_id' => Customer::inRandomOrder()->first()->id,
        'invoice_number' => time(),
        'total_amount' => $faker->randomFloat(2, 10, 300),
        'status' => $status[array_rand($status)],
    ];
});

// Code to generate the Order Item data
$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'product_id' => Product::inRandomOrder()->first()->id,
        'quantity' => rand(1, 10),
    ];
});

