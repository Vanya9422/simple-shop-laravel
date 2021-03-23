@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-primary" role="alert">
            You can not confirm until the admin confirms
        </div>
        <div class="row mt-5">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th class="text-center text-capitalize" scope="col">#</th>
                    <th class="text-center text-capitalize" scope="col">Product</th>
                    <th class="text-center text-capitalize" scope="col">Customer</th>
                    <th class="text-center text-capitalize" scope="col">email</th>
                    <th class="text-center text-capitalize" scope="col">phone </th>
                    <th class="text-center text-capitalize" scope="col">region</th>
                    <th class="text-center text-capitalize" scope="col">city</th>
                    <th class="text-center text-capitalize" scope="col">address</th>
                    <th class="text-center text-capitalize" scope="col">zip</th>
                    <th class="text-center text-capitalize" scope="col">quantity</th>
                    <th class="text-center text-capitalize" scope="col">By Admin</th>
                    <th class="text-center text-capitalize" scope="col">By You</th>
                    <th class="text-center text-capitalize" scope="col">ordered</th>
                    <th class="text-center text-capitalize" scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr class="order_{{$order->id}}">
                        <th scope="row" class="vertical-td">{{$order->id}}</th>
                        <td class="vertical-td">{{$order->product->name}}</td>
                        <td class="vertical-td">{{$order->full_name}}</td>
                        <td class="vertical-td">{{$order->email}}</td>
                        <td class="vertical-td">{{$order->phone}}</td>
                        <td class="vertical-td">{{$order->region}}</td>
                        <td class="vertical-td">{{$order->city}}</td>
                        <td class="vertical-td">{{$order->address}}</td>
                        <td class="vertical-td">{{$order->zip}}</td>
                        <td class="vertical-td">{{$order->quantity}}</td>
                        <td class="vertical-td">{!! confirmationBadge($order->is_approved) !!}</td>
                        <td class="vertical-td confirm-badge-{{$order->id}}">{!! confirmationBadge($order->is_confirmed) !!}</td>
                        <td class="vertical-td">{{ dateHuman($order->created_at)}}</td>
                        <td class="vertical-td">
                            <button data-id="{{$order->id}}" data-approve="{{$order->is_approved}}" {{!$order->is_approved ? 'disabled' : ''}}  class="btn btn-sm btn-success confirm-order">
                                Confirm
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/order.js')}}"></script>
@endsection
