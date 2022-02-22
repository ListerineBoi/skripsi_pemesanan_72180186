@extends('layouts.appadmin')

@section('content')
<div class="main-content">
            
            
            <div class="main-content-inner">
                <div class="row">
                   
                        <div class="row">
                            <!-- Textual inputs start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                    <form method="post" action="{{route('tambahkonsul')}}" enctype='multipart/form-data'>
                                        @csrf
                                        <h4 class="header-title">isi dengan jadwal konsul </h4>
                                        <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                        <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">title</label>
                                            <input class="form-control" type="text" value="" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="example-date-input" class="col-form-label">Date</label>
                                            <input class="form-control" type="date" value="2018-03-05" name="tgl">
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
                            <!-- Textual inputs end -->
                            
                            
                        </div>
                    </div>
                    </div>
                    
                    <div class="col-lg-10 col-md-12">
                        
                            <!-- basic form start -->
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
                            <!-- basic form end -->
                            
                        
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
                     $echo="{"."title: "."'".$row['title']." ".$row['mulai']."'".",
                        start: "."'".$row['tgl']."'".",";
                        
                        if ($row['status']==0) {
                            $echo.="backgroundColor: "."'"."green"."'".",
                            borderColor: "."'"."green"."'"."},";
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