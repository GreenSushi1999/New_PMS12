@extends('layout.app')

@section('title', 'Performance Management System')

<div class="container mt-5">
    <div class="row justify-content-center align-item-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Instruction</h3>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <h6>Note</h6>
                        <br>
                        <p>This form shall be accomplished at the end of each evaluation period. This form summarizes
                            the entire process of performance management and must objectively and honestly reflect the
                            evaluation based on facts and actual incidents identified through monitoring and coaching.
                        </p>
                    </div>
                    <div class="row mt-2">
                        <p>INSTRUCTION: Write your ratings on the corresponding boxes of each indicator. Use percentage
                            for your answers.</p>
                        <div class="bg-primary p-2">GRADE EQUIVALENT AND VERBAL INTERPRETATION</div>
                        <div class="row">
                            @foreach ($grades as $grade)
                                <div class="card col-lg-3 ">
                                    <div class="card-header bg-success">
                                        <h6 class="card-title text-white">{{ $grade->verbal_interpretation }}</h6>
                                        <h6 class="text-white">
                                            {{ $grade->grade_min . '% - ' . $grade->grade_max . '%' }}
                                        </h6>
                                    </div>
                                    <div class="card-body bg-white">
                                        <p> {{ $grade->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <form action="{{ route('values') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="performance_cid" value="{{ $performance_cid }}">
                        <input type="text" name="ratee_cid" value="{{ $ratee_cid }}">
                        <button class="btn btn-primary" type="submit">Start</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('content')

@endsection