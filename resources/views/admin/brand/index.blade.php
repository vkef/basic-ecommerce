<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brands <b></b>

        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class='row'>
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-header"> Brands </div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($brands as $brand)
                                <tr>
                                    <th scope="row">{{$brands->firstItem()+$loop->index }}</th>
                                    <td>{{$brand-> brand_name}}</td>
                                    <td><img src="" alt=""></td>
                                    <td>{{$brand->created_at->diffForHumans()}}</td>

                                    <td>
                                    <a href="{{url('brand/edit/' .$brand->id)}}" class="btn btn-light">Edit</a>
                                    <a href="{{url('brand/remove/' .$brand->id)}}" class="btn btn-dark">Remove</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{$brands->links()}}
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Add Brand </div>
                        <div class='card-body'>
                            <form action="{{route('store.category')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                    @error('category_name')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror

                                </div>



                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                    @error('brand_image')
                                    <span class='text-danger'>{{$message}}</span>
                                    @enderror

                                </div>




                                <button type="submit" class="btn btn-primary">Add Brand</button>
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
</x-app-layout>