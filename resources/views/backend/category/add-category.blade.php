@extends('backend.layout')
@section('content')
@push('style')
<link rel="stylesheet" href="{{ asset('/') }}backend/sweetalert2/sweetalert2.min.css">
<link href="{{ asset('/') }}backend/toastr/toastr.min.css" id="app-style" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Category</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                    <li class="breadcrumb-item active">Add Category</li>
                </ol>
            </div>

            

        </div>
    </div>
</div>
{{ Form::open(['route'=>'category.add']) }}

<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-body">

                <h4 class="card-title">Add Category</0h4>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3 mt-3">
                                <label for="" class="form-label">Parent Category</label>
                                <select class="form-control" id="parent_id">
                                    <option value="0">None</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="categoryName" placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <textarea id="categoryDescription" id="" cols="30" rows="10" class="form-control" placeholder="Description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="c_status" class="form-label">Status</label>
                                <select name="" class="form-control" id="c_status">
                                    <option value="1">Publish</option>
                                    <option value="0">Unpublish</option>
                                </select>
                            </div>
                        </div>
                    </div>

            </div>
        </div>

    </div>


</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-body">

                <h4 class="card-title">Category SEO</h4>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3 mt-3">
                                <input type="text" class="form-control" id="keywords" placeholder="Keywords">
                            </div>
                            <div class="mb-3 mt-3">
                                <input type="text" class="form-control" id="metaTitle" placeholder="Meta Title">
                            </div>
                            <div class="mb-3">
                                <textarea id="metaDescription" cols="30" rows="10" class="form-control" placeholder="Meta Description"></textarea>
                            </div>
                            <div class="mb-3">
                                <button id="addCategory" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>

            </div>
        </div>

    </div>

</div>
{{ Form::close() }}
@push('script')

    <script src="{{ asset('/') }}backend/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('/') }}backend/toastr/toastr.min.js"></script>

@endpush
<script>
    
    document.getElementById('addCategory').addEventListener('click',function(e){
        e.preventDefault();
        document.getElementById('addCategory').textContent = 'Processing...'
        let name = document.getElementById('categoryName');
        let category_description = document.getElementById('categoryDescription');
        let status = document.getElementById('c_status');
        let meta_title = document.getElementById('metaTitle');
        let keywords = document.getElementById('keywords');
        let meta_description = document.getElementById('metaDescription');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajaxSetup({
            type: 'POST',
            url: '{{ Route("category.add") }}',
            data: {
                category_name: name.value,
                category_description: category_description.value,
                status: status.value,
                meta_title: meta_title.value,
                keywords: keywords.value,
                meta_description: meta_description.value,
                parent_id: parent_id.value
            },
            success: function(response){
                toastr.options = {
                    'positionClass': 'toast-bottom-right',
                    'progressBar': true,
                    'debug': false
                }
                if($.isEmptyObject(response.errors)){
                    if($.isEmptyObject(response.error)){
                        Swal.fire(
                            'success',
                            response.success,
                            'success'
                        );
                        name.value = '';
                        category_description.value = '';
                        status.value = '1';
                        meta_title.value = '';
                        keywords.value = '';
                        meta_description.value = '';
                        document.getElementById('addCategory').textContent = 'Submit'

                        let nopt = document.createElement('option')
                        nopt.setAttribute('value',response.id)
                        nopt.textContent = response.name
                        parent_id.appendChild(nopt)
                    }else{
                        toastr.error(response.error)
                    }
                }else{
                    response.errors.forEach(function(value){
                        toastr.error(value)
                    })
                }
            }
        });
    });

    
    
    let parent_id = document.getElementById('parent_id');
    
    let categories = {!! $categories !!}
    let opt;
    categories.forEach(function(value){

        opt = document.createElement('option');
        opt.setAttribute('value',value.id)
        opt.textContent = value.name
        parent_id.appendChild(opt)

    });


    






    

    
</script>
@endsection