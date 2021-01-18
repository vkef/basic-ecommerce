@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

        <div class="container">
            <div class='row'>

                <div class="col-md-12">
                    <div class="card">

                        @if(session("success"))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        

                        <div class="card-header d-flex justify-content-between align-items-center"> About Section
                            <a href="{{ route('add.about') }}"> <button class='btn btn-info'>Add About</button></a>
                        </div>



                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="15%">Slider Title</th>
                                    <th scope="col" width="20%">Short Description</th>
                                    <th scope="col" width="35%">Long Description</th>
                                    <th scope="col" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($homeabout as $about)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{$about-> title}}</td>
                                    <td>{{$about-> short_des}}</td>
                                    <td>{{$about-> long_des}}</td>
                                    <td>{{$about->created_at->diffForHumans()}}</td>

                                    <td>
                                        <a href="{{url('about/delete/' .$about->id)}}" onclick="return confirm ('Are you sure you want to delete this file?')" style="float:right" class="btn btn-danger">Delete</a>
                                    <a href="{{url('about/edit/' .$about->id)}}" style="float:right" class="btn btn-light">Edit</a>
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

@endsection