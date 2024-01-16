@extends('admin.layout.app')
@section('content')

    <div class="card">
        <div class="card-body p-4">

            <form action="{{ (request()->path() === 'blogpost/create') ? route('blogpost.store') : route('blogpost.update' , ['blogpost' => $blogpost]) }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf
                @if (request()->path() !== 'blogpost/create')
                    @method('PUT')
                @endif


                <div class="col-md-6">
                    <label for="input7" class="form-label">Blog Category</label>
                    <select id="input7" class="form-select" name="blogcat">
                        {{-- @if (request()->path() !== 'blogpost/create')
                            <option value="{{ $blogpost->blog_categorie_id  }}" selected="{{ $blogpost->blog_categorie_id  }}">{{ $blogpost->blogcat->CategoryName }}</option>
                        @endif --}}
                        <option selected >Select Category</option>
                        @foreach ($category as $cat)
                            <option value="{{ $cat->id }}" {{ ($blogpost->blog_categorie_id ?? null) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->CategoryName }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="input1" class="form-label">Post Title</label>
                    <input type="text" class="form-control" id="input1" name="PostTitile" value="{{ $blogpost->PostTitile ?? null }}">
                </div>

                <div class="col-md-12">
                    <label for="input11" class="form-label">Short Description</label>                    
                    <textarea class="form-control" name="ShortDesc" id="input11" rows="3">{{ $blogpost->ShortDesc ?? null }}</textarea>
                </div>

                <div class="col-md-12">
                    <label for="input11" class="form-label">Post Description</label>
                    <textarea class="form-control" name="LongDesc" {{-- id="input11" rows="3" --}} id="myeditorinstance" >{!! $blogpost->LongDesc ?? null !!}</textarea>
                </div>


                <div class="col-md-6">
                    <label for="input11" class="form-label">Photo</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="photo" type="file" id="image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-sm-9 text-secondary mt-3">
                        <img id="showImage" src="{{ ($blogpost->images ?? null) ? $blogpost->images->url() : url('no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80">
                    </div>
                </div>
                
                
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">{{ (request()->path() == 'blogpost/create') ? "Create New BlogPost" : 'Update BlogPost' }}</button>
                    </div>
                </div>

            </form>
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