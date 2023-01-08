@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <!-- Simple card -->
                <div class="card">
                    {{--
                         ? adalah then
                         : adalah else
                                        --}}
                    <img class="rounded-circle avatar-xl m-4" alt="200x200" 
                    src="{{ (!empty($adminData->profile_image))? 
                    url('upload/admin_images/'. $adminData->profile_image):
                    url('upload/admin_images/no_image.jpg') }}">
                        <div class="card-body">
                            <h4 class="card-title">Name : {{ $adminData->name }}</h4>
                            <hr>
                            <h4 class="card-title">Email : {{ $adminData->email }}</h4>
                            <hr>
                            <h4 class="card-title">Username : {{ $adminData->username }}</h4>
                            <hr>
                            <a href="{{ route('edit.profile') }}" class="btn btn-primary waves-effect waves-light">Edit Profile</a>
                         </div>
                </div>
            </div><!-- end col -->
        </div>
    </div>
</div>

@endsection