@extends('layout.app')

@section('title', 'Performance Management System')
@section('content')
    <!-- Add these CDN links to your HTML file -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <div class="container mt-5">
        <div class="row justify-content-center align-item-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="card-title">Edit Rank and File Level</h3>
                    </div>
                    <div class="card-body">

                        <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#editValues_modal"
                            id="editValues"> Edit Values</button>
                        <button class="btn btn-primary text-white" data-bs-toggle="modal"
                            data-bs-target="#editCriteria_modal" id="editCriteria"> Edit Criteria</button>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Preview</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($indicators as $ind)
                                    <tr>
                                        <th>{{ $ind->value }}</th>

                                    </tr>
                                    @foreach ($ind->evaluation as $ind_eval)
                                        <tr>
                                            <td>
                                                {{ $ind_eval->criteria }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer">
                        <a href="/index" class="btn btn-success m-2">Back</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="editValues_modal" tabindex="-1" aria-labelledby="editValuesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Values</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-success">Add new</button>
                    <table class="table table-bordered mt-2">
                        <form action="{{ route('edit-values') }}" method="POST">
                            {{ csrf_field() }}
                            <thead>
                                <tr>
                                    <th class="text-center"> Values
                                    </th>
                                    <th class="text-center col-lg-1">Critical <br> Incident</th>
                                    <th class="text-center">Percentage</th>
                                    <th class="text-center col-lg-1">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="sortable-table">

                                @foreach ($indicators as $index => $ind)
                                    <tr>
                                        <input type="hidden" name="order[]" value="{{ $ind->cid }}">
                                        <td>
                                            <input type="text" name="value[{{ $ind->cid }}]"
                                                value="{{ $ind->value }}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="critical_incident[{{ $ind->cid }}]"
                                                value="{{ $ind->critical_incident }}" class="form-control">
                                        </td>
                                        <td class="col-lg-2">
                                            <input type="number" min="1" class="form-control"
                                                name="percentage[{{ $ind->cid }}]" value="{{ $ind->percentage }}">
                                        </td>
                                        <td>
                                            <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>


                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCriteria_modal" tabindex="-1" aria-labelledby="editCriteriaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Criteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form action="{{ route('edit-criteria') }}" method="POST"> --}}
                    {{-- {{ csrf_field() }} --}}

                    <select name="value" id="indicatorSelect" class="select2 form-select">
                        <option value="" disabled selected>Select</option>
                        @foreach ($indicators as $ind)
                            <option value="{{ $ind->cid }}">{{ $ind->value }}</option>
                        @endforeach
                    </select>

                    <form action="{{ route('edit-criteria') }}" method="POST">
                        {{ csrf_field() }}
                        <table id="criteriaTable" class="table table-bordered mt-2">
                            <thead></thead>
                            <tbody>
                            </tbody>
                        </table>

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
            // Attach change event listener to the select dropdown
            $('#indicatorSelect').change(function() {
                var selectedValue = $(this).val();

                // Make an AJAX request to get criteria and remarks for the selected indicator
                $.ajax({
                    url: '{{ route('get-criteria') }}', // Replace with your actual route
                    method: 'GET',
                    data: {
                        indicator: selectedValue

                    },
                    success: function(response) {
                        // Update the table body with the received criteria and remarks
                        var thead = $('#criteriaTable thead');
                        thead.empty();
                        var headrow =
                            '<tr><th>Criteria</th><th>Remarks</th><th>Delete</th></tr>';
                        thead.append(headrow);
                        var tbody = $('#criteriaTable tbody');
                        tbody.empty();

                        for (var i = 0; i < response.length; i++) {
                            var criteria = response[i].criteria;
                            var remarks = response[i].remarks;
                            var row = '<tr><td>' + criteria +
                                '</td><td ><input type="number" class="form-control col-lg-1" name="remarks[' +
                                response[i].cid + ']" value="' + remarks +
                                '"</td><td>' +
                                '<button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>' +
                                '</td></tr>';
                            tbody.append(row);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>










@endsection
