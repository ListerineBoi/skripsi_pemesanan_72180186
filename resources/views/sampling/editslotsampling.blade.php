@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">Edit Set Slot</div>

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
                    <form method="post" action="{{route('saveeditslot')}}" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="id" value="{{$slot->id}}">
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="nik">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" value="{{$slot->title}}">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="control-label col-sm-2" for="nik">Tanggal Slot Ditutup</label>
                        <div class="col-sm-2 ">
                            <input type="date" class="form-control" name="selesai" value="{{$slot->selesai}}">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="control-label col-sm-2" for="nik">Mulai Pembuatan</label>
                        <div class="col-sm-2 ">
                            <input type="date" class="form-control" name="mulai" value="{{$slot->mulai}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="nik">Kuota Max Pesanan</label>
                        <div class="col-sm-2 ">
                            <input type="number" min='1' max='100' class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="kuota" value="{{$slot->kuota}}">
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name='status' id="flexSwitchCheckChecked" @if($slot->status==1) checked @endif>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Aktif/Non-Aktif</label>
                    </div>
                    <button type="submit" class="btn btn-danger" class="text-right" style="float: right;">Save</button>
            </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
