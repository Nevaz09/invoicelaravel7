<?php
    $invoicestatus = invoiceStatus();
?>
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12 col-md">
        <form action="{{ route('updateinvoice', $invoice->id)}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="code">Order Id</label>
                <input type="text" class="form-control" id="orderid" name="orderid" value="{{$invoice->order_id}}" readonly="readonly">
            </div>
            <div class="form-group">
                <label for="nama">Nama Customer</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{namaCustomer($invoice->order_id)}}" readonly="readonly">
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Order</label>
                <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{$invoice->tanggal_issued}}" readonly="readonly">
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah Item</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" value="{{totalOrderItem($invoice->order_id)}}" readonly="readonly">
            </div>
            <div class="form-group">
                <label for="total">Total Harga</label>
                <input type="text" class="form-control" id="total" name="total" value="{{formatRupiah(totalHarga($invoice->order_id))}}" readonly="readonly">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    @foreach($invoicestatus as $key=>$value)
                        <option value="{{$key}}" {{($invoice->status==$key)?"selected":""}}> {{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-12 col-md">
                    <button class="btn btn-primary" type="submit">Update Invoice</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection