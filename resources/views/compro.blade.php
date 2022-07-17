@extends('layouts.apphome')

@section('content')

<script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />

<div class="row justify-content-center bg-white mt-3 mx-5">
    <div class="container " style="margin: 0;">
        <div class="row col-md-12" style="padding-right:0;margin-right:0">
            <div class="col-md-6 mt-5">
                <div class="col-md-12 mt-5 pt-5 mr-5 pr-5">
                    <img class="mt-5 pt-5 pt-5 mr-5 pr-5" src="{{ asset('img/logo.jpeg') }}" alt="logo">
                    <h4 class="pt-5" style="color:grey;font-weight: bold; text-align: center;">Konveksi Premium "Ready To Wear"</h4>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/banner1.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="row col-md-12" style="padding-right:0;margin-right:0">
                    <div class="col-md-6 pl-0">
                        <img src="{{ asset('img/banner2.png') }}" alt="">
                    </div>
                    <div class="card-body col-md-6">
                        <div class="col-md-12" >
                            <div class="container col-md-12 ml-2 rounded"  style="background-color:#9A7563">
                                <h1 class="py-2 text-white"><b>About Us</b></h1>
                            </div> 
                            <div class="container col-md-12 mt-5" >
                                <p class="text-dark">
                                    <strong> “CV. Amoora Couture” adalah sebuah usaha yang menggeluti bidang konveksi/jasa jahit yang berlokasi di Yogyakarta. 
                                    Amoora Couture memiliki spesialisasi pembuatan pakaian dan seragam dalam sekala kecil maupun besar dengan minimum pemesanan 12 pcs / 1 lusin yang telah berdiri pada akhir tahun 2019.
                                    Kami menyediakan berbagai macam model pakaian serta memberikan keleluasaan bagi pelanggan untuk memesan baju dengan desain custom yang disediakan oleh pelanggan. 
                                    </strong>
                                </p>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="col-md-12 container rounded-top " style="background-color:#9A7563;margin-right:0; ">
                    <H1 class="ml-2 text-white"><b>Why Choose Us</b></H1>
                </div>
                <div class="card-body">
                    <div class="row col-md-12">
                        <div class="container rounded"style="background-color:#9A7563;">
                            <div class="row">
                                <h1 class="col-md-2 pt-3 text-white" style="text-align: center;"><b>1</b></h1>
                                <div class="container col-md-10">
                                    <h3 class=" text-white mb-1">
                                        <b>Sampling Product</b> 
                                    </h3>
                                    <h4 class=" text-white mb-3">
                                        Konsumen dapat melakukan pembuatan contoh produk sebelum produksi
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="container rounded mt-3"style="background-color:#9A7563;">
                            <div class="row">
                                <h1 class="col-md-2 pt-3 text-white" style="text-align: center;"><b>2</b></h1>
                                <div class="container col-md-10">
                                    <h3 class=" text-white mb-1">
                                        <b>Affordable Prices</b> 
                                    </h3>
                                    <h4 class=" text-white mb-3">
                                    Harga terjangkau dan sesuai Dengan spesifikasi dan bahan dari produk.
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="container rounded mt-3"style="background-color:#9A7563;">
                            <div class="row">
                                <h1 class="col-md-2 pt-3 text-white" style="text-align: center;"><b>3</b></h1>
                                <div class="container col-md-10">
                                    <h3 class=" text-white mb-1">
                                        <b>Negotiable</b> 
                                    </h3>
                                    <h4 class=" text-white mb-3">
                                    Dapat melakukan negosiasi tanpa
                                    mengesampingkan kualitas
                                    produk
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="container rounded mt-3"style="background-color:#9A7563;">
                            <div class="row">
                                <h1 class="col-md-2 pt-3 text-white" style="text-align: center;"><b>4</b></h1>
                                <div class="container col-md-10">
                                    <h3 class=" text-white mb-1">
                                        <b>Quality Guaranteed</b> 
                                    </h3>
                                    <h4 class=" text-white mb-3">
                                    Produk Jahitan Amoora
                                    dibuat dengan material dan
                                    teknik jahit terbaik
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="container rounded mt-3"style="background-color:#9A7563;">
                            <div class="row">
                                <h1 class="col-md-2 pt-3 text-white" style="text-align: center;"><b>5</b></h1>
                                <div class="container col-md-10">
                                    <h3 class=" text-white mb-1">
                                        <b>Quality Unit Control</b> 
                                    </h3>
                                    <h4 class=" text-white mb-3">
                                    Sebelum Tahap Shipping
                                    Amoora Melakukan QC untuk
                                    memastikan produk sesuai
                                    standar
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="container rounded mt-3"style="background-color:#9A7563;">
                            <div class="row">
                                <h1 class="col-md-2 pt-3 text-white" style="text-align: center;"><b>6</b></h1>
                                <div class="container col-md-10">
                                    <h3 class=" text-white mb-1">
                                        <b>Just In Time</b> 
                                    </h3>
                                    <h4 class=" text-white mb-3">
                                    Proses pengerjaan produk
                                    sesuai dengan kesepakatan
                                    konsumen
                                    </h4>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <div class="card">    
                <div class="card-body col-md-12 rounded pt-5" style=" height:900px; padding:9px; background-image: url({{ asset('img/bgkatalog.png') }});" >
                    <div class=" my-5 py-5"></div>
                    <div class=" my-2 py-2"></div>
                    <div class="col-md-12 row justify-content-center ml-1 mt-5 pt-5">
                        <a class="btn btn-primary btn-xl mt-5"  href="/katalog"> <h4><b>Lihat Katalog</b>  <i class="fa fa-arrow-right"></i></h4></a>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mt-5">
                <div class="card">
                    <div class="col-md-12 container rounded-top " style="background-color:#9A7563;margin-right:0; ">
                        <H1 class="ml-2 text-white"><b>Lokasi </b></H1>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                        <div id='map' class="col-md-12 rounded" style='height: 600px;'></div>
                        <h5>Jl. Kaliurang, Tambakan, Sinduharjo, Kec. Sleman, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581, Indonesia</h5>     
                        <a href="https://www.google.com/maps/place/Amoora.couture/@-7.7349825,110.3949197,17.62z/data=!4m12!1m6!3m5!1s0x0:0xdd3b0fd9ae4f59ca!2sAmoora.couture!8m2!3d-7.7353855!4d110.394894!3m4!1s0x0:0xdd3b0fd9ae4f59ca!8m2!3d-7.7353855!4d110.394894" type="button" class="btn btn-success" >Google Maps</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4 mt-5">
                <div class="card">
                    <div class="col-md-12 container rounded-top " style="background-color:#9A7563;margin-right:0; ">
                        <H1 class="ml-2 text-white"><b>Kontak</b></H1>
                    </div>
                    <div class="card-body">
                        <div class="row col-md-12">
                            <h4><i class="fa fa-whatsapp mr-2"></i>082123488998</h4>
                            <h4><i class="ti-email mt-2 mr-2"></i>@amoora.couture</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
// TO MAKE THE MAP APPEAR YOU MUST
// ADD YOUR ACCESS TOKEN FROM
// https://account.mapbox.com
mapboxgl.accessToken = 'pk.eyJ1IjoibGlzdGVyaW5lYm9pIiwiYSI6ImNrdmRzenZzMTllbDQyd29mOTN2Nnk4cDAifQ.ILAoM1z0NOugYT9C5yCZpA';
const map = new mapboxgl.Map({
    container: 'map', // container ID
    style: 'mapbox://styles/mapbox/streets-v11', // style URL
    center: [110.39494053517959,-7.735272009902705], // starting position [lng, lat]
    zoom: 14, // starting zoom
    projection: 'globe' // display the map as a 3D globe
});
map.on('style.load', () => {
    map.setFog({}); // Set the default atmosphere style
});
const places = {
'type': 'FeatureCollection',
'features': [
                {
                'type': 'Feature',
                'properties': {
                'description':'Amoora Ada Disini ',
                'icon': 'embassy-15'
                },
                'geometry': {
                'type': 'Point',
                'coordinates':[110.39494053517959,-7.735272009902705]
                }
                },
            ]
};
map.on('load', () => {
// Add a GeoJSON source containing place coordinates and information.
map.addSource('places', {
'type': 'geojson',
'data': places
});
map.addLayer({
'id': 'poi-labels',
'type': 'symbol',
'source': 'places',
'layout': {
'text-field': ['get', 'description'],
'text-variable-anchor': ['right'],
'text-radial-offset': 0.5,
'text-justify': 'auto',
'icon-size':1,
'icon-image': ['get', 'icon']
}
});
});
</script>
@endsection
