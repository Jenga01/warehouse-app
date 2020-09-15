<?php
namespace App\Services;

use App\Product;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Image;


class ProductService
{

    public function __construct(ProductRepository $product)
    {
        $this->product = $product ;
    }

    public function index()
    {
        return $this->product->index();
    }


    public function show($id)
    {
        return $this->product->show($id);
    }

    public function edit($id)
    {
        return $this->product->show($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();
        $product = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/storage/images/' . $filename);
            $isExists = File::exists($path);
            Image::make($image->getRealPath())->resize(300, 300)->save($path);
            $product->image = '' . $filename;
            $product->save();
        }

        return $this->product->update($id, $attributes);
    }

    public function destroy($id)
    {
        return $this->product->destroy($id);
    }

    public function restore($id)
    {
        return $this->product->restore($id);
    }


}

