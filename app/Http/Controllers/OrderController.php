<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Orderitem;
use App\Invoice;
use App\Profile;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judulhalaman = "Order List";
        $orders = Order::all();
        return view('product.orderlist', compact(['judulhalaman', 'orders']));
    }

    public function productlist(){
        $judulhalaman = "Product Tersedia";
        $product = Product::where('stock', '>',0)->get();
        $uid = Auth::user()->id;
        return view('product.productlist', compact(['judulhalaman', 'product', 'uid']));
    }

    public function editproductlist($order_id){
        $judulhalaman = "Edit Pesananan Anda";
        $products = Product::where('stock', '>',0)->get();
        $uid = Auth::user()->id;
        $items = Orderitem::where("order_id", $order_id)->get();
        $productitems = array();
        $qtys = array();
        foreach($items as $item){
            $productitems[$item->product_id] = $item->product_id;
            $qtys[$item->product_id] = $item->qty;
        }
        return view('product.editproductlist', compact(['judulhalaman','products', 'order_id',  'uid', 'productitems', 'qtys']));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemsid = $request->itemsid;
        if(is_null($itemsid)){
            $pesan = "Anda Belum Pilih Product, Silahkan Pilih Product";
            return redirect()->route('productlist')->with('warning', $pesan);
        }else{
            $uid = $request->uid;
            $todaydate = Carbon::today();
            $order = new Order;
            $order->user_id = $uid;
            $order->tanggal_order = $todaydate;
            $order->save();

            $order_id = $order->id;
            $totalitem = count($itemsid);
            $qtys = $request->qtys;
            for($i=0; $i<$totalitem; $i++){
                $pid = $itemsid[$i];
                $qty = $qtys[$pid];
                $orderitem = new Orderitem;
                $orderitem->order_id = $order_id;
                $orderitem->product_id = $pid;
                $orderitem->qty = $qty;
                $orderitem->save();
            }
            $pesan = "Order Berhasil Dilakukan";
            return redirect()->route('productlist')->with('success', $pesan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order_id)
    {
        $itemsid = $request->itemsid;
        if(is_null($itemsid)){
            $pesan = "Anda Belum Pilih Product, Silahkan Pilih Product";
            return redirect()->route('orderlist')->with('warning', $pesan);
        }else{
            $totalitem = count($itemsid);
            $qtys = $request->qtys;
            Orderitem::where('order_id',$order_id)->delete();
            for($i=0; $i<$totalitem; $i++){
                $pid = $itemsid[$i];
                $qty = $qtys[$pid];
                $orderitem = new Orderitem;
                $orderitem->order_id = $order_id;
                $orderitem->product_id = $pid;
                $orderitem->qty = $qty;
                $orderitem->save();
            }
            $pesan = "Order Berhasil Diperbarui";
            return redirect()->route('orderlist')->with('success', $pesan);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        $pesan = "Order Berhasil Dihapus";
        return redirect()->route('orderlist')->with('success', $pesan);
    }
    public function destroyall(Request $request){
        $itemsid = $request->itemsid;
        // dd($itemsid);
        if(is_null($itemsid)){
            $pesan ="Silahkan Pilih Item Yang Akan Dihapus";
            return redirect()->route('orderlist')->with('warning', $pesan);
        }else{
            Order::whereIn('id', $itemsid)->delete();
            $pesan = "Items Berhasil Di Hapus";
            return redirect()->route('orderlist')->with('success', $pesan);   
        }
    }

    public function invoice($order_id){
        $invoice = Invoice::where('order_id', $order_id)->first();
        // dd($invoice);
        if(is_null($invoice)){
            $todaydate = Carbon::today();
            $invoice = new Invoice;
            $invoice->order_id = $order_id;
            $invoice->tanggal_issued = $todaydate;
            $invoice->status = 1; //invoice baru
            $invoice->save();
        }
        $order = Order::find($order_id);
        $customer_id = $order->user_id;
        $profile = Profile::where('user_id', $customer_id)->first();
        $orderitems = Orderitem::where('order_id', $order_id)->get();
        $judulhalaman = "Invoice";
        return view('product.invoice', compact(['judulhalaman', 'profile', 'order', 'orderitems']));
    }

    public function invoicelist(){
        $judulhalaman = "Invoice List";
        $invoices = Invoice::all();
        return view('product.invoicelist', compact(['judulhalaman', 'invoices']));
    }

    public function editinvoice($id){
        $judulhalaman = "Edit Status Invoice";
        $invoice = Invoice::find($id);
        return view('product.editinvoice', compact(['judulhalaman', 'invoice']));
    }

    public function updateinvoice(Request $request, $id){
        $invoice = Invoice::find($id);
        $invoice->status = $request->status;
        $invoice->save();
        $pesan =" Berhasil Update Invoice";
        return redirect('/order/invoicelist/')->with('success', $pesan);
    }
}
