<?php
    $invoicestatus = invoiceStatus();
?>

@extends('layouts.main')

@section('content')
<!-- <div class="row">
    <div class="col-12 col-md">
        @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>
        @endif
    </div>
</div> -->
<form action="{{ route('destroyallproduct')}}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token()}}">
    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Invoice List</h3>
                        </div>
                        <div class="float-right">
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="chkpilihsemua"></th>
                                <th>Order ID</th>
                                <th>Nama Customer</th>
                                <th>Tanggal Order</th>
                                <th>Jumlah Item</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                        
                                <tr>
                                    <td><input type="checkbox" name="itemsid[]" value="{{$invoice->id}}"></td>
                                    <td>{{$invoice->order_id}}</td>
                                    <td>{{namaCustomer($invoice->order_id)}}</td>
                                    <td>{{$invoice->tanggal_issued}}</td>
                                    <td>{{totalOrderItem($invoice->order_id)}}</td>
                                    <td>{{formatRupiah(totalHarga($invoice->order_id))}}</td>
                                    <td>{{$invoicestatus[$invoice->status]}}</td>
                                    <td>
                                        <a href="{{ asset('/order/editinvoice/' .$invoice->id)}}" class="btn btn-success"><i class="fas fa-edit"> Edit Status</i></a>                                        
                                    </td>
                                </tr>
                            @endforeach  
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</form>
@endsection()
@section('js')
    <script>
        $('.delete').click(function(){
            var productid=$(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            swal({
                title: "Apakah kamu yakin?",
                text: "Untuk Menghapus Data Product "+nama+"..! ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location ="/product/destroy/"+productid+""
                swal("Terhapus! Kamu Berhasil Menghapus Data Product "+nama+"!", {
                icon: "success",
                });
            } else {
                swal("Data Tidak Jadi Dihapus!");
            }
            }); 
        });
  </script>
  <script>
    @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}")
    @endif
    @if(Session::has('error'))
        toastr.error("{{Session::get('error')}}")
    @endif
    @if(Session::has('warning'))
        toastr.warning("{{Session::get('warning')}}")
    @endif
    </script>
@endsection()