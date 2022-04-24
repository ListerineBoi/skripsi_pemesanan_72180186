@extends('layouts.app')

@section('content')
<div class="main-content">
            
            
            <div class="main-content-inner">
                
                    
                            <!-- Textual inputs start -->
                            <div class="row">
                            <div class="col-4 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                    <form method="post" action="{{route('pilihkonsul')}}" enctype='multipart/form-data'>
                                        @csrf
                                        <input type="hidden" name="jasa_id" value="{{$id}}">
                                        <h4 class="header-title">Pilih jadwal konsul </h4>
                                        <div class="form-group">
                                            <label class="col-form-label">Slot</label>
                                            <select class="custom-select" name="id">
                                                @foreach($jadwal as $row)
                                                    <option value="{{$row->id}}">@if($row->jenis == 0)Tatap Muka @else Online @endif {{$row->tgl}} Pada Jam {{$row->mulai}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-danger mt-2" class="text-right" style="float: right;">Save</button>
                                        </form>
                                        
                                    </div>
                                </div>
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <input type="hidden" name="jasa_id" value="{{$id}}">
                                        <h4 class="header-title">Petunjuk Cara Konsultasi</h4>
                                        <div class="form-group">
                                           1. Jadwal konsultasi <br> 
                                           <p class="text-muted">sesi konsultasi yang tersedia dapat dilihat pada bagan kalender sebagai petunjuk, pilih sesuai keinginan melalui dropdown pemilihan slot waktu.</p>
                                           2. Warna pada Jadwal konsultasi <br> 
                                           <p class="text-muted">Pada slot konsultasi yang ada di kalendar akan dibedakan dengan warna, Warna <span style="background-color: #239b56; color:white"><b>Hijau</b></span>
                                            Merupakan konsultasi Tatap Muka, sedangkan warna <span style="background-color: #3498db; color:white"><b>Biru</b> </span> merupakan konsultasi secara online (gmeet/zoom). Warna 
                                            <span style="background-color: Red; color:white"><b>Merah</b> </span> berarti slot jadwal tersebut sudah terisi.</p> 
                                            3. Mengahdiri Konsultasi <br> 
                                           <p class="text-muted">Setelah memilih jadwal yang sesuai maka customer dapat menghadiri sesi konsultasi.Sesi online dapat dihadiri melalui link yang tersedia pada table jadwal dibawah.
                                                konsultasi tatap muka dapat dihadiri di gedung konveksi amoora yaitu Jl. Kaliurang, Tambakan, Sinduharjo, Kec. Sleman, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581, Indonesia.
                                                customer diharapkan datang tepat waktu sesuai jadwal.
                                           </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Textual inputs end -->
                            
                            <!-- basic form start -->
                            <div class="col-7 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Calendar</h4>
                                        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
                                            <link href="{{ asset('css/style.css') }}" rel="stylesheet">
                                            <link href="{{ asset('fullcalendar/packages/core/main.css') }}" rel="stylesheet">
                                            <link href="{{ asset('fullcalendar/packages/daygrid/main.css') }}" rel="stylesheet">
                                            <div class="content p-0 col-sm-12">
                                            <div id='calendar'></div>
                                    </div>
                                </div>
                            </div>
                            <!-- basic form end -->
            </div>
            </div>
                 <div class="col-md-12 mt-5">
                                <div class="card">
                                    <div class="card-header"></div>

                                    <div class="card-body">
                                    <div class="single-table">
                                            <div class="table-responsive">
                                                <table class="table table-hover progress-table text-center">
                                                    <thead class="text-uppercase">
                                                        <tr>
                                                            <th scope="col">Jenis</th>
                                                            <th scope="col">Tgl</th>
                                                            <th scope="col">Jam</th>
                                                            <th scope="col">Link</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $jadwal1 as $jdwl)
                                                        <tr>
                                                            <td>@if($jdwl->jenis==0) Tatap Muka @else Online @endif</td>
                                                            <td>{{$jdwl->tgl}}</td>
                                                            <td>{{$jdwl->mulai}}</td>
                                                            <td><a href="{{$jdwl->link}}">{{$jdwl->link}}</a></td>
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
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('fullcalendar/packages/core/main.js') }}"></script>
        <script src="{{ asset('fullcalendar/packages/interaction/main.js') }}"></script>
        <script src="{{ asset('fullcalendar/packages/daygrid/main.js')}}"></script>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid' ],
                defaultDate: <?php echo "'".date('Y-m-d')."'" ?>,
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    // {title:'eek',start:'2022-02-08'},
                    <?php
                 foreach($cal as $row){
                     $echo="{"."title: "."'".$row['mulai'].' WIB'."'".",
                        start: "."'".$row['tgl']."'".",";
                        
                        if ($row['status']==0) {
                            if ($row['jenis']==0) {
                                $echo.="backgroundColor: "."'"."#239b56"."'".",
                                borderColor: "."'"."#239b56"."'"."},";
                            }elseif ($row['jenis']==1) {
                                $echo.="backgroundColor: "."'"."#3498db"."'".",
                                borderColor: "."'"."#3498db"."'"."},";
                            }
                        }elseif ($row['status']==1) {
                            $echo.="backgroundColor: "."'"."red"."'".",
                            borderColor: "."'"."red"."'"."},";
                        }else{
                            $echo.="backgroundColor: "."'"."grey"."'".",
                            borderColor: "."'"."grey"."'"."},";
                        }
                    echo $echo;   
                }
                ?>
                ]
                });

                calendar.render();
            });

                </script>
        @endsection