@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
<div class="row">
    <div class="col-12">
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Blog Category All</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

        <h4 class="card-title">Blog Category All Data</h4>
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Blog Category Name</th>
                    <th>Action</th>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($category as $key => $item)
                <tr>
                    <td> {{ $key+1 }} </td>
                    <td> {{ $item->blog_category }} </td>
                    <td>
                        <a href="{{ route('edit.blog.category', $item->id) }}" class="btn btn-info sm" title="Edit Data">  
                            <i class="fas fa-edit">
                            </i> 
                        </a>
                        <a href="{{ route('delete.blog.category', $item->id) }}"
                             class="btn btn-danger sm" id="delete" title="Delete Data">
                            <i class="fas fa-trash-alt">
                            </i> 
                        </a>
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
</div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


@endsection 