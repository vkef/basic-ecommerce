@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

        <div class="container">
            <div class='row'>

                

                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header"> All Slider </div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Slider Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{$sliders->firstItem()+$loop->index }}</th>
                                    <td>{{$slider-> title}}</td>
                                    <td>{{$slider-> description}}</td>
                                    <td><img src="{{asset($slider->image) }}" style="height:40px; width:70px;"></td>
                                    <td>{{$brand->created_at->diffForHumans()}}</td>

                                    <td>
                                    <a href="{{url('slider/edit/' .$slider->id)}}" class="btn btn-light">Edit</a>
                                    <a href="{{url('slider/delete/' .$slider->id)}}" onclick="return confirm ('Are you sure you want to delete this file?')" class="btn btn-danger">Delete</a>
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