 @extends('layout.app')

 @section('title', 'Performance Management System')
 <select class="js-example-basic-single">
     <option value="option1">Option 1</option>
     <option value="option2">Option 2</option>
     <!-- Add more options as needed -->
 </select>

 @section('content')
     <script>
         $(document).ready(function() {
             $('.js-example-basic-single').select2();
         });
     </script>
 @endsection
