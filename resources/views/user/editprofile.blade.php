@extends('layouts.main')

@section('content')
    <div class="col-12 col-md">
        <form action="{{ route('updateprofile', $profile->id)}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="nama_depan">Nama Depan</label>
                <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="{{$profile->nama_depan}}">
            </div>
            <div class="form-group">
                <label for="nama_belakang">Nama Belakang</label>
                <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="{{$profile->nama_belakang}}">
            </div>
            <div class="form-group">
                <label for="bod">Tanggal Lahir</label>
                <input type="text" class="form-control" id="bod" name="bod" value="{{$profile->bod}}">
            </div>
            <div class="form-group">
                <label for="telp">Nomor Telepon</label>
                <input type="text" class="form-control" id="telp" name="telp" value="{{$profile->telp}}">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" value="{{$profile->alamat}}"></textarea>
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" value="{{$profile->kota}}">
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{$profile->provinsi}}">
            </div>
            <div class="form-group">
                <label for="negara">Negara</label>
                <input type="text" class="form-control" id="negara" name="negara" value="{{$profile->negara}}">
            </div>
            <div class="form-group">
                <label for="kode_pos">Kode Pos</label>
                <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{$profile->kode_pos}}">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection