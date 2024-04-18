<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body >
    @include('header2')
    <section class="p-0 mt-5 pt-5"  >
        <div class="container-fluid">
          <style>
            * {
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }

            .Dash_chip_ul ul {

                padding: 10px;
                transition: 0.5s;
            }

            .Dash_chip_ul ul li {
                list-style-type: none;
                border-bottom: 1px solid rgba(0, 0, 0, 0.311);
                padding: 10px;
                transition: 0.5s;
            }

            .Dash_chip_ul ul li a {
                text-decoration: none;
                color: rgb(0, 0, 0);

            }

            .Dash_chip_ul ul li:hover {
                list-style-type: none;
                text-decoration: none;
                background: #ffffff;
                color: rgb(0, 0, 0);
                padding: 10px;
            }

            .Dash_chip_ul ul li:hover a {

                color: rgb(0, 0, 0);
                padding: 10px;
            }

            .Dash_chips {
                background: #f2f2f2;
                padding: 10px 50px;
                transition: 0.5s;
                box-shadow: 0px 0px 10px 1px #0000007e;
            }

            .Dash_chips:hover {
                padding: 15px 60px;
                border-radius: 10px;
                box-shadow: 0px 0px 50px 1px #000000;
            }
        </style>
        <div class="row" style="height: 94vh;">
            <div style="background-color: #f2f2f2; height: 94vh;" class="col-lg-3 Dash_chip_ul pt-4">
            <h3 class="p-0 m-0">Hospital <h6>Dashboard</h6>
            </h3>
            <hr class="m-0 mt-2">

                <ul>
                    <!-- <li><a href="">Hospital Registration <i class="fa-solid fa-registered float-end"></i></a></li> -->
                    <li><a href="/patient_list">Requested Patient <i class="fa-solid  {{ request()->is('patient_list') ? 'text-dark' : 'text-secondary' }} fa-bed float-end"></i></a></li>
                    <li><a href="/report">Patient Reports <i class="fa-solid {{ request()->is('report') ? 'text-dark' : 'text-secondary' }} fa-file float-end"></i></a></li>
                    <li><a href="/causes">Causes Summary <i class="fa-solid {{ request()->is('causes') ? 'text-dark' : 'text-secondary' }} fa-hospital float-end"></i></a></li>
                </ul>
                <h3 class="mt-5">Vaccine</h3>
                <hr class="m-0 mt-2">
                <ul>
                    <li><a href="/h_vaccine_list">Vaccines Stock <i class="fa-solid {{ request()->is('h_vaccine_list') ? 'text-dark' : 'text-secondary' }} fa-syringe float-end"></i></a></li>
                    <!-- <li><a href="">Avalible vaccine <i class="fa-solid {{ request()->is('report') ? 'text-dark' : 'text-secondary' }} fa-plus float-end"></i></a></li> -->
                    <!-- <li><a href="">Stock Updates <i class="fas fa-inventory"></i></a></li> -->
                    <!-- <li><a href="">Stock Summary </a></li> -->
                    <!-- <li><a href="">Issuance of vaccine</a></li> -->
                    <!-- <li><a href="">Rollback Vaccine</a></li> -->
                </ul>
            </div>

                @yield('right')
        
    </section>
    @include('footer')
</body>

</html>