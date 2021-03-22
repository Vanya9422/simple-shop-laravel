@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{route('update.product', ['product' => $product->id])}}" class="col-10 offset-lg-1" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="name">Name*</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$product->name}}" required maxlength="100">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity">Quantitiy*</label>
                    <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $product->quantity }}" required>
                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity">Price*</label>
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="category">Select Category*</label>
                <select name="category_id" class="form-control @error('category') is-invalid @enderror" >
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}") @if($product->category->id === $category->id) selected @endif>
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputAddress">Description*</label>
                <textarea name="description" id="" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{$product->description}}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="general_image">Choosing [General Image]*</label>
                    <input type="file" name="general_image" class="form-control @error('general_image') is-invalid @enderror" id="general_image" value="{{getPrimaryImage($product->images)->url}}">
                    @error('general_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="multiple_image">Choosing [Images]</label>
                    <input type="file" name="multiple_image[]" class="form-control @error('multiple_image.*') is-invalid @enderror" id="multiple_image" multiple>
                    @error('multiple_image.*')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group d-flex flex-nowrap">
                @foreach($product->images as $image)
                    <div id="image_{{$image->id}}" class="w-25 ml-1 p-1" style="background-image: url('{{asset("storage/{$image->url}")}}');background-size: cover;height: 134px">
                        <a href="#" class="delete-image" style="color: red" data-slug="{{$product->slug}}" data-id="{{$image->id}}">X</a>
                        @if($image->is_primary)
                            <strong style="color: seagreen"> Primary</strong>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" value="0" name="status" {{$product->status ? 'checked' : ''}}>
                    <label class="form-check-label" for="gridCheck">
                        Active
                    </label>
                </div>
            </div>
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/product.js')}}"></script>
@endsection

