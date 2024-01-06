@extends('layout.app')

@section('title', 'Performance Management System')
@section('content')

<div class="mt-3"> 
        <button class="btn btn-primary">Create New Version</button> 
</div>  
<div class=" row bg-white mt-2"> 
    <div class="col "> 
        <select name="" id="" class="form-select"  > 
            <option value="">Version 2023 [Default]</option>
            <option value="">Version 2024</option>
            <option value="">Version 2025</option>
             </select>
    </div>
<div class="col "> 
    <button class="btn btn-success">Set as Default</button>
</div>
</div>
 <div class="card mt-2">
    <div class="card-header bg-primary">
        <h6 class="card-title mt-1 text-white">Preview</h6>
    </div> 
    <div class="card-body">  
        <div class="col-4 mb-2">
            <select name="" id="" class="form-select"  > 
                <option value="">Rank and File Level</option>
                <option value="">Supervisory/Officer Level</option>
            </select>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Indicators</th>
                    <th colspan="2" class="text-center">Ratings</th>
                </tr>
                <tr> 
                    <th>PART I. VALUES INDICATOR</th> 
                    <th colspan="2"class="text-center"><i>WEIGHT (100%)</i></th>
                </tr>
                <tr>
                    <th>1.COMPETENT (15%)</th>
                    <th class="text-center">RATEE</th>
                    <th class="text-center">RATER</th>
                </tr>
            </thead>
           
 
        </table>
    </div>
 </div>


<script>
    $(document).ready(function() {
        $('.list-unstyled.CTAs li').removeClass('active');
        $('#settings').addClass('active');
    });

</script>
@endsection
