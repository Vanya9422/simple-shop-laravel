@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">General Image</th>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Quantity</th>
                    <th class="text-center" scope="col">Created At</th>
                    <th class="text-center" scope="col">Updated At</th>
                    <th class="text-center" scope="col">Approved</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr class="parent_{{$product->id}}">
                        <th class="vertical-td" scope="row">{{$product->id}}</th>
                        <td class="vertical-td">
                            <input type="image" src="{{$product->generalImage ? asset("storage/". $product->generalImage->url) : ImagePicsum}}" alt="" width="50px">
                        </td>
                        <td class="vertical-td">{{$product->name}}</td>
                        <td class="vertical-td">{{$product->quantity}}</td>
                        <td class="vertical-td">{{ dateCreate($product->created_at)}}</td>
                        <td class="vertical-td">{{ dateHuman($product->updated_at)}}</td>
                        <td class="vertical-td">{!! confirmationBadge($product->approved) !!}</td>
                        <td class="vertical-td">{!! confirmationBadge($product->status, 'Status') !!}</td>
                        <td class="vertical-td">
                            <a href="{{route('edit.product', ['slug' => $product->slug])}}" class="btn btn-primary">Edit</a>
                            <a href="#" data-id="{{$product->id}}" class="btn btn-danger delete-product">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')

@endsection
