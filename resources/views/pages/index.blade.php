 @extends('layout.app')

 @section('title', 'Performance Management System')
 @section('content')

     <nav class="mt-3">
         <div class="nav nav-tabs" id="nav-tab" role="tablist">
             <button class="nav-link active" id="nav-ratee-tab" data-bs-toggle="tab" data-bs-target="#nav-ratee" type="button"
                 role="tab" aria-controls="nav-ratee" aria-selected="true"><i class="fa fa-user me-2"></i>Ratee</button>

             <button class="nav-link" id="nav-rater-tab" data-bs-toggle="tab" data-bs-target="#nav-rater" type="button"
                 role="tab" aria-controls="nav-rater" aria-selected="false"><i class='fas fa-user-tie me-2'></i>
                 Rater</button>
         </div>
     </nav>

     <div class="card bg-white p-2">
         <div class="tab-content" id="nav-tabContent">
             <div class="col-lg-11  tab-pane fade show active" id="nav-ratee" role="tabpanel"
                 aria-labelledby="nav-ratee-tab">
                 <div class="row">
                     <div class="col">
                         <div>
                             <button class="btn btn-primary btn-block" id="newForm" data-bs-toggle="modal"
                                 data-bs-target="#rateeForm_modal">New Form</button>
                         </div>

                     </div>
                     <div class="col">
                         <div class="d-flex justify-content-end">
                             <input type="text" class="form-control " style="max-width:300px;" placeholder="Search "
                                 name="searchPMS">
                         </div>
                     </div>
                 </div>

                 <div class="card mt-2  ">
                     <div class="card-header bg-primary">
                         <h6 class="text-white card-title mt-1">Ratee Forms</h6>
                     </div>
                     <div class="card-body p-2  " style="height:75vh;">
                         <div style="height:73vh;background:#D6D8DA;overflow:scroll;">

                             @foreach ($perf_ratee as $perform)
                                 <a href="/instruction/{{ $perform->cid }}/{{ $perform->ratee_cid }}">
                                     <div class="m-2 p-2 bg-success card col-lg-11 shadow-sm" style="cursor:pointer;">
                                         <span class="text-white" style="font-size:14px;">#{{ $perform->cid }} -
                                             {{ $perform->document->doc_name }} / Rater: {{ $perform->rater->Name }} /
                                             Period covered: {{ $perform->period_cover }} / Date Created:
                                             {{ $perform->created_at }}
                                         </span>
                                     </div>
                                 </a>
                             @endforeach


                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-lg-11  tab-pane fade  " id="nav-rater" role="tabpanel" aria-labelledby="nav-rater-tab">
                 <div class="row">
                     <div class="col">
                         <div class="">
                             <input type="text" class="form-control " placeholder="Search " name="searchPMS">
                         </div>
                     </div>
                 </div>

                 <div class="card mt-2  ">
                     <div class="card-header bg-primary">
                         <h6 class="text-white card-title mt-1">Ratee Forms</h6>
                     </div>
                     <div class="card-body p-2" style="height:75vh;">
                         <div style="height:73vh;background:#D6D8DA;overflow:scroll;">

                             @foreach ($perf_rater as $perform)
                                 <a href="/instruction/{{ $perform->cid }}/{{ $perform->ratee_cid }}">
                                     <div class="m-2 p-2 bg-success card col-lg-11 shadow-sm" style="cursor:pointer;">
                                         <span class="text-white" style="font-size:14px;">#{{ $perform->cid }} -
                                             {{ $perform->document->doc_name }} / Rater: {{ $perform->hr->Name }} /
                                             Period covered: {{ $perform->period_cover }} / Date Created:
                                             {{ $perform->created_at }}
                                         </span>
                                     </div>
                                 </a>
                             @endforeach

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="modal fade" id="rateeForm_modal" tabindex="-1" aria-labelledby="rateeFormModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header bg-primary text-white">
                     <h5 class="modal-title" id="exampleModalLabel">New Ratee Form</h5>
                     <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <form action="{{ route('save-info') }}" method="POST">
                         {{ csrf_field() }}
                         <div class="mb-3">
                             <label for="doc_type" class="form-label">Document Type:</label>
                             @if (Session::get('user')->hr->Head_Tag == 0)
                                 <input type="text" value="Rank And File Level" class="form-control" readonly>
                             @elseif (Session::get('user')->hr->Head_Tag == 1)
                                 <input type="text" value="Supervisory/Officer Level" class="form-control" readonly>
                             @endif
                         </div>

                         <div class="mb-3">
                             <label for="period_covered" class="form-label">Period Covered:</label>
                             <input type="text" class="form-control" id="period_covered" name="period_covered"
                                 placeholder="Period Covered" required>
                         </div>
                         <div class="mb-3">
                             <label for="rater" class="form-label">Rater:</label>
                             <select class="form-select" id="rater" name="rater" aria-label="Select input"
                                 required>
                                 <option selected>Select an option</option>
                                 @foreach ($raters->unique('Name') as $rater)
                                     <option value="{{ $rater->EmpNo }}">{{ $rater->Name }}</option>
                                 @endforeach
                             </select>

                         </div>
                         @if (Session::get('user')->hr->Head_Tag == 0)
                             <div class="mb-3">
                                 <label for="director" class="form-label">AVP-DIRECTOR / DIRECTOR / ASST.
                                     DIRECTOR
                                     :</label>
                                 <select class="form-select" id="director" name="director" aria-label="Select input"
                                     required>
                                     <option selected>Select an option</option>
                                     @foreach ($raters->unique('Name') as $rater)
                                         <option value="{{ $rater->EmpNo }}">{{ $rater->Name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                         @endif
                         <div class="mb-3">
                             <label for="op" class="form-label">OP / VPFA / VPAR:</label>
                             <select class="form-select " id="op" name="op" aria-label="Select input"
                                 required>
                                 <option selected disabled>Select an option</option>
                                 <option value="{{ $op->EmpNo }}">{{ $op->Name }}</option>
                                 <option value="{{ $vpar->EmpNo }}">{{ $vpar->Name }}</option>
                                 <option value="{{ $vpfa->EmpNo }}">{{ $vpfa->Name }}</option>

                             </select>
                         </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Submit</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>

     <script>
         $(document).ready(function() {
             $('#newForm').on('click', function() {
                 $('#ratee_modal').modal('hide');
             });
         });
     </script>

 @endsection
