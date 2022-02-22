@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">List Sampling</div>

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
                <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Tanggal Slot</th>
                                        <th scope="col">Model</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">status</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($produksi as $row)
                                    <tr>
                                        <th>{{DB::table('users')->where('id', $row->cus_id)->value('name')}}</th>
                                        <td>{{DB::table('slot_p')->where('id', $row->slot_id)->value('mulai')}} <br> s/d {{DB::table('slot_p')->where('id', $row->slot_id)->value('selesai')}}</td>
                                        <td>@if($row->model == 0)
                                            rok
                                            @elseif($row->model == 1)
                                            dress
                                            @elseif($row->model == 2)
                                            Top
                                            @endif
                                        </td>
                                        <td>{{$row->jml}}</td>
                                        <td>
                                            @if($row->status == 0)
                                            <span class="status-p bg-secondary mb-2">pending</span>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 2%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @elseif($row->status == 1)
                                            <span class="status-p bg-warning mb-2">Waiting list</span>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @elseif($row->status == 2)
                                            <span class="status-p bg-info mb-2">Proses</span>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @elseif($row->status == 3)
                                            <span class="status-p bg-primary mb-2">Finishing</span>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @elseif($row->status == 4)
                                            <span class="status-p bg-success mb-2">Selesai</span>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            @endif
                                            
                                        </td>
                                        <td>
                                        <a href="{{route('admineditproduksi',['id' => $row->id])}}" class="btn btn-primary mb-2">Detail</a>
                                        <a type="button" class="btn btn-danger mb-2" href="{{route('admindelS',['id' => $row->id])}}">Delete</a>
                                        <br>
                                        <a href="{{route('lihatinvoicesampling',['id' => $row->id,'jns' => '1'])}}" class="btn btn-primary">Invoice</a>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong{{$loop->iteration}}">
                                                Set Status
                                            </button>
                                            <div class="modal fade" id="exampleModalLong{{$loop->iteration}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Ubah Status Sampling
                                                <form method="post" action="{{route('statusprod')}}" enctype='multipart/form-data'>
                                                @csrf
                                                <input type="hidden" name="id" value="{{$row->id}}">
                                                <select class="custom-select" name="status">
                                                    <option value="1">Waiting list</option>
                                                    <option value="2">Proses</option>
                                                    <option value="3">Finishing</option>
                                                    <option value="4">Selesai</option>
                                                </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
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
    </div>
</div>
@endsection
