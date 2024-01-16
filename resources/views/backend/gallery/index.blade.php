@extends('admin.layout.app')
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All Team</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('gallery.create') }}" class="btn btn-primary px-5">Add Gallery</a>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<hr/>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <form action="{{ route('gallery.select') }}" method="POST">
                @csrf
                @method('delete')
                
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th width="50px">Select</th>
                        <th width="50px">Sl</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gallerys as $key => $gallery)
                    <tr> 
                        <td>
                            <input type="checkbox" name="selectedItem[]" value="{{ $gallery->id }}">
                        </td>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <img src="{{ $gallery->images ? $gallery->images->url() : '' }}" alt="" style="width:70px; height:40px;" >
                        </td>
                        <td>
                            <a href="{{ route('gallery.edit' , ['gallery' => $gallery]) }}" class="btn btn-warning px-3 radius-30">Edit</a>
                            <a onclick="event.preventDefault();document.getElementById('deletegallery{{ $gallery->id }}').submit()" href="#" class="btn btn-outline-danger px-3 radius-30" id="delete">Delete</a>
                            <form action="{{ route('gallery.destroy' , ['gallery' => $gallery]) }}" method="post" id="deletegallery{{ $gallery->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach 
                    
                </tbody>
                
                </table>
                
                <button type="submit" class="btn btn-danger">Delete Selected</button>
            </form>
        </div>
    </div>
</div>
    
<hr/>

@endsection