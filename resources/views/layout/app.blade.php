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
            background-color: #F8F8F8;

            padding-bottom: 30px;
            position: relative;
            min-height: 100%;
        }

        a {
            transition: background 0.2s, color 0.2s;
        }

        a:hover,
        a:focus {
            text-decoration: none;
        }

        #wrapper {
            padding-left: 0;
            transition: all 0.5s ease;
            position: relative;
        }

        #sidebar-wrapper {
            z-index: 1000;
            position: fixed;
            left: 250px;
            width: 0;
            height: 100%;
            margin-left: -250px;
            overflow-y: auto;
            overflow-x: hidden;
            background: #F8F8F8;
            transition: all 0.5s ease;
        }

        #wrapper.toggled #sidebar-wrapper {
            width: 250px;
        }

        .sidebar-brand {
            position: absolute;
            top: 0;
            width: 250px;
            text-align: center;
            padding: 20px 0;
        }

        .sidebar-brand h2 {
            margin: 0;
            font-weight: 600;
            font-size: 24px;
            color: #fff;
        }

        .sidebar-nav {
            position: absolute;
            top: 75px;
            width: 250px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .sidebar-nav>li {
            text-indent: 10px;
            line-height: 42px;
        }

        .sidebar-nav>li a {
            display: block;
            text-decoration: none;
            color: #757575;
            font-weight: 600;
            font-size: 18px;
        }

        .sidebar-nav>li>a:hover,
        .sidebar-nav>li.active>a {
            text-decoration: none;
            color: #fff;
            background: #0275d8;
        }

        .sidebar-nav>li>a i.fa {
            font-size: 24px;
            width: 60px;
        }

        #navbar-wrapper {
            width: 100%;
            position: absolute;
            z-index: 2;
        }

        #wrapper.toggled #navbar-wrapper {
            position: absolute;
            margin-right: -250px;
        }

        #navbar-wrapper .navbar {
            border-width: 0 0 0 0;
            background-color: #eee;
            font-size: 24px;
            margin-bottom: 0;
            border-radius: 0;
        }

        #navbar-wrapper .navbar a {
            color: #757575;
        }

        #navbar-wrapper .navbar a:hover {
            color: #0275d8;
        }

        #content-wrapper {
            width: 100%;
            position: absolute;
            padding: 15px;
            top: 100px;
        }

        #wrapper.toggled #content-wrapper {
            position: absolute;
            margin-right: -250px;
        }

        @media (min-width: 992px) {
            #wrapper {
                padding-left: 250px;
            }

            #wrapper.toggled {
                padding-left: 60px;
            }

            #sidebar-wrapper {
                width: 250px;
            }

            #wrapper.toggled #sidebar-wrapper {
                width: 60px;
            }

            #wrapper.toggled #navbar-wrapper {
                position: absolute;
                margin-right: -190px;
            }

            #wrapper.toggled #content-wrapper {
                position: absolute;
                margin-right: -190px;
            }

            #navbar-wrapper {
                position: relative;
            }

            #wrapper.toggled {
                padding-left: 60px;
            }

            #content-wrapper {
                position: relative;
                top: 0;
            }

            #wrapper.toggled #navbar-wrapper,
            #wrapper.toggled #content-wrapper {
                position: relative;
                margin-right: 60px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #wrapper {
                padding-left: 60px;
            }

            #sidebar-wrapper {
                width: 60px;
            }

            #wrapper.toggled #navbar-wrapper {
                position: absolute;
                margin-right: -250px;
            }

            #wrapper.toggled #content-wrapper {
                position: absolute;
                margin-right: -250px;
            }

            #navbar-wrapper {
                position: relative;
            }

            #wrapper.toggled {
                padding-left: 250px;
            }

            #content-wrapper {
                position: relative;
                top: 0;
            }

            #wrapper.toggled #navbar-wrapper,
            #wrapper.toggled #content-wrapper {
                position: relative;
                margin-right: 250px;
            }
        }

        @media (max-width: 767px) {
            #wrapper {
                padding-left: 0;
            }

            #sidebar-wrapper {
                width: 0;
            }

            #wrapper.toggled #sidebar-wrapper {
                width: 250px;
            }

            #wrapper.toggled #navbar-wrapper {
                position: absolute;
                margin-right: -250px;
            }

            #wrapper.toggled #content-wrapper {
                position: absolute;
                margin-right: -250px;
            }

            #navbar-wrapper {
                position: relative;
            }

            #wrapper.toggled {
                padding-left: 250px;
            }

            #content-wrapper {
                position: relative;
                top: 0;
            }

            #wrapper.toggled #navbar-wrapper,
            #wrapper.toggled #content-wrapper {
                position: relative;
                margin-right: 250px;
            }
        }
    </style>
</head>

<body>
    <div id="wrapper">

        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <h5 class="sidebar-title ">Employee Portal</h5>
            </div>
            <ul class="sidebar-nav">
                <li>
                    <a href="#"><i class="fa fa-home"></i>Attendance</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-suitcase"></i></i>Leave Request</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users"></i>Administration </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-download"></i>Downloadable Forms</a>
                </li>
                <li class="pms">
                    <a href="/index"><i class="fa fa-user"></i>PMS</a>
                </li>
                <li>
                    <a href="/logout"><i class="fa fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </aside>


        <div id="navbar-wrapper">
            <nav class="navbar navbar-inverse " style="height:50px;">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </nav>
        </div>

        <section id="content-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container-fluid">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script>
        const $button = document.querySelector('#sidebar-toggle');
        const $wrapper = document.querySelector('#wrapper');

        $button.addEventListener('click', (e) => {
            e.preventDefault();
            $wrapper.classList.toggle('toggled');
            $wrapper
        });
        $('.pms').addClass('active');
    </script>
</body>

</html>
