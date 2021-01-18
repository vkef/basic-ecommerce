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
                        

                        <div class="card-header d-flex justify-content-between align-items-center"> All Sliders
                            <a href="{{ route('add.slider') }}"> <button class='btn btn-info'>Add Slider</button></a>
                        </div>



                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="15%">Slider Title</th>
                                    <th scope="col" width="30%">Description</th>
                                    <th scope="col" width="15%">Image</th>
                                    <th scope="col" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{$slider-> title}}</td>
                                    <td>{{$slider-> description}}</td>
                                    <td><img src="{{asset($slider->image) }}" style="height:40px; width:70px;"></td>
                                    <td>{{$slider->created_at->diffForHumans()}}</td>

                                    <td>
                                        <a href="{{url('slider/delete/' .$slider->id)}}" onclick="return confirm ('Are you sure you want to delete this file?')" style="float:right" class="btn btn-danger">Delete</a>
                                    <a href="{{url('slider/edit/' .$slider->id)}}" style="float:right" class="btn btn-light">Edit</a>
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