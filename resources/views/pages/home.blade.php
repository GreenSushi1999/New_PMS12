 @extends('layout.app')

 @section('title', 'Performance Management System')
 @section('content')
 

 <div class="container">
     <div class="row d-flex justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="card-title text-center text-white mt-2">Performance Management System</h4>
                </div>
                <div class="card-body">
                  <div class="row justify-content-center mt-3 mb-5">
                    <div class="col-lg-6">
                        <div class="card m-3 shadow rounded">
                            <div class="card-header bg-primary text-center" style="background-color: #343a40;color:white;">
                                Select your Role
                            </div>
                            <div class="card-body m-3">
                             <div class="row mb-3"> 
                                <a href="{{route('ratee')}}" class="btn btn-success"><i class="fa fa-user me-2"></i>Ratee</a>
                             </div>
                             <div class="row mb-3">
                                <a href="{{route('rater')}}" class="btn btn-primary"><i class="fa fa-user-o me-2"></i>Rater</a>
                             </div>
                             
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
     </div>
 </div>


 @endsection 