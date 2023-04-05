@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12 col-md">
        <form action="{{ route('updateproduct', $product->id)}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="code">Kode Product</label>
                <input type="text" class="form-control" id="code" name="code" value="{{$product->code}}">
            </div>
            <div class="form-group">
                <label for="nama">Nama Product</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{$product->nama}}">
            </div>
            <div class="form-group">
                <label for="harga">Harga Product</label>
                <input type="text" class="form-control" id="harga" name="harga" value="{{$product->harga}}">
            </div>
            <div class="form-group">
                <label for="stock">Stock Product</label>
                <input type="text" class="form-control" id="stock" name="stock" value="{{$product->stock}}">
            </div>
            <div class="row">
                <div class="col-12 col-md">
                    <button class="btn btn-primary" type="submit">Update Product</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection