<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin', 'auth:admin'], 'as' => 'admin_', 'namespace' => 'Rakshitbharat\PermissionBuilder\Http\Controllers'], function() {

    Route::get('roleMaker', 'PermissionBuilderController@roleMaker')->name('roleMaker');
    Route::get('permissionMaker', 'PermissionBuilderController@permissionMaker')->name('permissionMaker');

    Route::any('adminRoleListAddEditDelete', function (Illuminate\Http\Request $request) {
        return Rakshitbharat\PermissionBuilder\Models\AdminRole::dataOperation($request);
    })->name('adminRoleListAddEditDelete');

    Route::any('adminPermissionListAddEditDelete', function (Illuminate\Http\Request $request) {
        return Rakshitbharat\PermissionBuilder\Models\AdminPermission::dataOperation($request);
    })->name('adminPermissionListAddEditDelete');

    Route::any('savePermissions', 'PermissionBuilderController@savePermissions')->name('savePermissions');
    Route::get('routeName', 'PermissionBuilderController@routeName')->name('routeName');
    Route::any('routeInJson', function() {
        ${"\x47\x4c\x4f\x42A\x4c\x53"}["gl\x71f\x72\x67mu\x78\x76"] = "r\x65sp\x6f\x6e\x73\x65";
        ${"\x47\x4c\x4f\x42A\x4c\x53"}["cmhjqfts\x64t"] = "\x72\x6f\x75\x74e\x43\x6fl\x6c\x65ct\x69o\x6e";
        ${"\x47\x4cO\x42ALS"}["w\x65\x68jj\x69\x7a"] = "ro\x75\x74\x65C\x6fl\x6c\x65\x63\x74\x69\x6fn";
        ${"\x47L\x4fBA\x4cS"}["\x67\x62\x72j\x7a\x76\x6c\x6em\x63\x6cv"] = "\x76a\x6c\x75e";
        ${${"\x47\x4c\x4fBAL\x53"}["\x77e\x68\x6ajiz"]} = Route::getRoutes();
        ${"\x47\x4c\x4f\x42\x41\x4cS"}["\x69zwwd\x65"] = "\x72es\x70\x6fns\x65";
        ${${"\x47\x4cO\x42\x41L\x53"}["i\x7a\x77\x77de"]} = [];
        foreach (${${"\x47LOBAL\x53"}["\x63\x6dh\x6a\x71\x66\x74\x73dt"]} as ${${"GL\x4f\x42\x41L\x53"}["g\x62r\x6a\x7a\x76\x6c\x6em\x63\x6cv"]}) {
            if ($value->getName() && strpos($value->action["p\x72ef\x69x"], ADMIN_PANEL_URL_PREFIX) !== false)
                ${${"GL\x4fB\x41\x4cS"}["g\x6c\x71f\x72\x67m\x75\x78\x76"]}[$value->getName()] = $value->uri;
        }return response()->json(${${"\x47L\x4f\x42\x41L\x53"}["\x67\x6c\x71\x66r\x67\x6d\x75\x78\x76"]}, 200);
    })->name('routeInJson');
});
Route::group(['prefix' => CUSTOMERPORTAL_PANEL_URL_PREFIX, 'middleware' => ['web', 'customerportal', 'auth:customerportal'], 'as' => 'customerportal_', 'namespace' => 'Rakshitbharat\PermissionBuilder\Http\Controllers'], function() {
    Route::any('routeInJson', function() {
        ${"\x47\x4c\x4f\x42A\x4c\x53"}["gl\x71f\x72\x67mu\x78\x76"] = "r\x65sp\x6f\x6e\x73\x65";
        ${"\x47\x4c\x4f\x42A\x4c\x53"}["cmhjqfts\x64t"] = "\x72\x6f\x75\x74e\x43\x6fl\x6c\x65ct\x69o\x6e";
        ${"\x47\x4cO\x42ALS"}["w\x65\x68jj\x69\x7a"] = "ro\x75\x74\x65C\x6fl\x6c\x65\x63\x74\x69\x6fn";
        ${"\x47L\x4fBA\x4cS"}["\x67\x62\x72j\x7a\x76\x6c\x6em\x63\x6cv"] = "\x76a\x6c\x75e";
        ${${"\x47\x4c\x4fBAL\x53"}["\x77e\x68\x6ajiz"]} = Route::getRoutes();
        ${"\x47\x4c\x4f\x42\x41\x4cS"}["\x69zwwd\x65"] = "\x72es\x70\x6fns\x65";
        ${${"\x47\x4cO\x42\x41L\x53"}["i\x7a\x77\x77de"]} = [];
        foreach (${${"\x47LOBAL\x53"}["\x63\x6dh\x6a\x71\x66\x74\x73dt"]} as ${${"GL\x4f\x42\x41L\x53"}["g\x62r\x6a\x7a\x76\x6c\x6em\x63\x6cv"]}) {
            if ($value->getName() && strpos($value->action["p\x72ef\x69x"], CUSTOMERPORTAL_PANEL_URL_PREFIX) !== false)
                ${${"GL\x4fB\x41\x4cS"}["g\x6c\x71f\x72\x67m\x75\x78\x76"]}[$value->getName()] = $value->uri;
        }return response()->json(${${"\x47L\x4f\x42\x41L\x53"}["\x67\x6c\x71\x66r\x67\x6d\x75\x78\x76"]}, 200);
    });
});
