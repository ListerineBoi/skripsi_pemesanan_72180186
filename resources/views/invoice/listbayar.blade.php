@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">List Tagihan</div>

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
                                        <th scope="col">No Nota</th>
                                        <th scope="col">Jenis Pesanan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Invoice/Nota</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pemba as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>@if($row->prod_id == null)
                                            Sampling
                                            @elseif($row->samp_id == null)
                                            Produksi
                                            @endif
                                        </td>
                                        <td>{{DB::table('detail_invoice')->where('bayar_id', $row->id)->sum('total')}}</td>
                                        <td>@if($row->status==0) Belum Lunas @elseif($row->status==1) Menunggu @elseif($row->status==2) Lunas  @elseif($row->status==3) Deposit @endif</td>
                                        <td>
                                            @if($row->file_invoice !=null)
                                            <a href="/storage/invoice/{{$row->file_invoice}}" class="btn btn-primary">lihat invoice</a>
                                            @else
                                            <button type="button" class="btn btn-secondary" disabled="disabled">Belum Ada Invoice</button> 
                                            @endif
                                            
                                        </td>
                                        <td>
                                            @if($row->status!=2)
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong{{$loop->iteration}}">
                                            Upload Bukti Bayar
                                            </button>
                                            @endif
                                            <div class="modal fade" id="exampleModalLong{{$loop->iteration}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Ubah Status Sampling
                                                    <form method="post" action="{{route('inputbuktibyr')}}" enctype='multipart/form-data'>
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$row->id}}">
                                                    <input type="hidden" name="jns" value="{{$row->jenis_jasa}}">
                                                    <select class="custom-select" name="jenis_pembayaran">
                                                        <option value="1">Transfer Bank</option>
                                                        <option value="2">Lainnya</option>
                                                        <option value="3">Cash</option>
                                                    </select>
                                                    <div class="col-sm-10 mt-2">
                                                    <input type="file" class="form-control-file" name="img_bukti">
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Kirim</button>
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
