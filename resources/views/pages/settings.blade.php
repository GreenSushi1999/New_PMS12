@extends('layout.app')

@section('title', 'Performance Management System')
@section('content')

 <div class="mt-2 row justify-content-between">  
    <div class="col">
        <button class="btn btn-primary">Create Version</button> 
    </div>
   <div class="col d-flex justify-content-end">
    <button class="btn btn-success">Set as Default </button>
   </div>
 </div>
<div class="bg-white mt-2">   
    <select name="version" id="versionSelect" class="form-select">
        @foreach ($version as $v)
        <option value="{{$v->cid}}" {{$v->status == 1 ?  'selected': '' }}>{{$v->ver_name}} {{$v->status == 1 ? '[Default]' : ''}}</option>
        @endforeach
    </select>
</div>
 <div class="card mt-2">
    <div class="card-header bg-primary">
        <h6 class="card-title mt-1 text-white">Preview</h6>
    </div> 
    <div class="card-body">  
        <div class="col mb-2">
            <select name="document" id="documentSelect" class="form-select"> 
                <option value="" selected disabled>Select</option>
                @foreach ($document as $d)
                <option value="{{$d->cid}}">{{$d->doc_name}}</option>
                @endforeach
            </select>
        </div>
        <table id="tval" class="table table-bordered">
            <thead  >
           
           <tbody>
     
           </tbody>
        </table> 
        <table class="table table-bordered"  >
            <thead>
            <tr><th colspan="3" class="text-center">PART II. RATEE’S ACHIEVEMENT/S FOR THIS PERIOD (Ratee and Rater may write inputs)</th></tr> 
            </thead>
            <tbody>
                <tr>
                    <td colspan="3">1</td>
                </tr>
                <tr>
                    <td colspan="3">2</td>
                </tr>
                <tr>
                    <td colspan="3">3</td>
                </tr>
                <tr>
                    <td colspan="3">4</td>
                </tr>
                <tr>
                    <td colspan="3">5</td>
                </tr>
            </tbody>
        </table> 
        <table class="table table-bordered"  >
            <thead>
                <tr><th class="text-center" colspan="2">PART III. RATER'S COMMENTS AND RECOMMENDATIONS (Areas to Improve, Action Plan, among others)</th></tr>
                <tr>
                    <th style="width:320px;" class="text-center">AREA/S FOR IMPROVEMENT</th>
                    <th  class="text-center">ACTION PLAN</th>
                </tr> 
            </thead>
            <tbody>
                <tr>
                   <td style="height:250px;"></td> 
                   <td></td>
                </tr> 
            </tbody>
        </table>  
         <table class="table">
            <thead>
                <tr >
                    <td colspan="3"><b>Agreement </b>(To be accomplished by the Ratee and the Rater. <b>Tick</b> yes or no for your answer)</td>
                </tr>
            </thead>
            <tbody>
                @php
                $counter = 1;
                @endphp
                @foreach ($agreement as $a)
                <tr>
                    <td>
                        {{ chr($counter + 96) }}.  {{$a->agreement}}
                    </td>
                    <td>Yes <input type="checkbox" class="form-check-input"></td>
                    <td>No <input type="checkbox" class="form-check-input"></td>
                </tr>
                @php
                $counter++;
            @endphp
                @endforeach
              
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
<script>
    $(document).ready(function() {
        // Handle change event for the version select dropdown
        $('#versionSelect, #documentSelect').change(function() {
            var selectedVersion = $('#versionSelect').val();
            var selectedDocument = $('#documentSelect').val();
            
            // Make an Ajax call only if both version and document are selected
            if (selectedVersion && selectedDocument) {
                $.ajax({
                    url: '{{ route('fetch-values') }}',
                    method: 'GET',
                    data: {
                        version: selectedVersion,
                        document: selectedDocument
                    },
                    success: function(response) {
                        var tbody = $('#tval tbody');
                        tbody.empty();

                        var thead = $('#tval thead');
                        thead.empty(); 
                        var footer = '<tr>' +
                            '<td><b>OVERALL WEIGHTED AVERAGE</b></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><b>FINAL RANKING</b></td>' +
                            '<td colspan="2"></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><b>VERBAL INTERPRETATION</b></td>' +
                            '<td colspan="2"></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th colspan="3"></th>' +
                            '</tr>';

                        // Generate the table header
                        thead.append('<tr>' +
                            '<th class="text-center">Indicators</th>' +
                            '<th colspan="2" class="text-center">Ratings</th>' +
                            '</tr>' +
                            '<tr>' +
                            '<th>PART I. VALUES INDICATOR</th>' +
                            '<th colspan="2" class="text-center"><i>WEIGHT (100%)</i></th>' +
                            '</tr>');

                        // Generate the table body
                        $.each(response, function(index, value) {
                            var row = '<tr>' +
                                '<th>' + (index + 1) + '. ' + value.value + ' (' + value.percentage + '%)</th>' +
                                '<th class="text-center">RATEE</th>' +
                                '<th class="text-center">RATER</th>' +
                                '</tr>';

                            $.each(value.criteria, function(i, criteria) {
                                row += '<tr>' +
                                    '<td>' + String.fromCharCode(97 + i) + '. ' + criteria.criteria +
                                    (criteria.remarks == 1 ? '<br> Remarks:' : '') +
                                    '</td>' +
                                    '<td></td>' +
                                    '<td></td>' +
                                    '</tr>';
                            });

                            if (value.critical_incident == 1) {
                                row += '<tr>' +
                                    '<td rowspan="2">Critical Incident:</td>' +
                                    '<td colspan="2" class="text-center"> Average x '+ value.percentage +'% </td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td></td>' +
                                    '<td></td>' +
                                    '</tr>';
                            }

                            tbody.append(row);  
                            tbody.append(footer);
                        });
                 
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    });
</script>



 
@endsection
