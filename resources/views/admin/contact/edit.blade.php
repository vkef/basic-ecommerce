@extends('admin.admin_master')

@section('admin')


<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Contact</h2>
        </div>
        <div class="card-body">
            <form action="{{url('admin/contact/update/'.$contacts->id)}}" method="POST">
                    @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$contacts->email}}" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Phone</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$contacts->phone}}" name="phone">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Address</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  name="address">{{$contacts->address}}</textarea>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Update</button>
                </div>
            </form>
        </div>
    </div>  
</div>

@endsection