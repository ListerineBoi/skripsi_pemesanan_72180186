@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-12 mt-5">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Sampling</li>
            </ol>
            </nav>
            @if(\Session::has('success'))
                <input type="hidden" id='popupif' value='1'>
            @endif
            <div class="modal fade" id="popup">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                    
                        <div class="modal-body">
                            
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Pesanan Anda Sudah Diterima!</h4>
                                <p class="text-dark"> <strong>Silahkan masuk ke halaman detail pemesanan untuk cek kembali detail pesanan anda, dan untuk upload lampiran file ataupun gambar pada pesanan anda. Terimakasih</strong> </p>
                                <hr>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Sampling Aktif
                            <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Sampling Aktif" 
                                data-content="Pesanan sampling anda yang saat ini sedang dalam pelaksanaan/pembuatan.">
                                    <i class="fa fa-info-circle text-info"></i>
                            </a>
                        </h4>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach($sampling as $row)
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                    @if(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==0)
                                        <img src="\img\tnb.png" class="card-img-top" alt="...">
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==1)
                                        <img src="\img\top.png" class="card-img-top" alt="...">
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==2)
                                        <img src="\img\bottom.png" class="card-img-top" alt="...">
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==3)
                                        <img src="\img\dress.png" class="card-img-top" alt="...">
                                    @endif
                                <div class="card-body">
                                    @if(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==0)
                                        <h5 > {{DB::table('detail_pakaian')->where('id', $row->detail_id)->value('nama_atasan')}} + {{DB::table('detail_pakaian')->where('id', $row->detail_id)->value('nama_bawahan')}} </h5>
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==1)
                                        <h5 > {{DB::table('detail_pakaian')->where('id',  $row->detail_id)->value('nama_atasan')}} </h5>
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==2)
                                        <h5 > {{DB::table('detail_pakaian')->where('id',  $row->detail_id)->value('nama_bawahan')}} </h5>
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==3)
                                        <h5 > {{DB::table('detail_pakaian')->where('id',  $row->detail_id)->value('nama_atasan')}} </h5>
                                    @endif
                                    <h5 class="title">Pembuatan dimulai {{DB::table('slot')->where('id', $row->slot_id)->value('mulai')}} 
                                        @if($row->status == 0)
                                        <a href="#" class="badge badge-secondary">Konsultasi</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Konsultasi" 
                                        data-content="Fase konsultasi merupakan fase pertama dalam melakukan pemesanan,
                                         dalam fase ini customer dan pihak amoora akan membicarakan lebih lanjut tentang 
                                         detail pakaian yang dipesan hingga terjadi kesepakatan antar customer dan pihak amoora.
                                         Konsultasi dapat dilakukan melalui fitur livechat maupun fitur konsul online/offline.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @elseif($row->status == 1)
                                        <a href="#" class="badge badge-warning">Waiting list</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Waiting list" 
                                        data-content="Fase waiting list merupakan fase dimana sudah terjadi kesepakatan antara pihak amoora dan customer,
                                        dengan demikian proses pembuatan akan segera kami laksanakan, Terimakasih atas kesabaran anda.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @elseif($row->status == 2)
                                        <a href="#" class="badge badge-info">Cutting</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Cutting" 
                                        data-content="Fase pembuatan dimana sewer kami sedang dalam proses pemotongan kain.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @elseif($row->status == 3)
                                        <a href="#" class="badge badge-primary">Sewing</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Sewing" 
                                        data-content="Fase pembuatan dimana sewer kami dalam proses penjaitan pakaian.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @elseif($row->status == 4)
                                        <a href="#" class="badge badge-info">Finishing & QC + Shipping</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Finishing & QC + Shipping" 
                                        data-content="Fase pembuatan dimana sewer kami memasang accessories pakaian dll, serta mengemas pakaian yang sudah jadi dan shipping ke alamat anda.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @endif
                                    </h5>
                                    <h6 class="card-title">@if(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==0) Atasan+Bawahan @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==1) Atasan @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==2) Bawahan @else Dress @endif</h6>
                                    <a href="{{route('vieweditsampling',['id' => $row->id])}}" class="btn btn-primary">Detail</a>
                                    @if($row->status == 0)
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del{{$loop->iteration}}">
                                        Delete
                                    </button>
                                    <div class="modal fade" id="del{{$loop->iteration}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda Yakin Akan Menghapus Data Ini?.
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <a type="button" class="btn btn-danger" href="{{route('delS',['id' => $row->id])}}">Delete</a>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @endif
                                </div>
                                </div>
                            </div> 
                            @endforeach
                    </div>
                    <div class="mt-3">
                    {{ $sampling->withQueryString()->links() }}
                    </div>
                    </div>
                </div>
            </div>
            @if(count($samplingS) != 0)
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Sampling Selesai
                            <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Sampling Selesai" 
                                data-content="Tabel ini berisi histori pemesanan sampling anda yang sudah selesai. Semua detail pakaian yang anda berikan pada saat pemesanan tersimpan pada tabel ini,
                                 anda dapat mengajukan revisi/pesan kembali menggunakan detail pakaian yang sama.">
                                    <i class="fa fa-info-circle text-info"></i>
                            </a>
                        </h4>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                          
                            @foreach($samplingS as $row)
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                    @if(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==0)
                                        <img src="\img\tnb.png" class="card-img-top" alt="...">
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==1)
                                        <img src="\img\top.png" class="card-img-top" alt="...">
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==2)
                                        <img src="\img\bottom.png" class="card-img-top" alt="...">
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==3)
                                        <img src="\img\dress.png" class="card-img-top" alt="...">
                                    @endif
                                    <div class="card-body">
                                        @if(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==0)
                                            <h5 > {{DB::table('detail_pakaian')->where('id', $row->detail_id)->value('nama_atasan')}} + {{DB::table('detail_pakaian')->where('id', $row->detail_id)->value('nama_bawahan')}} </h5>
                                        @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==1)
                                            <h5 > {{DB::table('detail_pakaian')->where('id',  $row->detail_id)->value('nama_atasan')}} </h5>
                                        @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==2)
                                            <h5 > {{DB::table('detail_pakaian')->where('id',  $row->detail_id)->value('nama_bawahan')}} </h5>
                                        @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==3)
                                            <h5 > {{DB::table('detail_pakaian')->where('id',  $row->detail_id)->value('nama_atasan')}} </h5>
                                        @endif
                                        <h5 class="title">Pembuatan Selesai {{$row->tgl_jadi}} 
                                        </h5>
                                        <h6 class="card-title">@if(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==0) Atasan+Bawahan @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==1) Atasan @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==2) Bawahan @else Dress @endif</h6>
                                        @if(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('public')==1)
                                        <a href="{{route('revisisampling',['id' => $row->id])}}" class="btn btn-primary">Ajukan Revisi</a>
                                        @endif
                                        <a href="{{route('vieweditsampling',['id' => $row->id])}}" class="btn btn-primary">Detail</a>
                                    </div>
                                </div>
                            </div> 
                            
                            @endforeach
                            
                           
                    </div>
                    <div class="mt-3">
                    {{ $samplingS->withQueryString()->links() }}
                    </div>
                    </div>
                </div>
            </div>
            @endif
          
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
                        <form method="post" action="{{route('savesampling')}}" enctype='multipart/form-data'>
                            @csrf
                            <h4 class="header-title">Form Pengajuan Sampling Custom</h4>
                            <p class="text-muted font-14 mb-4"></p>
                            <div class="form-group">
                            
                                <label class="col-form-label">Slot/Batch Pembuatan</label> 
                                <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Slot/Batch Pembuatan" 
                                data-content="Slot/Batch adalah kelompok pesanan yang akan dibuat pada tanggal tertentu,pilih Slot/Batch dengan tanggal pembuatan yang anda inginkan,
                                 pendaftaran slot akan ditutup paling lambat 1 minggu sebelum tanggal pembuatan yang tertera. 
                                 Satu minggu sebelum tanggal pembuatan ditujukan sebagai waktu konsultasi desain/harga dll.">
                                    <i class="fa fa-info-circle text-info"></i>
                                </a>
                                <select class="custom-select" name="slot_id">
                                    @foreach($slot as $row)
                                        <option value="{{$row->id}}">{{$row->title}}, Pembuatan Dimulai {{$row->mulai}}</option>
                                    @endforeach
                                </select>
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
                                    <input class="form-control" type="text" maxlength='5'  value="" name="ling_pgang" placeholder="Ukuran Dalam Cm">
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
                                <!-- <div class="form-group col-sm-6">
                                <label class="control-label" for="ftktp">Upload Image *</label>
                                <div class="col-sm-10">
                                <input type="file" class="form-control-file" name="img_model">
                                </div> -->
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
                            
                            <button type="submit" class="btn btn-success" class="text-right" style="float: right;">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
