<?php
    // dd($profile);
    $nama = $profile->nama_depan . ' ' . $profile->nama_belakang;
    $img = $profile->photo;
    if(is_null($img)){
        $img = "noimage.png";
    }
    $bod = $profile->bod;
    $telp = $profile->telp;
    $alamat = $profile->alamat;
    $kota = $profile->kota;
    $provinsi = $profile->provinsi;
    $kode_pos = $profile->kode_pos;
    $negara = $profile->negara;
     
?>

@extends('layouts.main')

@section('content')
<!-- <div class="row">
    <div class="col-12 col-md">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>    
        @endif
    </div>
</div> -->
<div class="container emp-profile">
            <form method="post" enctype="multipart/form-data" id="formgantiphoto" action="{{route('simpanphoto')}}">
                <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                <input type="hidden" name="user_id" value="{{ $profile->user_id}}"/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="{{asset('image/' . $img)}}" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="photoprofile" id="photoprofile"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        {{$nama}}
                                    </h5>
                                    <h6>
                                        Lahir   : {{$bod}}
                                    </h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ asset('user/editprofile/'.$user->id)}}" class="profile-edit-btn">Edit Profile</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->id}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$telp}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$alamat}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Kota</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$kota}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Provinsi</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$provinsi}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Negara</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$negara}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Kode Pos</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$kode_pos}}</p>
                                            </div>
                                        </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </form>           
        </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('#photoprofile').change(function(){
                $('#formgantiphoto').submit();
            });
            $('#formgantiphoto').submit(function(e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type:'post',
                    url: "{{ url('user/profile/simpanphoto')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType:'json',
                    success: (data) =>{
                        this.reset();
                        // alert("Photo Berhasil Diganti");
                        setTimeout(function(){
                            location.reload()
                        }, );
                        toastr.success("{{Session::get('success')}}")
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
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
@endsection