@extends('layouts.appadmin')

@section('content')
    <div class="row">
    <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                <h4 class="header-title">Daftar Invoice</h4>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">No Nota</th>
                                        <th scope="col">Bukti Bayar</th>
                                        <th scope="col">Jenis Pembayaran</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pemb as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>
                                        @if($row->nota !=null)
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalnota{{$loop->iteration}}">
                                            Lihat Bukti Bayar
                                        </button>
                                        <div class="modal fade" id="modalnota{{$loop->iteration}}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">List bukti bayar</h5>
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
                                        @else
                                        <p>Belum Ada</p>
                                        @endif
                                        </td>
                                        <td>{{$row->jenis_pembayaran}}</td>
                                        
                                        <td>@if($row->status==0) Belum Lunas @elseif($row->status==1) Menunggu @elseif($row->status==2) Lunas @elseif($row->status==3) Deposit @endif</td>
                                        <td>
                                                @if(count($row->nota)!=0)
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong{{$loop->iteration}}">
                                                Verifikasi Bukti Bayar
                                                </button>
                                                @endif
                                                <a href="{{route('lihatdetailinvoice',['id' => $row->id,'jns' => $jns])}}" class="btn btn-primary" disabled>Detail</a>
                                            

                                            <div class="modal fade" id="exampleModalLong{{$loop->iteration}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Verifikasi Pembayaran</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <label for="example-time-input" class="col-form-label">Jenis Pembayaran</label>
                                                    <form method="post" action="{{route('verifbuktibyr')}}" enctype='multipart/form-data'>
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$row->id}}">
                                                    <input type="hidden" name="jns" value="{{$jns}}">
                                                    <select class="custom-select" name="jp" id="disparent">
                                                        <option value="0">Lunas</option>
                                                        <option value="1">Deposit(Partial)</option>
                                                    </select>
                                                    <div class="form-group">
                                                        <label for="example-time-input" class="col-form-label">Nominal Yang Terbayar</label>
                                                        <input class="form-control" id="dischild1" max="10000000" type="number" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="" name="terbayar">
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
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <form action="{{route('tambahinvoice')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="jasa_id" value='{{$jasa->id}}'>
                                                    <input type="hidden" name="jns" value='{{$jns}}'>
                                                <li><button type="submit" class="unstyled-btn text-danger"><i class="ti-plus"></i></button></li>
                                                </form>
                                            </ul>
                                        </td>
                                    </tr>
                                
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
@endsection