<?php
use App\Profile;
use App\Order;
use App\Orderitem;
use App\User;
use App\Product;


    


    function totalHarga($orderid){
        $orderitems = Orderitem::where('order_id', $orderid)->get();
        $totalharga = 0;
        foreach($orderitems as $item){
            $pid = $item->product_id;
            $qty = $item->qty;
            $product = Product::find($pid, ['harga']);
            $subharga = $product->harga * $qty;
            $totalharga +=$subharga;
        }
        return $totalharga;
    }


    function totalOrderItem($orderid){
        $totalorderitem =  Orderitem::where('order_id', $orderid)->get()->sum('qty');
        return $totalorderitem;
    }


    function namaUser($uid){
        $profile = Profile::where('user_id', $uid)->first();
        $nama = $profile->nama_depan .' ' .$profile->nama_belakang;
        return $nama;
    }


    function formatRupiah($nilai){
        $formatrupiah = number_format($nilai, 2, ',','.');
        return $formatrupiah;
    }

    function productDetail($pid){
        $product = Product::find($pid);
        return $product;
    }

    function namaCustomer($orderid){
        $order = Order::find($orderid);
        $cuid = $order->user_id;
        return namaUser($cuid);
    }

    function invoiceStatus(){
        $invoicestatus [1] = 'Baru' ;
        $invoicestatus [2] = 'Lunas' ;
        $invoicestatus [3] = 'Batal' ;
        return $invoicestatus;
    }
?>