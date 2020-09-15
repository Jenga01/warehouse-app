<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use Image;

class productController extends Controller
{

    protected $productservice;



    public function __construct(ProductService $productservice)
    {
        $this->productservice = $productservice;
    }

    public function index()
    {
        $products = $this->productservice->index();


        return view('products.index', compact('products'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productservice->edit($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->productservice->update($request, $id);

        return redirect()->back()->with('status', 'Product has been updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productservice->destroy($id);

        return back()->with(['status'=>'Deleted successfully']);
    }

    public function restore($id)
    {
        $this->productservice->restore($id);

        return back()->with(['status'=>'Product restored']);
    }
}
