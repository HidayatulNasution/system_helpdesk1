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
                <h1 class="text-3xl text-black pb-6">User Management</h1>
                <button
                    class="w-64 bg-skyblue cta-btn font-semibold py-2 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 hover:scale-105 transform transition-transform duration-200 flex items-center justify-center">
                    <i class="fas fa-user-plus mr-3"></i> <a href="javascript:void(0)" id="create-new-user">New User</a>
                </button>
                <div id="progress-content" class="fade-in-animation">
                    @include('user.table-user')
                </div>

            </main>
            @include('user.modal-user')
        </div>
    </div>

</body>

</html>
