@extends('layout.app')

@section('title', 'Performance Management System')
@section('content')

<div class="mt-3"> 
        <button class="btn btn-primary">Create New Version</button> 
</div>  
<div class=" row bg-white mt-2"> 
    <div class="col"> 
        <select name="" id="" class="form-select"  > 
            <option value="">Version 2023 [Default]</option>
            <option value="">Version 2024</option>
            <option value="">Version 2025</option>
             </select>
    </div>
<div class="col"> 
    <button class="btn btn-success">Set as Default</button>
</div>
</div>
 <div class="card mt-2">
    <div class="card-header bg-primary">
        <h6 class="card-title mt-1 text-white">Preview</h6>
    </div> 
    <div class="card-body">
        
    </div>
 </div>


<script>
    $(document).ready(function() {
        $('.list-unstyled.CTAs li').removeClass('active');
        $('#settings').addClass('active');
    });

</script>
@endsection
