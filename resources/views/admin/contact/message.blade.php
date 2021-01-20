@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

        <div class="container">
            <div class='row'>

                <div class="col-md-12">
                    <div class="card">
                        

                        <div class="card-header d-flex justify-content-between align-items-center"> Admin Message Page
                        </div>



                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="10%">Name</th>
                                    <th scope="col" width="10%">Email</th>
                                    <th scope="col" width="20%">Subject</th>
                                    <th scope="col" width="30%">Message</th>
                                    <th scope="col" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($messages as $msg)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{$msg-> name}}</td>
                                    <td>{{$msg-> email}}</td>
                                    <td>{{$msg-> subject}}</td>
                                    <td>{{$msg-> message}}</td>
                                    <td>
                                        <a href="{{url('admin/message/delete/' .$msg->id)}}" onclick="return confirm ('Are you sure you want to delete this file?')" style="float:right" class="btn btn-danger">Delete</a>
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