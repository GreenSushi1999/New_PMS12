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
        <div class="row mb-2">  
            <div class="col col-7">
                <select name="document" id="documentSelect" class="form-select"> 
                    <option value="" selected disabled>Select</option>
                    @foreach ($document as $d)
                    <option value="{{$d->cid}}">{{$d->doc_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col col-5">
               <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editFile_modal"
               onlick="openEditFile" id="editFile">Edit File</button>
               
            </div>
        </div> 
        <div id="tablesContainer"></div>
    </div>
    
 </div>


 <div class="modal fade" id="editFile_modal" tabindex="-1" aria-labelledby="editFileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 

                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-values-tab" data-bs-toggle="tab" data-bs-target="#nav-values" type="button"
                        role="tab" aria-controls="nav-values" aria-selected="true"> <i class="fa fa-heart me-2"></i>Edit Values</button>
       
                    <button class="nav-link" id="nav-criteria-tab" data-bs-toggle="tab" data-bs-target="#nav-criteria" type="button"
                        role="tab" aria-controls="nav-criteria" aria-selected="false"><i class='fa fa-list me-2'></i>
                        Edit Criteria</button>
                </div>

                <div class="tab-content" id="nav-tabContent">
                    <div class="col-lg-11  tab-pane fade show active" id="nav-values" role="tabpanel"
                        aria-labelledby="nav-values-tab"> 
                     <div class="mt-3">
                        <button class="btn btn-primary text-white" id="openAddValues" type="button"> Add Value</button>
                     </div>
                </div>
                <div class="col-lg-11  tab-pane fade " id="nav-criteria" role="tabpanel"
                aria-labelledby="nav-criteria-tab">  

                <div class="mt-3">
                    <select name="value" id="indicatorSelect" class="select2 form-select">
                        <option value="" disabled selected>Select</option>
                    </select>
                </div>
               </div>
            </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                {{-- </form> --}}
            </div>
        </div>
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

                        var valuesData = response.values;
                        var agreementData = response.agreement;  

                        var tablesContainer = $('#tablesContainer'); 
                        var tablesData = '<table id="tval" class="table table-bordered"><thead></head><tbody></tbody></table> <table id="tachieve" class="table table-bordered"></table> <table id="tblrecommendation" class="table table-bordered"></table>  <table id="tblagree" class="table"></table>';
                        tablesContainer.empty();

                        // Check if response is not equal to 0
                        if (valuesData.length !== 0) {
                            tablesContainer.append(tablesData);

                            var tbody = $('#tval tbody');
                            var thead = $('#tval thead');
                            var AchieveTable = $('#tachieve');
                            var recommendationTable = $('#tblrecommendation');
                            var agreeTable = $('#tblagree');

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

                            var AchieveHead = '<thead><tr><th colspan="3" class="text-center">PART II. RATEE’S ACHIEVEMENT/S FOR THIS PERIOD (Ratee and Rater may write inputs)</th></tr></thead>';
                            var AchieveBody = '<tbody><tr><td colspan="3">1</td></tr><tr><td colspan="3">2</td></tr><tr><td colspan="3">3</td></tr><tr> <td colspan="3">4</td></tr><tr><td colspan="3">5</td></tr></tbody>';

                            var recommendationHead = '<thead>' +
                                '<tr>' +
                                '<th class="text-center" colspan="2">PART III. RATER\'S COMMENTS AND RECOMMENDATIONS (Areas to Improve, Action Plan, among others)</th>' +
                                '</tr>' +
                                '<tr>' +
                                '<th style="width:320px;" class="text-center">AREA/S FOR IMPROVEMENT</th>' +
                                '<th class="text-center">ACTION PLAN</th>' +
                                '</tr>' +
                                '</thead>';

                            var recommendationBody = '<tbody>' +
                                '<tr>' +
                                '<td style="height:250px;"></td>' +
                                '<td></td>' +
                                '</tr>' +
                                '</tbody>';

                            var agreeHead = '<thead>' +
                                '<tr>' +
                                '<td colspan="3"><b>Agreement </b>(To be accomplished by the Ratee and the Rater. <b>Tick</b> yes or no for your answer)</td>' +
                                '</tr>' +
                                '</thead>';

                            var agreeBody = '<tbody id="tblagreeBody">';
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($agreement as $a)
                                agreeBody += '<tr>' +
                                    '<td>' +
                                    '{{ chr($counter + 96) }}.  {{$a->agreement}}' +
                                    '</td>' +
                                    '<td>Yes <input type="checkbox" class="form-check-input"></td>' +
                                    '<td>No <input type="checkbox" class="form-check-input"></td>' +
                                    '</tr>';
                                @php
                                    $counter++;
                                @endphp
                            @endforeach
                            agreeBody += '</tbody>';

                            thead.append('<tr>' +
                                '<th class="text-center">Indicators</th>' +
                                '<th colspan="2" class="text-center">Ratings</th>' +
                                '</tr>' +
                                '<tr>' +
                                '<th>PART I. VALUES INDICATOR</th>' +
                                '<th colspan="2" class="text-center"><i>WEIGHT (100%)</i></th>' +
                                '</tr>');

                            // Generate the table body
                            $.each(valuesData, function(index, value) {
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
                                        '<td colspan="2" class="text-center"> Average x ' + value.percentage + '% </td>' +
                                        '</tr>' +
                                        '<tr>' +
                                        '<td></td>' +
                                        '<td></td>' +
                                        '</tr>';
                                }

                                tbody.append(row);
                            });

                            tbody.append(footer);
                            AchieveTable.append(AchieveHead);
                            AchieveTable.append(AchieveBody);
                            recommendationTable.append(recommendationHead);
                            recommendationTable.append(recommendationBody);
                            agreeTable.append(agreeHead);
                            agreeTable.append(agreeBody);
                        }
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
