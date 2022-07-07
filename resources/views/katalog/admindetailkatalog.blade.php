@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-12 mt-5">
    <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('homeadmin')}}">Katalog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
                </nav>
    <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-12">
                <div class="card-body">
                @if(\Session::has('Forbidden'))
                            <div class="alert alert-danger">
                                {{\Session::get('Forbidden')}}
                            </div>
                        @endif
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
                                <textarea class="form-control" aria-label="With textarea" name="desc" disabled>{{$details->desc}}</textarea>
                            </div>
                            <a href="{{route('vieweditdetailkatalog',['id' => $katalog->detail_id_s])}}" class="btn btn-primary">Edit Detail Pakaian Ukuran S</a>
                            <a href="{{route('delkatalogukuran',['id' => $katalog->detail_id_s,'id_kat' => $katalog->id,'tipe' => 'S'])}}" class="btn btn-danger">Delete/reset Pakaian Ukuran S</a>
                            @else
                            <a href="{{route('createdetailkatalog',['id' => $katalog->id,'tipe' => 'S'])}}" class="btn btn-primary">Isi Detail Pakaian</a>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-m" role="tabpanel" aria-labelledby="pills-m-tab">
                            @if($detailm !=null)
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
                                <textarea class="form-control" aria-label="With textarea" name="desc" disabled>{{$detailm->desc}}</textarea>
                            </div>
                            <a href="{{route('vieweditdetailkatalog',['id' => $katalog->detail_id_m])}}" class="btn btn-primary">Edit Detail Pakaian Ukuran M</a>
                            <a href="{{route('delkatalogukuran',['id' => $katalog->detail_id_m,'id_kat' => $katalog->id,'tipe' => 'M'])}}" class="btn btn-danger">Delete/reset Pakaian Ukuran M</a>
                            @else
                            <a href="{{route('createdetailkatalog',['id' => $katalog->id,'tipe' => 'M'])}}" class="btn btn-primary">Isi Detail Pakaian</a>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-l" role="tabpanel" aria-labelledby="pills-l-tab">
                            @if($detaill !=null)
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
                                <textarea class="form-control" aria-label="With textarea" name="desc" disabled>{{$detaill->desc}}</textarea>
                            </div>
                            <a href="{{route('vieweditdetailkatalog',['id' => $katalog->detail_id_l])}}" class="btn btn-primary">Edit Detail Pakaian Ukuran L</a>
                            <a href="{{route('delkatalogukuran',['id' => $katalog->detail_id_l,'id_kat' => $katalog->id,'tipe' => 'L'])}}" class="btn btn-danger">Delete/reset Pakaian Ukuran L</a>
                            @else
                            <a href="{{route('createdetailkatalog',['id' => $katalog->id,'tipe' => 'L'])}}" class="btn btn-primary">Isi Detail Pakaian</a>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-xl" role="tabpanel" aria-labelledby="pills-xl-tab">
                            @if($detailxl !=null)
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
                                <textarea class="form-control" aria-label="With textarea" name="desc" disabled>{{$detailxl->desc}}</textarea>
                            </div>
                            <a href="{{route('vieweditdetailkatalog',['id' => $katalog->detail_id_xl])}}" class="btn btn-primary">Edit Detail Pakaian XL</a>
                            <a href="{{route('delkatalogukuran',['id' => $katalog->detail_id_xl,'id_kat' => $katalog->id,'tipe' => 'XL'])}}" class="btn btn-danger">Delete/reset Pakaian Ukuran XL</a>
                        </div>
                        
                        @else
                        <a href="{{route('createdetailkatalog',['id' => $katalog->id,'tipe' => 'XL'])}}" class="btn btn-primary">Isi Detail Pakaian</a>
                        @endif
                    </div>
                    
                    <p class="card-text text-dark"></p>
                    <form action="{{route('editkatalog')}}" method="post">
                        @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tentang Pakaian
                            </span>
                            
                        </div>
                        
                        <input type="hidden" name="id" value="{{$katalog->id}}">
                        <textarea rows="7" class="form-control" aria-label="With textarea" name="desc">{{$katalog->desc}}</textarea>
                        
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Harga
                            </span>
                        </div>
                        <textarea rows="7" class="form-control" aria-label="With textarea" name="harga">{{$katalog->harga}}</textarea>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" role="switch" name='aktif' id="flexSwitchCheckChecked" @if($katalog->aktif==1) checked @endif>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Aktif/Non-Aktif</label>
                    </div>
                    <button class="btn btn-Primary" type="submit">Ubah</button>
                    
                    </form>
                    
                   
                    
                    <h4 class="header-title mt-5">File/Gambar Design
                    <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="File/Gambar Design" 
                        data-content="Anda dapat upload gambar maupun file yang dapat membantu kami memahami design pakaian pesanan anda. (Upload File/gambar hanya bisa dilakukan pada tahap konsultasi).">
                            <i class="fa fa-info-circle text-info"></i>
                    </a>
                    </h4>
                    <div class="row row-cols-1 row-cols-md-3 mb-3 pb-3 g-4 bg-light" >
                        
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
                                        <a type="button" class="btn btn-danger mr-1 mb-2" href="/admin/katalog/img/del/{{$katalog->id}}/img_depan">Delete</a>
                                        @endif
                                            <div class="custom-file col-12">
                                                <form method="post" action="{{route('addimgkatalog')}}" enctype='multipart/form-data'>
                                                @csrf
                                                <input type="hidden" name="id" value="{{$katalog->id}}">
                                                <input type="hidden" name="jenis" value="dep">
                                                <label class="custom-file-label " for="file-upload">Choose file</label>
                                                <input type="file" class="form-control-file" name="img" id="file-upload">
                                            </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-Primary mt-1" type="submit">Simpan</button>
                                                </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                
                                        @if($katalog->img_belakang!=null)
                                        <img src="/storage/katalog/{{$katalog->img_belakang}}" class="card-img-top" onError="this.onerror=null;this.src='/img/file.png';">
                                        @else
                                        belum ada
                                        @endif
                                
                                    <div class="card-body">
                                        Tampak Belakang
                                        <div class="row col-12">
                                        @if($katalog->img_belakang!=null)
                                        <a type="button" class="btn btn-primary mr-1 mb-2" target="_blank" href="{{url('/')}}/storage/katalog/{{$katalog->img_belakang}}">Lihat File</a>
                                        <a type="button" class="btn btn-danger mr-1 mb-2" href="/admin/katalog/img/del/{{$katalog->id}}/img_belakang">Delete</a>
                                        @endif
                                            <div class="custom-file col-12">
                                                <form method="post" action="{{route('addimgkatalog')}}" enctype='multipart/form-data'>
                                                @csrf
                                                <input type="hidden" name="id" value="{{$katalog->id}}">
                                                <input type="hidden" name="jenis" value="bel">
                                                <label class="custom-file-label " for="file-upload1">Choose file</label>
                                                <input type="file" class="form-control-file" name="img" id="file-upload1">
                                            </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-Primary mt-1" type="submit">Simpan</button>
                                                </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">

                                        @if($katalog->img_dll1!=null)
                                        <img src="/storage/katalog/{{$katalog->img_dll1}}" class="card-img-top" onError="this.onerror=null;this.src='/img/file.png';">
                                        @else
                                        belum ada
                                        @endif
                                    <div class="card-body">
                                        Detail Lainnya
                                        <div class="row col-12">
                                        @if($katalog->img_dll1!=null)
                                        <a type="button" class="btn btn-primary mr-1 mb-2" target="_blank" href="{{url('/')}}/storage/katalog/{{$katalog->img_dll1}}">Lihat File</a>
                                        <a type="button" class="btn btn-danger mr-1 mb-2" href="/admin/katalog/img/del/{{$katalog->id}}/img_dll1">Delete</a>
                                        @endif
                                            <div class="custom-file col-12">
                                                <form method="post" action="{{route('addimgkatalog')}}" enctype='multipart/form-data'>
                                                @csrf
                                                <input type="hidden" name="id" value="{{$katalog->id}}">
                                                <input type="hidden" name="jenis" value="dll1">
                                                <label class="custom-file-label " for="file-upload2">Choose file</label>
                                                <input type="file" class="form-control-file" name="img" id="file-upload2">
                                            </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-Primary mt-1" type="submit">Simpan</button>
                                                </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                
                                        @if($katalog->img_dll2!=null)
                                        <img src="/storage/katalog/{{$katalog->img_dll2}}" class="card-img-top" onError="this.onerror=null;this.src='/img/file.png';">
                                        @else
                                        belum ada
                                        @endif
                                
                                    <div class="card-body">
                                        Detail Lainnya
                                        <div class="row col-12">
                                        @if($katalog->img_dll2!=null)
                                        <a type="button" class="btn btn-primary mr-1 mb-2" target="_blank" href="{{url('/')}}/storage/katalog/{{$katalog->img_dll2}}">Lihat File</a>
                                        <a type="button" class="btn btn-danger mr-1 mb-2" href="/admin/katalog/img/del/{{$katalog->id}}/img_dll2">Delete</a>
                                        @endif
                                            <div class="custom-file col-12">
                                                <form method="post" action="{{route('addimgkatalog')}}" enctype='multipart/form-data'>
                                                @csrf
                                                <input type="hidden" name="id" value="{{$katalog->id}}">
                                                <input type="hidden" name="jenis" value="dll2">
                                                <label class="custom-file-label " for="file-upload3">Choose file</label>
                                                <input type="file" class="form-control-file" name="img" id="file-upload3">
                                            </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-Primary mt-1" type="submit">Simpan</button>
                                                </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
