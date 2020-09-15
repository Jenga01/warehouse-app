<?php


namespace App\Repository\Interfaces;


use App\Product;
use http\Env\Request;

interface ProductRepositoryInterface
{

    public function index();

    public function show($id);

    public function edit($id);

    public function update($id, array $attributes);

    public function destroy($id);

    public function restore($id);


}
