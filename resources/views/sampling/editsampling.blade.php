@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-12 mt-5">
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
                                            @if($sampling->status==0)
                                                <a type="button" class="btn btn-danger" href="">Delete</a>
                                            @endif
                                            </div>
                                        </div>
                                    </div> 
                                @endforeach
                            </div>
                            <div class="input-group mb-3">
                            @if($sampling->status==0)
                                <div class="row col-12">
                                    <h4 class="header-title">Upload File/Gambar Design</h4>
                                </div>
                                
                                <div class="row col-12">
                                    <div class="custom-file col-6">
                                        <form method="post" action="{{route('uploadimg')}}" enctype='multipart/form-data'>
                                        @csrf
                                        <input type="hidden" name="detail_id" value="{{$sampling->detail_id}}">
                                        <label class="custom-file-label " for="file-upload">Choose file</label>
                                        <input type="file" class="form-control-file" name="file_img" id="file-upload">
                                    </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-Primary" type="submit">Simpan</button>
                                        </div>
                                    </div>
                            </div>
                            </form>
                            @endif

                                
                    </div>
                </div>
            </div>
    <!-- /////////////////// -->
    <div class="col-12 mt-5">
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
                        <form id="target" method="post" action="{{route('saveeditS')}}" enctype='multipart/form-data'>
                            @csrf
                            <input type="hidden" name="id" value="{{$sampling->id}}">
                            <h4 class="header-title">Detail Pesanan
                            <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Detail Pesanan" 
                                data-content="Detail pesanan hanya dapat diedit ketika dalam tahap konsultasi,
                                 setelah terjadi kesepakatan antara pihak kami dan customer dan masuk tahap selanjutnya maka detail pakaian tidak dapat lagi diedit.">
                                    <i class="fa fa-info-circle text-info"></i>
                            </a>
                            </h4>
                            
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Slot</label>
                                        <select class="custom-select" name="slot_id" disabled>
                                            <option value="{{$sampling->slot_id}}">{{DB::table('slot_s')->where('id', $sampling->slot_id)->value('mulai')}} sampai {{DB::table('slot_s')->where('id', $sampling->slot_id)->value('selesai')}}</option>
                                        </select>
                                    </div>
                            <div class="form-group">
                            
                                <label class="col-form-label">Jenis</label> 
                                <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Jenis" 
                                data-content="pilihan jenis pemesanan baju, pilih sesuai kebutuhan pemesanan">
                                    <i class="fa fa-info-circle text-info"></i>
                                </a>
                                <select class="custom-select" name="jenis" id=disparent1>
                                    <option value="0" @if(DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('jenis')==0) selected @endif>Atasan + Bawahan</option>
                                    <option value="1" @if(DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('jenis')==1) selected @endif>Atasan</option>
                                    <option value="2" @if(DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('jenis')==2) selected @endif>Bawahan</option>
                                    <option value="3" @if(DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('jenis')==3) selected @endif>Dress</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Nama Pakaian</label>
                                <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Nama Pakaian" 
                                data-content="Contoh:dress, top, shirt dll">
                                    <i class="fa fa-info-circle text-info"></i>
                                </a>
                                <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('nama_atasan')}}" id="dischild" name="nama_atasan">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Nama Pakaian Bawahan</label>
                                <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Nama Pakaian" 
                                data-content="Contoh:rok, celana panjang, dll">
                                    <i class="fa fa-info-circle text-info"></i>
                                </a>
                                <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('nama_bawahan')}}" id="dischild2" name="nama_bawahan">
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
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_b')}}" name="ling_b" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggang</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_pgang')}}" name="ling_pgang" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggul</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_pingl')}}" name="ling_pingl" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar leher</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_lh')}}" name="ling_lh" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Bahu</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('leb_bahu')}}" name="leb_bahu" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Lengan</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('pj_lengan')}}" name="pj_lengan" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Kerung Lengan</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_kr_leng')}}" name="ling_kr_leng" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Lengan</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_lengan')}}" name="ling_lengan" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pergelangan</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_pergel')}}" name="ling_pergel" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Muka</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('leb_muka')}}" name="leb_muka" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Punggung</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('leb_pungg')}}" name="leb_pungg" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Punggung</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('panj_pungg')}}" name="panj_pungg" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Baju</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('panj_baju')}}" name="panj_baju" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Tinggi pinggul</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('tinggi_pingl')}}" name="tinggi_pingl" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggang celana rok</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_pinggang')}}" name="ling_pinggang" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pesak</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_pesak')}}" name="ling_pesak" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Paha</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_paha')}}" name="ling_paha" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Lutut</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_lutut')}}" name="ling_lutut" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Kaki</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_kaki')}}" name="ling_kaki" placeholder="Ukuran Dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Celana</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('panj_cln_rok')}}" name="panj_cln_rok" placeholder="Ukuran Dalam Cm">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Tinggi Duduk</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('tingg_dudk')}}" name="tingg_dudk" placeholder="Ukuran Dalam Cm">
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
                                    <textarea class="form-control" aria-label="With textarea" name="desc">{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('desc')}}</textarea>
                                </div>
                            </div>
                            @if($sampling->status==0)
                            <button type="submit" class="btn btn-success" class="text-right" style="float: right;">Simpan</button>
                            @endif
                        </form>
                    </div>
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
