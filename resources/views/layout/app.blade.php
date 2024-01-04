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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

    body {
        font-family: 'Poppins', sans-serif;
        background: #fafafa;
    }

    p {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1em;
        font-weight: 300;
        line-height: 1.7em;
        color: #999;
    }

    a,
    a:hover,
    a:focus {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s;
    }

    .navbar {
        padding: 15px 10px;
        background: #fff;
        border: none;
        border-radius: 0;
        margin-bottom: 20px;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .navbar-btn {
        box-shadow: none;
        outline: none !important;
        border: none;
    }

    .line {
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #ddd;
        margin: 40px 0;
    }

    .wrapper {
        display: flex;
        width: 100%;
        align-items: stretch;
    }

    #sidebar {
        min-width: 250px;
        max-width: 250px;
        background: #343a40;
        color: #fff;
        transition: all 0.3s;
    }

    #sidebar.active {
        margin-left: -250px;

    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: #343a40;
    }

    #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid #0D6EFD;
    }

    #sidebar ul p {
        color: #fff;
        padding: 10px;
    }

    #sidebar ul li a {
        padding: 10px;
        font-size: 1.1em;
        display: block;
    }

    #sidebar ul li a:hover {

        color:#198754;
        background: #fff;
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
        color: #198754;
        background: #fff;
    }

    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: #0D6EFD;
    }

    ul.CTAs {
        padding: 20px;
    }

    ul.CTAs a {
        text-align: center;
        font-size: 0.9em !important;
        display: block;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    a.download {
        background: #fff;
        color: #0D6EFD;
    }

    a.article,
    a.article:hover {
        background: #0D6EFD !important;
        color: #fff !important;
    }



    #content {
        width: 100%;
        padding: 20px;
        min-height: 100vh;
        transition: all 0.3s;
    }



    @media (max-width: 768px) {
        #sidebar {
            margin-left: -250px;
        }

        #sidebar.active {
            margin-left: 0;
        }

        #sidebarCollapse span {
            display: none;
        }
    }
</style>

<body>

    <div class="wrapper">

        <nav id="sidebar"  >
            <div class="d-flex align-items-center m-3 mt-4 mb-4 ">
                <div class="me-3 mb-2">
                    <img src="{{asset('logo.png')}}" alt="" height="100px" width="100px" class="img-fluid">
                </div>
                <div>
                    <h6>Performance Management System</h6>
                </div>
            </div>
            
            <ul class="list-unstyled CTAs">
                <li class="active">
                    <a href="/home" class="d-flex align-items-center text-decoration-none">
                        <i class="fa fa-user mr-2" style="margin-right:10px;font-size:18px;"></i> PMS
                    </a>
                </li>
                <li>
                    <a href="/logout" class="d-flex align-items-center text-decoration-none ">
                        <i class="fa fa-sign-out mr-2" style="margin-right:10px;font-size:18px;"></i> Logout
                    </a>
                </li>
            </ul>



            <div class="bg-white border border-success d-flex flex-column align-items-center m-4 rounded p-1">
                <span class="text-dark" style="font-size:12px;font-weight:bold;">
                    {{ Session::get('user')->LastName . ',' . Session::get('user')->FirstName }}
                </span>
                <span class="text-dark font-weight-bold" style="font-size:12px;">
                    Today is <strong style="font-weight:bold;color:black;">{{ now()->format('m/d/Y') }}
                    </strong>
                </span>
            </div>
            <div class="border border-white p-2 text-center m-4">
                <span class="text-white" style="font-size:12px;"> For employee concern please contact: </span>
                <br>
                <span class="text-white" style="font-size:12px;">
                    Human Capital Management
                    (02)8859-0854
                    hro@mtc.edu.ph
                </span>
            </div>

            <div class="border border-white p-2 text-center m-4">
                <span class="text-white" style="font-size:12px;">For administration concern please contact: </span>
                <br>
                <span class="text-white" style="font-size:12px;">
                    Administration Office
                    (02)8859-0801
                </span>
            </div>





        </nav>


        <div id="content">
            <nav class="navbar navbar-expand-md navbar-light rounded">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn text-white" style="background-color:#343a40; ">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </nav>

            <main>
                @yield('content')
            </main>



        </div> 
 
        <script>
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>
</body>

</html>
