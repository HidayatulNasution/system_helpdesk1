<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>System Helpdesk Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    {{-- <link id="pagestyle" href="assets/css/argon-dashboard.css" rel="stylesheet" /> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #3d68ff;
        }

        .cta-btn {
            color: #3d68ff;
        }

        .upgrade-btn {
            background: #1947ee;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #1947ee;
        }

        .nav-item:hover {
            background: #1947ee;
        }

        .account-link:hover {
            background: #3d68ff;
        }

        /* <!-- CSS untuk Animasi --> */
        .fade-in-animation {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Card Animation */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Card */
        .card-body {
            flex: 1 1 auto;
            padding: 1rem 1rem;
        }

        .card .card-body {
            font-family: "Open Sans", sans-serif;
            padding: 1.5rem;
        }

        .card.card-background .card-body {
            color: #fff;
            position: relative;
            z-index: 2;
        }

        .card.card-background .card-body .content-center,
        .card.card-background .card-body .content-left {
            min-height: 330px;
            max-width: 450px;
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .card.card-background .card-body .content-center {
            text-align: center;
        }

        .card.card-background .card-body.body-left {
            width: 90%;
        }

        .card.card-background .card-body .author .name span,
        .card.card-background .card-body .author .name .stats {
            color: #fff;
        }

        .icon-shape {
            width: 48px;
            height: 48px;
            background-position: center;
            border-radius: 0.75rem;
        }

        .icon-shape i {
            color: white;
            opacity: 0.8;
            top: 14px;
            position: relative;
        }

        .g-sidenav-hidden .navbar-vertical .card.card-background .icon-shape {
            margin-bottom: 0 !important;
        }

        .g-sidenav-hidden .navbar-vertical:hover .card.card-background .icon-shape {
            margin-bottom: 4rem !important;
        }
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">

    @include('admin.sidebar')

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        @include('admin.navbar')

        <div class="w-full overflow-x-hidden border-t flex flex-col bg-gray-100">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">System Helpdesk Administrator</h1>

                <div class="container-fluid py-4 mt-4">
                    <div class="row">
                        <!-- On Progress Card -->
                        <div class="col-lg-4 col-sm-6 mb-lg-0 mb-4">
                            <div class="card progress-card transform transition duration-500 hover:scale-105">
                                <div class="card-body p-3" style="background-color: teal;">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <h2 class="mb-0 text-capitalize font-weight-bold text-white">
                                                    TIKET BARU</h2>
                                                <h1 class="font-weight-bolder mt-3 mb-3 text-white">
                                                    {{ array_sum($dataByStatus) }}
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div style="background-color: #ff5100;"
                                                class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="ni ni-settings text-lg opacity-10" aria-hidden="true"></i>
                                                <!-- Icon for On Progress -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Done Card -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="card done-card transform transition duration-500 hover:scale-105">
                                <div class="card-body p-3" style="background-color: rebeccapurple">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <h2 class="mb-0 text-capitalize font-weight-bold text-white">
                                                    TIKET DONE</h2>
                                                <h5 class="font-weight-bolder mt-3 mb-3 text-white">
                                                    {{ array_sum($dataByStatusDone) }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div style="background-color:turquoise;"
                                                class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                                                <!-- Icon for Done -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Report Card -->
                        <div class="col-lg-4 col-sm-6">
                            <div class="card report-card transform transition duration-500 hover:scale-105">
                                <div class="card-body p-3" style="background-color: steelblue">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <h2 class="mb-0 text-capitalize font-weight-bold text-white">
                                                    REPORT DATA</h2>
                                                <h5 class="font-weight-bolder mt-3 mb-3 text-white">
                                                    Grafik Data
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div style="background-color:salmon;"
                                                class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                                <i class="ni ni-chart-bar-32 text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="grafik-content" class="fade-in-animation" style="display: none;">
                    @include('admin.grafik')
                </div>
                <div id="progress-content" class="fade-in-animation" style="display: none;">
                    @include('admin.table-progres')
                </div>
                <div id="done-content" class="fade-in-animation" style="display: none;">
                    @include('admin.table-done')
                </div>
            </main>
            @include('admin.modal')
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Handle Click event on the report data card 
            $('.report-card').on('click', function() {
                // show 
                $('#grafik-content').slideToggle();
            });

            $('.progress-card').on('click', function() {
                // show
                $('#progress-content').slideToggle();
            });

            $('.done-card').on('click', function() {
                // show
                $('#done-content').slideToggle();
            })
        });
    </script>
</body>

</html>
