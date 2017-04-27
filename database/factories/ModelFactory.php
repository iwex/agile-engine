<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(2, true),
        'price' => $faker->randomFloat(null, 100, 1000),
    ];
});

$factory->define(App\Models\Voucher::class, function (Faker\Generator $faker) {
    static $discounts;
    
    $discounts = $discounts ?: $discounts = \App\Models\DiscountTier::all();
    
    return [
        'discount_tier_id' => $discounts->random(1)->first()->id,
        'start_date' => $faker->dateTimeBetween('now', '+1 month'),
        'end_date' => $faker->dateTimeBetween('+2 month', '+5 month')
    ];
});

