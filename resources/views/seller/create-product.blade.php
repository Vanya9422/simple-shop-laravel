@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{route('store.product')}}" class="col-10 offset-lg-1" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="name">Name*</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required maxlength="100">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity">Quantitiy*</label>
                    <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required>
                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="quantity">Price*</label>
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>
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
                        <option value="{{$category->id}}") @if(old('category') === $category->id) selected @endif>
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
                <textarea name="description" id="" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{old('description')}}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="general_image">Choosing [General Image]*</label>
                    <input type="file" name="general_image" class="form-control @error('general_image') is-invalid @enderror" id="general_image">
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
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" value="0" name="status" {{old('status') ? 'checked' : ''}}>
                    <label class="form-check-label" for="gridCheck">
                       Active
                    </label>
                </div>
            </div>
            <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading">Attention:</h4>
                <p>
                    After making the product, your product will go to the confirmation admin, after confirmation
                    it will be displayed on the website. If you do not mark it as an active product after cooking,
                    it will not appear on the site anyway
                </p>
                <hr>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/product.js')}}"></script>
@endsection
