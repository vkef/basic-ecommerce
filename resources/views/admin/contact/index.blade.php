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
                        

                        <div class="card-header d-flex justify-content-between align-items-center"> Contact Page
                            <a href="{{ route('add.contact') }}"> <button class='btn btn-info'>Add Contact</button></a>
                        </div>



                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="25%">Contact Address</th>
                                    <th scope="col" width="20%">Contact Email</th>
                                    <th scope="col" width="20%">Contact Phone</th>
                                    <th scope="col" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($contacts as $con)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{$con-> address}}</td>
                                    <td>{{$con-> email}}</td>
                                    <td>{{$con-> phone}}</td>
                                    <td>{{$con->created_at->diffForHumans()}}</td>

                                    <td>
                                        <a href="{{url('admin/contact/delete/' .$con->id)}}" onclick="return confirm ('Are you sure you want to delete this file?')" style="float:right" class="btn btn-danger">Delete</a>
                                    <a href="{{url('admin/contact/edit/' .$con->id)}}" style="float:right" class="btn btn-light">Edit</a>
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