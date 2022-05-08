@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Form Set Slot</div>

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
                    <form method="post" action="{{route('saveslot')}}" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" class="form-control" name="jenis" value="1">
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="nik">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="control-label col-sm-2" for="nik">Tanggal Slot Ditutup</label>
                        <div class="col-sm-2 ">
                            <input type="date" class="form-control" name="selesai" placeholder="">
                        </div>
                    </div>		
                    <div class="form-group row mt-2">
                        <label class="control-label col-sm-2" for="nik">Mulai Pembuatan</label>
                        <div class="col-sm-2 ">
                            <input type="date" class="form-control" name="mulai" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="control-label col-sm-2" for="nik">Kuota Max Pesanan</label>
                        <div class="col-sm-2 ">
                            <input type="number" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57" name="kuota" placeholder="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger" class="text-right" style="float: right;">Save</button>
            </form>
                </div>
            </div>
            
        </div>
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">Slot</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Title</th>
                            <th class="text-center">Tanggal Slot Ditutup</th>
                            <th class="text-center">Tanggal Mulai Pembuatan</th>
                            <th class="text-center">Jumlah Customer</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($slot as $row)
                        <tr>
                            <td class="text-center">{{$row->title}}</td>
                            <td class="text-center">{{$row->selesai}}</td>
                            <td class="text-center">{{$row->mulai}}</td>
                            <td class="text-center">{{$row->jml}} / {{$row->kuota}}</td>
                            <td class="text-center"> @if($row->status==1) Aktif @else Non-Aktif @endif</td>
                            <td class="text-center">
                                <a type="button" class="btn btn-success" href="{{route('vieweditslot',['id' => $row->id])}}">Edit</a>
                                <a type="button" class="btn btn-danger" href="{{route('delslot',['id' => $row->id])}}">Delete</a>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
