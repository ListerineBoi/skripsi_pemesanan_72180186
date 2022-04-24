@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">List Tagihan Sampling</div>

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
                                        <th scope="col">Nama Pesanan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Invoice/Nota</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pemba_samp as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{DB::table('detail_pakaian')->where('id', $row->sampling->detail_id)->value('nama_atasan')}} - {{DB::table('detail_pakaian')->where('id', $row->sampling->detail_id)->value('nama_bawahan')}}</td>
                                        <td>{{DB::table('detail_invoice')->where('bayar_id', $row->id)->sum('total')-$row->terbayar}}</td>
                                        <td>@if($row->status==0) Belum Lunas @elseif($row->status==1) Menunggu @elseif($row->status==2) Lunas  @elseif($row->status==3) Deposit @endif</td>
                                        <td>
                                            @if($row->file_invoice !=null)
                                            <a href="/storage/invoice/{{$row->file_invoice}}" class="btn btn-primary">lihat invoice</a>
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
                                                        <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                            <td><a href="/storage/buktibayar/{{$nota->img_bukti}}" class="btn btn-primary">{{$nota->img_bukti}}</a></td>
                                                                            @if($nota->file_nota!=null)
                                                                            <td><a href="/storage/nota/{{$nota->file_nota}}" class="btn btn-primary">{{$nota->file_nota}}</a></td>
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

        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">List Tagihan Produksi</div>

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
                                @foreach($pemba_prod as $row)
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
                                                        <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="single-table">
                                                            <div class="table-responsive">
                                                                <table class="table table-hover text-center">
                                                                    <thead class="text-uppercase">
                                                                        <tr>
                                                                            <th scope="col">ID</th>
                                                                            <th scope="col">Name</th>
                                                                            <th scope="col">date</th>
                                                                            <th scope="col">price</th>
                                                                            <th scope="col">action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">1</th>
                                                                            <td>Mark</td>
                                                                            <td>09 / 07 / 2018</td>
                                                                            <td>$120</td>
                                                                            <td><i class="ti-trash"></i></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">1</th>
                                                                            <td>jone</td>
                                                                            <td>09 / 07 / 2018</td>
                                                                            <td>$150</td>
                                                                            <td><i class="ti-trash"></i></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">1</th>
                                                                            <td>Mark</td>
                                                                            <td>09 / 07 / 2018</td>
                                                                            <td>$120</td>
                                                                            <td><i class="ti-trash"></i></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">1</th>
                                                                            <td>jone</td>
                                                                            <td>09 / 07 / 2018</td>
                                                                            <td>$150</td>
                                                                            <td><i class="ti-trash"></i></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
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
