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
                            <div class="mt-3 d-flex justify-content-center">
                                <img src="logo.png" alt=""  height='150px' width='150px'>
                            </div>
                            <div class="text-center">
                            <p class="text-dark font-weight-normal m-0" style="font-size:26px;">Performance Management <br>  
                                 System</p>
                            </div>
                        <div class="card-body">
                            <form action="{{ route('login') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="m-1">
                                    <label for="" class="form-label" style="font-size:14px;font-weight:bold;">Employee Number:</label>
                                    <div class="input-group mb-2">
                                        <input type="text"  name="EmpNo" class="form-control" placeholder="Employee No."  aria-describedby="basic-addon1">
                                        <span class="input-group-text" style="width:40px;" id="basic-addon1"><i class="fa fa-user"></i></span>
                                      </div>
                                </div>
                               <div class="m-1">
                                <label for="" class="form-label" style="font-size:14px;font-weight:bold;">Birthdate:</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="Bdate" placeholder="MMDDYYYY"   aria-describedby="basic-addon1">
                                    <span class="input-group-text" style="width:40px;" id="basic-addon1"><i class="fa fa-birthday-cake"></i></span>
                                  </div>
                               </div>
                                    <div class="row m-1">
                                        <button class="btn btn-success ">Login</button>
                                    </div>
                                  <div class="row m-1">
                                    <button class="btn btn-primary" type="button"
                                    onclick="clearInputs()">Clear</button>
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
