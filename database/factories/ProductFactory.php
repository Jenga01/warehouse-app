<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

//use App\Model;
use App\Product;
use App\Price;
use App\Quantity;
use App\Details;

use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker)
{
    return [
        'name' => $faker->word,
        'ean' => $faker->ean8,
        'type' => $faker->randomLetter,
        'weight' => $faker->randomDigit,
        'color' => $faker->colorName,
        'active' => $faker->numberBetween($min = 0, $max = 1),
        'image' => $faker->image('public/storage/images',640,480, null, false)
    ];
});

$factory->define(Price::class, function (Faker $faker)
{
    return [
        'price' => $faker->numberBetween($min = 10, $max = 10000),
        'created_at' => $faker->unique()->dateTimeBetween('-180 days', 'now')->format('Y-m-d'),
    ];
});

$factory->define(Quantity::class, function (Faker $faker)
{
    return [
        'quantity' => $faker->numberBetween($min = 10, $max = 100),
        'created_at' => $faker->unique()->dateTimeBetween('-180 days', 'now')->format('Y-m-d'),
    ];
});


