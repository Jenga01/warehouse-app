<?php
namespace App\Http\Controllers;

use App\Services\ProductService;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DetailsPriceQuantityController extends Controller
{

    protected $productservice;

    public function __construct(ProductService $productservice)
    {
        $this->productservice = $productservice;
    }


    public function get_details_price_quantity_history($id)
    {
        $productDetails = $this->productservice->show($id);

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

        ];

        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Quantity history',
            'report_type' => 'group_by_date',
            'model' => 'App\Quantity',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'quantity',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 90, // show prices for the last 90 days
            'conditions'            => [
                ['name' => 'Quantity', 'condition' => "product_id = {$id}",   'color' => 'black'],
            ],

        ];

        $chart2 = new LaravelChart($chart_options);

        return view('products.charts.index', compact('productDetails', 'chart1', 'chart2'));

    }
}
