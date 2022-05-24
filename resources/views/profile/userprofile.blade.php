@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mt-3">
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
                        <form method="post" action="{{route('saveprofile')}}" enctype='multipart/form-data'>
                            @csrf
                            <h4 class="header-title">User Detail</h4>
                            <p class="text-muted font-14 mb-4"></p>
                            
                            <div class="form-group">
                                <label class="col-form-label">Nama</label>
                                
                                <input class="form-control" type="text" value="{{Auth::user()->name}}" name="name">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Alamat</label>
                                
                                <input class="form-control" type="text" value="{{Auth::user()->alamat}}" name="alamat">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                
                                <input class="form-control" type="text" value="{{Auth::user()->email}}" name="email">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">No telp</label>
                                
                                <input class="form-control" type="text" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{Auth::user()->no_telp}}" name="no_telp">
                            </div>
                
                            
                            <button type="submit" class="btn btn-success" class="text-right" style="float: right;">Ubah</button>
                        </form>
                    </div>  
                </div>
            </div>
        </div>       
    </div>
@endsection
