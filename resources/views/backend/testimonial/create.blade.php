<div class="modal fade" id="CreateNewtestimonial" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            
            <div class="modal-body text-white">
                <form action="{{ route('testimonial.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body p-4">
                        <h5 class="mb-4">Add New testimonial</h5>
                        <div class="row mb-3">
                            <label for="input35" class="col-sm-3 col-form-label">Enter Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Enter Name" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input36" class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                                <input type="text" name="city"  class="form-control" placeholder="Enter City" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input37" class="col-sm-3 col-form-label">Message</label>
                            <div class="col-sm-9">
                                <textarea name="message" class="form-control" cols="30" rows="4"></textarea>
                                {{-- <input type="text" name="message" class="form-control" placeholder="Enter Message" /> --}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="input38" class="col-sm-3 col-form-label">Photo</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="photo" type="file" id="imageOnCreate">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0"></h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <img id="showImageOnCreate" src="{{ url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="90">
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
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