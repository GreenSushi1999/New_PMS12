@extends('layout.app')

@section('title', 'Performance Management System')

@section('content')



    <div class="container mt-1">
        <div class="row justify-content-center align-item-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary  text-white">
                        <h6 class="card-title mt-1">Instruction</h6>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <p style="font-size:15px;" class="text-dark">This form shall be accomplished at the end of each
                                evaluation period.
                                This
                                form summarizes
                                the entire process of performance management and must objectively and honestly reflect the
                                evaluation based on facts and actual incidents identified through monitoring and coaching.
                            </p>
                            <p style="font-size:15px;" class="text-dark">Write your ratings on the corresponding boxes of
                                each
                                indicator. Use percentage
                                for your answers.</p>


                        </div>

                        <div class="card m-1 bg-primary">
                            <div class="card-header">
                                <h6 class="text-white  mt-1">Grade Equivalent and Verbal Interpretation</h6>
                            </div>
                            <div class="card-body bg-white ">

                                <div class="row p-2 justify-content-center">
                                    <div class="card col-lg-5 p-0 m-1">
                                        <div class="card-header bg-danger text-center">
                                            <h6 class="card-title text-white">{{ $needsImprovement->verbal_interpretation }}
                                                <br>
                                                {{ $needsImprovement->grade_min }}% - {{ $needsImprovement->grade_max }}%
                                            </h6>
                                        </div>
                                        <div class="card-body bg-white p-2 m-1">
                                            <p style="font-size:15px;" class="text-dark">
                                                {{ $needsImprovement->description }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card col-lg-5 p-0 m-1 ">
                                        <div class="card-header bg-info text-center">
                                            <h6 class="card-title text-white">
                                                {{ $goodPerformance->verbal_interpretation }}<br>
                                                {{ $goodPerformance->grade_min }}% - {{ $goodPerformance->grade_max }}%
                                            </h6>
                                        </div>
                                        <div class="card-body bg-white p-2 m-1">
                                            <p style="font-size:15px;" class="text-dark">
                                                {{ $goodPerformance->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-2 justify-content-center">


                                    <div class="card col-lg-5 p-0 m-1 ">
                                        <div class="card-header bg-success text-center">
                                            <h6 class="card-title text-white">
                                                {{ $satisfactoryPerformance->verbal_interpretation }}
                                                <br>
                                                {{ $satisfactoryPerformance->grade_min }}% -
                                                {{ $satisfactoryPerformance->grade_max }}%
                                            </h6>
                                        </div>
                                        <div class="card-body bg-white p-2 m-1">
                                            <p style="font-size:15px;" class="text-dark">
                                                {{ $satisfactoryPerformance->description }}</p>
                                        </div>
                                    </div>

                                    <div class="card col-lg-5 p-0  m-1">
                                        <div class="card-header bg-primary text-center">
                                            <h6 class="card-title text-white">
                                                {{ $excellentPerformance->verbal_interpretation }}<br>
                                                {{ $excellentPerformance->grade_min }}% -
                                                {{ $excellentPerformance->grade_max }}%
                                            </h6>
                                        </div>
                                        <div class="card-body bg-white p-2 m-1">
                                            <p style="font-size:15px;" class="text-dark">
                                                {{ $excellentPerformance->description }}</p>
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
            </div>
        </div>
    </div>
@endsection
