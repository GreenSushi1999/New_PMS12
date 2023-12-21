 @extends('layout.app')

 @section('title', 'Performance Management System')
 @section('content')


     <div class="container mt-5">
         <div class="row justify-content-center align-item-center">
             <div class="col-md-10  ">
                 <div class="card shadow">
                     <div class="card-header text-white bg-primary d-flex align-items-center justify-content-center">
                         <h4 class="card-title mt-2">Performance Management System</h4>
                     </div>
                     <div class="card-body">
                         <nav>
                             <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                 <button class="nav-link active" id="nav-ratee-tab" data-bs-toggle="tab"
                                     data-bs-target="#nav-ratee" type="button" role="tab" aria-controls="nav-ratee"
                                     aria-selected="true">Ratee</button>
                                 <button class="nav-link" id="nav-rater-tab" data-bs-toggle="tab"
                                     data-bs-target="#nav-rater" type="button" role="tab" aria-controls="nav-rater"
                                     aria-selected="false">Rater</button>
                                 @if (Session::get('user')->hr->Dept_ID == 2469 || Session::get('user')->hr->Dept_ID == 713)
                                     <button class="nav-link" id="nav-hcm-tab" data-bs-toggle="tab"
                                         data-bs-target="#nav-hcm" type="button" role="tab" aria-controls="nav-hcm"
                                         aria-selected="false">HCM</button>
                                 @endif
                             </div>
                         </nav>
                         <div class="tab-content" id="nav-tabContent">
                             <div class="tab-pane fade show active" id="nav-ratee" role="tabpanel"
                                 aria-labelledby="nav-ratee-tab">
                                 <div class="m-3">
                                     <button class="btn btn-primary text-white" data-bs-toggle="modal"
                                         data-bs-target="#rateeForm_modal" id="newForm"> New
                                         Form</button>
                                 </div>
                                 <div class="card m-3 shadow">
                                     <div class="card-header bg-primary ">
                                         <h6 class="text-white mt-1">Ratee Forms</h6>
                                     </div>
                                     <div class="card-body ">
                                         <div class="p-2"style="height:330px;background:#D6D8DA;overflow:auto;">

                                             @foreach ($perf_ratee as $perform)
                                                 <a href="/instruction/{{ $perform->cid }}/{{ $perform->ratee_cid }}">

                                                     <div class="p-2  m-2 bg-success rounded border border-white">
                                                         <p style="font-size:14px;" class="text-white">#
                                                             {{ $perform->cid }}
                                                             -
                                                             {{ $perform->document->doc_name }}

                                                             <br>
                                                             Last Updated : {{ $perform->updated_at }}
                                                         </p>

                                                     </div>

                                                 </a>
                                             @endforeach
                                         </div>
                                     </div>

                                 </div>
                             </div>

                             <div class="tab-pane fade" id="nav-rater" role="tabpanel" aria-labelledby="nav-rater-tab">
                                 <div class="m-3">
                                 </div>
                                 <div class="card m-3 shadow">
                                     <div class="card-header  " style="background:#001F3F;">
                                         <h6 class="text-white">Rater Forms</h6>
                                     </div>
                                     <div class="card-body ">
                                         <div class="p-2"style="height:330px;background:#D6D8DA;overflow:auto;">

                                             @foreach ($perf_rater as $perform)
                                                 <a href="/instruction/{{ $perform->cid }}/{{ $perform->ratee_cid }}">

                                                     <div class="p-2  m-2 bg-primary rounded border border-white">
                                                         <p style="font-size:14px;" class="text-white">#
                                                             {{ $perform->cid }}
                                                             -
                                                             {{ $perform->document->doc_name }}

                                                             <br>
                                                             Last Updated : {{ $perform->updated_at }}
                                                         </p>

                                                     </div>

                                                 </a>
                                             @endforeach
                                         </div>
                                     </div>

                                 </div>
                             </div>


                             <div class="tab-pane fade" id="nav-hcm" role="tabpanel" aria-labelledby="nav-hcm-tab">
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 @endsection

 {{-- ratee modal --}}


 <div class="modal fade" id="rateeForm_modal" tabindex="-1" aria-labelledby="rateeFormModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Ratee Information Form</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('save-info') }}" method="POST">
                     {{ csrf_field() }}
                     <div class="mb-3">
                         <label for="doc_type" class="form-label">Choose your Document Type:</label>
                         <select class="form-select" id="doc_type" name="doc_type" aria-label="Select input" required>
                             <option selected disabled>Select an option</option>

                             @foreach ($documents as $document)
                                 <option value="{{ $document->cid }}">{{ $document->doc_name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="mb-3">
                         <label for="name" class="form-label">Name:</label>
                         <input type="text" class="form-control" id="name" name="name"
                             placeholder="Lastname, Firstname" required>
                     </div>
                     <div class="mb-3">
                         <label for="position" class="form-label">Position:</label>
                         <input type="text" class="form-control" id="position" name="position"
                             placeholder="Position" required>
                     </div>
                     <div class="mb-3">
                         <label for="department" class="form-label">Department:</label>
                         <select class="form-select" id="department" name="department" aria-label="Select input"
                             required>
                             <option selected>Select an option</option>
                             @foreach ($HRS->unique('DeptName') as $HR)
                                 <option value="{{ $HR->Dept_ID }}">{{ $HR->DeptName }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="mb-3">
                         <label for="period_covered" class="form-label">Period Covered:</label>
                         <input type="text" class="form-control" id="period_covered" name="period_covered"
                             placeholder="Period Covered" required>
                     </div>
                     <div class="mb-3">
                         <label for="rater" class="form-label">Rater:</label>
                         <select class="form-select select2" id="rater" name="rater" aria-label="Select input"
                             required>
                             <option selected>Select an option</option>
                             @foreach ($HRS->unique('Name') as $HR)
                                 <option value="{{ $HR->EmpNo }}">{{ $HR->Name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="mb-3">
                         <label for="director" class="form-label">AVP-DIRECTOR / DIRECTOR / ASST. DIRECTOR
                             :</label>
                         <select class="form-select select2" id="director" name="director"
                             aria-label="Select input" required>
                             <option selected disabled>Select an option</option>
                             @foreach ($HRS->unique('Name') as $HR)
                                 <option value="{{ $HR->EmpNo }}">{{ $HR->Name }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="mb-3">
                         <label for="op" class="form-label">OP / VPFA / VPAR:</label>
                         <select class="form-select select2" id="op" name="op" aria-label="Select input"
                             required>
                             <option selected disabled>Select an option</option>
                             @foreach ($HRS->unique('Name') as $HR)
                                 <option value="{{ $HR->EmpNo }}">{{ $HR->Name }}</option>
                             @endforeach
                         </select>
                     </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Save changes</button>
                 </form>
             </div>
         </div>
     </div>
 </div>


 <script>
     $(document).ready(function() {
         $('.js-example-basic-single').select2();

         $('#newForm').on('click', function() {
             $('#ratee_modal').modal('hide');
         });

     });
 </script>
