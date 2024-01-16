@extends('admin.layout.app')
@section('content')


<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Edit Roles</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Roles</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-4">
                        <form  class="row g-3" action="{{ route('update.roles') }}" method="post">
                            @csrf

                            <input type="hidden" name="id" value="{{ $roles->id }}">

                            <div class="col-md-6">
                                <label for="input1" class="form-label">Roles Name </label>
                                <input type="text" name="name" class="form-control" value="{{ $roles->name }}" >
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Update Changes</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection