@extends('admin.admin_master')

@section('admin')


    <div class="py-12">

        <div class="container">
            <div class='row'>
    

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"> Edit Slider </div>
                        <div class='card-body'>

                            <form action="{{url('slider/update/'.$sliders->id) }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <input type="hidden" name="old_image" value="{{$sliders->image}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Update Title</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$sliders->title}}">

                                    @error('title')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1" class="form-label">Update Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" >{{$sliders->description}}</textarea>


                                    @error('description')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Update Brand Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$sliders->image}}">

                                    @error('image')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror

                                </div>

                                <div class='form-group'> 
                                <img src="{{asset($sliders->image) }}" style="height:200px; width:400px;">
                                </div>


                                <button type="submit" class="btn btn-primary">Update Slider</button>
                            </form>
                        </div>
                    </div>


                    @if(session("success"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif


                </div>

            </div>
        </div>

    </div>
@endsection