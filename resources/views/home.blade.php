@extends('layouts.apphome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-12 mt-5">
            @if(\Session::has('success'))
                <input type="hidden" id='popupif' value='1'>
            @endif
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Pilihan Katalog
                            <a tabindex="0" class="ml-1" data-toggle="popover" data-trigger="focus" title="Pilihan Katalog" 
                                data-content="Katalog yang tersedia di Amoora Couture,jika katalog kurang sesuai customer dapat melakukan pesanan custom dengan login/register terlebih dahulu.">
                                    <i class="fa fa-info-circle text-info"></i>
                            </a>
                        </h4>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($Katalog as $row)
                            <div class="col-lg-4 col-md-6 mt-3">
                                <div class="card h-100 card-bordered">
                                   
                                        <img src="/storage/katalog/{{$row->img_depan}}" class="card-img-top" alt="...">
                                   
                                <div class="card-body">
                                   
                                        <h5 > {{$row->title}} </h5>
                                    
                                    <h5 class="title">Harga: 
                                    </h5>
                                    <textarea class="form-control" aria-label="With textarea" style="background-color: #fff; height: 200px;" name="desc" readonly>{{$row->harga}}</textarea>
                                    <div class="row mt-3 ml-2">
                                        <a href="{{route('viewdetailkatalogpublic',['id' => $row->id])}}" class="btn btn-primary mr-1">Detail Pakaian</a>
                                    </div>
                                   
                                </div>
                                </div>
                            </div> 
                        @endforeach    
                    </div>
                    <div class="mt-3">
                    {{ $Katalog->links() }}
                    </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="header-title">Cara Pemesanan Melalui Website Ini
                        </h4>
                        <p class="text-muted font-14 mb-4">Customer diharapakan <a href="{{ route('login') }}" class="alert-link"> Login </a> terlebih dahulu, jika belum memiliki akun maka 
                        dapat melakukan <a href="{{ route('login') }}" class="alert-link"> Registrasi </a> terlebih dahulu. Ada 2 tipe pemesanan dapat anda lakukan yaitu sampling dan produksi.
                        
                        </p>
                        <p class="h6"> <strong>Pemesanan Sampling</strong> </p>
                        <p class="text-muted font-14 mb-4">Sampling bertujuan agar customer dapat mencoba design dari katalog kami ataupun design yang diberikan oleh customer sendiri,
                            karena pemesanan ini bersifat sampling maka jumlahnya barang yang dibuat hanya satu. Pemesana sampling dibagi menjadi dua yaitu sampling produk pada katalog yang ada maupun
                            sampling custom.
                        </p>
                        <div id="accordion4" class="according accordion-s3 ">
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#SKatalog">Sampling Katalog</a>
                                </div>
                                <div id="SKatalog" class="collapse" data-parent="#SKatalog">
                                    <div class="card-body">
                                        1. Sampling Katalog dapat dilakukan dengan memilih salah satu produk di katalog kami lalu masuk ke menu detail katalog. <br>
                                        2. Kemudian klik tombol <button class="btn btn-primary" >Pesan Sample Pakaian Ini</button>. <br>
                                        3. Setelah itu pilih slot/batch dengan tanggal produksi yang diinginkan. <br>
                                        4. Maka pesanan sampling anda akan masuk ke menu <a href="{{route('viewsampling')}}" class="alert-link"> Sampling </a>. <br>
                                        5. Setelah itu admin akan memberikan invoice ke menu <a href="{{route('viewlistbayar')}}" class="alert-link"> Nota Tagihan </a> <br>
                                        6. Pada menu sampling customer dapat melihat tahap/status pemesanan mereka. <br>
                                        7. Saat pemesanan selesai maka barang akan otomatis dikirimkan ke alamat pada <a href="{{route('viewprofile')}}" class="alert-link"> Profil Anda </a> anda jika tidak ada permintaan pengambilan mandiri dari anda.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#SCustom">Sampling Custom</a>
                                </div>
                                <div id="SCustom" class="collapse" data-parent="#SCustom">
                                    <div class="card-body">
                                        1. Sampling custom dapat dilakukan dengan masuk kehalaman <a href="{{route('viewsampling')}}" class="alert-link"> Sampling </a> lalu isi detail pada Form Pengajuan Sampling Custom.<br>
                                        2. Kemudian klik tombol <button class="btn btn-success" >Simpan</button>. <br>
                                        3. Setelah itu masuklah ke halaman detail dari pesanan tersebut dan upload file/image yang dapat membantu memperjelas design yang diinginkan. <br>
                                        4. Jika ingin melakukan konsul dengan admin, customer dapat memanfaatkan livechat atau customer dapat memilih jadwal konsul yang ada pada laman<a href="{{route('viewkonsul')}}" class="alert-link"> Konsultasi </a><br>
                                        5. Jika sudah selesai/tidak ingin konsultasi customer dapat memberitahu admin melalui livechat jika ingin melanjutkan ketahap selanjutnya.<a href="{{route('viewlistbayar')}}" class="alert-link"> Nota Tagihan </a> <br>
                                        6. Setelah itu admin akan memberikan invoice ke menu <a href="{{route('viewlistbayar')}}" class="alert-link"> Nota Tagihan </a> <br>
                                        7. Pada menu sampling customer dapat melihat tahap/status pemesanan mereka. <br>
                                        8. Saat pemesanan selesai maka barang akan otomatis dikirimkan ke alamat pada <a href="{{route('viewprofile')}}" class="alert-link"> Profil Anda </a> anda jika tidak ada permintaan pengambilan mandiri dari anda.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="h6 mt-5"> <strong>Pemesanan Produksi</strong> </p>
                        <p class="text-muted font-14 mb-4">Pemesanan Produksi ditujukan saat customer sudah yakin dan akan memesan produk dalam jumlah banyak, customer dapat memilih produk dari katalog untuk diproduksi
                            , customer juga dapat memasukan detail custom untuk diproduksi dan yang terakhir customer dapat menggunakan detail dari sampling custom yang sudah pernah dipesan dan sudah selesai.

                        </p>
                        <div id="accordion4" class="according accordion-s3 ">
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#PKatalog">Produksi Katalog</a>
                                </div>
                                <div id="PKatalog" class="collapse" data-parent="#PKatalog">
                                    <div class="card-body">
                                        1. Produksi Katalog dapat dilakukan dengan memilih salah satu produk di katalog kami lalu masuk ke menu detail katalog. <br>
                                        2. Kemudian klik tombol <button class="btn btn-primary" >Pesan Produksi Pakaian Ini</button>. <br>
                                        3. Setelah itu pilih slot/batch dengan tanggal produksi yang diinginkan. <br>
                                        4. Maka pesanan produksi anda akan masuk ke menu <a href="{{route('viewproduksi')}}" class="alert-link"> Produksi </a>. <br>
                                        5. Setelah itu admin akan memberikan invoice ke menu <a href="{{route('viewlistbayar')}}" class="alert-link"> Nota Tagihan </a> <br>
                                        6. Pada menu produksi customer dapat melihat tahap/status pemesanan mereka. <br>
                                        7. Saat pemesanan selesai maka barang akan otomatis dikirimkan ke alamat pada <a href="{{route('viewprofile')}}" class="alert-link"> Profil Anda </a> anda jika tidak ada permintaan pengambilan mandiri dari anda.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#PCustom">Produksi Custom</a>
                                </div>
                                <div id="PCustom" class="collapse" data-parent="#PCustom">
                                    <div class="card-body">
                                        1. Produksi custom dapat dilakukan dengan masuk kehalaman <a href="{{route('viewproduksi')}}" class="alert-link"> Produksi </a> lalu isi klik dengan detail pakaian baru.<br>
                                        2. Kemudian isi form, pilih slot dan klik tombol <button class="btn btn-success" >Simpan</button>. <br>
                                        3. Setelah itu masuklah ke halaman detail dari pesanan tersebut dan upload file/image yang dapat membantu memperjelas design yang diinginkan. <br>
                                        4. Jika ingin melakukan konsul dengan admin, customer dapat memanfaatkan livechat atau customer dapat memilih jadwal konsul yang ada pada laman<a href="{{route('viewkonsul')}}" class="alert-link"> Konsultasi </a><br>
                                        5. Jika sudah selesai/tidak ingin konsultasi customer dapat memberitahu admin melalui livechat jika ingin melanjutkan ketahap selanjutnya.<a href="{{route('viewlistbayar')}}" class="alert-link"> Nota Tagihan </a> <br>
                                        6. Setelah itu admin akan memberikan invoice ke menu <a href="{{route('viewlistbayar')}}" class="alert-link"> Nota Tagihan </a> <br>
                                        7. Pada menu produksi customer dapat melihat tahap/status pemesanan mereka. <br>
                                        8. Saat pemesanan selesai maka barang akan otomatis dikirimkan ke alamat pada <a href="{{route('viewprofile')}}" class="alert-link"> Profil Anda </a> anda jika tidak ada permintaan pengambilan mandiri dari anda.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#PSCustom">Produksi Dengan Pesanan Sampling Yang Sudah Ada</a>
                                </div>
                                <div id="PSCustom" class="collapse" data-parent="#PSCustom">
                                    <div class="card-body">
                                        1. Produksi dengan detail sampling yang pernah dipesan dapat dilakukan dengan memilih salah satu pesanan sampling yang sudah selesai di menu <a href="{{route('viewproduksi')}}" class="alert-link"> Produksi </a> . <br>
                                        2. Kemudian klik tombol pesan <br>
                                        3. Setelah itu pilih slot/batch dengan tanggal produksi yang diinginkan. <br>
                                        4. Maka pesanan produksi anda akan masuk ke menu <a href="{{route('viewproduksi')}}" class="alert-link"> Produksi </a>. <br>
                                        5. Setelah itu admin akan memberikan invoice ke menu <a href="{{route('viewlistbayar')}}" class="alert-link"> Nota Tagihan </a> <br>
                                        6. Pada menu produksi customer dapat melihat tahap/status pemesanan mereka. <br>
                                        7. Saat pemesanan selesai maka barang akan otomatis dikirimkan ke alamat pada <a href="{{route('viewprofile')}}" class="alert-link"> Profil Anda </a> anda jika tidak ada permintaan pengambilan mandiri dari anda.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
          
            
    </div>
</div>
@endsection
