<div class="btn-group" role="group" aria-label="Product Actions">
    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $id }}" data-original-title="Detail"
        class="btn btn-info detail-product">
        🔍 Detail
    </a>

    {{-- <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $id }}" data-original-title="Edit"
        class="btn btn-primary edit-product">
        🖊 Edit
    </a> --}}

    <a href="javascript:void(0);" id="delete-product" data-toggle="tooltip" data-original-title="Delete"
        data-id="{{ $id }}" class="btn btn-danger">
        ❌ Delete
    </a>
</div>
