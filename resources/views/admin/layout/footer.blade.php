<!-- Bootstrap JS -->
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
{{-- Jquery Render In Head --}}
<script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/chartjs/js/chart.js') }}"></script>
{{-- DataTable --}}
<script src="{{ asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
{{-- DataTable --}}
<script src="{{ asset('backend/assets/js/index.js') }}"></script>
<!--app JS-->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>
{{-- Sweet Alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('backend/assets/js/code.js')}}"></script>

{{-- Tiny Text Are --}}
<script src="{{ asset('backend/assets/js/tinycdn.min.js') }}" referrerpolicy="origin"></script>
<script>
   tinymce.init({
     selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
     plugins: 'powerpaste advcode table lists checklist',
     toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
   });
</script>
{{-- Tiny Text Are --}}
<script>
    new PerfectScrollbar(".app-container")
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
      });
</script>

{{-- Display Images When Uploade --}}
<script type="text/javascript">
  $(document).ready(function(){
      $('#image').change(function(e){
          var reader = new FileReader();
          reader.onload = function(e){
            $('#showImage').attr('src',e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
      });

      $('#imageOnCreate').change(function(e){
          var reader = new FileReader();
          reader.onload = function(e){
            $('#showImageOnCreate').attr('src',e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
      });
  });

</script>
{{-- Display Images When Uploade --}}


{{-- Toster Js --}}
<script type="text/javascript" src="{{ asset('gassets/js/toastr.js') }}"></script>
<script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type','info') }}"
  switch(type){
     case 'info':
     toastr.info(" {{ Session::get('message') }} ");
     break;
 
     case 'success':
     toastr.success(" {{ Session::get('message') }} ");
     break;
 
     case 'warning':
     toastr.warning(" {{ Session::get('message') }} ");
     break;
 
     case 'error':
     toastr.error(" {{ Session::get('message') }} ");
     break; 
  }
  @endif 
 </script>
{{-- Toster Js --}}

</body>

</html>

