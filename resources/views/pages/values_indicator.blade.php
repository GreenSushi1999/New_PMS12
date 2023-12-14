@extends('layout.app')

@section('title', 'Performance Management System')

<div class="container mt-5">
    <div class="row justify-content-center align-item-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Values Indicator</h3>
                </div>
                <div class="card-body">

                    <form action="{{ route('save-ratings') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $performance_cid }}" name="performance_cid">
                        <table class="table  table-striped table-bordered">
                            @foreach ($performance->indicators->sortBy('ord') as $indicator)
                                <thead>
                                    <tr>
                                        <th class="col-lg-6">{{ $indicator->value }}</th>
                                        <th class="text-center">Ratee</th>
                                        <th class="text-center">Rater</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($indicator->evaluation->sortBy('ord') as $evaluation)
                                        <tr>
                                            @php
                                                $ratee_rate = null;
                                                $rater_rate = null;
                                                $remarks = null;

                                            @endphp

                                            @foreach ($performance->ratings as $per_rate)
                                                @if ($per_rate->eval_cid == $evaluation->cid)
                                                    @php
                                                        $ratee_rate = $per_rate->ratee_rate;
                                                        $rater_rate = $per_rate->rater_rate;
                                                        $remarks = $per_rate->remarks;
                                                    @endphp
                                                @endif
                                            @endforeach

                                            <td>{{ $evaluation->criteria }} <br>
                                                @if ($evaluation->remarks == 1)
                                                    <label for="">Remarks</label> <br>
                                                    <textarea id="" cols="70" rows="2" class="form-control" name="remarks{{ $evaluation->cid }}">{{ $remarks }}  </textarea>
                                                @endif
                                            </td>
                                            <td class="col-lg-1">
                                                <input type="number" min="71" max="100"
                                                    class="form-control ratee{{ $evaluation->ind_cid }}"
                                                    name="ratee{{ $evaluation->cid }}"
                                                    onchange="updateRateeSum({{ $evaluation->ind_cid }},{{ $evaluation->indicators->percentage }})"
                                                    value="{{ $ratee_rate }}">
                                            </td>
                                            <td class="col-lg-1"> <input type="number" min="71" max="100"
                                                    class="form-control rater{{ $evaluation->ind_cid }}"
                                                    name="rater{{ $evaluation->cid }}"
                                                    onchange="updateRaterSum({{ $evaluation->ind_cid }},{{ $evaluation->indicators->percentage }}) "
                                                    value="{{ $rater_rate }}"
                                                    @if ($performance->ratee_cid == 23014) readonly @endif>
                                            </td>
                                        </tr>
                                    @endforeach


                                    <tr>
                                        <td>
                                            @php
                                                $evaluationRateeAve = null;
                                                $evaluationRaterAve = null;
                                                $evaluationCriticalIncident = null;
                                            @endphp

                                            @foreach ($performance->perf_indicatorsAve as $perfAve)
                                                @if ($perfAve->ind_cid == $evaluation->ind_cid)
                                                    @php
                                                        $evaluationRateeAve = $perfAve->ratee_ave;
                                                        $evaluationRaterAve = $perfAve->rater_ave;
                                                        $evaluationCriticalIncident = $perfAve->critical_incident;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($indicator->critical_incident == 1)
                                                <label for="">Critical Incident:</label> <br>
                                                <textarea name="critical_incident{{ $evaluation->ind_cid }}" id="" cols="70" rows="2"
                                                    class="form-control"> {{ $evaluationCriticalIncident }}</textarea>
                                            @endif
                                        </td>
                                        <td colspan='2'>
                                            <div class="row">
                                                <label for="" class="form-label text-center"
                                                    style="font-size:12px;">Average *
                                                    {{ $evaluation->indicators->percentage / 100 }}</label>
                                            </div>



                                            <div class="row">
                                                <div class="col">


                                                    <input type="number" class="form-control" step="any"
                                                        name="ratee_ave{{ $evaluation->ind_cid }}"
                                                        value="{{ $evaluationRateeAve }}" readonly>

                                                </div>
                                                <div class="col">


                                                    <input type="number" class="form-control" step="any"
                                                        name="rater_ave{{ $evaluation->ind_cid }}"
                                                        value="{{ $evaluationRaterAve }}" readonly>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                </tbody>
                            @endforeach
                        </table>

                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-success" type="submit">Next</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function updateRateeSum(cid, percentage) {
        var inputs = document.getElementsByClassName('ratee' + cid);
        var sum = 0;

        for (var i = 0; i < inputs.length; i++) {
            sum += parseFloat(inputs[i].value) || 0;
        }

        var ave = sum / inputs.length;
        var percent = percentage / 100;

        var total = ave * percent;

        document.getElementsByName('ratee_ave' + cid)[0].value = total.toFixed(2);
    }


    function updateRaterSum(cid, percentage) {
        var inputs = document.getElementsByClassName('rater' + cid);
        var sum = 0;

        for (var i = 0; i < inputs.length; i++) {
            sum += parseFloat(inputs[i].value) || 0;
        }

        var ave = sum / inputs.length;
        var percent = percentage / 100;

        var total = ave * percent;

        document.getElementsByName('rater_ave' + cid)[0].value = total.toFixed(2)
    }
</script>


@section('content')

@endsection
