<div class="d-flex flex-row-reverse">
    <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#CreateRoomNumber">Add Room Number</button>
</div>
<hr>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>SSL</th>
                        <th>Room Number</th>
                        <th>Status</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($room->roomnumber as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->room_number }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                {{-- <a href="{{ route('team.edit' , ['team' => $team]) }}" class="btn btn-warning px-3 radius-30"> Edit</a> --}}
                                <button type="button" class="btn btn-outline-warning px-3 radius-30" data-bs-toggle="modal" data-bs-target="#EditRoomNumber{{ $item->id }}">Edit</button>
                                <a href="#" class="btn btn-outline-danger px-3 radius-30" data-formid="{{ 'deleteRoomNumber'.$item->id }}" id="delete">Delete</a>
                                <form action="{{ route('room.roomnumber.destroy' , [$room, $item]) }}" method="post" id="deleteRoomNumber{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        
                        <div class="modal fade" id="EditRoomNumber{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    
                                    <div class="modal-body text-white">
                                        <form action="{{ route('room.roomnumber.update' , [$room, $item]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                        
                                            <div class="card-body p-4">
                                                <h5 class="mb-4">Edit Room Number</h5>
                        
                                                <div class="row mb-3">
                                                    <label for="input35" class="col-sm-3 col-form-label">Room Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="room_number" class="form-control" value="{{ $item->room_number }}" />
                                                    </div>
                                                </div>
                        
                                                <div class="row mb-3">
                                                    <label for="input35" class="col-sm-3 col-form-label">Room Active</label>
                                                    <div class="col-sm-9">
                                                        <select id="input9" class="form-select" name="status">
                                                            <option selected="">Choose...</option>
                                                            <option value="Active" {{ $item->status == 'active' ? 'selected' : ''}}>Active</option>
                                                            <option value="InActive" {{ $item->status == 'in_active' ? 'selected' : ''}}>InActive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                        
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label"></label>
                                                    <div class="col-sm-9">
                                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                                            <button type="submit" class="btn btn-primary px-4">Update Room Number</button>
                                                        </div>
                                                    </div>
                                                </div>
                        
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    




<!--========== Start Room Number ==============-->
<div class="modal fade" id="CreateRoomNumber" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            
            <div class="modal-body text-white">
                <form action="{{ route('room.roomnumber.store' , $room) }}" method="post">
                    @csrf

                    <div class="card-body p-4">
                        <h5 class="mb-4">Add New Room Number</h5>

                        <div class="row mb-3">
                            <label for="input35" class="col-sm-3 col-form-label">Enter Room Number</label>
                            <div class="col-sm-9">
                                <input type="text" name="room_number" class="form-control" placeholder="Enter Room Number" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="input35" class="col-sm-3 col-form-label">Room Active</label>
                            <div class="col-sm-9">
                                <select id="input9" class="form-select" name="status">
                                    <option selected="">Choose...</option>
                                    <option value="active">Active</option>
                                    <option value="in_active">InActive</option>
                                </select>
                            </div>
                        </div>
                        

                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<!--========== End Room Number ==============-->