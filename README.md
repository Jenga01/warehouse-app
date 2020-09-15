


## Setup
Install missing dependencies:
`composer install`

copy .env.example to .env and edit config by your environment

Generate APP_KEY in .env file: `php artisan key:generate`

Run migrations:
`php artisan migrate`

To populate database with fake data run:
`php artisan db:seed`
Following fake data will be generated:

users
```$factory->define(User::class, function (Faker $faker)
{
    $password = Hash::make('pass1234');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => $password,
        'remember_token' => Str::random(10),
    ];
});
```

products/price/quantity
```$factory->define(Product::class, function (Faker $faker)
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
```
## Price/quantity history

One-to-many many relationship between product and price tables

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
One-to-many many relationship between product and quantity tables

    public function quantities()
    {
        return $this->hasMany(Quantity::class);
    }
 However faker does not support unique dates generation hence there are gaps between the days
 
 For data representation on the charts I've used following package:
 
    https://github.com/LaravelDaily/laravel-charts
    
 Configuration:
 
    $chart_options = [
            'chart_title' => 'Price history',
            'report_type' => 'group_by_date',
            'model' => 'App\Price',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'price',
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => 90, // show prices for the last 90 days
            'conditions'            => [
                ['name' => 'Prices', 'condition' => "product_id = {$id}",   'color' => 'black'],
            ],

## API Documentation

To create documentation for the API scribe package has been used. Full generated documentation can be found in public/docs/index.html


## Cron job for soft deleted products

To test this you can run scheduler command:

    php artisan schedule:run

This will be running command regstered in the App/Console/Kernel.php

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('delete:product')
            ->hourly();
        
    }

Command implementation:

    public function handle()
    {
        $date = date("Y-m-d", strtotime('-7 day'));

      $products = Product::withTrashed()->where([
           ['deleted_at', '<', $date],
            ])->get()->each->forceDelete();

        foreach ($products as $product) {
            $image = $product->image;
            $ImagePath = (public_path('storage/images/').$image);

            if(file_exists($ImagePath))
            {
                @unlink($ImagePath);

            }
        }

    }
Hard deletes all soft deleted products which have been deleted for 7 days or more and removes images stored in the folder which belong to those products    

## Unit Testing

Unit tests test repository and models(relationships).
To run tests execute 'vendor/bin/phpunit` from the root table
