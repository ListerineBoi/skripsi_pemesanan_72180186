@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-12 mt-3">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('viewproduksi')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produksi Custom</li>
            </ol>
            </nav>
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
                        <form method="post" action="{{route('saveprodcustom')}}" enctype='multipart/form-data'>
                            @csrf
                            <h4 class="header-title">Form Detail Produksi</h4>
                            <p class="text-muted font-14 mb-4"></p>
                            <div class="form-group">
                            
                                
                            </div>
                            <div class="form-group">
                            
                                <label class="col-form-label">Jenis</label> 
                                <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Jenis" 
                                data-content="pilihan jenis pemesanan baju, pilih sesuai kebutuhan pemesanan">
                                    <i class="fa fa-info-circle text-info"></i>
                                </a>
                                <select class="custom-select" name="jenis" id=disparent1>
                                    <option value="0">Atasan + Bawahan</option>
                                    <option value="1">Atasan</option>
                                    <option value="2">Bawahan</option>
                                    <option value="3">Dress</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Nama Pakaian</label>
                                <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Nama Pakaian" 
                                data-content="Contoh:dress, top, shirt dll">
                                    <i class="fa fa-info-circle text-info"></i>
                                </a>
                                <input class="form-control" type="text" value="" id="dischild" name="nama_atasan">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Nama Pakaian Bawahan</label>
                                <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Nama Pakaian" 
                                data-content="Contoh:rok, celana panjang, dll">
                                    <i class="fa fa-info-circle text-info"></i>
                                </a>
                                <input class="form-control" type="text" value="" id="dischild2" name="nama_bawahan">
                            </div>
                            <div class="row col-sm-12 mb-3">
                            <h6 class="">Detail Ukuran</h6>
                                <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Detail Ukuran" 
                                data-content="Kolom yang tidak diperlukan dapat dikosongi,jika ada ukuran custom yang tidak ada kolomnya maka dapat di tulis di dalam kolom detail lebih lanjut">
                                    <i class="fa fa-info-circle text-info"></i>
                                </a>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Badan</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_b" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggang</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_pgang" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggul</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_pingl" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar leher</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_lh" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Bahu</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="leb_bahu" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Lengan</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="pj_lengan" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Kerung Lengan</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_kr_leng" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Lengan</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_lengan" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pergelangan</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_pergel" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Muka</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="leb_muka" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Punggung</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="leb_pungg" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Punggung</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="panj_pungg" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Baju</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="panj_baju" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Tinggi pinggul</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="tinggi_pingl" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggang celana rok</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_pinggang" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pesak</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_pesak" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Paha</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_paha" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Lutut</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_lutut" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Kaki</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="ling_kaki" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Celana</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="panj_cln_rok" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Tinggi Duduk</label>
                                    <input class="form-control" type="text" maxlength='5' value="" name="tingg_dudk" placeholder="Ukuran Dalam Cm">
                                </div>
                            </div>
                            <div class="row col-sm-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Deskripsi Lebih Lanjut
                                            <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Deskripsi Lebih Lanjut" 
                                            data-content="berisi segala instruksi/permintaan tambahan meliputi detail model baju, jenis trimmings, accessories tambahan, jenis kancing dll.">
                                                <i class="fa fa-info-circle text-info"></i>
                                            </a>
                                        </span>
                                        
                                    </div>
                                    <textarea class="form-control" aria-label="With textarea" name="desc"></textarea>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-success" class="text-right" style="float: right;">Form Selanjutnya</button>
                        </form>
                    </div>
                        
                    
                </div>
                </div>
            </div>


    

    
            
        </div>
        </div>
    </div>
</div>
@endsection
