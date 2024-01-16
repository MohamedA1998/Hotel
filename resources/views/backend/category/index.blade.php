@extends('admin.layout.app')
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All Blog Category</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#CreateNewCategory">Add New Category</button>
            {{-- <a href="{{ route('team.create') }}" class="btn btn-primary px-5">Add Team </a> --}}
        </div>
    </div>
</div>
<!--end breadcrumb-->

<hr/>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Category Name </th>
                        <th>Category Slug</th> 
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $categorie ) 
                    <tr>
                        <td>{{ $categorie->id }}</td> 
                        <td>{{ $categorie->CategoryName }}</td>
                        <td>{{ $categorie->CategorySlug }}</td> 
                        <td>
                            <button type="button" class="btn btn-outline-warning px-3 radius-30" data-bs-toggle="modal" data-bs-target="#EditCategorie{{ $categorie->id }}">Edit</button>
                            <a onclick="event.preventDefault();document.getElementById('deleteCategorie{{ $categorie->id }}').submit()" href="#" class="btn btn-outline-danger px-3 radius-30" id="delete">Delete</a>
                            <form action="{{ route('blogCategorie.destroy' , ['blogCategorie' => $categorie]) }}" method="post" id="deleteCategorie{{ $categorie->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    <!-- Edit Team Modal -->
                    <div class="modal fade" id="EditCategorie{{ $categorie->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                
                                <div class="modal-body text-white">
                                    <form action="{{ route('blogCategorie.update' , ['blogCategorie' => $categorie]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                    
                                        <div class="card-body p-4">
                                            <h5 class="mb-4">Edit Category</h5>
                                            <div class="row mb-3">
                                                <label for="input35" class="col-sm-3 col-form-label">CategoryNmae</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="CategoryName" class="form-control" value="{{ $categorie->CategoryName }}" />
                                                </div>
                                            </div>
                    
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                                        <button type="submit" class="btn btn-primary px-4">Update</button>
                                                        <button type="reset" class="btn btn-light px-4">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Edit Team Modal -->
                    @endforeach                     
                   
                </tbody>
                
            </table>
        </div>
    </div>
</div>
    
<hr/>



    
<!-- Create New Team Modal -->
<div class="modal fade" id="CreateNewCategory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            
            <div class="modal-body text-white">
                <form action="{{ route('blogCategorie.store') }}" method="post">
                    @csrf

                    <div class="card-body p-4">
                        <h5 class="mb-4">Create New Category</h5>
                        <div class="row mb-3">
                            <label for="input35" class="col-sm-3 col-form-label">CategoryNmae</label>
                            <div class="col-sm-9">
                                <input type="text" name="CategoryName" class="form-control" />
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Create</button>
                                    <button type="reset" class="btn btn-light px-4">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- Create New Team Modal -->


@endsection