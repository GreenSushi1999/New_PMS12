@extends('layout.app')

@section('title', 'Performance Management System')
@section('content')
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Values</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-success">Add new</button>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th> Values
                                </th>

                                <th>Percentage</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indicators as $ind)
                                <tr>
                                    <td class="col-lg-2"><input type="number" min="1" class="form-control"
                                            value="{{ $ind->ord }}"></td>
                                    <td> {{ $ind->value }}
                                    </td>

                                    <td class="col-lg-2"><input type="number" min="1" class="form-control"
                                            value="{{ $ind->percentage }}"></td>
                                    <td><button class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Values</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-success">Add new</button>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th> Values
                                </th>

                                <th>Percentage</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indicators as $ind)
                                <tr>
                                    <td class="col-lg-2"><input type="number" min="1" class="form-control"
                                            value="{{ $ind->ord }}"></td>
                                    <td> {{ $ind->value }}
                                    </td>

                                    <td class="col-lg-2"><input type="number" min="1" class="form-control"
                                            value="{{ $ind->percentage }}"></td>
                                    <td><button class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td>
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





    <script></script>




@endsection
