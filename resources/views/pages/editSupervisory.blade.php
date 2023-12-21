@extends('layout.app')

@section('title', 'Performance Management System')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-item-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="card-title">Edit Supervisory/Officer Level</h6>
                    </div>
                    <div class="card-body">


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



    <script></script>




@endsection
