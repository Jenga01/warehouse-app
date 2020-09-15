<?php
namespace App\Repository;

use App\Product;
use App\Repository\Interfaces\ProductRepositoryInterface;
use http\Env\Request;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return $this->product::withTrashed()->paginate(10);
    }


    public function show($id)
    {
        return $this->product->find($id);
    }

    public function edit($id)
    {
        return $this->product->find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->product->find($id)->update($attributes);
    }

    public function destroy($id)
    {
        return $this->product->find($id)->delete();
    }


    public function restore($id)
    {
        return $this->product::withTrashed()->find($id)->restore();
    }

}
