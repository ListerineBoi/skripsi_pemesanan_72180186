@extends('layouts.appadmin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mt-3">
                <div class="card">
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
                        <form method="post" action="{{route('addadmin')}}" enctype='multipart/form-data'>
                            @csrf
                            <h4 class="header-title">Tambah Admin</h4>
                            <p class="text-muted font-14 mb-4"></p>
                            
                            <div class="form-group">
                                <label class="col-form-label">Nama</label>
                                
                                <input class="form-control" maxlength="190" type="text" value="" name="name">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" maxlength="190" type="text" value="" name="email">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                
                                <input class="form-control" maxlength="190" type="password" value="" name="password">
                            </div>
                            
                
                            
                            <button type="submit" class="btn btn-success" class="text-right" style="float: right;">Tambah</button>
                        </form>
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
                                                <th scope="col">Nama</th>
                                                <th scope="col">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($admin as $row)
                                            <tr>
                                                <td>{{$row->name}}</td>
                                                <td>{{$row->email}}</td>
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
    </div>
    
@endsection
