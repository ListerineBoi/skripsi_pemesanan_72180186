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
                        <p>
                        <button class="btn btn-secondary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#filtercollapse" aria-expanded="false" aria-controls="collapseExample">
                            Filter
                        </button>
                    </p>
                    <div class="collapse" id="filtercollapse">
                        <div class="card card-body">
                               <form action="{{route('viewlistbayar')}}" method="get">
                                <div class="form-row align-items-center">
                                        <div class="col-sm-3 my-1">
                                            <label for="validationCustom01">Diurutkan Dari</label>
                                            <select class="custom-select" name='sort'>
                                                <option value="created_at" @if($request->sort=='created_at') selected @endif>Tanggal Input</option>
                                                <option value="status" @if($request->sort=='status') selected @endif>Status</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3 my-1">
                                            <label for="validationCustom01" >Ascending/descending</label>
                                            <select class="custom-select" name='ascdesc'>
                                                <option value="asc" @if($request->ascdesc=='asc') selected @endif>Ascending</option>
                                                <option value="desc" @if($request->ascdesc=='desc') selected @endif>Descending</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3 my-1">
                                            <label for="validationCustom01">Kategori</label>
                                            <select class="custom-select" name='Kategori'>
                                            <option value="All" @if($request->Kategori=='All') selected @endif>All</option>
                                                <option value="0" @if($request->Kategori=='Sampling') selected @endif>Sampling</option>
                                                <option value="1" @if($request->Kategori=='Produksi') selected @endif>Produksi</option>
                                            </select>
                                        </div>
                                        <div class="col-auto mt-4">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>  
                               </form>
                        </div>
                    </div>
                <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">No Nota</th>
                                        <th scope="col">Nama Pesanan</th>
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
                                        <td>{{DB::table('detail_pakaian')->where('id', $row->jasa->detail_id)->value('nama_atasan')}} - {{DB::table('detail_pakaian')->where('id', $row->jasa->detail_id)->value('nama_bawahan')}}</td>
                                        <td>{{DB::table('detail_invoice')->where('bayar_id', $row->id)->sum('total')-$row->terbayar}}</td>
                                        <td>@if($row->status==0) Belum Lunas @elseif($row->status==1) Menunggu @elseif($row->status==2) Lunas  @elseif($row->status==3) Deposit @endif</td>
                                        <td>
                                            @if($row->file_invoice !=null)
                                            <a href="{{url('/')}}/storage/invoice/{{$row->file_invoice}}" target="_blank" class="btn btn-primary">lihat invoice</a>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalnota{{$loop->iteration}}">
                                            Nota Terbayar
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-secondary" disabled="disabled">Belum Ada Invoice</button> 
                                            @endif
                                            <div class="modal fade" id="modalnota{{$loop->iteration}}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">History Bayar</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="single-table">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover text-center">
                                                                    <thead class="text-uppercase">
                                                                        <tr>
                                                                            <th scope="col">ID</th>
                                                                            <th scope="col">Jenis Pembayaran</th>
                                                                            <th scope="col">Bukti Bayar</th>
                                                                            <th scope="col">Nota</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($row->nota as $nota)
                                                                        <tr>
                                                                            <th scope="row">{{$nota->id}}</th>
                                                                            <td>
                                                                                @if($nota->jenis_pembayaran==1)
                                                                                Deposit
                                                                                @else
                                                                                Full
                                                                                @endif
                                                                            </td>
                                                                            <td><a href="{{url('/')}}/storage/buktibayar/{{$nota->img_bukti}}" target="_blank" class="btn btn-primary">{{$nota->img_bukti}}</a></td>
                                                                            @if($nota->file_nota!=null)
                                                                            <td><a href="{{url('/')}}/storage/nota/{{$nota->file_nota}}" target="_blank" class="btn btn-primary">{{$nota->file_nota}}</a></td>
                                                                            @else
                                                                            <td>Menunggu Verifikasi Admin.</td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    
                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                        Input Bukti Bayar
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
