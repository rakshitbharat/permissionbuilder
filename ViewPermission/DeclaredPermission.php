<?php

namespace Rakshitbharat\PermissionBuilder\ViewPermission;

use Rakshitbharat\PermissionBuilder\ViewPermission\PermissionFunction;
use Illuminate\Support\Facades\Facade;

class DeclaredPermission extends Facade {

    public static function permmisionForView() {
        $permission['location_view'] = array(
            'view',
            'add',
            'edit',
            'delete'
        );
        $permission['locationmanagement_view'] = array(
            'view',
        );
        $permission['usermanagement_view'] = array(
            'view',
        );
        $permission['customer_view'] = array(
            'view',
            'add',
            'edit',
            'delete'
        );
        $permission['permission_management_view'] = array(
            'view',
        );
        $permission['systemutilities_view'] = array(
            'view',
        );
        return $permission;
    }

}

//URL Permission on Routes, Example
//Route::get('home', [
//        'as' => 'home',
//        'uses' => 'HomeController@index',
//        'permission_area_name_prefix_inroute' => 'adminHome_',
//        'permission_area_name_inroute' => 'create|read|update|delete',
//    ]);

//View Permission on Code or In View, Example
//if (PermissionFunction::checkDeclaredPermissionView('userView_update')) {
//                                        $string .= "<a href='javascript:;' onclick=edit('$data->id','$tableName') class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-edit'></i> Edit</a> &nbsp";
//                                    }
//if (PermissionFunction::checkDeclaredPermissionView('userView_delete')) {
//    $string .= "<a href='javascript:;' onclick=destroyFinally('$data->id','$tableName') class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-remove-circle'></i> Delete</a>";
//}

//Check Route declaration for this module
//Auth not found error
//now it can be solved by adding middleware to code
//Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin_auth']

//Add this facades to app config aliases
//'PermissionFunction' => Rakshitbharat\PermissionBuilder\ViewPermission\PermissionFunction::class,

//URL for this module
//$masterMenus[] = [
//    'menu_text' => 'Role Maker',
//    'url' => route("admin_roleMaker"),
//    'childs' => []
//];
//$masterMenus[] = [
//    'menu_text' => 'Permission Maker',
//    'url' => route("admin_permissionMaker"),
//    'childs' => []
//];

//Dont forget to change blade main layout in view files
//@extends('admin.layouts.app')

//set to run migration by module by following code
//before this check and match admin or user table which you want to add admin_role_id 
//Just go ahead and take a look in migration
//
//php artisan module:migrate permissionBuilder

//Last set to add middleware check code
//PermissionFunction::checkDeclaredPermissionURL();