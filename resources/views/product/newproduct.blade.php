@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12 col-md">
        <form action="{{route('storeproduct')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="code">Kode Product</label>
                <input type="text" class="form-control" id="code" name="code" placeholde="Product Code">
            </div>
            <div class="form-group">
                <label for="nama">Nama Product</label>
                <input type="text" class="form-control" id="nama" name="nama" palceholder="Nama Product">
            </div>
            <div class="form-group">
                <label for="harga">Harga Product</label>
                <input type="text" class="form-control" id="harga" name="harga" palceholder="Harga Product">
            </div>
            <div class="form-group">
                <label for="stock">Stock Product</label>
                <input type="text" class="form-control" id="stock" name="stock" palceholder="Stock Product">
            </div>
            <div class="row">
                <div class="col-12 col-md">
                    <button class="btn btn-primary" type="submit">Tambah Product</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection