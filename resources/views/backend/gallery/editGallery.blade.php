@extends('admin.layout.app')
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create Gallery</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('gallery.index') }}" class="btn btn-primary px-5">Gallery App</a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <form action="{{ route('gallery.update' , ['gallery' => $gallery]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label for="input5" class="form-label">Gallery Image</label>
                <input class="form-control mb-3" name="image" type="file" id="image">
            </div>

            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0"></h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <img id="showImage" src="{{ $gallery->images->url() }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="90">
                </div>
            </div>




            <div class="col-md-12  mt-3">
                <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Save Change</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection