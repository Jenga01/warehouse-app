<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    protected $table = 'products';

    protected $products = ['deleted_at'];

    protected $fillable = ['name', 'ean', 'type', 'weight', 'color', 'active'];


    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function quantities()
    {
        return $this->hasMany(Quantity::class);
    }

}

