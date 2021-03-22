@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        {{ __('Hello Customer, You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantitiy</th>
                    <th scope="col">By Admin</th>
                    <th scope="col">By Seller</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{$order->id}}</th>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{!! confirmationBadge($order->is_approved) !!}</td>
                            <td>{!! confirmationBadge($order->is_confirmed) !!}</td>
                            <td>{{ dateCreate($order->created_at)}}</td>
                            <td>{{ dateHuman($order->updated_at)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
