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
        <div class="col mb-2">
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
           <tbody>
            <tr>
                <td>a. Freedom from errors and mistakes.</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>b. Exhibits breadth, depth and leadership of his/her area of expertise.</td> 
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>c. Produces useful and timely outputs and contributes to the attainment of objectives.</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    d. Mentors colleagues when needed.
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>e. Self-starter on professional development to maintain up-to-date knowledge of concepts and practices related to area of work. (Base on
                    employee's professional development effort such as attendance to trainings, and further studies.).</td> 
                    <td></td>
                    <td></td>
            </tr>
            <tr>
                <td rowspan="2">Critical Incident:</td>
              <td colspan="2" class="text-center"> Average x 0.15
              </td>
            </tr>
            <tr>
                <td></td> 
                <td></td>
              
            </tr>
            <tr>
                <td><b>OVERALL WEIGHTED AVERAGE</b></td> 
                <td></td>
                <td> </td>
            </tr>
            <tr>
                <td><b>FINAL RANKING</b></td> 
                <td colspan="2"></td>
            </tr>
            <tr>
                <td><b>VERBAL INTERPRETATION</b></td> 
                <td colspan="2"></td>
                 
            </tr>
           </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr><th class="text-center">PART II. RATEE’S ACHIEVEMENT/S FOR THIS PERIOD (Ratee and Rater may write inputs)</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                </tr>
                <tr>
                    <td>2</td>
                </tr>
                <tr>
                    <td>3</td>
                </tr>
                <tr>
                    <td>4</td>
                </tr>
                <tr>
                    <td>5</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr><th class="text-center" colspan="2">PART III. RATER'S COMMENTS AND RECOMMENDATIONS (Areas to Improve, Action Plan, among others)</th></tr>
                <tr><th class="text-center">AREA/S FOR IMPROVEMENT</th>
                    <th class="text-center">ACTION PLAN</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td style="height:240px;"></td>
                </tr>
            </tbody>
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
