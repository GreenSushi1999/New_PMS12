<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <div class="col-lg-4">
                    <div class="card shadow">

                        <div class="card-body">
                            <div class="m-1 mt-3 d-flex justify-content-center">
                                <img src="{{ asset('logo.png') }}" height="140px;" width="140px;" alt="">
                            </div>
                            <div class="text-center">
                                <p class="font-weight-normal" style="font-size:28px;">Performance Management System</p>
                            </div>
                            <form action="{{ route('login') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="m-1">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="EmpNo"
                                            placeholder="Employee No." aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="padding:12px;" id="basic-addon2"><i
                                                    class='fas fa-user-tie'></i></span>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="Bdate"
                                            placeholder="Birthdate [MMDDYYYY]" aria-describedby="basic-addon2" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="padding:12px;" id="basic-addon2"><i
                                                    class='fas fa-birthday-cake'></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-1">
                                    <button class="btn btn-success ">Login</button>
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

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
