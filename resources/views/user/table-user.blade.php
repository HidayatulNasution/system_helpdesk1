<div class="w-full mt-8">
    <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-list mr-3"></i> Table User
    </p>
    <div class="bg-white overflow-auto">
        <table class="min-w-full bg-white" id="laravel_11_datatable2">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm">No</th>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm" style="min-width: 100px;">Tanggal
                        Create</th>
                    <th class="text-left py-3 px-2 uppercase font-semibold text-sm">Username</th>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm">Email</th>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm" style="min-width:100px;">Status</th>
                    <th class="text-left py-4 px-3 uppercase font-semibold text-sm" style="min-width:100px;">Action</th>

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
                url: SITEURL + "user",
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
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'email',
                    name: 'email'
                },

                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        return data == 1 ? 'ADMIN' : 'USER';
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

        $('#create-new-user').click(function() {
            $('#btn-save').val("create-user");
            $('#user_id').val('');
            $('#userForm').trigger("reset");
            $('#userCrudModal').html("Add New user");
            $('#ajax-user-modal').modal('show');
            $('#modal-preview').attr('src', 'https://via.placeholder.com/150');
        });

        $('#btn-cancel').click(function() {
            $('#ajax-user-modal').modal('hide');
        })

        $('body').on('click', '.edit-user', function() {
            var user_id = $(this).data('id');
            console.log(user_id);
            $.get('user/Edit/' + user_id, function(data) {
                $('#userCrudModal').html("Edit user");
                $('#btn-save').val("edit-user");
                $('#ajax-user-modal').modal('show');
                $('#user_id').val(data.id);
                $('#created_at').val(data.created_at);
                $('#username').val(data.username);
                $('#email').val(data.email);
                $('#password').val(data.password);
                $('#status').val(data.status);
            })
        });


        // Detail button click
        $('body').on('click', '.detail-user', function() {
            var user_id = $(this).data('id');
            //console.log(data);
            $.get('user/Detail/' + user_id, function(data) {
                if (data) {
                    // Fill the modal with data
                    $('#detail-username').val(data.username);
                    $('#detail-email').val(data.email);
                    //$('#detail-password').val(data.password);
                    $('#detail-status').val(data.status == 0 ? 'ADMIN' : 'USER');

                    // Show the modal
                    $('#detailUserModal').modal('show');
                } else {
                    alert('Data tidak ditemukan.');
                }
            }).fail(function() {
                alert('Gagal mengambil data.');
            });
        });
        // Close modal
        $('#btn-close').click(function() {
            $('#detailUserModal').modal('hide');
        });

        $('body').on('click', '#delete-user', function() {
            var user_id = $(this).data("id");
            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    type: "GET",
                    url: SITEURL + "user/Delete/" + user_id,
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

    $('body').on('submit', '#userForm', function(e) {
        e.preventDefault();
        if (confirm('Are you sure?')) {
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending..');
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: SITEURL + "user/Store",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    $('#userForm').trigger("reset");
                    $('#ajax-user-modal').modal('hide');

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
