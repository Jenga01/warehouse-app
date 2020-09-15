<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    protected $productservice;

    public function __construct(ProductService $productservice)
    {
        $this->productservice = $productservice;
    }

    /**
     * Get list of the products
     *
     * @response  {
    *"data":
    *{
    * "id": 292,
    * "name": "atque",
    * "ean": 24346320,
    * "type": "y",
    * "weight": 3,
    * "color": "Ivory",
    * "active": 0,
    * "image": "45a552ae1356579d4e6ec0326afa6518.jpg",
    * "deleted_at": null,
    * "created_at": "2020-08-15T15:43:42.000000Z",
    * "updated_at": "2020-08-15T18:21:31.000000Z"
    * }
     * }
     */

    public function index()
    {
        $products = $this->productservice->index();
        return ProductResource::collection($products);
    }

    /**
     * Store new product.
     *
     * @bodyParam  name string required Name of the product. Example: table
     * @bodyParam  ean int required EAN of the product.
     * @bodyParam  type string required type of the product. Example: B
     * @bodyParam  weight int required weight of the product.
     * @bodyParam  color string required color of the product.
     * @bodyParam  active boolean required 0 - inactive, 1 - active.
     * @bodyParam  image blob required image of the product.
     * @response  {
     *   "data": {
     *   "name": "table",
     *   "ean": "11112233",
     *   "type": "B",
     *   "weight": "20",
     *   "color": "Brown",
     *   "active": "1",
     *   "image": "1597577655.jpg",
     *   "updated_at": "2020-08-16T11:34:16.000000Z",
     *  "created_at": "2020-08-16T11:34:16.000000Z",
     *  "id": 303
        }
     * }
     */
    public function store(Request $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->ean = $request->ean;
        $product->type = $request->type;
        $product->weight = $request->weight;
        $product->color = $request->color;
        $product->active = $request->active;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/storage/images/' . $filename);
            Image::make($image->getRealPath())->resize(300, 300)->save($path);
            $product->image = '' . $filename;
            $product->save();

        }
        if ($product->save()) {
            return new ProductResource($product);
        }
        else
            return redirect()->back()->with('status', 'Product failed');
    }
    


    /**
     * Update the specified resource in storage.
     *
     * @queryParam  name string required Name of the product. Example: table
     * @queryParam  ean int required EAN of the product.
     * @queryParam  type string required type of the product. Example: B
     * @queryParam  weight int required weight of the product.
     * @queryParam  color string required color of the product.
     * @queryParam  active boolean required 0 - inactive, 1 - active.
     * @queryParam  image blob required image of the product.
     * @response  {
     *   "product": "product with id 301 edited sucessfully "
     *   }
     * }
     */
    public function update(Request $request, $id)
    {

        try {
            $this->productservice->update($request, $id);
            return response()->json(['product' => "product with id $id edited sucessfully "]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }

    /**
     * Remove the product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @response  {
     *    "message": "Product has been deleted."
     *
     * }
     */
    public function destroy($id)
    {
        $this->productservice->destroy($id);
        try {
        return response()->json(['message' => 'Product has been deleted.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }

    }

    /**
     * Restore the product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @response  {
     *    "message": "Product has been restored."
     *
     * }
     */
    public function restore($id){

        $this->productservice->restore($id);

        try {
            return response()->json(['message' => 'Product has been restored.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],
                $e->getStatus());
        }

    }


}
