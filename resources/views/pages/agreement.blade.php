@extends('layout.app')

@section('title', 'Performance Management System')

<div class="container mt-5">
    <div class="row justify-content-center align-item-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Agreement</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="achievementsTable">
                        <tr>
                            <th class="col-lg-1 text-center">No.</th>
                            <th class="text-left">Agreement</th>
                            <th>Yes</th>
                            <th>No</th>
                        </tr>
                        @php
                            $ctr = 1;
                        @endphp
                        <form action="{{ route('save-perf_agreement') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="performance_cid" value="{{ $performance->cid }}">

                            @foreach ($agreement as $agr)
                                @php
                                    $tick = null;
                                @endphp
                                @foreach ($performance->perf_agreement as $perf_agree)
                                    @if ($perf_agree->agr_cid == $agr->cid)
                                        @php
                                            $tick = $perf_agree->tick;

                                        @endphp
                                    @endif
                                @endforeach

                                <tr>
                                    <td class="text-center">
                                        {{ $ctr++ }}
                                    </td>
                                    <td>
                                        {{ $agr->criteria }}
                                    </td>

                                    <td>
                                        <input type="checkbox" class="agree-checkbox form-check-input"
                                            name="perf_agree[{{ $agr->cid }}]" value="1"
                                            {{ $tick == 1 ? 'checked' : '' }} onclick="toggleCheckbox(this)">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="agree-checkbox form-check-input"
                                            name="perf_agree[{{ $agr->cid }}]" value="2"
                                            {{ $tick == 2 ? 'checked' : '' }} onclick="toggleCheckbox(this)">
                                    </td>
                                </tr>
                            @endforeach

                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="/recommendations/{{ $performance->cid }}/{{ $performance->ratee_cid }}"
                        class="btn btn-success m-2">Back</a>
                    <button class="btn btn-primary m-2" class="submit">Next</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@section('content')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function toggleCheckbox(clickedCheckbox) {
            var checkboxes = document.querySelectorAll('input[name="' + clickedCheckbox.name + '"]');
            checkboxes.forEach(function(checkbox) {
                if (checkbox !== clickedCheckbox) {
                    checkbox.checked = false;
                }
            });
        }
    </script>
@endsection
