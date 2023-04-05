<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judulhalaman = "Daftar Product";
        $products = Product::all();
        return view('product.index', compact(['judulhalaman', 'products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $judulhalaman = "Tambah Product";
        return view('product.newproduct', compact(['judulhalaman']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $product = new Product;
        $product->code = $request->code;
        $product->nama = $request->nama;
        $product->harga = $request->harga;
        $product->stock = $request->stock;
        $product->save();
        $pesan = "Data Product Berhasil Di Tambahkan";
        return redirect('product/index')->with('success', $pesan); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $judulhalaman ="Edit Product";
        $product = Product::find($id);
        return view('product.editproduct', compact(['judulhalaman','product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $product = Product::find($id);
        $product->code = $request->code;
        $product->nama = $request->nama;
        $product->harga = $request->harga;
        $product->stock = $request->stock;
        $product->save();
        $pesan = "Data Product Berhasil Di Perbarui";
        return redirect('product/index')->with('success', $pesan); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $product = Product::find($id);
        $product->delete();
        $pesan = "Data Peroduct Telah Di Hapus";
        return redirect('product/index')->with('success', $pesan); 
    }
    public function destroyall(Request $request)
    {
        $itemsid = $request->itemsid;
        // dd($itemsid);
        if(is_null($itemsid)){
            $pesan ="Silahkan Pilih Item Yang Akan Dihapus";
            return redirect('product/index')->with('warning', $pesan);
        }else{
            Product::whereIn('id', $itemsid)->delete();
            $pesan = "Items Berhasil Di Hapus";
            return redirect('product/index')->with('success', $pesan);   
        }
    }
}
