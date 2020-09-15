<?php

namespace Tests\Unit\Product;

use App\Price;
use App\Product;
use App\Quantity;
use App\Repository\ProductRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Faker;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function show_the_product()
    {
        $product = factory(Product::class)->create();
        $productRepository = new ProductRepository(new Product);
        $found = $productRepository->show($product->id);

        $this->assertInstanceOf(Product::class, $found);
        $this->assertEquals($found->name, $product->name);
        $this->assertEquals($found->ean, $product->ean);
        $this->assertEquals($found->type, $product->type);
        $this->assertEquals($found->weight, $product->weight);
        $this->assertEquals($found->color, $product->color);
        $this->assertEquals($found->active, $product->active);
        $this->assertEquals($found->image, $product->image);
    }

    /** @test */
    public function product_is_updatable()
    {
        $faker = Faker\Factory::create();

        $data = [
            'name' => $faker->word,
            'ean' => $faker->ean8,
            'type' =>$faker->randomLetter,
            'weight' => $faker->randomDigit,
            'color' => $faker->colorName,
            'active' => $faker->numberBetween($min = 0, $max = 1),
            'image' => $faker->image($dir = 'public/storage/images', $width = 640, $height = 480)
        ];

        $productRepository = new Product($data);
        $update = $productRepository->update($data);

        $this->assertTrue($update);

    }

    /** @test */
    public function delete_product()
    {
        $product = factory(Product::class)->create();

        $productRepository = new ProductRepository($product);
        $delete = $productRepository->destroy($product->id);

        $this->assertTrue($delete);
    }

    /** @test */
    public function restore_product()
    {
        $product = factory(Product::class)->create();

        $productRepository = new ProductRepository($product);
        $delete = $productRepository->restore($product->id);

        $this->assertTrue($delete);
    }

    /** @test */
    public function a_product_has_many_prices()
    {
        $product = factory(Product::class)->create();
        $price   = factory(Price::class)->create(['product_id' => $product->id]);

        $this->assertTrue($product->prices->contains($price));

    }

    /** @test */
    public function a_product_has_many_quantity()
    {
        $product = factory(Product::class)->create();
        $quantity= factory(Quantity::class)->create(['product_id' => $product->id]);

        $this->assertTrue($product->quantities->contains($quantity));

    }
}
