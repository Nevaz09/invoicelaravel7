<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $judulhalaman = "Halaman Profile";
        $user = User::find($id);
        $profile = Profile::where('user_id', $id)->first();
        return view('user.showprofile', compact(['judulhalaman', 'user', 'profile']));
    }

    public function simpanphoto(Request $request){
        request()->validate([
            'photoprofile'=>'required|image|mimes:jpeg,png,gif,jpg,svg|max:2048',
        ]);
        $uid = $request->user_id;
        $profile = Profile::where('user_id',$uid)->first();
        $photolama = $profile->photo;
        if($files = $request->file('photoprofile')){
            $image = $request->file('photoprofile');
            $photobaru = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $photobaru);
           if(\File::exists(public_path('image/'.$photolama))){
                \File::delete(public_path('image/'.$photolama));
           }
        }
        $profile->photo = $photobaru;
        $profile->save();
        return Response()->json("success");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $judulhalaman ="Edit Halaman Profile";
        $user = User::find($id);
        $profile = Profile::where('user_id', $id)->first();
        return view('user.editprofile', compact(['judulhalaman', 'user', 'profile']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        $profile->nama_depan = $request->nama_depan;
        $profile->nama_belakang = $request->nama_belakang;
        $profile->bod = $request->bod;
        $profile->telp = $request->telp;
        $profile->alamat = $request->alamat;
        $profile->kota = $request->kota;
        $profile->provinsi = $request->provinsi;
        $profile->negara = $request->negara;
        $profile->kode_pos = $request->kode_pos;
        $profile->save();
        $pesan = "Profile Berhasil Diperbarui";
        return redirect('/user/profile/' . $profile->user_id)->with('success', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
