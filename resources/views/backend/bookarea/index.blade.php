@extends('admin.layout.app')
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Manage BookArea</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            {{-- <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#CreateNewTeam">Add Team</button> --}}
        </div>
    </div>
</div>
<!--end breadcrumb-->

<hr>

<div class="main-body">
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('bookarea.update' , $bookarea) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">ShortTitle</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="ShortTitle" value="{{ $bookarea->ShortTitle }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">MainTitle</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="MainTitle" value="{{ $bookarea->MainTitle }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">ShortDesc</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <textarea type="text" class="form-control" name="ShortDesc" rows="5">{{ $bookarea->ShortDesc }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Photo</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="photo" value="{{ $bookarea->image }}">
                            </div>
                        </div>

                        {{-- image And Diplay It On Upload --}}
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Image</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="file" name="image" class="form-control" id="image" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0"></h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <img id="showImage" src="{{ \App\Facades\ImageFacade::image($bookarea->image) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="90">
                            </div>
                        </div>
                        {{-- image And Diplay It On Upload --}}


                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection