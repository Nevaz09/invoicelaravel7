@extends('layouts.nomenu')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">\
            <div class="row">
                <div class="col-md-2">
                    <h5 class="brand-text font-weight-light">Webstore<h2>Invoice</h2></h5>
                </div>
                <div class="col-md-10">
                    <span class="float-right font-weight-light">Order #{{$order->id}}</span>
                </div>
            </div>


    		
    		<hr>
    		<div class="row">
    			<div class="col-md-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					WebStore<br>
    					18 S Beverly Avenue<br>
    					Chicago, ST 60620, United States<br>
    					Telp. (424) 741-0294
    				</address>
    			</div>
    			<div class="col-md-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
                        {{namaUser($order->user_id)}}<br>
    					{{$profile->alamat}} {{$profile->kota}}<br>
    					{{$profile->provinsi}}, {{$profile->kode_pos}}, {{$profile->negara}}<br>
                        Telp. {{$profile->telp}}
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-md-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					Visa ending **** 4242<br>
    					jsmith@email.com
    				</address>
    			</div>
    			<div class="col-md-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{$order->tanggal_order}}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td class="text-center"><strong>Code Barang</strong></td>
        							<td class="text-center"><strong>Nama Nama</strong></td>
        							<td class="text-center"><strong>Harga Barang</strong></td>
        							<td class="text-center"><strong>QTY</strong></td>
        							<td class="text-right"><strong>Total</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							@foreach($orderitems as $orderitem)
                                @php($product = productDetail($orderitem->product_id))
                                    <tr>
                                        <td class="text-center">{{$product->code}}</td>
                                        <td class="text-center">{{$product->nama}}</td>
                                        <td class="text-center">{{formatRupiah($product->harga)}}</td>
                                        <td class="text-center">{{$orderitem->qty}}</td>
                                        <td class="text-center">Rp. {{(formatRupiah($product->harga*$orderitem->qty))}}</td>
                                    </tr>
                                @endforeach
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">Rp. {{formatRupiah(totalHarga($order->id))}}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
@endsection
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
@endsection