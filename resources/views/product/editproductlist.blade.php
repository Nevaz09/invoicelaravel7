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
<form action="{{ route('updateorder',$order_id)}}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token()}}">
    <input type="hidden" name="uid" value="{{ $uid}}">
    <div class="row">
        <div class="col-12 col-md">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Update Product Yang Anda Order</h3>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Update Order</button>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><input type="checkbox" name="itemsid[]" value="{{$product->id}}" {{isset($productitems[$product->id])?"checked":""}}></td>
                                    <td>{{$product->code}}</td>
                                    <td>{{$product->nama}}</td>
                                    <td>{{formatRupiah($product->harga)}}</td>
                                    <td>
                                        <select id="qtys" name="qtys[{{$product->id}}]" class="form-control">
                                            @for($i=1;$i<=$product->stock;$i++)
                                                <option value="{{$i}}" {{isset($qtys[$product->id])?(($qtys[$product->id]==$i)?"selected":""):""}}>{{$i}}</option>
                                            @endfor
                                        </select>
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