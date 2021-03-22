@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-3 mt-2">
                    <img class="card-img-top" src="{{$product->generalImage ? asset("storage/". $product->generalImage->url) : ImagePicsum}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text mt-2">
                            {{  \Illuminate\Support\Str::limit($product->description, 50) }}
                        </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Category:</b> {{$product->category->name}}</li>
                        <li class="list-group-item"><b>Quantity:</b> {{$product->quantity}}</li>
                        <li class="list-group-item"><b>Price:</b> {{$product->price}} AMD</li>
                        <li class="list-group-item"><b>Created At:</b>
                            {{\Carbon\Carbon::parse($product->created_at)->format('d m Y')}}
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link" data-toggle="modal" data-target=".order-modal" data-product="{{$product->id}}"
                        data-name="{{$product->name}}">
                            Buy Now
                        </a>
                        <a href="#" class="card-link float-right">Details</a>
                    </div>
                </div>
            @endforeach
            <div class="w-auto m-auto">
                {{$products->links("pagination::bootstrap-4")}}
            </div>
        </div>
    </div>
    @include('modals.product-order')
@endsection

@section('js')
    <script src="{{asset('js/order.js')}}"></script>
@endsection
