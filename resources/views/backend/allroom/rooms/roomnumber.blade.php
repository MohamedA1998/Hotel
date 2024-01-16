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
                            <td>{{ $item->RoomNumber }}</td>
                            <td>{{ $item->Status }}</td>
                            <td>
                                {{-- <a href="{{ route('team.edit' , ['team' => $team]) }}" class="btn btn-warning px-3 radius-30"> Edit</a> --}}
                                <button type="button" class="btn btn-outline-warning px-3 radius-30" data-bs-toggle="modal" data-bs-target="#EditRoomNumber{{ $item->id }}">Edit</button>
                                <a onclick="event.preventDefault();document.getElementById('deleteTeam{{ $item->id }}').submit()" href="#" class="btn btn-outline-danger px-3 radius-30" id="delete">Delete</a>
                                <form action="{{ route('roomnumber.destroy' , ['roomnumber' => $item]) }}" method="post" id="deleteTeam{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        
                        <div class="modal fade" id="EditRoomNumber{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    
                                    <div class="modal-body text-white">
                                        <form action="{{ route('roomnumber.update' , ['roomnumber' => $item]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                        
                                            <div class="card-body p-4">
                                                <h5 class="mb-4">Edit Room Number</h5>
                        
                                                <div class="row mb-3">
                                                    <label for="input35" class="col-sm-3 col-form-label">Room Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="RoomNumber" class="form-control" value="{{ $item->RoomNumber }}" />
                                                    </div>
                                                </div>
                        
                                                <div class="row mb-3">
                                                    <label for="input35" class="col-sm-3 col-form-label">Room Active</label>
                                                    <div class="col-sm-9">
                                                        <select id="input9" class="form-select" name="Status">
                                                            <option selected="">Choose...</option>
                                                            <option value="Active" {{ $item->Status == 'Active' ? 'selected' : ''}}>Active</option>
                                                            <option value="InActive" {{ $item->Status == 'InActive' ? 'selected' : ''}}>InActive</option>
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
                <form action="{{ route('roomnumber.store') }}" method="post">
                    @csrf

                    <div class="card-body p-4">
                        <h5 class="mb-4">Add New Room Number</h5>

                        <div class="row mb-3">
                            <label for="input35" class="col-sm-3 col-form-label">Enter Room Number</label>
                            <div class="col-sm-9">
                                <input type="text" name="RoomNumber" class="form-control" placeholder="Enter Room Number" />
                            </div>
                        </div>

                        <input type="hidden" name="RoomId" value="{{ $room->id }}">

                        <div class="row mb-3">
                            <label for="input35" class="col-sm-3 col-form-label">Room Active</label>
                            <div class="col-sm-9">
                                <select id="input9" class="form-select" name="Status">
                                    <option selected="">Choose...</option>
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
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