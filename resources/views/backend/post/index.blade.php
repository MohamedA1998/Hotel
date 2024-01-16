@extends('admin.layout.app')
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All Blog Post</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('blogpost.create') }}" class="btn btn-primary px-5">Create BlogPost</a>
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
                        <th>Post Titile</th>
                        <th>Blog Category</th>
                        <th>Post Image</th>
                        {{-- <th>Post Slug</th> 
                        <th>Short Descreption</th> 
                        <th>Long Descreption</th>  --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($BlogPosts as $BlogPost)
                    <tr>
                        <td>{{ $BlogPost->id }}</td>
                        <td>{{ $BlogPost->PostTitile }}</td>
                        <td>{{ $BlogPost->blogcat->CategoryName }}</td>
                        <td>
                            <img src="{{ $BlogPost->images ? $BlogPost->images->url() : '' }}" alt="" style="width:70px; height:40px;" >
                        </td>
                        
                        
                        {{-- <td>{{ $BlogPost->PostSlug }}</td> 
                        <td>{{ $BlogPost->ShortDesc }}</td> 
                        <td>{{ $BlogPost->LongDesc }}</td> --}}
                        <td>
                            <a href="{{ route('blogpost.edit' , ['blogpost' => $BlogPost]) }}" class="btn btn-outline-warning px-3 radius-30">Edit</a>
                            <a onclick="event.preventDefault();document.getElementById('deleteBlogPost{{ $BlogPost->id }}').submit()" href="#" class="btn btn-outline-danger px-3 radius-30" id="delete">Delete</a>
                            <form action="{{ route('blogpost.destroy' , ['blogpost' => $BlogPost]) }}" method="post" id="deleteBlogPost{{ $BlogPost->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach                     
                   
                </tbody>
                
            </table>
        </div>
    </div>
</div>
    
<hr/>

@endsection