 @extends('layout.app')

 @section('title', 'Performance Management System')

 <div class="container mt-5">
     <div class="row justify-content-center align-item-center">
         <div class="col-md-6">
             <div class="card shadow">
                 <div class="card-header">
                     <h3 class="card-title">Welcome to Laravel!</h3>
                 </div>
                 <div class="card-body">
                     <div class="row ">
                         <button class="btn btn-primary" data-bs-toggle="modal"
                             data-bs-target="#ratee_modal">Ratee</button>
                     </div>
                     <div class="row mt-2">
                         <button class="btn btn-success" data-bs-toggle="modal"
                             data-bs-target="#rater_modal">Rater</button>
                     </div>
                     <div class="row mt-2">


                         <button class="btn btn-info text-white">HCM</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 {{-- ratee modal --}}

 <div class="modal fade" id="ratee_modal" tabindex="-1" aria-labelledby="rateeModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Ratee Modal</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                 <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#rateeForm_modal"
                     id="newForm">New
                     Form</button>

                 @foreach ($performance as $perform)
                     <a href="/instruction/{{ $perform->cid }}/{{ $perform->ratee_cid }}"
                         style="text-decoration: none;">
                         <div class="card bg-success p-2 submit-form">

                             <p class="text-white"> {{ $perform->hr->Name }}</p>
                             <p class="text-white">{{ $perform->document->doc_name }}</p>
                         </div>
                     </a>
                 @endforeach


             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

             </div>
         </div>
     </div>
 </div>

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
                         <label for="director" class="form-label">AVP-DIRECTOR / DIRECTOR / ASST. DIRECTOR :</label>
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


 <div class="modal fade" id="rater_modal" tabindex="-1" aria-labelledby="raterModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Rater Modal</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                 @foreach ($performance as $perform)
                     @if ($perform->rater_cid == 23014)
                         <a href="/instruction/{{ $perform->cid }}/{{ $perform->ratee_cid }}"
                             style="text-decoration: none;">
                             <div class="card bg-success p-2">
                                 <p class="text-white"> {{ $perform->hr->Name }}</p>
                                 <p class="text-white">{{ $perform->document->doc_name }}</p>
                             </div>
                         </a>
                     @endif
                 @endforeach
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>


 @section('content')
     <script>
         $(document).ready(function() {
             $('.js-example-basic-single').select2();

             $('#newForm').on('click', function() {
                 $('#ratee_modal').modal('hide');
             });
         });
     </script>
 @endsection
