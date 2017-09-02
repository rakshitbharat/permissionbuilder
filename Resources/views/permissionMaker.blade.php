@extends('admin.adminLayout')
@section('headMenu')
<a id="add" onclick="$('#edit').modal('show'); $('#addEdit')[0].reset(); $('#id').val(null);" class="btn green-steel btn-circle">Add {{ $title }}</a>
@stop
@section('content')
<div class="table-container">
    <table class="table" id="dataTableBuilder">
        <thead>
            <tr>
                <th width="20px">No</th>
                <th>admin_permission_slug</th>
                <th  width="130px">Action</th>
            </tr>
        </thead>
    </table>
</div>
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addEdit" class="form-group" method="POST"  enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="form-errors"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class = "form-group">
                                <label for="name">admin_permission_slug</label>
                                <input class="form-control" rows = "3" id="admin_permission_slug" name="admin_permission_slug">
                            </div>
                            <div class = "form-group">
                                <label for="name">admin_role_id</label>
                                <select class="form-control" rows = "3" id="admin_role_id" name="admin_role_id">
                                    @foreach($role as $roles)
                                    <option value="{{ $roles->id }}">{{ $roles->admin_role_slug }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id" name="id">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('javascript')
<script>
    var table = $('#dataTableBuilder').DataTable({
        bProcessing: true,
        bServerSide: true,
        processing: true,
        serverSide: true,
        order: [0, 'desc'],
        ajax: "{{ route('admin_adminPermissionListAddEditDelete') }}?datatable=yes",
        columns: [
            {data: 'id'},
            {data: 'admin_permission_slug'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    function edit(id) {
        $('#edit').modal('show');
        $.getJSON("{{ route('admin_adminPermissionListAddEditDelete') }}", {id: id}, function (json) {
            $.each(json, function (key, value) {
                if (key !== 'profile_image' && key !== 'cover_image') {
                    $('input[name="' + key + '"]').val(value);
                    $('textarea[name="' + key + '"]').val(value);
                    $("select[name=" + key + "]").val(value).trigger("change");
                    $("select[name=" + key + "]").val(value);
                }
            });
        });
    }
    $('#edit').on('hidden.bs.modal', function () {
        resetField();
    });
    $('form#addEdit').submit(function (event) {
        $.ajax({
            type: "POST",
            url: "{{ route('admin_adminPermissionListAddEditDelete') }}",
            data: new FormData($('#addEdit')[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                $('#edit').modal('hide');
            },
            error: function (jqXhr) {
                if (jqXhr.status === 422) {
                    $.each(jqXhr.responseJSON, function (key, value) {
                        $('input[name="' + key + '"]').notify(
                                value,
                                {position: "top"}
                        );
                        $('input[file="' + key + '"]').notify(
                                value,
                                {position: "top"}
                        );
                        $('textarea[name="' + key + '"]').notify(
                                value,
                                {position: "top"}
                        );
                        $("select[name=" + key + "]").notify(
                                value,
                                {position: "top"}
                        );
                        $("select[name=" + key + "]").notify(
                                value,
                                {position: "top"}
                        );
                    });
                }
            }
        });
        event.preventDefault();
    });
</script>
@endsection