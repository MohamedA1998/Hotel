@extends('admin.layout.app')
@section('content')


<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">All Testimonial</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#CreateNewtestimonial">Add Testimonial</button>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>City</th>
                        {{-- <th>Message</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testimonials as $testimonial)
                    <tr>
                        <td>{{ $testimonial->id }}</td>
                        <td>
                            <img src="{{ $testimonial->images ? $testimonial->images->url() : '' }}" alt="" style="width:70px; height:40px;" >
                        </td>
                        <td>{{ $testimonial->name }}</td>
                        <td>{{ $testimonial->city }}</td>
                        {{-- <td>{{ $testimonial->message }}</td> --}}
                        <td>
                            <button type="button" class="btn btn-outline-warning px-3 radius-30" data-bs-toggle="modal" data-bs-target="#EditTestimonial{{ $testimonial->id }}">Edit</button>
                            <a onclick="event.preventDefault();document.getElementById('deleteTestimonial{{ $testimonial->id }}').submit()" href="#" class="btn btn-outline-danger px-3 radius-30" id="delete">Delete</a>
                            <form action="{{ route('testimonial.destroy' , ['testimonial' => $testimonial]) }}" method="post" id="deleteTestimonial{{ $testimonial->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Team Modal -->
                    @include('backend.testimonial.edit')
                    <!-- Edit Team Modal -->

                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>
    
<hr/>



    
<!-- Create New Team Modal -->
@include('backend.testimonial.create')
<!-- Create New Team Modal -->

<script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $('#imageOnCreate').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImageOnCreate').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection