<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Optional theme -->
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha256-djO3wMl9GeaC/u6K+ic4Uj/LKhRUSlUFcsruzS7v5ms=" crossorigin="anonymous">

    <!-- Bootstrap JS Bundle CDN (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha256-fh8VA992XMpeCZiRuU4xii75UIG6KvHrbUF8yIS/2/4=" crossorigin="anonymous"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />


    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    <style>
        body {
            background-image: url('MTCbg.jpg');
            background-size: cover;
        }
    </style>
</head>


<body>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center align-item-center">
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header bg-primary p-1 d-flex align-item-center justify-content-center">
                            <h5 class="card-title text-white mt-2 ">EMPLOYEE PORTAL</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('login') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group m-1">
                                    <label for="EmpNo" class="form-label" style="font-weight:bold"
                                        style="font-weight:bold">Employee No.</label>
                                    <input type="text" name="EmpNo" class="form-control"
                                        placeholder="Enter your employee number" required>
                                </div>
                                <div class="form-group m-1">
                                    <label for="Bdate" class="form-label" style="font-weight:bold">Birth Date
                                        (MMDDYYYY)</label>
                                    <input type="password" name="Bdate" class="form-control" placeholder="MMDDYYYY"
                                        id="Bdate" required>

                                </div>
                                <div class="form-group mt-3">
                                    <div class="row m-1">
                                        <button class="btn btn-primary  ">Login</button>
                                    </div>
                                    <div class="row m-1">
                                        <button class="btn btn-primary" type="button"
                                            onclick="clearInputs()">Clear</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $('#newForm').on('click', function() {
                $('#ratee_modal').modal('hide');
            });
        });

        function clearInputs() {
            $('.form-control').val('');
        }
    </script>


</body>

</html>
