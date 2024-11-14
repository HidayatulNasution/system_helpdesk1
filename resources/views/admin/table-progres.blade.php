<div class="w-full mt-6">
    <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-list mr-3"></i> Progress Tiket
    </p>
    <div class="bg-white overflow-auto">
        <table class="table align-items-center mb-0" id="laravel_11_datatable2">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm">No</th>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm" style="min-width: 100px;">Tanggal
                        Entry</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">User</th>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm">Bidang System</th>
                    {{-- <th class="text-left py-3 px-2 uppercase font-semibold text-sm">Problem</th> --}}
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm">Prioritas</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm" style="min-width:100px;">Status</th>
                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm" style="min-width:100px;">Action</th>

                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    var SITEURL = 'http://127.0.0.1:8000/';
    console.log(SITEURL);
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#laravel_11_datatable2').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: SITEURL + "admin",
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
                $('#status').val(data.status);
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
                    $('#detail-result').val(data.result);

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
                        location.reload();
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
                    location.reload();
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
