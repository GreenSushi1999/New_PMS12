@extends('layout.app')

@section('title', 'Performance Management System')

<div class="container mt-5">
    <div class="row justify-content-center align-item-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Login</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Employee No.</label>
                            <input type="text" name="EmpNo">
                        </div>
                        <div class="form-group">
                            <label for="">Birthday</label>
                            <input type="date" name="Bdate">
                        </div>
                        <button class="btn btn-success">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@section('content')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $('#newForm').on('click', function() {
                $('#ratee_modal').modal('hide');
            });
        });
    </script>
@endsection
