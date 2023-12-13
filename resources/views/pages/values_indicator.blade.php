@extends('layout.app')

@section('title', 'Performance Management System')

<div class="container mt-5">
    <div class="row justify-content-center align-item-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">part 1</h3>
                </div>
                <div class="card-body">
                    <table class="table  table-striped table-bordered">
                        @foreach ($indicators->sortBy('ord') as $indicator)
                            <thead>
                                <tr>
                                    <th>{{ $indicator->value }}</th>
                                    <th>Ratee</th>
                                    <th>Rater</th>
                                </tr>
                            </thead>

                            @foreach ($indicator->evaluation->sortBy('ord') as $evaluation)
                                <tbody>
                                    <tr>
                                        <td>{{ $evaluation->criteria }} <br>
                                            @if ($evaluation->remarks == 1)
                                                <label for="">Remarks</label> <br>
                                                <textarea name="" id="" cols="70" rows="2" class="form-control"> </textarea>
                                            @endif
                                        </td>
                                        <td class="col-lg-1">
                                            <input type="number" min="71" max="100" class="form-control ">
                                        </td>
                                        <td class="col-lg-1"> <input type="number" min="71" max="100"
                                                class="form-control ">
                                        </td>
                                    </tr>
                            @endforeach
                            <tr>
                                <td>
                                    @if ($indicator->critical_incident == 1)
                                        <label for="">Critical Incident:</label> <br>
                                        <textarea name="" id="" cols="70" rows="2" class="form-control"> </textarea>
                                    @endif
                                </td>

                            </tr>

                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">

                </div>
            </div>
        </div>
    </div>
</div>

@section('content')

@endsection
