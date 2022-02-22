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
                                        @if($row->img_bukti !=null)
                                        <a href="/storage/buktibayar/{{$row->img_bukti}}" class="btn btn-primary" disabled>lihat bukti bayar</a>
                                        @else
                                        <p>Belum Ada</p>
                                        @endif
                                        </td>
                                        <td>{{$row->jenis_pembayaran}}</td>
                                        
                                        <td>@if($row->status==0) Belum Lunas @elseif($row->status==1) Menunggu @elseif($row->status==2) Lunas @endif</td>
                                        <td>
                                            <form action="{{route('verifbuktibyr')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$row->id}}">
                                                <input type="hidden" name="jns" value="{{$jns}}">
                                                <button type="submit" class="btn btn-primary">Verif Bukti Bayar</button>
                                                <a href="{{route('lihatdetailinvoice',['id' => $row->id,'jns' => $jns])}}" class="btn btn-primary" disabled>Detail</a>
                                            </form>
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