@extends('layouts.app')

<style>

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div style="overflow-x:auto;">
                        <table>
                            <tr>
                                <th>{{trans('products.product_name')}}</th>
                                <th>{{trans('products.ean')}}</th>
                                <th>{{trans('products.type')}}</th>
                            </tr>
                            @foreach($products as $product)
                                @if($product->trashed())
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->ean}}</td>
                                        <td>{{$product->type}}</td>
                                        <td>
                                        <form action="{{ route('restore.product', $product->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn">{{trans('products.restore')}}</button>
                                        </form>
                                        </td>
                                    </tr>
                                @else
                            <tr>
                                <td><a href="product-details-history/{{$product->id}}">{{$product->name}}</a></td>
                                <td>{{$product->ean}}</td>
                                <td>{{$product->type}}</td>
                                <td><a href="{{route('edit.product',$product->id)}}" class="btn btn-info">{{trans('products.edit')}}</a></td>
                                <td>
                                <form action="{{ route('destroy.product' , $product->id)}}" method="POST">
                                    <input name="_method" type="hidden" value="DELETE">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">{{trans('products.delete')}}</button>
                                </form>
                                </td>
                            </tr>
                                @endif
                            @endforeach

                        </table>
                    </div>
                    {{ $products->links() }}


                </div>
                @if(session()->has('status'))
                    <div class="alert alert-success">
                        {{ session()->get('status') }}
                    </div>
                @else
                    <div class="alert alert-fail">
                        {{ session()->get('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
