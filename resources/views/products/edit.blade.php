@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{trans('edit_product.edit')}}</div>
                    <div class="row">
                        <div class="col-sm-8 offset-sm-2">
                            <form action="{{route('update.product', $product->id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                    <label for="product name">{{trans('edit_product.product_name')}}</label>
                                    <input type="text" name = "name" class="form-control" required value = "{{$product->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="ean">{{trans('edit_product.ean')}}</label>
                                    <input type="text" name = "ean" class="form-control" required value = "{{$product->ean}}">
                                </div>

                                <div class="form-group">
                                    <label for="type">{{trans('edit_product.type')}}</label>
                                    <input type="text" name = "type" class="form-control" required value = "{{$product->type}}">
                                </div>

                                <div class="form-group">
                                    <label for="weight">{{trans('edit_product.weight')}}</label>
                                    <input type="text" name = "weight" class="form-control" required value = "{{$product->weight}}">
                                </div>

                                <div class="form-group">
                                    <label for="color">{{trans('edit_product.color')}}</label>
                                    <input type="text" name = "color" class="form-control" value = "{{$product->color}}">
                                </div>


                                <div class="form-group">
                                    <label for="active">{{trans('edit_product.active')}}</label>
                                    <select name="active">

                                        @if($product -> active == 0)
                                            <option value="{{$product -> active}}">{{trans('edit_product.active_option_no')}}</option>
                                            <option value="1">{{trans('edit_product.active_option_yes')}}</option>
                                        @else
                                            <option value="{{$product -> active}}">{{trans('edit_product.active_option_yes')}}</option>
                                            <option value="0">{{trans('edit_product.active_option_no')}}</option>

                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="price">{{trans('edit_product.image')}}</label>
                                    <input type="file" name = "image" class="form-control" value = "{{$product->image}}">
                                </div>

                                <div>
                                    <img width="300px" src="{{asset('/storage/images') .'/'.$product->image}}"/>
                                </div>

                                <button style="margin-top: 8px" type = "submit" class = "btn btn-success">{{trans('edit_product.submit_button')}}</button>

                            </form>

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
            </div>
        </div>
    </div>


@endsection
