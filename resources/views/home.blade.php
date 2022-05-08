@extends('layouts.apphome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-12 mt-5">
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
                                    <textarea class="form-control" aria-label="With textarea" style="background-color: #fff;" name="desc" readonly>{{$row->harga}}</textarea>
                                    <div class="row mt-3 ml-2">
                                        <a href="{{route('viewdetailkatalogpublic',['id' => $row->id])}}" class="btn btn-primary mr-1">Detail Pakaian</a>
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
