@extends('admin.adminLayout')
@section('headMenu')
<a href="{!! route('admin_permissionMaker') !!}" class="btn green-steel btn-circle">Permission Maker (Raw)</a>
<a id="add" onclick="$('#edit').modal('show');$('#addEdit')[0].reset();$('#id').val(null);" class="btn green-steel btn-circle">Add {{ $title }}</a>
@stop
@section('content')
<style>
    .checkbox {
        padding-left: 20px; }
    .checkbox label {
        display: inline-block;
        position: relative;
        padding-left: 5px; }
    .checkbox label::before {
        content: "";
        display: inline-block;
        position: absolute;
        width: 17px;
        height: 17px;
        left: 0;
        margin-left: -20px;
        border: 1px solid #cccccc;
        border-radius: 3px;
        background-color: #fff;
        -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
        -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
        transition: border 0.15s ease-in-out, color 0.15s ease-in-out; }
    .checkbox label::after {
        display: inline-block;
        position: absolute;
        width: 16px;
        height: 16px;
        left: 0;
        top: 0;
        margin-left: -20px;
        padding-left: 3px;
        padding-top: 1px;
        font-size: 11px;
        color: #555555; }
    .checkbox input[type="checkbox"] {
        opacity: 0; }
    .checkbox input[type="checkbox"]:focus + label::before {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px; }
    .checkbox input[type="checkbox"]:checked + label::after {
        font-family: 'FontAwesome';
        content: "\f00c"; }
    .checkbox input[type="checkbox"]:disabled + label {
        opacity: 0.65; }
    .checkbox input[type="checkbox"]:disabled + label::before {
        background-color: #eeeeee;
        cursor: not-allowed; }
    .checkbox.checkbox-circle label::before {
        border-radius: 50%; }
    .checkbox.checkbox-inline {
        margin-top: 0; }

    .checkbox-primary input[type="checkbox"]:checked + label::before {
        background-color: #428bca;
        border-color: #428bca; }
    .checkbox-primary input[type="checkbox"]:checked + label::after {
        color: #fff; }

    .checkbox-danger input[type="checkbox"]:checked + label::before {
        background-color: #d9534f;
        border-color: #d9534f; }
    .checkbox-danger input[type="checkbox"]:checked + label::after {
        color: #fff; }

    .checkbox-info input[type="checkbox"]:checked + label::before {
        background-color: #5bc0de;
        border-color: #5bc0de; }
    .checkbox-info input[type="checkbox"]:checked + label::after {
        color: #fff; }

    .checkbox-warning input[type="checkbox"]:checked + label::before {
        background-color: #f0ad4e;
        border-color: #f0ad4e; }
    .checkbox-warning input[type="checkbox"]:checked + label::after {
        color: #fff; }

    .checkbox-success input[type="checkbox"]:checked + label::before {
        background-color: #5cb85c;
        border-color: #5cb85c; }
    .checkbox-success input[type="checkbox"]:checked + label::after {
        color: #fff; }

    .radio {
        padding-left: 20px; }
    .radio label {
        display: inline-block;
        position: relative;
        padding-left: 5px; }
    .radio label::before {
        content: "";
        display: inline-block;
        position: absolute;
        width: 17px;
        height: 17px;
        left: 0;
        margin-left: -20px;
        border: 1px solid #cccccc;
        border-radius: 50%;
        background-color: #fff;
        -webkit-transition: border 0.15s ease-in-out;
        -o-transition: border 0.15s ease-in-out;
        transition: border 0.15s ease-in-out; }
    .radio label::after {
        display: inline-block;
        position: absolute;
        content: " ";
        width: 11px;
        height: 11px;
        left: 3px;
        top: 3px;
        margin-left: -20px;
        border-radius: 50%;
        background-color: #555555;
        -webkit-transform: scale(0, 0);
        -ms-transform: scale(0, 0);
        -o-transform: scale(0, 0);
        transform: scale(0, 0);
        -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33); }
    .radio input[type="radio"] {
        opacity: 0; }
    .radio input[type="radio"]:focus + label::before {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px; }
    .radio input[type="radio"]:checked + label::after {
        -webkit-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -o-transform: scale(1, 1);
        transform: scale(1, 1); }
    .radio input[type="radio"]:disabled + label {
        opacity: 0.65; }
    .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed; }
    .radio.radio-inline {
        margin-top: 0; }

    .radio-primary input[type="radio"] + label::after {
        background-color: #428bca; }
    .radio-primary input[type="radio"]:checked + label::before {
        border-color: #428bca; }
    .radio-primary input[type="radio"]:checked + label::after {
        background-color: #428bca; }

    .radio-danger input[type="radio"] + label::after {
        background-color: #d9534f; }
    .radio-danger input[type="radio"]:checked + label::before {
        border-color: #d9534f; }
    .radio-danger input[type="radio"]:checked + label::after {
        background-color: #d9534f; }

    .radio-info input[type="radio"] + label::after {
        background-color: #5bc0de; }
    .radio-info input[type="radio"]:checked + label::before {
        border-color: #5bc0de; }
    .radio-info input[type="radio"]:checked + label::after {
        background-color: #5bc0de; }

    .radio-warning input[type="radio"] + label::after {
        background-color: #f0ad4e; }
    .radio-warning input[type="radio"]:checked + label::before {
        border-color: #f0ad4e; }
    .radio-warning input[type="radio"]:checked + label::after {
        background-color: #f0ad4e; }

    .radio-success input[type="radio"] + label::after {
        background-color: #5cb85c; }
    .radio-success input[type="radio"]:checked + label::before {
        border-color: #5cb85c; }
    .radio-success input[type="radio"]:checked + label::after {
        background-color: #5cb85c; }
    #origin {
        font-size: 15px;
        font-family: cursive;
    }
    #origin label{
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .list-group-item {
        position: relative;
        display: block;
        padding: 3px 5px;
        margin-bottom: -1px;
        background-color: #fff;
        border: 1px solid #ddd;
    }
</style>
<div class="table-container">
    <table class="table" id="dataTableBuilder">
        <thead>
            <tr>
                <th width="20px">No</th>
                <th>Description</th>
                <th>Role</th>
                <th  width="130px">Action</th>
            </tr>
        </thead>
    </table>
</div>
<div id="edit" class="modal fade" role="dialog">
    <form id="addEdit" class="form-group" method="POST"  enctype="multipart/form-data">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="form-errors"></div>
                    <div class="row">
                        <div id="origin">
                            @foreach(PermissionFunction::permissionCompressorViewWithBase() as $key => $declaredPermissionsWithBase)
                            <div class="col-md-4">
                                <ul class="list-group">
                                    <li class="list-group-item  list-group-item-info active">{{ $key }}</li>
                                    @foreach($declaredPermissionsWithBase as $declaredPermissions)
                                    <li class="list-group-item draggable sortable">
                                        {{ $declaredPermissions }}
                                        <div class="pull-right checkbox checkbox-primary checkbox-inline">
                                            <input id="{{ $declaredPermissions }}" name="admin_permission_slug[{{ $declaredPermissions }}]" type="checkbox" value="{{ $declaredPermissions }}">
                                            <label for="{{ $declaredPermissions }}">
                                                On
                                            </label>
                                        </div>
                                        <div class="pull-right checkbox checkbox-danger checkbox-inline">
                                            <input id="admin_permission_slug_deleted{{ $declaredPermissions }}" name="admin_permission_slug_deleted[{{ $declaredPermissions }}]" type="checkbox" value="{{ $declaredPermissions }}">
                                            <label for="admin_permission_slug_deleted{{ $declaredPermissions }}">
                                                Off &nbsp;&nbsp;
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                            @foreach(PermissionFunction::permissionCompressorURLWithBase() as $key => $declaredPermissionsWIthBase)
                            <div class="col-md-4">
                                <ul class="list-group">
                                    <li class="list-group-item list-group-item-success active">{{ $key }}</li>
                                    @foreach($declaredPermissionsWIthBase as $declaredPermissions)
                                    <li class="list-group-item draggable sortable">
                                        {{ $declaredPermissions }}
                                        <div class="pull-right checkbox checkbox-primary checkbox-inline">
                                            <input id="{{ $declaredPermissions }}" name="admin_permission_slug[{{ $declaredPermissions }}]" type="checkbox" value="{{ $declaredPermissions }}">
                                            <label for="{{ $declaredPermissions }}">
                                                On
                                            </label>
                                        </div>
                                        <div class="pull-right checkbox checkbox-danger checkbox-inline">
                                            <input id="admin_permission_slug_deleted{{ $declaredPermissions }}" name="admin_permission_slug_deleted[{{ $declaredPermissions }}]" type="checkbox" value="{{ $declaredPermissions }}">
                                            <label for="admin_permission_slug_deleted{{ $declaredPermissions }}">
                                                Off &nbsp;&nbsp;
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Admin Role slug/title</label>
                            <input class="form-control" id="admin_role_slug" name="admin_role_slug">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Admin Role Description</label>
                            <textarea class="form-control" id="admin_role_description" name="admin_role_description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" id="id" name="id">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
        ajax: "{{ route('admin_adminRoleListAddEditDelete') }}?datatable=yes",
        columns: [
            {data: 'id'},
            {data: 'admin_role_description'},
            {data: 'admin_role_slug'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    function edit(id) {
        $('#edit').modal('show');
        $.getJSON("{{ route('admin_adminRoleListAddEditDelete') }}", {id: id}, function (json) {
            $.each(json, function (key, value) {
                if (key !== 'profile_image' && key !== 'cover_image') {
                    $('input[name="' + key + '"]').val(value);
                    $('textarea[name="' + key + '"]').val(value);
                    $("select[name=" + key + "]").val(value).trigger("change");
                    $("select[name=" + key + "]").val(value);
                }
                if (key == 'admin_permission') {
                    $.each(value, function (keyIn, valueIn) {
                        var fieldName = 'admin_permission_slug[' + valueIn.admin_permission_slug + ']';
                        $('input[name="' + fieldName + '"]').prop('checked', true);
                    });
                }
            });
        });
    }
    function resetTable() {
        $('#edit').modal('hide');
        $('#dataTableBuilder').dataTable().fnDraw(false);
        $('#addEdit')[0].reset();
        $('#id').val(null);
    }
    $('#edit').on('hidden.bs.modal', function () {
        resetTable();
    });
    $('form#addEdit').submit(function (event) {
        $.ajax({
            type: "POST",
            url: "{{ route('admin_adminRoleListAddEditDelete') }}",
            data: new FormData($('#addEdit')[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
                resetTable();
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