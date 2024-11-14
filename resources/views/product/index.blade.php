<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">


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
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-60 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">USER</a>
            <button
                class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 hover:scale-105 transform transition-transform duration-200 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> <a href="javascript:void(0)" id="create-new-product">New Tiket</a>
            </button>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="index.html" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>

        </nav>

    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen"
                    class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
                </button>
                <button x-show="isOpen" @click="isOpen = false"
                    class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Account</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Support</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">USER</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex' : 'hidden'" class="flex flex-col pt-4">
                <a href="index.html" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="blank.html"
                    class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Blank Page
                </a>
            </nav>

        </header>

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Dashboard</h1>

                <div class="flex flex-wrap mt-6">
                    <div class="w-full lg:w-1/2 pr-0 lg:pr-2">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="fas fa-plus mr-3"></i> Monthly Reports
                        </p>
                        <div class="p-2 bg-white">
                            <canvas id="chartOne" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 pl-0 lg:pl-2 mt-12 lg:mt-0">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="fas fa-check mr-3"></i> Resolved Reports
                        </p>
                        <div class="p-2 bg-white">
                            <canvas id="chartTwo" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Latest Reports
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white" id="laravel_11_datatable">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm">No</th>
                                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm"
                                        style="min-width: 100px;">Tanggal Entry</th>
                                    <th class="text-left py-3 px-2 uppercase font-semibold text-sm">User</th>
                                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm">Bidang System</th>
                                    {{-- <th class="text-left py-3 px-2 uppercase font-semibold text-sm">Problem</th> --}}
                                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm">Prioritas</th>
                                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm"
                                        style="min-width:100px;">Status</th>
                                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm"
                                        style="min-width:100px;">Action</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </main>
            {{-- Modal Update & Insert --}}
            <div class="modal fade" id="ajax-product-modal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: rgba(0, 202, 238, 0.533);">
                            <h4 class="modal-title" id="productCrudModalDetail">Form Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="productForm" name="productForm" class="form-horizontal"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <input type="hidden" name="product_id" id="product_id">

                                                    <div class="form-group">
                                                        {{-- <label for="tgl_entry" class="col-sm-4 control-label">Tanggal Entry</label> --}}
                                                        <div class="col-sm-12">
                                                            <input type="hidden" class="form-control"
                                                                id="created_at" name="created_at"
                                                                value="<?= date('Y-m-d') ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="user">User</label>

                                                        <input type="text" class="form-control" id="user"
                                                            name="user" value="" required=""
                                                            autocomplete="off">

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="no_hp">No.
                                                            HP</label>
                                                        <input type="number" class="form-control" id="no_hp"
                                                            name="no_hp" value="" required=""
                                                            autocomplete="off">

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="bidang_system">Bidang
                                                            System</label>

                                                        <select class="form-control" name="bidang_system"
                                                            id="bidang_system" required>

                                                            <option value="CRM">CRM</option>
                                                            <option value="FICO">FICO</option>
                                                            <option value="RENTSYS">RENTSYS</option>
                                                            <option value="WORKSHOP">WORKSHOP</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="kategori">Kategori</label>

                                                        <select class="form-control" name="kategori" id="kategori">
                                                            <option value="">-Tentukan Kategori-
                                                            </option>
                                                            <option value="CRM">CRM</option>
                                                            <option value="FICO">FICO</option>
                                                            <option value="RENTSYS">RENTSYS</option>
                                                            <option value="WORKSHOP">WORKSHOP</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="sub_kategori">Sub Kategori</label>

                                                        <select class="form-control" name="sub_kategori"
                                                            id="sub_kategori">
                                                            <option value="">-Tentukan Sub Kategori-
                                                            </option>
                                                            <option value="CRM">CRM</option>
                                                            <option value="FICO">FICO</option>
                                                            <option value="RENTSYS">RENTSYS</option>
                                                            <option value="WORKSHOP">WORKSHOP</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="menu">Menu</label>

                                                        <select class="form-control" name="menu" id="menu">
                                                            <option value="">-Tentukan Menu system-
                                                            </option>
                                                            <option value="CRM">CRM</option>
                                                            <option value="FICO">FICO</option>
                                                            <option value="RENTSYS">RENTSYS</option>
                                                            <option value="WORKSHOP">WORKSHOP</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="prioritas">Prioritas</label>
                                                        <select class="form-control" name="prioritas" id="prioritas"
                                                            required>
                                                            <option value="0">BIASA</option>
                                                            <option value="1">URGENT</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group col-6">
                                                        <input type="hidden" class="form-control" name="status"
                                                            id="status" value="0">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="problem">Problem</label>
                                                        <textarea name="problem" id="problem" cols="47" rows="15"
                                                            placeholder=" Jelaskan Request / Problem yang di alami di system" autocomplete="off"></textarea>
                                                    </div>

                                                    <div style="display: none;" class="form-group col-6">
                                                        <label for="result">Result</label>
                                                        <textarea name="result" id="result" cols="47" rows="15" autocomplete="off"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Lampiran</label>
                                                        <div class="col-sm-12">
                                                            <input id="image" type="file" name="image"
                                                                accept="image/*" onchange="readURL(this);">
                                                            <input type="hidden" name="hidden_image"
                                                                id="hidden_image">
                                                        </div>
                                                    </div>
                                                    <img id="modal-preview" src="https://via.placeholder.com/150"
                                                        alt="Preview" class="form-group hidden" width="100"
                                                        height="100">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <br>
                                                        <button type="submit" class="btn btn-primary" id="btn-save"
                                                            value="create">Save
                                                            changes</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal" id="btn-cancel">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Modal -->
            <div class="modal fade" id="detailProductModal" tabindex="-1" role="dialog"
                aria-labelledby="detailProductModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #00e897;">
                            <h4 class="modal-title" id="detailProductModalLabel">Detail Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="formDetail">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label for="user">User</label>
                                                        <input type="text" class="form-control" id="detail-user"
                                                            name="detail-user" readonly>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="bidang_system">Bidang System</label>
                                                        <input type="text" class="form-control"
                                                            id="detail-bidang_system" name="detail-bidang_system"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="prioritas">Detail Prioritas</label>
                                                        <input type="text" class="form-control"
                                                            id="detail-prioritas" name="detail-prioritas" readonly>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="status">Status</label>
                                                        <input type="text" class="form-control" id="detail-status"
                                                            name="detail-status" readonly>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="problem">Problem</label>
                                                        <textarea class="form-control" name="detail-problem" id="detail-problem" cols="30" rows="15" readonly></textarea>
                                                    </div>

                                                    <!-- Hidden field to store image URL -->
                                                    <input type="hidden" id="image-url">

                                                    <!-- New View Image Button -->
                                                    <div
                                                        class="form-group col-12  mt-3 mb-3   d-flex justify-content-between">

                                                        <button type="button" class="btn btn-primary"
                                                            id="viewImageBtn">
                                                            <i class="fas fa-eye"></i> View Image
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal" id="btn-close"><i
                                                                class="fas fa-angle-double-left"></i>
                                                            Close</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
        integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    <script>
        var chartData = @json($dataByMonth);

        var chartOne = document.getElementById('chartOne');
        var myChart = new Chart(chartOne, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: '# Total Tiket  ',
                    data: chartData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation: 0,
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 8
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });


        var chartDataStatus = @json($dataByStatus);

        var chartTwo = document.getElementById('chartTwo');
        var myLineChart = new Chart(chartTwo, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: '# Tiket Done',
                    data: chartDataStatus,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 8
                        }
                    }
                }
            }
        });
    </script>

    <script>
        var SITEURL = 'http://127.0.0.1:8000/';
        console.log(SITEURL);
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#laravel_11_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: SITEURL + "tiket",
                    type: 'GET',
                },
                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            if (data) {
                                const date = new Date(data);
                                const formattedDate =
                                    ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                                    ('0' + date.getDate()).slice(-2) + '-' +
                                    date.getFullYear() + ' ' +
                                    ('0' + date.getHours()).slice(-2) + ':' +
                                    ('0' + date.getMinutes()).slice(-2) + ':' +
                                    ('0' + date.getSeconds()).slice(-2);
                                return formattedDate;
                            }
                            return '';
                        }
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'bidang_system',
                        name: 'bidang_system'
                    },
                    // {
                    //     data: 'problem',
                    //     name: 'problem'
                    // },
                    {
                        data: 'prioritas',
                        name: 'prioritas',
                        render: function(data, type, row) {
                            return data == 1 ? 'URGENT' : 'BIASA';
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            let statusText = data == 0 ? 'On Progress' : 'DONE';

                            // Calculate time remaining
                            if (data == 0 && row.created_at) {
                                const createdAt = new Date(row.created_at);
                                const deadline = new Date(createdAt.getTime() + 24 * 60 * 60 *
                                    1000); // 24 hours later

                                // Generate a unique ID for each row
                                const uniqueId = 'time-remaining-' + row
                                    .id; // Assuming `row.id` is unique for each row
                                statusText += ` (Waktu Tersisa <span id="${uniqueId}"></span>)`;

                                // Update the time remaining every second
                                setTimeout(function updateCountdown() {
                                    const now = new Date();
                                    const timeRemaining = deadline - now;

                                    if (timeRemaining > 0) {
                                        // Format time remaining
                                        const hours = Math.floor(timeRemaining / (1000 *
                                            60 * 60));
                                        const minutes = Math.floor((timeRemaining % (1000 *
                                            60 * 60)) / (1000 * 60));
                                        const seconds = Math.floor((timeRemaining % (1000 *
                                            60)) / 1000);
                                        document.getElementById(uniqueId).innerText =
                                            `${hours}h ${minutes}m ${seconds}s`;
                                        setTimeout(updateCountdown,
                                            1000); // Repeat every second
                                    } else {
                                        document.getElementById(uniqueId).innerText =
                                            'Time Expired';
                                    }
                                }, 0);
                            }

                            return statusText;
                        }


                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });

            $('#create-new-product').click(function() {
                $('#btn-save').val("create-product");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#productCrudModal').html("Add New Product");
                $('#ajax-product-modal').modal('show');
                $('#modal-preview').attr('src', 'https://via.placeholder.com/150');
            });

            $('#btn-cancel').click(function() {
                $('#ajax-product-modal').modal('hide');
            })



            $('body').on('click', '.edit-product', function() {
                var product_id = $(this).data('id');
                console.log(product_id);
                $.get('tiket/Edit/' + product_id, function(data) {
                    $('#productCrudModal').html("Edit Product");
                    $('#btn-save').val("edit-product");
                    $('#ajax-product-modal').modal('show');
                    $('#product_id').val(data.id);
                    $('#created_at').val(data.created_at);
                    $('#user').val(data.user);
                    $('#no_hp').val(data.no_hp);
                    $('#bidang_system').val(data.bidang_system);
                    $('#kategori').val(data.kategori);
                    $('#sub_kategori').val(data.sub_kategori);
                    $('#menu').val(data.menu);
                    $('#prioritas').val(data.prioritas);
                    $('#problem').val(data.problem);
                    $('#result').val(data.result);
                    $('#modal-preview').attr('alt', 'No image available');
                    if (data.image) {
                        $('#modal-preview').attr('src', SITEURL + 'public/product/' + data.image);
                        $('#hidden_image').attr('src', SITEURL + 'public/product/' + data.image);
                    }
                })
            });

            // Detail button click
            $('body').on('click', '.detail-product', function() {
                var product_id = $(this).data('id');
                //console.log(data);
                $.get('tiket/Detail/' + product_id, function(data) {
                    if (data) {
                        // Fill the modal with data
                        $('#detail-user').val(data.user);
                        $('#detail-bidang_system').val(data.bidang_system);
                        $('#detail-prioritas').val(data.prioritas == 1 ? 'URGENT' : 'BIASA');
                        $('#detail-status').val(data.status == 0 ? 'On Progress' : 'DONE');
                        $('#detail-problem').val(data.problem);

                        if (data.image) {
                            const imageUrl = SITEURL + 'public/product/' + data.image;
                            $('#modal-preview').attr('src', imageUrl);
                            $('#hidden_image').attr('src', imageUrl);
                            $('#image-url').val(imageUrl); // Set the hidden image URL for viewing
                        }

                        // Show the modal
                        $('#detailProductModal').modal('show');
                    } else {
                        alert('Data tidak ditemukan.');
                    }
                }).fail(function() {
                    alert('Gagal mengambil data.');
                });
            });
            // Close modal
            $('#btn-close').click(function() {
                $('#detailProductModal').modal('hide');
            });

            // JavaScript to open a new page to display the image
            document.getElementById('viewImageBtn').addEventListener('click', function() {
                const imageUrl = document.getElementById('image-url').value;
                if (imageUrl) {
                    window.open(imageUrl, '_blank');
                } else {
                    alert('No image available to view.');
                }
            });



            $('body').on('click', '#delete-product', function() {
                var product_id = $(this).data("id");
                if (confirm("Are You sure want to delete !")) {
                    $.ajax({
                        type: "GET",
                        url: SITEURL + "tiket/Delete/" + product_id,
                        success: function(data) {
                            var oTable = $('#laravel_11_datatable').dataTable();
                            oTable.fnDraw(false);
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });

        });

        $('body').on('submit', '#productForm', function(e) {
            e.preventDefault();
            if (confirm('Are you sure?')) {
                var actionType = $('#btn-save').val();
                $('#btn-save').html('Sending..');
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: SITEURL + "tiket/Store",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        $('#productForm').trigger("reset");
                        $('#ajax-product-modal').modal('hide');

                        toastr.options = {
                            "positionClass": "toast-top-center",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut",
                            "toastClass": "green-toast"
                        };
                        toastr.success('Successfully!!!');

                        setTimeout(function() {
                            var toasts = document.getElementsByClassName('medium-toast');
                            $.each(toasts, function(index, toast) {
                                toast.style.top = '50px';
                                toast.style.width = '300px';
                                toast.style.left = '50%';
                                toast.style.marginLeft = '-150px';
                            });
                        });


                        $('#btn-save').html('Save Changes');
                        var oTable = $('#laravel_11_datatable').dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#btn-save').html('Save Changes');
                    }

                });
            }
        });

        // CSS for green background toastr
        $('<style>.green-toast { background-color: green !important; color: white !important; }</style>').appendTo('head');


        function readURL(input, id) {
            id = id || '#modal-preview';
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(id).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
                $('#modal-preview').removeClass('hidden');
                $('#start').hide();
            }
        }
    </script>

</body>

</html>
