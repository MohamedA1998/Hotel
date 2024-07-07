@extends('admin.layout.app')
@section('content')

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Room Type</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#CreateRoomType">Create Room Type</button>
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
                        <th>RoomType Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($RoomTypes as $item ) 
                    <tr>
                        <td>{{ $item->id }}</td> 
                        <td><img src="{{ \App\Facades\ImageFacade::first($item->room->image) }}" alt="" width="50" height="50"></td>
                        {{-- <td><img src="{{ count($item->room->images) > 0 ? $item->room->images->first()->url() : asset('no_image.jpg') }}" alt="" width="50" height="50"></td> --}}
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="{{ route('room.edit' , ['room' => $item->room]) }}" class="btn btn-outline-warning mx-2 px-3 radius-30">Edit</button>
                            <a href="#" class="btn btn-outline-danger px-3 radius-30" data-formid="{{ 'deleteRoomType'.$item->id }}" id="delete">Delete</a>
                            <form action="{{ route('type.destroy' , ['type' => $item]) }}" method="post" id="deleteRoomType{{ $item->id }}">
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



    
<!-- Create New Team Modal -->
<div class="modal fade" id="CreateRoomType" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            
            <div class="modal-body text-white">
                <form action="{{ route('type.store') }}" method="post">
                    @csrf

                    <div class="card-body p-4">
                        <h5 class="mb-4">Create Room Type</h5>
                        <div class="row mb-3">
                            <label for="input35" class="col-sm-3 col-form-label">Room Type Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" />
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