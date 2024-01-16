@extends('admin.layout.app')
@section('content')

<div class="card">
    <div class="card-body">
        
        <ul class="nav nav-tabs nav-primary" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#ManageRoom" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Manage Room</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#RoomNumber" role="tab" aria-selected="false" tabindex="-1">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Room Number</div>
                    </div>
                </a>
            </li>

        </ul>

        <div class="tab-content py-3">
            {{-- Manage Room --}}
            <div class="tab-pane fade active show" id="ManageRoom" role="tabpanel">

                <div class="col-xl-12 mx-auto">

                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="mb-4">Update Room</h5>
                            <form action="{{ route('room.update' , ['room' => $room]) }}" method="POST" class="row g-3" enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')

                                <div class="col-md-4">
                                    <label for="input1" class="form-label">Room Type Name</label>
                                    <input type="text" name="room_type_id" value="{{ $room->roomType->name }}" class="form-control" id="input1" >
                                </div>
                                <div class="col-md-4">
                                    <label for="input2" class="form-label">Total Adult</label>
                                    <input type="text" name="total_adult" value="{{ $room->total_adult }}" class="form-control" id="input2" >
                                </div>
                                <div class="col-md-4">
                                    <label for="input3" class="form-label">Total Child</label>
                                    <input type="text" name="total_child" value="{{ $room->total_child }}" class="form-control" id="input3" >
                                </div>


                                <div class="col-md-6">
                                    <label for="input4" class="form-label">Main Image</label>
                                    <input type="file" name="image" class="form-control" id="image" >
                                    <img id="showImage" src="{{ !empty($room->image) ? $room->imageurl() : asset('no_image.jpg') }}" alt="Admin" class="bg-primary" width="60">
                                </div>

                                <div class="col-md-6">
                                    <label for="input5" class="form-label">Gallery Image</label>
                                    <input type="file" name="images[]" class="form-control" id="multiImg" multiple accept="image/jpeg , image/jpg , image/gif , image/png">
                                    
                                    @foreach ($room->images as $image)
                                        <img src="{{ $image->url() }}" alt="Admin" class="bg-primary" width="60">
                                        <a href="{{ route('room.delete.image' , ['image' => $image->id]) }}"><i class="lni lni-close"></i></a>
                                    @endforeach
                                </div>
                                
                                

                                <div class="col-md-3">
                                    <label for="input1" class="form-label">Room Price</label>
                                    <input type="text" name="price" value="{{ $room->price }}" class="form-control" id="input1" >
                                </div>
                                <div class="col-md-3">
                                    <label for="input1" class="form-label">Room Size</label>
                                    <input type="text" name="size" value="{{ $room->size }}" class="form-control" id="input1" >
                                </div>
                                <div class="col-md-3">
                                    <label for="input2" class="form-label">Discount(%)</label>
                                    <input type="text" name="discount" value="{{ $room->discount }}" class="form-control" id="input2" >
                                </div>
                                <div class="col-md-3">
                                    <label for="input3" class="form-label">Room Capacity</label>
                                    <input type="text" name="room_capacity" value="{{ $room->room_capacity }}" class="form-control" id="input3" >
                                </div>


                                <div class="col-md-6">
                                    <label for="input9" class="form-label">Room View</label>
                                    <select id="input9" class="form-select" name="view">
                                        <option selected="">Choose...</option>
                                        <option value="See View"  {{$room->view == 'See View'?'selected':''}}>See View</option>
                                        <option value="Hill View" {{$room->view == 'Hill View'?'selected':''}}>Hill View</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="input9" class="form-label">Bed Style</label>
                                    <select id="input9" class="form-select" name="bed_style">
                                        <option selected="">Choose...</option>
                                        <option value="Queen Bed" {{$room->bed_style == 'Queen Bed'?'selected':''}}>Queen Bed</option>
                                        <option value="Twin Bed"  {{$room->bed_style == 'Twin Bed'?'selected':''}}>Twin Bed</option>
                                        <option value="King Bed"  {{$room->bed_style == 'King Bed'?'selected':''}}>King Bed</option>
                                    </select>
                                </div> 

                                
                                <div class="col-md-12">
                                    <label for="input11" class="form-label">Short Description</label>
                                    <textarea name="short_desc" class="form-control" id="input11" rows="3">{{ $room->short_desc }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="input11" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="myeditorinstance" rows="3">{!! $room->description  !!}</textarea>
                                </div>


                                 <div class="row mt-2">
                                    <div class="col-md-12 mb-3">
                                        @forelse ($room->facility as $item)
                                            <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                                                <div class="row add_item">
                                                    <div class="col-md-8">
                                                        <label for="facility_name" class="form-label"> Room Facilities </label>
                                                        <select name="facility_name[]" id="facility_name" class="form-control">
                                                            <option value="">Select Facility</option>
                                                            <option value="Complimentary Breakfast" {{$item->facility_name == 'Complimentary Breakfast'?'selected':''}}>Complimentary Breakfast</option>
                                                            <option value="32/42 inch LED TV"  {{$item->facility_name == '32/42 inch LED TV'?'selected':''}}> 32/42 inch LED TV</option>
                                                            <option value="Smoke alarms"  {{$item->facility_name == 'Smoke alarms'?'selected':''}}>Smoke alarms</option>
                                                            <option value="Minibar" {{$item->facility_name == 'Minibar'?'selected':''}}> Minibar</option>
                                                            <option value="Work Desk"  {{$item->facility_name == 'Work Desk'?'selected':''}}>Work Desk</option>
                                                            <option value="Free Wi-Fi" {{$item->facility_name == 'Free Wi-Fi'?'selected':''}}>Free Wi-Fi</option>
                                                            <option value="Safety box" {{$item->facility_name == 'Safety box'?'selected':''}} >Safety box</option>
                                                            <option value="Rain Shower" {{$item->facility_name == 'Rain Shower'?'selected':''}} >Rain Shower</option>
                                                            <option value="Slippers" {{$item->facility_name == 'Slippers'?'selected':''}} >Slippers</option>
                                                            <option value="Hair dryer" {{$item->facility_name == 'Hair dryer'?'selected':''}} >Hair dryer</option>
                                                            <option value="Wake-up service"  {{$item->facility_name == 'Wake-up service'?'selected':''}}>Wake-up service</option>
                                                            <option value="Laundry & Dry Cleaning" {{$item->facility_name == 'Laundry & Dry Cleaning'?'selected':''}} >Laundry & Dry Cleaning</option>
                                                            <option value="Electronic door lock"  {{$item->facility_name == 'Electronic door lock'?'selected':''}}>Electronic door lock</option> 
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group" style="padding-top: 30px;">
                                                            <a class="btn btn-success addeventmore"><i class="lni lni-circle-plus"></i></a>
                                                            <span class="btn btn-danger btn-sm removeeventmore"><i class="lni lni-circle-minus"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                                                <div class="row add_item">
                                                    <div class="col-md-6">
                                                        <label for="facility_name" class="form-label">Room Facilities </label>
                                                        <select name="facility_name[]" id="basic_facility_name" class="form-control">
                                                            <option value="">Select Facility</option>
                                                            <option value="Complimentary Breakfast">Complimentary Breakfast</option>
                                                            <option value="32/42 inch LED TV" > 32/42 inch LED TV</option>
                                                            <option value="Smoke alarms" >Smoke alarms</option>
                                                            <option value="Minibar"> Minibar</option>
                                                            <option value="Work Desk" >Work Desk</option>
                                                            <option value="Free Wi-Fi">Free Wi-Fi</option>
                                                            <option value="Safety box" >Safety box</option>
                                                            <option value="Rain Shower" >Rain Shower</option>
                                                            <option value="Slippers" >Slippers</option>
                                                            <option value="Hair dryer" >Hair dryer</option>
                                                            <option value="Wake-up service" >Wake-up service</option>
                                                            <option value="Laundry & Dry Cleaning" >Laundry & Dry Cleaning</option>
                                                            <option value="Electronic door lock" >Electronic door lock</option> 
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="padding-top: 30px;">
                                                            <a class="btn btn-success addeventmore"><i class="lni lni-circle-plus"></i></a>

                                                            <span class="btn btn-danger removeeventmore"><i class="lni lni-circle-minus"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div> 
                                </div>
                                <br>


                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Save Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>





            </div>
            {{-- // End Manage Room --}}
            

            {{-- Room Number --}}
            <div class="tab-pane fade" id="RoomNumber" role="tabpanel">
                @include('backend.allroom.rooms.roomnumber')
            </div>
            {{-- End Room Number --}}
        </div>

    </div>
</div>



<!--------===Show MultiImage Image ========------->
<script>
   $(document).ready(function(){
    $('#multiImg').on('change', function(){ //on file input change
       if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
       {
           var data = $(this)[0].files; //this file data
            
           $.each(data, function(index, file){ //loop though each file
               if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                   var fRead = new FileReader(); //new filereader
                   fRead.onload = (function(file){ //trigger function on successful read
                   return function(e) {
                       var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                   .height(80); //create image element 
                       $('#preview_img').append(img); //append image to output element
                   };
                   })(file);
                   fRead.readAsDataURL(file); //URL representing the file's data.
               }
           });
            
       }else{
           alert("Your browser doesn't support File API!"); //if File API is absent
       }
    });
   });
</script>
<!--------===End MultiImage Image ========------->

<!--========== Start of add Basic Plan Facilities ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
       <div class="basic_facility_section_remove" id="basic_facility_section_remove">
          <div class="container mt-2">
             <div class="row">
                <div class="form-group col-md-6">
                   <label for="facility_name">Room Facilities</label>
                   <select name="facility_name[]" id="basic_facility_name" class="form-control">
                        <option value="">Select Facility</option>
                        <option value="Complimentary Breakfast">Complimentary Breakfast</option>
                        <option value="32/42 inch LED TV" > 32/42 inch LED TV</option>
                        <option value="Smoke alarms" >Smoke alarms</option>
                        <option value="Minibar"> Minibar</option>
                        <option value="Work Desk" >Work Desk</option>
                        <option value="Free Wi-Fi">Free Wi-Fi</option>
                        <option value="Safety box" >Safety box</option>
                        <option value="Rain Shower" >Rain Shower</option>
                        <option value="Slippers" >Slippers</option>
                        <option value="Hair dryer" >Hair dryer</option>
                        <option value="Wake-up service" >Wake-up service</option>
                        <option value="Laundry & Dry Cleaning" >Laundry & Dry Cleaning</option>
                        <option value="Electronic door lock" >Electronic door lock</option> 
                   </select>
                </div>
                <div class="form-group col-md-6" style="padding-top: 20px">
                   <span class="btn btn-success addeventmore"><i class="lni lni-circle-plus"></i></span>
                   <span class="btn btn-danger removeeventmore"><i class="lni lni-circle-minus"></i></span>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore",function(){
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
        });
        $(document).on("click",".removeeventmore",function(event){
                $(this).closest("#basic_facility_section_remove").remove();
                counter -= 1
        });
    });
</script>
<!--========== End of Basic Plan Facilities ==============-->
 
@endsection