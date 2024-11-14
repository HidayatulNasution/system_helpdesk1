<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Test</h1>
        <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-product">Add New</a>
        <br><br>
        <table class="table table-bordered table-striped" id="laravel_11_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No</th>
                    <th>Tanggal Entry</th>
                    <th>User</th>
                    <th>No. HP</th>
                    <th>Bidang System</th>
                    <th>Kategori</th>
                    <th>Sub Kategori</th>
                    <th>Menu</th>
                    <th>Prioritas</th>
                    <th>Handle BY</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="ajax-product-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="productCrudModal"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" id="product_id">
                        {{-- <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Tilte" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="category" name="category"
                                    placeholder="Enter Category" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="price" name="price"
                                    placeholder="Enter Price" value="" required="">
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="tgl_entry" class="col-sm-4 control-label">Tanggal Entry</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="tgl_entry" name="tgl_entry"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user" class="col-sm-4 control-label">User</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="user" name="user" value=""
                                    required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="col-sm-4 control-label">No. HP</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="no_hp" name="no_hp" value=""
                                    required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bidang_system" class="col-sm-4 control-label">Bidang System</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="bidang_system" name="bidang_system"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kategori" class="col-sm-4 control-label">Kategori</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="kategori" name="kategori" value=""
                                    required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sub_kategori" class="col-sm-4 control-label">Sub Kategori</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="sub_kategori" name="sub_kategori"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="menu" class="col-sm-4 control-label">Menu</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="menu" name="menu" value=""
                                    required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prioritas" class="col-sm-4 control-label">Prioritas</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="prioritas" name="prioritas"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="handle_by" class="col-sm-4 control-label">Handle BY</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="handle_by" name="handle_by"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-12">
                                <input id="image" type="file" name="image" accept="image/*"
                                    onchange="readURL(this);">
                                <input type="hidden" name="hidden_image" id="hidden_image">
                            </div>
                        </div>
                        <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview"
                            class="form-group hidden" width="100" height="100">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                                changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
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
            $('#laravel_11_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: SITEURL + "tiket",
                    type: 'GET',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        'visible': false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    // {
                    //     data: 'title',
                    //     name: 'title'
                    // },
                    // {
                    //     data: 'category',
                    //     name: 'category'
                    // },
                    // {
                    //     data: 'price',
                    //     name: 'price'
                    // },
                    {
                        data: 'tgl_entry',
                        name: 'tgl_entry'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
                    },
                    {
                        data: 'bidang_system',
                        name: 'bidang_system'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'sub_kategori',
                        name: 'sub_kategori'
                    },
                    {
                        data: 'menu',
                        name: 'menu'
                    },
                    {
                        data: 'prioritas',
                        name: 'prioritas'
                    },
                    {
                        data: 'handle_by',
                        name: 'handle_by'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false
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

            $('body').on('click', '.edit-product', function() {
                var product_id = $(this).data('id');
                console.log(product_id);
                $.get('tiket/Edit/' + product_id, function(data) {
                    $('#productCrudModal').html("Edit Product");
                    $('#btn-save').val("edit-product");
                    $('#ajax-product-modal').modal('show');
                    $('#product_id').val(data.id);
                    //$('#title').val(data.title);
                    //$('#category').val(data.category);
                    //$('#price').val(data.price);
                    $('#tgl_entry').val(data.tgl_entry);
                    $('#user').val(data.user);
                    $('#no_hp').val(data.no_hp);
                    $('#bidang_system').val(data.bidang_system);
                    $('#kategori').val(data.kategori);
                    $('#sub_kategori').val(data.sub_kategori);
                    $('#menu').val(data.menu);
                    $('#prioritas').val(data.prioritas);
                    $('#handle_by').val(data.handle_by);
                    $('#modal-preview').attr('alt', 'No image available');
                    if (data.image) {
                        $('#modal-preview').attr('src', SITEURL + 'public/product/' + data.image);
                        $('#hidden_image').attr('src', SITEURL + 'public/product/' + data.image);
                    }
                })
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
                success: (data) => {
                    console.log(data);
                    $('#productForm').trigger("reset");
                    $('#ajax-product-modal').modal('hide');
                    $('#btn-save').html('Save Changes');
                    var oTable = $('#laravel_11_datatable').dataTable();
                    oTable.fnDraw(false);
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#btn-save').html('Save Changes');
                }
            });
        });

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
