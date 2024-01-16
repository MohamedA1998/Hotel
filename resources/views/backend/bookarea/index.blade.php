@extends('admin.layout.app')
@section('content')


<div class="main-body">
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('bookarea.update' , ['bookarea' => $bookarea]) }}" method="POST" enctype="multipart/form-data">
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
                                <h6 class="mb-0">LinkUrl</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="LinkUrl" value="{{ $bookarea->LinkUrl }}">
                            </div>
                        </div>

                        {{-- image And Diplay It On Upload --}}
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Photo</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="file" name="photo" class="form-control" id="image" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0"></h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <img id="showImage" src="{{ $bookarea->images ? $bookarea->images->url() : asset('no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="90">
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