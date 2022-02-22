@extends('layouts.appadmin')

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
                        <form method="post" action="{{route('adminsaveeditS')}}" enctype='multipart/form-data'>
                        @csrf
                            <input type="hidden" name="id" value="{{$sampling->id}}">
                            <h4 class="header-title">Textual inputs</h4>
                            <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                            <div class="row mb-3">
                            <div class="col-md-4 col-sm-4">
                                <img src="/storage/imgsampling/{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('img')}}" height='350' class="card-img-top" alt="...">
                            </div>
                                <div class="col-md-8 col-sm-8">
                                    <div class="form-group">
                                        <label class="col-form-label">Slot</label>
                                        <select class="custom-select" name="slot_id" disabled>
                                            <option value="{{$sampling->slot_id}}">{{DB::table('slot_s')->where('id', $sampling->slot_id)->value('mulai')}} sampai {{DB::table('slot_s')->where('id', $sampling->slot_id)->value('selesai')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Model</label>
                                        <select class="custom-select" name="model">
                                            <option selected value="0">rok</option @if(DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('model')==0) selected @endif>
                                            <option selected value="1">dress</option @if(DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('model')==1) selected @endif>
                                            <option selected value="2">top</option @if(DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('model')==2) selected @endif>
                                        </select>
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Deskripsi</span>
                                        </div>
                                        <textarea class="form-control" aria-label="With textarea" name="desc">{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('desc')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-number-input" class="col-form-label">Jumlah Sampling</label>
                                        <input class="form-control" type="number" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="jml" value="{{$sampling->jml}}">
                                    </div>
                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Badan</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_b')}}" name="ling_b" placeholder="Angka dalam Cm">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggang</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_pgang')}}" name="ling_pgang">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggul</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_pingl')}}" name="ling_pingl">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar leher</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_lh')}}" name="ling_lh">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Bahu</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('leb_bahu')}}" name="leb_bahu">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Lengan</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('pj_lengan')}}" name="pj_lengan">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Kerung Lengan</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_kr_leng')}}" name="ling_kr_leng">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Lengan</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_lengan')}}" name="ling_lengan">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pergelangan</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_pergel')}}" name="ling_pergel">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Muka</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('leb_muka')}}" name="leb_muka">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lebar Punggung</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('leb_pungg')}}" name="leb_pungg">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Punggung</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('panj_pungg')}}" name="panj_pungg">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Baju</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('panj_baju')}}" name="panj_baju">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Tinggi pinggul</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('tinggi_pingl')}}" name="tinggi_pingl">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pinggang</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_pinggang')}}" name="ling_pinggang">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Pesak</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_pesak')}}" name="ling_pesak">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Paha</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_paha')}}" name="ling_paha">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Lutut</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_lutut')}}" name="ling_lutut">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Lingkar Kaki</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('ling_kaki')}}" name="ling_kaki">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Panjang Celana</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('panj_cln_rok')}}" name="panj_cln_rok">
                                </div>

                            </div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-6">
                                    <label for="example-text-input" class="col-form-label">Tinggi Duduk</label>
                                    <input class="form-control" type="text" value="{{DB::table('detail_pakaian')->where('id', $sampling->detail_id)->value('tingg_dudk')}}" name="tingg_dudk">
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
            
        
        
        
            
        </div>
    </div>
</div>
@endsection
