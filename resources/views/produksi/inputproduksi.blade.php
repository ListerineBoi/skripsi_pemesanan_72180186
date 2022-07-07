@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('viewproduksi')}}">Produksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Produksi</li>
            </ol>
            </nav>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-12">
                <div class="card-body">
                    <h3 class="card-title">Detail Yang Dipakai</h3>
                    <h6>
                        @if($detail->jenis==0)
                            <h5 > {{$detail->nama_atasan}} + {{$detail->nama_bawahan}} </h5>
                        @elseif($detail->jenis==1)
                            <h5 > {{$detail->nama_atasan}} </h5>
                        @elseif($detail->jenis==2)
                            <h5 > {{$detail->nama_bawahan}} </h5>
                        @elseif($detail->jenis==3)
                            <h5 > {{$detail->nama_atasan}} </h5>
                        @endif
                    </h6>
                    <div id="accordion2" class="according accordion-s2 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#accordion21">Detail Ukuran</a>
                            </div>
                            <div id="accordion21" class="collapse" data-parent="#accordion2">
                                <div class="card-body">
                                    
                                <table class="table table-bordered text-center">
                                    <tbody>
                                            <tr>
                                                <th scope="row">Lingkar Badan</th>
                                                <td>{{$detail->ling_b}} Cm</td>
                                                <th scope="row">Lingkar Pinggang</th>
                                                <td>{{$detail->ling_pgang}} Cm</td>
                                                <th scope="row">Lingkar Pinggul</th>
                                                <td>{{$detail->ling_pingl}} Cm</td>
                                                <th scope="row">Lingkar Leher</th>
                                                <td>{{$detail->ling_lh}} Cm</td>
                                            </tr>
                                        
                                            <tr>
                                                <th scope="row">Lebar Bahu</th>
                                                <td>{{$detail->leb_bahu}} Cm</td>
                                                <th scope="row">Panjang Lengan</th>
                                                <td>{{$detail->pj_lengan}} Cm</td>
                                                <th scope="row">Lingkar Kerung Lengan</th>
                                                <td>{{$detail->ling_kr_leng}} Cm</td>
                                                <th scope="row">Lingkar Lengan</th>
                                                <td>{{$detail->ling_lengan}} Cm</td>
                                            </tr>
                                            
                                            <tr>
                                                <th scope="row">Lingkar Pergel</th>
                                                <td>{{$detail->ling_pergel}} Cm</td>
                                                <th scope="row">Lebar Muka</th>
                                                <td>{{$detail->leb_muka}} Cm</td>
                                                <th scope="row">Lebar Punggung</th>
                                                <td>{{$detail->leb_pungg}} Cm</td>
                                                <th scope="row">Panjang Punggung</th>
                                                <td>{{$detail->panj_pungg}} Cm</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Panjang Baju</th>
                                                <td>{{$detail->panj_baju}} Cm</td>
                                                <th scope="row">Tinggi Pinggul</th>
                                                <td>{{$detail->tinggi_pingl}} Cm</td>
                                                <th scope="row">Lingkar Paha</th>
                                                <td>{{$detail->ling_paha}} Cm</td>
                                                <th scope="row">Lingkar Lutut</th>
                                                <td>{{$detail->ling_lutut}} Cm</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Lingkar Kaki</th>
                                                <td>{{$detail->ling_kaki}} Cm</td>
                                                <th scope="row">Panjang Celana/Rok</th>
                                                <td>{{$detail->panj_cln_rok}} Cm</td>
                                            </tr>
                                    </tbody>
                                </table>



                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="card-text mt-5 mb-2">Deskripsi</h6>
                    <p class="card-text text-dark">{{$detail->desc}}</p>
                    
                    @if($detail->public==1)
                    <h4 class="header-title">File/Gambar Design
                    <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="File/Gambar Design" 
                        data-content="Anda dapat upload gambar maupun file yang dapat membantu kami memahami design pakaian pesanan anda. (Upload File/gambar hanya bisa dilakukan pada tahap konsultasi).">
                            <i class="fa fa-info-circle text-info"></i>
                    </a>
                    </h4>
                    <div class="row row-cols-1 row-cols-md-3 mb-3 pb-3 g-4 bg-light" >
                        @foreach($fileimg as $row)
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                
                                        <img src="/storage/imgdetail/{{$row->img}}" class="card-img-top" alt="...">
                                
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div> 
                        @endforeach
                    </div>
                    <div class="alert alert-info" role="alert">
                        <strong>Perhatian!</strong> Detail & file pakaian diatas masih bisa dirubah pada laman produksi setelah mengajukan pemesanan produksi ini.
                    </div>
                    @else
                    
                    @endif
                </div>
                </div>
            </div>
        </div>
        <div class="card">
                <div class="card-header">Form Pengajuan Produksi</div>

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
                                {{\Session::get('success')}}
                            </div>
                        @endif

                        @if(\Session::has('Forbidden'))
                            <div class="alert alert-danger">
                                {{\Session::get('Forbidden')}}
                            </div>
                        @endif
                    <form method="post" action="{{route('saveinputprod')}}" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" class="form-control" name="detail_id" value="{{$detail->id}}">
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="nik">Slot</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="slot_id">
                            @foreach($slot as $row)
                                <option value="{{$row->id}}">{{$row->title}}, Pembuatan Dimulai {{$row->mulai}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="control-label col-sm-2" for="nik">Jumlah Produksi</label>
                        <div class="col-sm-10">
                            <input type="number" min="12" max="20000" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" name="jml" placeholder="">
                        </div>
                    </div>
                    @if($detail->public==0)
                    <div class="row col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Permintaan <br>
                                        <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Deskripsi Lebih Lanjut" 
                                        data-content="Berisi warna atau permintaan lainya dari katalog.">
                                            <i class="fa fa-info-circle text-info"></i>
                                        </a>
                                    </span>
                                    
                                </div>
                                <textarea class="form-control" aria-label="With textarea" name="permintn"></textarea>
                            </div>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-danger mt-2" class="text-right" style="float: right;">Save</button>
            </form>
                </div>
                
            </div>
            
        </div>
        </div>
    </div>
</div>
@endsection
