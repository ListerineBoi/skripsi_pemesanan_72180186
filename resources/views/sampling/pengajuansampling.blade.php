@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
                            <h4 class="header-title">Form Pengajuan Sampling</h4>
                            <p class="text-muted font-14 mb-4"></p>
                            <div class="form-group">
                                <label class="col-form-label">Slot</label>
                                <select class="custom-select" name="slot_id">
                                    @foreach($slot as $row)
                                        <option value="{{$row->id}}">{{$row->mulai}} sampai {{$row->selesai}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Model</label>
                                <select class="custom-select" name="model">
                                    <option selected value="0">rok</option>
                                    <option selected value="1">dress</option>
                                    <option selected value="2">top</option>
                                </select>
                            </div>
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Deskripsi</span>
                                </div>
                                <textarea class="form-control" aria-label="With textarea" name="desc"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="example-number-input" class="col-form-label">Jumlah Sampling</label>
                                <input class="form-control" type="number" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="jml" placeholder="">
                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Badan</label>
                                    <input class="form-control" type="text" value="" name="ling_b" placeholder="Angka dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggang</label>
                                    <input class="form-control" type="text" value="" name="ling_pgang">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggul</label>
                                    <input class="form-control" type="text" value="" name="ling_pingl">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar leher</label>
                                    <input class="form-control" type="text" value="" name="ling_lh">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Bahu</label>
                                    <input class="form-control" type="text" value="" name="leb_bahu">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Lengan</label>
                                    <input class="form-control" type="text" value="" name="pj_lengan">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Kerung Lengan</label>
                                    <input class="form-control" type="text" value="" name="ling_kr_leng">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Lengan</label>
                                    <input class="form-control" type="text" value="" name="ling_lengan">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pergelangan</label>
                                    <input class="form-control" type="text" value="" name="ling_pergel">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Muka</label>
                                    <input class="form-control" type="text" value="" name="leb_muka">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Punggung</label>
                                    <input class="form-control" type="text" value="" name="leb_pungg">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Punggung</label>
                                    <input class="form-control" type="text" value="" name="panj_pungg">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Baju</label>
                                    <input class="form-control" type="text" value="" name="panj_baju">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Tinggi pinggul</label>
                                    <input class="form-control" type="text" value="" name="tinggi_pingl">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggang</label>
                                    <input class="form-control" type="text" value="" name="ling_pinggang">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pesak</label>
                                    <input class="form-control" type="text" value="" name="ling_pesak">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Paha</label>
                                    <input class="form-control" type="text" value="" name="ling_paha">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Lutut</label>
                                    <input class="form-control" type="text" value="" name="ling_lutut">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Kaki</label>
                                    <input class="form-control" type="text" value="" name="ling_kaki">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Celana</label>
                                    <input class="form-control" type="text" value="" name="panj_cln_rok">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Tinggi Duduk</label>
                                    <input class="form-control" type="text" value="" name="tingg_dudk">
                                </div>
                                <div class="form-group col-sm-6">
                                <label class="control-label" for="ftktp">Upload Image *</label>
                                <div class="col-sm-10">
                                <input type="file" class="form-control-file" name="img_model">
                                </div>
                            </div>
                            
                            
                            <button type="submit" class="btn btn-danger" class="text-right" style="float: right;">Save</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Sampling Aktif</h4>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach($sampling as $row)
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 card-bordered">
                                <img src="/storage/imgsampling/{{DB::table('detail_pakaian')->where('id', $row->detail_id)->value('img')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="title">{{DB::table('slot_s')->where('id', $row->slot_id)->value('mulai')}} s/d {{DB::table('slot_s')->where('id', $row->slot_id)->value('selesai')}} 
                                        @if($row->status == 0)
                                        <a href="#" class="badge badge-secondary">Pending</a>
                                        @elseif($row->status == 1)
                                        <a href="#" class="badge badge-warning">Waiting list</a>
                                        @elseif($row->status == 2)
                                        <a href="#" class="badge badge-info">Cutting</a>
                                        @elseif($row->status == 3)
                                        <a href="#" class="badge badge-primary">Sewing</a>
                                        @elseif($row->status == 4)
                                        <a href="#" class="badge badge-info">Finishing & QC</a>
                                        @endif
                                    </h5>
                                    <h5 class="card-title">@if(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('model')==0) rok @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('model')==1) dress @else Top @endif</h5>
                                    <p class="card-text">{{DB::table('detail_pakaian')->where('id', $row->detail_id)->value('desc')}}</p>
                                    <a href="{{route('vieweditsampling',['id' => $row->id])}}" class="btn btn-primary">Detail</a>
                                    <a type="button" class="btn btn-danger" href="{{route('delS',['id' => $row->id])}}">Delete</a>
                                </div>
                                </div>
                            </div> 
                            @endforeach
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Sampling Selesai</h4>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach($samplingS as $row)
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 card-bordered">
                                <img src="/storage/imgsampling/{{DB::table('detail_pakaian')->where('id', $row->detail_id)->value('img')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="title">{{DB::table('slot_s')->where('id', $row->slot_id)->value('mulai')}} s/d {{DB::table('slot_s')->where('id', $row->slot_id)->value('selesai')}} 
                                        <a href="#" class="badge badge-success">Selesai</a>
                                    </h5>
                                    <h5 class="card-title">@if(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('model')==0) rok @elseif(DB::table('detail_pakaian')->where('id', $row->detail_id)->value('model')==1) dress @else Top @endif</h5>
                                    <p class="card-text">{{$row->desc}}</p>
                                    <a href="{{route('revisisampling',['id' => $row->id])}}" class="btn btn-primary">Ajukan Revisi</a>
                                    <a type="button" class="btn btn-danger" href="{{route('delS',['id' => $row->id])}}">Delete</a>
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
