@extends('layouts.chart_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product details</div>


                    <div class="card-body">
                        <b>Product Details</b>
                    </div>

                    <div class="card-body">

                        <table style="width:100%">
                            <tr>
                                <th>Product name</th>
                                <th>EAN</th>
                                <th>Color</th>
                                <th>Weight</th>
                                <th>Active</th>
                            </tr>
                            <tr>
                                <td>{{$productDetails-> name}}</td>
                                <td>{{$productDetails-> ean}}</td>
                                <td>{{$productDetails-> color}}</td>
                                <td>{{$productDetails-> weight}}</td>
                                <td>@if($productDetails-> active == 1)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                            </tr>

                        </table>

                    </div>


                    <div class="card-body">

                        <h1>{{ $chart1->options['chart_title'] }}</h1>
                        {!! $chart1->renderHtml() !!}

                    </div>

                    <div class="card-body">

                        <h1>{{ $chart2->options['chart_title'] }}</h1>
                        {!! $chart2->renderHtml() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    {!! $chart2->renderChartJsLibrary() !!}
    {!! $chart2->renderJs() !!}
@endsection
