<?php

namespace Rakshitbharat\PermissionBuilder\Http\Controllers;

use view;
use Illuminate\Routing\Controller;
use App\Models\PermissionBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Route;
use Rakshitbharat\PermissionBuilder\ViewPermission\PermissionFunction;
use Rakshitbharat\PermissionBuilder\ViewPermission\DeclaredPermission;
use Rakshitbharat\PermissionBuilder\Models\AdminRole;

class PermissionBuilderController extends Controller {

    public $title = 'Permission Builder';

    public function roleMaker() {
        return view('permissionBuilder::roleMaker', array('title' => 'Role Maker', 'admin' => \App\Admin::all('email', 'id')));
    }

    public function permissionMaker() {
        return view('permissionBuilder::permissionMaker', array('title' => 'Permission Maker', 'role' => AdminRole::all('admin_role_slug', 'id')));
    }

}
