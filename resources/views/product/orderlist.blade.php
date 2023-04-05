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
<form action="{{ route('destroyallorder')}}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token()}}">
    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Order List</h3>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"> </i> Delete</button>
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
                                <th>Order By</th>
                                <th>Tanggal Order</th>
                                <th>Jumlah Item</th>
                                <th>Total Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><input type="checkbox" name="itemsid[]" value="{{$order->id}}"></td>
                                    <td>{{$order->id}}</td>
                                    <td>{{namaUser($order->user_id)}}</td>
                                    <td>{{$order->tanggal_order}}</td>
                                    <td>
                                        {{totalOrderItem($order->id)}}
                                    </td>
                                    <td>
                                        {{formatRupiah(totalHarga($order->id))}}
                                    </td>
                                    <td>
                                        <a href="{{ asset('/order/editproductlist/' .$order->id)}}" class="btn btn-success"><i class="fas fa-edit"> </i></a>
                                        <a href="{{ asset('/order/invoice/' .$order->id)}}" class="btn btn-secondary"><i class="fas fa-file-invoice"> </i></a>
                                        <a href="#" class="btn btn-danger delete" data-id="{{$order->id}}" data-nama="{{namaUser($order->user_id)}}"><i class="fa fa-trash "></i></a>
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
            var orderid=$(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            swal({
                title: "Apakah kamu yakin?",
                text: "Untuk Menghapus Order Id "+orderid+" Atas Nama " +nama+"..! ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location ="/order/destroy/"+orderid+""
                swal("Terhapus! Kamu Berhasil Menghapus Data Order "+nama +"!", {
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