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
                        <form action="{{ route('updateRecAndNext') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="performance_cid" value="{{ $performance->cid }}">

                            @foreach ($agreement as $agr)
                                <tr>
                                    <td class="text-center">
                                        {{ $ctr++ }}
                                    </td>
                                    <td>
                                        {{ $agr->criteria }}
                                    </td>

                                    <td>
                                        <input type="checkbox">
                                    </td>
                                    <td>
                                        <input type="checkbox">
                                    </td>
                                </tr>
                            @endforeach

                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-success m-2" id="addRecommendation" type="button" data-bs-toggle="modal"
                        data-bs-target="#addRecommendation_modal">Add New</button>
                    <button class="btn btn-primary m-2" id="updateBtn" class="submit">Next</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addRecommendation_modal" tabindex="-1" aria-labelledby="addRecommendationModalLabel"
    aria-hidden="true">
    <form action="{{ route('add-recommendation') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Comments and Recommendation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="addPerf_cid" value="{{ $performance->cid }}">
                    <div class="form-group">
                        <label for="" class="form-label">Area/s for Improvement</label>
                        <textarea name="addForImprovement" class="form-control" id="" cols="30" rows="8"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Action Plan</label>
                        <textarea name="addActionPlan" class="form-control" id="" cols="30" rows="8"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
            </div>
        </div>
    </form>
</div>


@section('content')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".delete-btn").click(function() {
                var cid = $(this).data("cid");

                // AJAX request to delete achievement
                $.ajax({
                    type: "POST",
                    url: "{{ route('delete-recommendation') }}", // Update this to your route for deleting achievements
                    data: {
                        _token: "{{ csrf_token() }}",
                        cid: cid
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(error) {
                        console.error('Error deleting recommendation:', error);
                    }
                });
            });
            $(".update-btn").click(function() {
                var cid = $(this).data("cid");
                var for_improvement = $("textarea[name='for_improvement[" + cid + "]']").val();
                var action_plan = $("textarea[name='action_plan[" + cid + "]']").val();

                // AJAX request to update achievement
                $.ajax({
                    type: "POST",
                    url: "{{ route('update-recommendation') }}", // Update this to your route for updating achievements
                    data: {
                        _token: "{{ csrf_token() }}",
                        cid: cid,
                        for_improvement: for_improvement,
                        action_plan: action_plan,
                    },
                    success: function(response) {
                        // Handle the response accordingly
                        console.log('Recommendation updated successfully!');
                    },
                    error: function(error) {
                        console.error('Error updating recommendation:', error);
                    }
                });
            });
        });
    </script>
@endsection
