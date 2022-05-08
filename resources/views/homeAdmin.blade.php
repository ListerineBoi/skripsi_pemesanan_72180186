@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-12 mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Katalog</li>
                </ol>
                </nav>
            @if(\Session::has('success'))
                <input type="hidden" id='popupif' value='1'>
            @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Pilihan Katalog
                            <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Sampling Aktif" 
                                data-content="Katalog yang tersedia di Amoora Couture,jika katalog kurang sesuai customer dapat melakukan pesanan custom dengan login/register terlebih dahulu.">
                                    <i class="fa fa-info-circle text-info"></i>
                            </a>
                        </h4>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($Katalog as $row)
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                   
                                        <img src="/storage/katalog/{{$row->img_depan}}" class="card-img-top" alt="...">
                                   
                                <div class="card-body">
                                   
                                        <h5 > {{$row->title}} </h5>
                                    
                                    <h5 class="title">Harga: 
                                    </h5>
                                    <h6 class="card-title">{{$row->harga}}</h6>
                                    <div class="row">
                                        <a href="{{route('viewadmindetailkatalog',['id' => $row->id])}}" class="btn btn-primary mr-1">Detail</a>
                                        <form action="{{route('delkatalog')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$row->id}}" name="id">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                   
                                </div>
                                </div>
                            </div> 
                        @endforeach    
                    </div>
                    </div>
                </div>
            </div>
          
            <div class="col-md-12 mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                            </ul>
                            </div>
                        @endif

                        @if(\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{\Session::get('success')}}</p>
                            </div>
                        @endif

                        @if(\Session::has('Forbidden'))
                            <div class="alert alert-danger">
                                <p>{{\Session::get('Forbidden')}}</p>
                            </div>
                        @endif
                        <form method="post" action="{{route('setkatalog')}}" enctype='multipart/form-data'>
                            @csrf
                            <h4 class="header-title">Form Pengajuan Sampling</h4>
                            <div class="form-group">
                                <label class="col-form-label">Nama Pakaian</label>
                                <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Nama Pakaian" 
                                data-content="Contoh:dress, top, shirt dll">
                                    <i class="fa fa-info-circle text-info"></i>
                                </a>
                                <input class="form-control" type="text" value="" id="dischild" name="title">
                            </div>
                            <div class="row col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Deskripsi Harga
                                        </span>
                                        
                                    </div>
                                    <textarea class="form-control" aria-label="With textarea" name="harga"></textarea>
                                </div>
                            </div>
                            <div class="row col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Deskripsi
                                        </span>
                                        
                                    </div>
                                    <textarea class="form-control" aria-label="With textarea" name="desc"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <!-- <label class="control-label" for="ftktp">Upload Image *</label>
                                <div class="col-sm-10">
                                <input type="file" class="form-control-file" name="img"> -->
                            </div>
                            
                            <button type="submit" class="btn btn-success" class="text-right" style="float: right;">Simpan</button>
                    </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
