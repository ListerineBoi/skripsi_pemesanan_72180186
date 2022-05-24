@extends('layouts.apphome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12 mt-5">
    <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-12">
                <div class="card-body">
                    <h3 class="card-title">Detail Katalog</h3>
                    <h6>
                            <h5 class="mb-3"> {{$katalog->title}} </h5>
                    </h6>

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-s" role="tab" aria-controls="pills-s" aria-selected="true">S</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-m" role="tab" aria-controls="pills-m" aria-selected="false">M</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-l" role="tab" aria-controls="pills-l" aria-selected="false">L</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-xl" role="tab" aria-controls="pills-xl" aria-selected="false">XL</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-s" role="tabpanel" aria-labelledby="pills-s-tab">
                            @if($details !=null)
                            <div class="row ml-1 my-2">
                                <a href="{{route('viewinputsampling',['id' => $details->id])}}" class="btn btn-primary mr-1">Pesan Sample Pakaian Ini</a>
                                <a href="{{route('viewinputproduksi',['id' => $details->id])}}" class="btn btn-success ">Pesan Produksi Pakaian ini</a>

                            </div>
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr>
                                        <th scope="row">Lingkar Badan</th>
                                        <td>{{$details->ling_b}} Cm</td>
                                        <th scope="row">Lingkar Pinggang</th>
                                        <td>{{$details->ling_pgang}} Cm</td>
                                        <th scope="row">Lingkar Pinggul</th>
                                        <td>{{$details->ling_pingl}} Cm</td>
                                        <th scope="row">Lingkar Leher</th>
                                        <td>{{$details->ling_lh}} Cm</td>
                                    </tr>
                                
                                    <tr>
                                        <th scope="row">Lebar Bahu</th>
                                        <td>{{$details->leb_bahu}} Cm</td>
                                        <th scope="row">Panjang Lengan</th>
                                        <td>{{$details->pj_lengan}} Cm</td>
                                        <th scope="row">Lingkar Kerung Lengan</th>
                                        <td>{{$details->ling_kr_leng}} Cm</td>
                                        <th scope="row">Lingkar Lengan</th>
                                        <td>{{$details->ling_lengan}} Cm</td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row">Lingkar Pergel</th>
                                        <td>{{$details->ling_pergel}} Cm</td>
                                        <th scope="row">Lebar Muka</th>
                                        <td>{{$details->leb_muka}} Cm</td>
                                        <th scope="row">Lebar Punggung</th>
                                        <td>{{$details->leb_pungg}} Cm</td>
                                        <th scope="row">Panjang Punggung</th>
                                        <td>{{$details->panj_pungg}} Cm</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Panjang Baju</th>
                                        <td>{{$details->panj_baju}} Cm</td>
                                        <th scope="row">Tinggi Pinggul</th>
                                        <td>{{$details->tinggi_pingl}} Cm</td>
                                        <th scope="row">Lingkar Paha</th>
                                        <td>{{$details->ling_paha}} Cm</td>
                                        <th scope="row">Lingkar Lutut</th>
                                        <td>{{$details->ling_lutut}} Cm</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lingkar Kaki</th>
                                        <td>{{$details->ling_kaki}} Cm</td>
                                        <th scope="row">Panjang Celana/Rok</th>
                                        <td>{{$details->panj_cln_rok}} Cm</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Deskripsi Detail Lebih Lanjut
                                    </span>
                                    
                                </div>
                                <textarea class="form-control" aria-label="With textarea" style="background-color: #fff;" name="desc" disabled>{{$details->desc}}</textarea>
                            </div>
                            @else
                            Tidak Tersedia
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-m" role="tabpanel" aria-labelledby="pills-m-tab">
                            @if($detailm !=null)
                            <div class="row ml-1 my-2">
                                <a href="" class="btn btn-primary mr-1">Pesan Sample Pakaian Ini</a>
                                <form action="{{route('delkatalog')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="" name="id">
                                    <a href="{{route('viewinputproduksi',['id' => $detailm->id])}}" class="btn btn-success ">Pesan Produksi Pakaian ini</a>
                                </form>
                            </div>
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr>
                                        <th scope="row">Lingkar Badan</th>
                                        <td>{{$detailm->ling_b}} Cm</td>
                                        <th scope="row">Lingkar Pinggang</th>
                                        <td>{{$detailm->ling_pgang}} Cm</td>
                                        <th scope="row">Lingkar Pinggul</th>
                                        <td>{{$detailm->ling_pingl}} Cm</td>
                                        <th scope="row">Lingkar Leher</th>
                                        <td>{{$detailm->ling_lh}} Cm</td>
                                    </tr>
                                
                                    <tr>
                                        <th scope="row">Lebar Bahu</th>
                                        <td>{{$detailm->leb_bahu}} Cm</td>
                                        <th scope="row">Panjang Lengan</th>
                                        <td>{{$detailm->pj_lengan}} Cm</td>
                                        <th scope="row">Lingkar Kerung Lengan</th>
                                        <td>{{$detailm->ling_kr_leng}} Cm</td>
                                        <th scope="row">Lingkar Lengan</th>
                                        <td>{{$detailm->ling_lengan}} Cm</td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row">Lingkar Pergel</th>
                                        <td>{{$detailm->ling_pergel}} Cm</td>
                                        <th scope="row">Lebar Muka</th>
                                        <td>{{$detailm->leb_muka}} Cm</td>
                                        <th scope="row">Lebar Punggung</th>
                                        <td>{{$detailm->leb_pungg}} Cm</td>
                                        <th scope="row">Panjang Punggung</th>
                                        <td>{{$detailm->panj_pungg}} Cm</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Panjang Baju</th>
                                        <td>{{$detailm->panj_baju}} Cm</td>
                                        <th scope="row">Tinggi Pinggul</th>
                                        <td>{{$detailm->tinggi_pingl}} Cm</td>
                                        <th scope="row">Lingkar Paha</th>
                                        <td>{{$detailm->ling_paha}} Cm</td>
                                        <th scope="row">Lingkar Lutut</th>
                                        <td>{{$detailm->ling_lutut}} Cm</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lingkar Kaki</th>
                                        <td>{{$detailm->ling_kaki}} Cm</td>
                                        <th scope="row">Panjang Celana/Rok</th>
                                        <td>{{$detailm->panj_cln_rok}} Cm</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Deskripsi Detail Lebih Lanjut
                                    </span>
                                    
                                </div>
                                <textarea class="form-control" aria-label="With textarea" name="desc"  style="background-color: #fff;" disabled>{{$detailm->desc}}</textarea>
                            </div>
                            @else
                            Tidak Tersedia
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-l" role="tabpanel" aria-labelledby="pills-l-tab">
                            @if($detaill !=null)
                            <div class="row ml-1 my-2">
                                <a href="" class="btn btn-primary mr-1">Pesan Sample Pakaian Ini</a>
                                <form action="{{route('delkatalog')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="" name="id">
                                    <a href="{{route('viewinputproduksi',['id' => $detaill->id])}}" class="btn btn-success ">Pesan Produksi Pakaian ini</a>
                                </form>
                            </div>
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr>
                                        <th scope="row">Lingkar Badan</th>
                                        <td>{{$detaill->ling_b}} Cm</td>
                                        <th scope="row">Lingkar Pinggang</th>
                                        <td>{{$detaill->ling_pgang}} Cm</td>
                                        <th scope="row">Lingkar Pinggul</th>
                                        <td>{{$detaill->ling_pingl}} Cm</td>
                                        <th scope="row">Lingkar Leher</th>
                                        <td>{{$detaill->ling_lh}} Cm</td>
                                    </tr>
                                
                                    <tr>
                                        <th scope="row">Lebar Bahu</th>
                                        <td>{{$detaill->leb_bahu}} Cm</td>
                                        <th scope="row">Panjang Lengan</th>
                                        <td>{{$detaill->pj_lengan}} Cm</td>
                                        <th scope="row">Lingkar Kerung Lengan</th>
                                        <td>{{$detaill->ling_kr_leng}} Cm</td>
                                        <th scope="row">Lingkar Lengan</th>
                                        <td>{{$detaill->ling_lengan}} Cm</td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row">Lingkar Pergel</th>
                                        <td>{{$detaill->ling_pergel}} Cm</td>
                                        <th scope="row">Lebar Muka</th>
                                        <td>{{$detaill->leb_muka}} Cm</td>
                                        <th scope="row">Lebar Punggung</th>
                                        <td>{{$detaill->leb_pungg}} Cm</td>
                                        <th scope="row">Panjang Punggung</th>
                                        <td>{{$detaill->panj_pungg}} Cm</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Panjang Baju</th>
                                        <td>{{$detaill->panj_baju}} Cm</td>
                                        <th scope="row">Tinggi Pinggul</th>
                                        <td>{{$detaill->tinggi_pingl}} Cm</td>
                                        <th scope="row">Lingkar Paha</th>
                                        <td>{{$detaill->ling_paha}} Cm</td>
                                        <th scope="row">Lingkar Lutut</th>
                                        <td>{{$detaill->ling_lutut}} Cm</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lingkar Kaki</th>
                                        <td>{{$detaill->ling_kaki}} Cm</td>
                                        <th scope="row">Panjang Celana/Rok</th>
                                        <td>{{$detaill->panj_cln_rok}} Cm</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Deskripsi Detail Lebih Lanjut
                                    </span>
                                    
                                </div>
                                <textarea class="form-control" aria-label="With textarea" name="desc" style="background-color: #fff;" disabled>{{$detaill->desc}}</textarea>
                            </div>
                            @else
                            Tidak Tersedia
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-xl" role="tabpanel" aria-labelledby="pills-xl-tab">
                            @if($detailxl !=null)
                            <div class="row ml-1 my-2">
                                <a href="" class="btn btn-primary mr-1">Pesan Sample Pakaian Ini</a>
                                <form action="{{route('delkatalog')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="" name="id">
                                    <a href="{{route('viewinputproduksi',['id' => $detailxl->id])}}" class="btn btn-success ">Pesan Produksi Pakaian ini</a>
                                </form>
                            </div>
                            <table class="table table-bordered text-center">
                                <tbody>
                                    <tr>
                                        <th scope="row">Lingkar Badan</th>
                                        <td>{{$detailxl->ling_b}} Cm</td>
                                        <th scope="row">Lingkar Pinggang</th>
                                        <td>{{$detailxl->ling_pgang}} Cm</td>
                                        <th scope="row">Lingkar Pinggul</th>
                                        <td>{{$detailxl->ling_pingl}} Cm</td>
                                        <th scope="row">Lingkar Leher</th>
                                        <td>{{$detailxl->ling_lh}} Cm</td>
                                    </tr>
                                
                                    <tr>
                                        <th scope="row">Lebar Bahu</th>
                                        <td>{{$detailxl->leb_bahu}} Cm</td>
                                        <th scope="row">Panjang Lengan</th>
                                        <td>{{$detailxl->pj_lengan}} Cm</td>
                                        <th scope="row">Lingkar Kerung Lengan</th>
                                        <td>{{$detailxl->ling_kr_leng}} Cm</td>
                                        <th scope="row">Lingkar Lengan</th>
                                        <td>{{$detailxl->ling_lengan}} Cm</td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row">Lingkar Pergel</th>
                                        <td>{{$detailxl->ling_pergel}} Cm</td>
                                        <th scope="row">Lebar Muka</th>
                                        <td>{{$detailxl->leb_muka}} Cm</td>
                                        <th scope="row">Lebar Punggung</th>
                                        <td>{{$detailxl->leb_pungg}} Cm</td>
                                        <th scope="row">Panjang Punggung</th>
                                        <td>{{$detailxl->panj_pungg}} Cm</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Panjang Baju</th>
                                        <td>{{$detailxl->panj_baju}} Cm</td>
                                        <th scope="row">Tinggi Pinggul</th>
                                        <td>{{$detailxl->tinggi_pingl}} Cm</td>
                                        <th scope="row">Lingkar Paha</th>
                                        <td>{{$detailxl->ling_paha}} Cm</td>
                                        <th scope="row">Lingkar Lutut</th>
                                        <td>{{$detailxl->ling_lutut}} Cm</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lingkar Kaki</th>
                                        <td>{{$detailxl->ling_kaki}} Cm</td>
                                        <th scope="row">Panjang Celana/Rok</th>
                                        <td>{{$detailxl->panj_cln_rok}} Cm</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Deskripsi Detail Lebih Lanjut
                                    </span>
                                    
                                </div>
                                <textarea class="form-control" aria-label="With textarea" name="desc" style="background-color: #fff;" disabled>{{$detailxl->desc}}</textarea>
                            </div>
                            
                        </div>
                        
                        @else
                            Tidak Tersedia
                        @endif
                    </div>
                    
                    <p class="card-text text-dark"></p>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tentang Pakaian
                            </span>
                            
                        </div>
                        <textarea class="form-control" aria-label="With textarea" name="desc" style="background-color: #fff;" disabled>{{$katalog->desc}}</textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Harga
                            </span>
                            
                        </div>
                        <textarea class="form-control" aria-label="With textarea" name="desc" style="background-color: #fff;" disabled>{{$katalog->harga}}</textarea>
                    </div>
                    
                   
                    
                    <h4 class="header-title mt-5">File/Gambar Design
                    </h4>
                    <div class="row row-cols-1 row-cols-md-3 mb-3 pb-3 g-4 bg-light" >
                            @if($katalog->img_depan!=null)
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                
                                        @if($katalog->img_depan!=null)
                                        <img src="/storage/katalog/{{$katalog->img_depan}}" class="card-img-top" onError="this.onerror=null;this.src='/img/file.png';">
                                        @else
                                        Belum Ada
                                        @endif
                                
                                    <div class="card-body">
                                        Tampak Depan
                                        <div class="row col-12">
                                            @if($katalog->img_depan!=null)
                                            <a type="button" class="btn btn-primary mr-1 mb-2" target="_blank" href="{{url('/')}}/storage/katalog/{{$katalog->img_depan}}">Lihat File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($katalog->img_belakang!=null)
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                
                                        @if($katalog->img_belakang!=null)
                                        <img src="/storage/katalog/{{$katalog->img_belakang}}" class="card-img-top" onError="this.onerror=null;this.src='/img/file.png';">
                                        @else
                                        Belum Ada
                                        @endif
                                
                                    <div class="card-body">
                                        Tampak Belakang
                                        <div class="row col-12">
                                            @if($katalog->img_belakang!=null)
                                            <a type="button" class="btn btn-primary mr-1 mb-2" target="_blank" href="{{url('/')}}/storage/katalog/{{$katalog->img_belakang}}">Lihat File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($katalog->img_dll1!=null)
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                
                                        @if($katalog->img_dll1!=null)
                                        <img src="/storage/katalog/{{$katalog->img_dll1}}" class="card-img-top" onError="this.onerror=null;this.src='/img/file.png';">
                                        @else
                                        Belum Ada
                                        @endif
                                
                                    <div class="card-body">
                                        Detail Lainnya
                                        <div class="row col-12">
                                            @if($katalog->img_dll1!=null)
                                            <a type="button" class="btn btn-primary mr-1 mb-2" target="_blank" href="{{url('/')}}/storage/katalog/{{$katalog->img_dll1}}">Lihat File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($katalog->img_dll2!=null)
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                
                                        @if($katalog->img_dll2!=null)
                                        <img src="/storage/katalog/{{$katalog->img_dll2}}" class="card-img-top" onError="this.onerror=null;this.src='/img/file.png';">
                                        @else
                                        Belum Ada
                                        @endif
                                
                                    <div class="card-body">
                                        Detail Lainnya
                                        <div class="row col-12">
                                            @if($katalog->img_dll2!=null)
                                            <a type="button" class="btn btn-primary mr-1 mb-2" target="_blank" href="{{url('/')}}/storage/katalog/{{$katalog->img_dll2}}">Lihat File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            </div> 
                    </div>
                    
                        
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
