@extends('layout.app')

@section('title', 'Performance Management System')
@section('content')
    <!-- Add these CDN links to your HTML file -->


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
                                    @foreach ($ind->evaluation->sortBy('ord') as $ind_eval)
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

                    <button class="btn btn-primary text-white" id="openAddValues" type="button"> Add Value</button>

                    <table class="table table-bordered mt-2" id="valuestbl">
                        <form action="{{ route('edit-values') }}" method="POST">
                            {{ csrf_field() }}
                            <thead>
                                <tr>
                                    <th class="text-center col-lg-1">Order</th>
                                    <th class="text-center"> Values
                                    </th>
                                    <th class="text-center col-lg-1">Critical <br> Incident</th>
                                    <th class="text-center">Percentage</th>
                                    <th class="text-center col-lg-1">Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($indicators as $index => $ind)
                                    <tr>
                                        <input type="hidden" name="cids[{{ $ind->cid }}]" value={{ $ind->cid }}>

                                        <td><input type="text" name="order[{{ $ind->cid }}]" class="form-control"
                                                value="{{ $ind->ord }}"></td>
                                        <td>
                                            <input type="text" name="value[{{ $ind->cid }}]"
                                                value="{{ $ind->value }}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="critical[{{ $ind->cid }}]"
                                                value="{{ $ind->critical_incident }}" min="0" max="1"
                                                class="form-control">
                                        </td>
                                        <td class="col-lg-2">
                                            <input type="number" min="1" class="form-control"
                                                name="percentage[{{ $ind->cid }}]" value="{{ $ind->percentage }}">
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" onclick="deleteValue({{ $ind->cid }})"
                                                type="button"><i class="fa fa-trash-o"></i></button>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Criteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select name="value" id="indicatorSelect" class="select2 form-select">
                        <option value="" disabled selected>Select</option>
                        @foreach ($indicators as $ind)
                            <option value="{{ $ind->cid }}" data-cid="{{ $ind->cid }}">{{ $ind->value }}
                            </option>
                        @endforeach
                    </select>

                    <div id="Addbtn_div" class="mt-2"></div>
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

            $('#indicatorSelect').change(function() {
                var selectedOption = $(this).find(':selected');
                var selectedValue = selectedOption.val();
                var selectedCid = selectedOption.data('cid'); // Get the ind->cid value

                // Make an AJAX request to get criteria and remarks for the selected indicator
                $.ajax({
                    url: '{{ route('get-criteria') }}', // Replace with your actual route
                    method: 'GET',
                    data: {
                        indicator: selectedValue
                    },
                    success: function(response) {
                        // Update the table body with the received criteria and remarks  
                        var addbtnDiv = $('#Addbtn_div');
                        addbtnDiv.empty();
                        var addbtn =
                            '<button type="button" class="btn btn-primary" id="openAddCriteria" data-cid="' +
                            selectedCid + '">Add Criteria</button>';
                        addbtnDiv.append(addbtn);
                        var thead = $('#criteriaTable thead');
                        thead.empty();
                        var headrow =
                            '<tr><th class="col-lg-1">Order</th><th class="text-center">Criteria</th><th class="col-lg-1 text-center">Remarks</th><th class="col-lg-1 text-center">Delete</th></tr>';
                        thead.append(headrow);
                        var tbody = $('#criteriaTable tbody');
                        tbody.empty();

                        for (var i = 0; i < response.length; i++) {
                            var criteria = response[i].criteria;
                            var remarks = response[i].remarks;
                            var cid = response[i].cid;
                            var order = response[i].ord;

                            var row = '<tr>' +
                                '<td><input type="hidden" class="form-control col-lg-1" name="cids[' +
                                response[i].cid +
                                ']" value="' + response[i].cid +
                                '">  <input type="text" class="form-control col-lg-1" name="ord[' +
                                response[i].cid +
                                ']" value="' + order +
                                '"></td><td><input type="text" class="form-control col-lg-4" name="criteria[' +
                                response[i].cid +
                                ']" value="' + criteria + '"></td>' +
                                '<td><input type="number" min="0" max="1" class="form-control col-lg-1" name="remarks[' +
                                response[i].cid + ']" value="' + remarks + '"></td>' +
                                '<td>' +
                                '<button class="btn btn-danger" type="button" onclick="deleteCriteria(' +
                                response[i].cid + ')"><i class="fa fa-trash-o"></i></button>' +
                                '</td>' +
                                '</tr>';

                            tbody.append(row);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $('#Addbtn_div').on('click', '#openAddCriteria', function() {
                var selectedCid = $(this).data('cid'); // Get the ind->cid value
                var tbody = $('#criteriaTable tbody');
                var newRow = '<tr>' +
                    '<td><input type="hidden" class="form-control" name="indCID[]" value="' + selectedCid +
                    '">' +
                    '<input type="text" class="form-control col-lg-1" name="newOrder[]"></td>' +
                    '<td><input type="text" class="form-control col-lg-4" name="newCriteria[]"></td>' +
                    '<td><input type="number" min="0" max="1" class="form-control col-lg-1" name="newRemarks[]" value=""></td>' +
                    '<td>' +
                    '<button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>' +
                    '</td>' +
                    '</tr>';
                tbody.append(newRow);
            });

        });


        function deleteValue(cid) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action will delete the associated criteria under this value. Are you sure you want to proceed? Please note that this action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-value') }}', // Update with your actual route
                        type: 'POST',
                        data: {
                            cid: cid,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function() {
                            alert('Error occurred during the deletion.');
                        }
                    });
                }
            })
        };



        $(document).ready(function() {

            // Add an event handler for the "Add" button in the modal
            $('#openAddValues').on('click', function() {
                var tbody = $('#valuestbl tbody');
                var newIndex = tbody.find('tr').length; // Get the number of existing rows
                var newRow = '<tr>' +
                    '<td><input type="text" name="newOrder[' + newIndex + ']" class="form-control"></td>' +
                    '<td><input type="text" name="newValue[' + newIndex + ']" class="form-control"></td>' +
                    '<td><input type="number" name="newCritical[' + newIndex +
                    ']" min="0" max="1" class="form-control"></td>' +
                    '<td class="col-lg-2"><input type="number" min="1" name="newPercentage[' + newIndex +
                    ']" class="form-control"></td>' +
                    '<td><button class="btn btn-danger" type="button" onclick="deleteNewRow(this)"><i class="fa fa-trash-o"></i></button></td>' +
                    '</tr>';
                tbody.append(newRow);
            });

            // Function to delete the dynamically added row
            window.deleteNewRow = function(element) {
                $(element).closest('tr').remove();
            };

        });


        function deleteCriteria(cid) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action will delete the associated criteria under this value. Are you sure you want to proceed? Please note that this action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-criteria') }}', // Update with your actual route
                        type: 'POST',
                        data: {
                            cid: cid,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function() {
                            alert('Error occurred during the deletion.');
                        }
                    });
                }
            })
        };
    </script>

@endsection
