@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-body">
                <h4 class="header-title">Sampling Yang Ada</h4>
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
                                        <h5 > {{DB::table('detail_pakaian')->where('id', $row->detail_id)->value('nama_atasan')}} + {{DB::table('detail_pakaian')->where('id', $row->slot_id)->value('nama_bawahan')}} </h5>
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==1)
                                        <h5 > {{DB::table('detail_pakaian')->where('id',  $row->detail_id)->value('nama_atasan')}} </h5>
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==2)
                                        <h5 > {{DB::table('detail_pakaian')->where('id',  $row->detail_id)->value('nama_bawahan')}} </h5>
                                    @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==3)
                                        <h5 > {{DB::table('detail_pakaian')->where('id',  $row->detail_id)->value('nama_atasan')}} </h5>
                                    @endif
                                    <h5 class="title">Pembuatan dimulai {{DB::table('slot_s')->where('id', $row->slot_id)->value('mulai')}} 
                                        @if($row->status == 0)
                                        <a href="#" class="badge badge-secondary">Konsultasi</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Konsultasi" 
                                        data-content="Fase konsultasi merupakan fase pertama dalam melakukan pemesanan,
                                         dalam fase ini customer dan pihak amoora akan membicarakan lebih lanjut tentang 
                                         detail pakaian yang dipesan hingga terjadi kesepakatan antar customer dan pihak amoora.
                                         Konsultasi dapat dilakukan melalui fitur livechat maupun fitur konsul online/offline">
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
                                        <a href="#" class="badge badge-info">Finishing & QC</a>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Sewing" 
                                        data-content="Fase pembuatan dimana sewer kami memasang accessories pakaian dll, serta mengemas pakaian yang sudah jadi.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                        @endif
                                    </h5>
                                    <h6 class="card-title">@if(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==0) Atasan+Bawahan @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==1) Atasan @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('jenis')==2) Bawahan @else Dress @endif</h6>
                                    <p class="card-text">{{DB::table('detail_pakaian')->where('id', $row->detail_id)->value('desc')}}</p>
                                    <a href="{{route('viewpilihkonsul',['id' => $row->id,'jns' => 0])}}" class="btn btn-primary">Pilih jadwal Konsul</a>
                                </div>
                                </div>
                            </div> 
                            @endforeach
                    </div>
                </div>
            </div>


            <div class="card mt-5">
                <div class="card-header">Produksi </div>

                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($produksi as $row2)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 card-bordered">
                            <img src="/storage/imgsampling/{{DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('img')}}" width='300' height='300' class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{DB::table('slot_p')->where('id', $row2->slot_id)->value('mulai')}} s/d {{DB::table('slot_p')->where('id', $row2->slot_id)->value('selesai')}} 
                                        @if($row2->status == 0)
                                        <a href="#" class="badge badge-secondary">Pending</a>
                                        @elseif($row2->status == 1)
                                        <a href="#" class="badge badge-warning">Waiting list</a>
                                        @elseif($row2->status == 2)
                                        <a href="#" class="badge badge-info">Proses</a>
                                        @elseif($row2->status == 3)
                                        <a href="#" class="badge badge-primary">Finishing</a>
                                        @elseif($row2->status == 4)
                                        <a href="#" class="badge badge-success">Selesai</a>
                                        @endif
                                </h5>
                                <h5 class="card-title">Jumlah Produksi : {{$row2->jml}}</h5>
                                <p class="card-text">{{DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('desc')}}</p>
                                <a href="{{route('viewpilihkonsul',['id' => $row2->id,'jns' => 1])}}" class="btn btn-primary">Pilih jadwal Konsul</a>
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
