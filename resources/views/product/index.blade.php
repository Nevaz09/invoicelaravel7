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
                            <h3 class="card-title">Data Product</h3>
                        </div>
                        <div class="float-right">
                            <a href="/product/create" class="btn btn-primary"><i class="fas fa-plus-square"></i> Create</a>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"> </i> Delete All</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="chkpilihsemua"></th>
                                <th>Kode Product</th>
                                <th>Nama Product</th>
                                <th>Harga</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><input type="checkbox" name="itemsid[]" value="{{$product->id}}"></td>
                                    <td>{{$product->code}}</td>
                                    <td>{{$product->nama}}</td>
                                    <td>{{formatRupiah($product->harga)}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>
                                        <a href="{{ asset('/product/edit/' .$product->id)}}" class="btn btn-success"><i class="fas fa-edit"> </i></a>
                                        <!-- <a href="{{ asset('/product/destroy/' .$product->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"> </i></a> -->
                                        <a href="#" class="btn btn-danger delete" data-id="{{$product->id}}" data-nama="{{$product->nama}}"><i class="fa fa-trash "></i></a>
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