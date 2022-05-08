@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Produksi</li>
            </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                <h4 class="header-title">Detail Sampling yang Sudah Selesai.</h4>
                <p class="text-muted font-14 mb-4">Anda dapat melakukan pemesanan produksi pakaian dengan detail pakaian di tabel ini.
                     Opsi di tabel ini merupakan detail pakaian dari pemesanan sampling yang sudah pernah anda pesan dan sudah selesai, jika tidak ingin menggunakan detail yang sudah ada,
                    anda dapat melakukan pemesanan produksi dengan detail pakaian baru melalui tabel "Produksi dengan Detail Pakaian Baru". </p>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @if(count($detail) != 0)
                
                        @foreach($detail as $row)
                        <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                    @if($row->jenis==0)
                                        <img src="\img\tnb.png" class="card-img-top" alt="...">
                                    @elseif($row->jenis==1)
                                        <img src="\img\top.png" class="card-img-top" alt="...">
                                    @elseif($row->jenis==2)
                                        <img src="\img\bottom.png" class="card-img-top" alt="...">
                                    @elseif($row->jenis==3)
                                        <img src="\img\dress.png" class="card-img-top" alt="...">
                                    @endif
                                <div class="card-body">
                                    @if($row->jenis==0)
                                        <h5 > {{$row->nama_atasan}} + {{$row->nama_bawahan}} </h5>
                                    @elseif($row->jenis==1)
                                        <h5 > {{$row->nama_atasan}} </h5>
                                    @elseif($row->jenis==2)
                                        <h5 > {{$row->nama_bawahan}} </h5>
                                    @elseif($row->jenis==3)
                                        <h5 > {{$row->nama_atasan}} </h5>
                                    @endif
                                    <h5 class="title">Pembuatan Selesai {{$row->tgl_jadi}} 
                                    </h5>
                                    <h6 class="card-title">@if($row->jenis==0) Atasan+Bawahan @elseif($row->jenis==1) Atasan @elseif($row->jenis==2) Bawahan @else Dress @endif</h6>
                                    <p class="card-text">{{$row->desc}}</p>
                                    <a href="{{route('viewinputproduksi',['id' => $row->id])}}" class="btn btn-primary">Produksi Dengan Sampling ini</a>
                                </div>
                                </div>
                            </div> 
                        @endforeach
                        @else
                        <div class="alert alert-warning ml-4" role="alert">
                            Tidak Ada Detail Pemesanan Sampling Yang Dapat Dipakai. 
                            <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Tidak Ada Detail Pemesanan Sampling Yang Dapat Dipakai." 
                                data-content="Belum ada pesanan sampling anda yang sudah selesai sehingga detail pakaian dari pesanan
                                 tersebut belum dapat digunakan atau detail sampling yang ada, sudah anda gunakan untuk melakukan pemesanan produksi sehingga semetara tidak bisa digunakan lagi sebelum pemesanan produksi tersebut selesai.">
                                <i class="fa fa-info-circle text-info"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card mt-5">
          

                <div class="card-body my-5">
                <div class="col-md-12 text-center">
                    <h3 class="mb-3" >Produksi dengan Detail Pakaian Baru
                    <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Sampling Selesai" 
                        data-content="Klik Tombol di bawah jika anda ingin melakukan pemesanan produksi dengan detail pakaian baru tanpa melakukan sampling terlebih dahulu.">
                        <i class="fa fa-info-circle text-info"></i>
                    </a>
                    </h3>
                    <a href="{{route('viewcussampproduksi')}}" class="btn btn-primary" style="text-align: center">Klik disini</a>
                    </div>
                    
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                <h4 class="header-title">Produksi On-Going</h4>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($produksi as $row2)
                        <div class="col-lg-4 col-md-6 mt-1">
                            <div class="card h-100 card-bordered">
                            @if(DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('jenis')==0)
                                        <img src="\img\tnb.png" class="card-img-top" alt="...">
                                    @elseif(DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('jenis')==1)
                                        <img src="\img\top.png" class="card-img-top" alt="...">
                                    @elseif(DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('jenis')==2)
                                        <img src="\img\bottom.png" class="card-img-top" alt="...">
                                    @elseif(DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('jenis')==3)
                                        <img src="\img\dress.png" class="card-img-top" alt="...">
                                    @endif
                            <div class="card-body">
                                    @if(DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('jenis')==0)
                                        <h5 > {{DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('nama_atasan')}} + {{DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('nama_bawahan')}} </h5>
                                    @elseif(DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('jenis')==1)
                                        <h5 > {{DB::table('detail_pakaian')->where('id',  $row2->detail_id)->value('nama_atasan')}} </h5>
                                    @elseif(DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('jenis')==2)
                                        <h5 > {{DB::table('detail_pakaian')->where('id',  $row2->detail_id)->value('nama_bawahan')}} </h5>
                                    @elseif(DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('jenis')==3)
                                        <h5 > {{DB::table('detail_pakaian')->where('id',  $row2->detail_id)->value('nama_atasan')}} </h5>
                                    @endif
                                <h5 class="card-title">Pembuatan dimulai {{DB::table('slot')->where('id', $row2->slot_id)->value('mulai')}} 
                                        @if($row2->status == 0)
                                        <a href="#" class="badge badge-secondary">Konsultasi</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Konsultasi" 
                                        data-content="Fase konsultasi merupakan fase pertama dalam melakukan pemesanan,
                                         dalam fase ini customer dan pihak amoora akan membicarakan lebih lanjut tentang 
                                         detail pakaian yang dipesan hingga terjadi kesepakatan antar customer dan pihak amoora.
                                         Konsultasi dapat dilakukan melalui fitur livechat maupun fitur konsul online/offline.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @elseif($row2->status == 1)
                                        <a href="#" class="badge badge-warning">Waiting list</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Waiting list" 
                                        data-content="Fase waiting list merupakan fase dimana sudah terjadi kesepakatan antara pihak amoora dan customer,
                                        dengan demikian proses pembuatan akan segera kami laksanakan, Terimakasih atas kesabaran anda.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @elseif($row2->status == 2)
                                        <a href="#" class="badge badge-info">Cutting</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Cutting" 
                                        data-content="Fase pembuatan dimana sewer kami sedang dalam proses pemotongan kain.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @elseif($row2->status == 3)
                                        <a href="#" class="badge badge-primary">Sewing</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Sewing" 
                                        data-content="Fase pembuatan dimana sewer kami dalam proses penjaitan pakaian.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @elseif($row2->status == 4)
                                        <a href="#" class="badge badge-info">Finishing & QC</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Sewing" 
                                        data-content="Fase pembuatan dimana sewer kami memasang accessories pakaian dll, serta mengemas pakaian yang sudah jadi.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @endif
                                </h5>
                                <h5 class="card-title">Jumlah Produksi : <strong> {{$row2->jml}} </strong> </h5>
                                <p class="card-text">{{$row2->desc}}</p>
                                <div class="row">
                                    <a href="{{route('editproduksi',['id' => $row2->id])}}" class="btn btn-primary mr-2">Detail</a>
                                    @if($row2->status == 0)
                                    <form action="{{route('delprod')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="slot_id" value="{{$row2->slot_id}}">
                                        <input type="hidden" name="id" value="{{$row2->id}}">
                                        <input type="hidden" name="detail_id" value="{{$row2->detail_id}}">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            </div>
                        </div> 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
