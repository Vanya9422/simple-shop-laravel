@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Dashboard') }}
                        <a href="{{route('order.list')}}" class="btn btn-link float-right">Order List</a>
                        <a href="{{route('product.list')}}" class="btn btn-link float-right">Product List</a>
                        <a href="{{route('create.product')}}" class="btn btn-link float-right">Add Product</a>
                    </div>

                    <div class="card-body">
                        {{ __('Hello Seller, You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
