@extends('backend.layout')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Category</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                    <li class="breadcrumb-item active">All Categories</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Categories</h4>    
                
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
    
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Added By/Update By</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($categories as $index => $category)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->addedBy->first_name .' '. $category->addedBy->last_name }}{{ $category->updateBy ? $category->updateBy->first_name . $category->updateBy->last_name : null }}</td>
                                <td id="categoryStatus">{{ $category->status == 1 ? 'Published' : 'Unpublished'}}</td>
                                <td>
                                    <button id="unpublished{{$loop->iteration}}" onclick="changeStatus()" class="btn btn-warning">
                                        <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
                                    </button>
                                    <button id="published{{$loop->iteration}}" onclick="changeStatus()" class="btn btn-success">
                                        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-info">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </button>
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            <script>
                                if({{$category->status}} == 1){
                                    document.getElementById('published{{$i}}').style.display = 'inline-block';
                                }else if({{$category->status}} == 0){
                                    document.getElementById('unpublished{{$i}}').style.display = 'none';
                                }
                            </script>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>


                        
                    </table>
                </div>
    
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('unpublished').
</script>
@endsection