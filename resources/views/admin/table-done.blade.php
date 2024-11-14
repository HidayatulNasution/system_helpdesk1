<div class="w-full mt-8">
    <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-list mr-3"></i> Done Tiket
    </p>

    <div class="w-full mt-2 mb-2">
        <div class="flex space-x-4">
            <select id="filter-month" class="border border-gray-400 rounded px-4 py-2">
                <option value="">All Months</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <select id="filter-year" class="border border-gray-400 rounded px-4 py-2">
                <option value="">All Years</option>
                @for ($year = 2024; $year <= date('Y') + 6; $year++)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
            <button id="filter-button" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
            <a href="javascript:void(0)" id="download-excel" class="bg-green-500 text-white px-4 py-2 rounded">Download
                Excel</a>
        </div>
    </div>


    <div class="bg-white overflow-auto">
        <table class="min-w-full bg-white" id="laravel_11_datatable">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm">No</th>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm" style="min-width: 100px;">Tanggal
                        Entry</th>
                    <th class="text-left py-3 px-2 uppercase font-semibold text-sm">User</th>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm">Bidang System</th>
                    {{-- <th class="text-left py-3 px-2 uppercase font-semibold text-sm">Problem</th> --}}
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm">Prioritas</th>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm" style="min-width:100px;">Status</th>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm" style="min-width:100px;">Action</th>

                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        var SITEURL = 'http://127.0.0.1:8000/';
        var table = $('#laravel_11_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: SITEURL + "admin/Done",
                type: 'GET',
                data: function(d) {
                    d.month = $('#filter-month').val();
                    d.year = $('#filter-year').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data) {
                        if (data) {
                            const date = new Date(data);
                            return ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                                ('0' + date.getDate()).slice(-2) + '-' +
                                date.getFullYear() + ' ' +
                                ('0' + date.getHours()).slice(-2) + ':' +
                                ('0' + date.getMinutes()).slice(-2) + ':' +
                                ('0' + date.getSeconds()).slice(-2);
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
                {
                    data: 'prioritas',
                    name: 'prioritas',
                    render: function(data) {
                        return data == 1 ? 'URGENT' : 'BIASA';
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        let statusText = data == 0 ? 'On Progress' : 'DONE';
                        if (data == 0 && row.created_at) {
                            const createdAt = new Date(row.created_at);
                            const deadline = new Date(createdAt.getTime() + 24 * 60 * 60 *
                                1000);
                            const uniqueId = 'time-remaining-' + row.id;
                            statusText += ` (Waktu Tersisa <span id="${uniqueId}"></span>)`;
                            setTimeout(function updateCountdown() {
                                const now = new Date();
                                const timeRemaining = deadline - now;
                                if (timeRemaining > 0) {
                                    const hours = Math.floor(timeRemaining / (1000 *
                                        60 * 60));
                                    const minutes = Math.floor((timeRemaining % (1000 *
                                        60 * 60)) / (1000 * 60));
                                    const seconds = Math.floor((timeRemaining % (1000 *
                                        60)) / 1000);
                                    document.getElementById(uniqueId).innerText =
                                        `${hours}h ${minutes}m ${seconds}s`;
                                    setTimeout(updateCountdown, 1000);
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
                }
            ],
            order: [
                [0, 'desc']
            ]
        });

        $('#filter-button').click(function() {
            table.draw();
        });

        // Handle Excel download
        $('#download-excel').click(function() {
            var month = $('#filter-month').val();
            var year = $('#filter-year').val();
            var url = SITEURL + 'admin/download-done-excel?month=' + month + '&year=' + year;
            window.location.href = url;
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
