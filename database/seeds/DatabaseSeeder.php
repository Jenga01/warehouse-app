<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Price;
use App\Quantity;
use App\Details;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 30)->create()->each(function ($product)
        {

            $prices = factory(Price::class, 10)->make();
            $product->prices()->saveMany($prices);

            $quantities = factory(Quantity::class, 10)->make();
            $product->quantities()->saveMany($quantities);

        });

        factory(User::class, 10)->create()->each(function() {
             factory(App\User::class, 1)->create();
        });

    }
}
