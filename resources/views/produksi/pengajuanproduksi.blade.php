@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-body">
                <h4 class="header-title">Sampling Yang Ada</h4>
                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($detail as $row)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 card-bordered">
                            <img src="/storage/imgsampling/{{$row->img}}" class="card-img-top" alt="...">
                            <div class="card-body">
                            
                                <h5 class="card-title">@if($row->model==0) rok @elseif($row->model==1) dress @else Top @endif</h5>
                                <p class="card-text">{{$row->desc}}</p>
                                <a href="{{route('viewinputproduksi',['id' => $row->id])}}" class="btn btn-primary">Produksi Dengan Sampling ini</a>
                            </div>
                            </div>
                        </div> 
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card mt-5">
          

                <div class="card-body my-5">
                <div class="col-md-12 text-center">
                    <h3 class="mb-3" >Produksi dengan Sampling Custom</h3>
                    <a href="{{route('viewcussampproduksi')}}" class="btn btn-primary" style="text-align: center">Klik disini</a>
                    </div>
                    
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Produksi on-going</div>

                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($produksi as $row2)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 card-bordered">
                            <img src="/storage/imgsampling/{{DB::table('detail_pakaian')->where('id', $row2->detail_id)->value('img')}}" width='300' height='300' class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{DB::table('slot_p')->where('id', $row2->slot_id)->value('mulai')}} s/d {{DB::table('slot_p')->where('id', $row2->slot_id)->value('selesai')}} 
                                        @if($row2->status == 0)
                                        <a href="#" class="badge badge-secondary">Pending</a>
                                        @elseif($row2->status == 1)
                                        <a href="#" class="badge badge-warning">Waiting list</a>
                                        @elseif($row2->status == 2)
                                        <a href="#" class="badge badge-info">Proses</a>
                                        @elseif($row2->status == 3)
                                        <a href="#" class="badge badge-primary">Finishing</a>
                                        @endif
                                </h5>
                                <h5 class="card-title">Jumlah Produksi : {{$row2->jml}}</h5>
                                <p class="card-text">{{$row2->desc}}</p>
                                <a href="{{route('editproduksi',['id' => $row2->id])}}" class="btn btn-primary">Detail</a>
                            </div>
                            </div>
                        </div> 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
