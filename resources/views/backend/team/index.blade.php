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
            <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#CreateNewTeam">Add Team</button>
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
                        <th>Postion</th>
                        <th>Facebook</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                    <tr>
                        <td>{{ $team->id }}</td>
                        <td>
                            <img src="{{ \App\Facades\ImageFacade::image($team->image) }}" alt="" style="width:70px; height:40px;" >
                        </td>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->postion }}</td>
                        <td>{{ $team->facebook }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-warning px-3 radius-30" data-bs-toggle="modal" data-bs-target="#EditTeam{{ $team->id }}">Edit</button>
                            <a href="#" class="btn btn-outline-danger px-3 radius-30" data-formid="{{ 'deleteTeam'.$team->id }}" id="delete">Delete</a>
                            <form action="{{ route('team.destroy' , ['team' => $team]) }}" method="post" id="deleteTeam{{ $team->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Team Modal -->
                    @include('backend.team.edit')
                    <!-- Edit Team Modal -->

                    @endforeach 
                    
                </tbody>

            </table>
        </div>
    </div>
</div>
    
<hr/>



    
<!-- Create New Team Modal -->
@include('backend.team.create')
<!-- Create New Team Modal -->

@endsection