@extends('layouts.appadmin')

@section('content')
<div class="main-content">
            
            
            <div class="main-content-inner">
                        <div class="row mt-5">
                            <!-- Textual inputs start -->
                            <div class="col-4 ">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="{{route('tambahkonsul')}}" enctype='multipart/form-data'>
                                            @csrf
                                            <h4 class="header-title">isi dengan jadwal konsul </h4>
                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">title</label>
                                                <input class="form-control" type="text" value="" name="title">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Jenis</label>
                                                <select class="custom-select" name="jns">
                                                    <option selected value="0">Tatap Muka</option>
                                                    <option selected value="1">Online</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-date-input" class="col-form-label">Date</label>
                                                <input class="form-control" type="date" value="" name="tgl">
                                            </div>
                                            <div class="form-group">
                                                <label for="example-time-input" class="col-form-label">Time</label>
                                                <input class="form-control" type="time" value="13:45:00" name="mulai">
                                            </div>
                                            <button type="submit" class="btn btn-danger mt-2" class="text-right" style="float: right;">Save</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Calendar</h4>
                                            <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
                                            <link href="{{ asset('css/style.css') }}" rel="stylesheet">
                                            <link href="{{ asset('fullcalendar/packages/core/main.css') }}" rel="stylesheet">
                                            <link href="{{ asset('fullcalendar/packages/daygrid/main.css') }}" rel="stylesheet">
                                            <div class="content p-0 m-0 col-sm-12">
                                            <div id='calendar'></div>
                                    </div>
                                </div>
                            </div>
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
                                        <th scope="col">Customer</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Tgl/jam</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $jadwal as $jdwl)
                                    <tr>
                                        <td>
                                            @if($jdwl->jasa_id != null)
                                            {{DB::table('users')->where('id', DB::table('jasa')->where('id', $jdwl->jasa_id)->value('cus_id'))->value('name')}}
                                            @else
                                            Belum Ada
                                            @endif
                                        </td>
                                        <td>@if($jdwl->jenis==0) Tatap Muka @else Online @endif</td>
                                        <td>{{$jdwl->tgl}}/{{$jdwl->mulai}}</td>
                                        <td>
                                            @if($jdwl->jenis!=0)
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalnota{{$loop->iteration}}">Set link</button>
                                            @endif
                                        </td>
                                        <div class="modal fade" id="modalnota{{$loop->iteration}}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Link</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form method="post" action="{{route('addlink')}}" enctype='multipart/form-data'>
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$jdwl->id}}">
                                                    <div class="form-group">
                                                        <label for="example-time-input" class="col-form-label">Link Google Meet</label>
                                                        <input class="form-control" type="text" value="{{$jdwl->link}}" name="link">
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
                 foreach($jadwal as $row){
                    $echo="{"."title: "."'".$row['mulai'].' WIB'."'".",
                        start: "."'".$row['tgl']."'".",";
                        
                        if ($row['status']==0) {
                            if ($row['jenis']==0) {
                                $echo.="backgroundColor: "."'"."green"."'".",
                                borderColor: "."'"."green"."'"."},";
                            }elseif ($row['jenis']==1) {
                                $echo.="backgroundColor: "."'"."blue"."'".",
                                borderColor: "."'"."blue"."'"."},";
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