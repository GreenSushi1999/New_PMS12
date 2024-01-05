@extends('layout.app')

@section('title', 'Performance Management System')

@section('content')

     <div class="card mt-3">
        <div class="card-header bg-primary">
            <h6 class="card-title mt-1 text-white">Instruction</h6>
        </div>
        <div class="card-body">
            <p style="font-size:14px;" class="text-dark">This form shall be accomplished at the end of each
                evaluation period.
                This
                form summarizes
                the entire process of performance management and must objectively and honestly reflect the
                evaluation based on facts and actual incidents identified through monitoring and coaching.
            </p>
            <p style="font-size:14px;" class="text-dark">Write your ratings on the corresponding boxes of
                each
                indicator. Use percentage
                for your answers.</p> 
            

                <div class="card">
                    <div class="card-header text-center text-white bg-primary">
                       <h6 class="card-title mt-1">Grade Equivalent and Verbal Interpretation</h6>
                    </div> 
                    <div class="card-body border border-primary">

                <div class="row p-3">
                    <div class="col-lg-6">
                        <div class="card m-1">
                            <div class="card-header bg-danger text-white  text-center">
                                <h6 class="card-title mt-1">{{ $needsImprovement->verbal_interpretation }}
                                    <br>
                                    {{ $needsImprovement->grade_min }}% - {{ $needsImprovement->grade_max }}%</h6>
                            </div> 
                            <div class="card-body"> 
                                <p style="font-size:15px;" class="text-dark">  {{ $needsImprovement->description }}</p>
                               
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="card m-1">
                            <div class="card-header bg-info text-white text-center">
                                <h6 class="card-title mt-1">   {{ $goodPerformance->verbal_interpretation }}<br>
                                    {{ $goodPerformance->grade_min }}% - {{ $goodPerformance->grade_max }}%</h6>
                            </div> 
                            <div class="card-body"> 
                                <p style="font-size:15px;" class="text-dark">      {{ $goodPerformance->description }}</p>
                               
                            </div>
                        </div>
                    </div> 
                </div>
                 <div class="row p-3">
                    <div class="col-lg-6">
                        <div class="card m-1">
                            <div class="card-header bg-success text-white text-center">
                                <h6 class="card-title mt-1">    {{ $satisfactoryPerformance->verbal_interpretation }}
                                    <br>
                                    {{ $satisfactoryPerformance->grade_min }}% -
                                    {{ $satisfactoryPerformance->grade_max }}%</h6>
                            </div> 
                            <div class="card-body "> 
                       <p style="font-size:15px;" class="text-dark">
                                    {{ $satisfactoryPerformance->description }}</p> 
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card m-1">
                            <div class="card-header bg-primary text-white text-center">
                                <h6 class="card-title mt-1">      {{ $excellentPerformance->verbal_interpretation }}<br>
                                    {{ $excellentPerformance->grade_min }}% -
                                    {{ $excellentPerformance->grade_max }}%</h6>
                            </div> 
                            <div class="card-body"> 
                                <p style="font-size:15px;" class="text-dark">
                                    {{ $excellentPerformance->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <form action="{{ route('values') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="performance_cid" value="{{ $performance_cid }}">
                <input type="hidden" name="ratee_cid" value="{{ $ratee_cid }}">
                <a href="/home" class="btn btn-secondary">Back</a>
                <button class="btn btn-primary " type="submit">Start</button>
            </form>
        </div>
     </div>
 
@endsection
