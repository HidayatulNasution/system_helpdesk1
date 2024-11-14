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
                <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xl-14 col-lg-14">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="product_id" id="product_id">

                                        <div class="form-group">
                                            {{-- <label for="tgl_entry" class="col-sm-4 control-label">Tanggal Entry</label> --}}
                                            <div class="col-sm-12">
                                                <input type="hidden" class="form-control" id="created_at"
                                                    name="created_at" value="<?= date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="user">User</label>
                                            <input type="text" class="form-control" id="user" name="user"
                                                value="" required="" autocomplete="off">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="no_hp">No.
                                                HP</label>
                                            <input type="number" class="form-control" id="no_hp" name="no_hp"
                                                value="" required="" autocomplete="off">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="bidang_system">Bidang
                                                System</label>
                                            <select class="form-control" name="bidang_system" id="bidang_system"
                                                required>
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

                                            <select class="form-control" name="sub_kategori" id="sub_kategori">
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
                                            <select class="form-control" name="prioritas" id="prioritas" required>
                                                <option value="0">BIASA</option>
                                                <option value="1">URGENT</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="0">On Progress</option>
                                                <option value="1">Done</option>
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label for="problem">Problem</label>
                                                <textarea name="problem" id="problem" cols="47" rows="15"
                                                    placeholder=" Jelaskan Request / Problem yang di alami di system" autocomplete="off"></textarea>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="result">Result</label>
                                                <textarea name="result" id="result" cols="47" rows="15"
                                                    placeholder=" Jelaskan penyelesaian dari case tersebut" autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Lampiran</label>
                                            <div class="col-sm-12">
                                                <input id="image" type="file" name="image" accept="image/*"
                                                    onchange="readURL(this);">
                                                <input type="hidden" name="hidden_image" id="hidden_image">
                                            </div>
                                        </div>
                                        <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview"
                                            class="form-group hidden" width="100" height="100">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <br>
                                            <button type="submit" class="btn btn-primary" id="btn-save"
                                                value="create">Save
                                                changes</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                                id="btn-cancel">Cancel</button>
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
                                            <input type="text" class="form-control" id="detail-bidang_system"
                                                name="detail-bidang_system" readonly>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="prioritas">Detail Prioritas</label>
                                            <input type="text" class="form-control" id="detail-prioritas"
                                                name="detail-prioritas" readonly>
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
                                        <div class="form-group col-12">
                                            <label for="result">Result</label>
                                            <textarea class="form-control" name="detail-result" id="detail-result" cols="30" rows="15" readonly></textarea>
                                        </div>

                                        <!-- Hidden field to store image URL -->
                                        <input type="hidden" id="image-url">

                                        <!-- New View Image Button -->
                                        <div class="form-group col-12  mt-3 mb-3   d-flex justify-content-between">

                                            <button type="button" class="btn btn-primary" id="viewImageBtn">
                                                <i class="fas fa-eye"></i> View Image
                                            </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                                id="btn-close"><i class="fas fa-angle-double-left"></i>
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
