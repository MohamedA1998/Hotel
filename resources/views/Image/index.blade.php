@extends('image.layoute')
@section('content')
<form id="myAwesomeDropzone" class="dropzone">
    @csrf
    <div class="dz-preview dz-file-preview"></div> <!-- this is were the previews should be shown. -->
    
    <!-- Now setup your input fields -->
    <input type="email" name="username" />
    {{-- <input type="password" name="password" /> --}}
  
    <button type="submit">Submit data and files!</button>
  </form>
@endsection

@push('script')
<script>
    new Dropzone("#myAwesomeDropzone" , { // The camelized version of the ID of the form element
    url:"{{ route('image.store') }}",
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 100,
    addRemoveLinks:true,


// The setting up of the dropzone
init: function() {
  var myDropzone = this;

  // First change the button to actually tell Dropzone to process the queue.
//   this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
//     // Make sure that the form isn't actually being sent.
//     e.preventDefault();
//     e.stopPropagation();
//     myDropzone.processQueue();
//   });
  $("#myAwesomeDropzone button[type=submit]").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        myDropzone.processQueue();
  })

  // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
  // of the sending event because uploadMultiple is set to true.
  this.on("sendingmultiple", function() {
    // Gets triggered when the form is actually being sent.
    // Hide the success button or the complete form.
  });
  this.on("successmultiple", function(files, response) {
    // Gets triggered when the files have successfully been sent.
    // Redirect user or notify of success.
  });
  this.on("errormultiple", function(files, response) {
    // Gets triggered when there was an error sending the files.
    // Maybe show form again, and notify user of error
  });
}

});
</script>
@endpush