<?php

namespace Rakshitbharat\PermissionBuilder\ViewPermission;

use Illuminate\Support\Facades\Facade;
use Rakshitbharat\PermissionBuilder\ViewPermission\DeclaredPermission;
use Auth;
use Rakshitbharat\PermissionBuilder\Models\AdminRole;
use Rakshitbharat\PermissionBuilder\Models\AdminPermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Facades\LiveServices;

class PermissionFunction extends Facade {

    public static function permissionCompressorView() {
        $permission = DeclaredPermission::permmisionForView();
        $permissionIndividual = array();
        foreach ($permission as $key => $permissions) {
            foreach ($permission[$key] as $keyInner => $permissionsInner) {
                $permissionIndividual[] = $key . '_' . $permissionsInner;
            }
        }
        return $permissionIndividual;
    }

    public static function permissionCompressorViewWithBase() {
        $permission = DeclaredPermission::permmisionForView();
        $permissionIndividual = array();
        foreach ($permission as $key => $permissions) {
            foreach ($permission[$key] as $keyInner => $permissionsInner) {
                $permissionIndividual[$key][] = $key . '_' . $permissionsInner;
            }
        }
        return $permissionIndividual;
    }

    public static function checkDeclaredPermissionView($DeclaredPermission = '') {
        if (LiveServices::accessProtected(Auth::guard(), 'name') != 'admin') {
            return 0;
        }
        if ($DeclaredPermission) {
            if (in_array($DeclaredPermission, PermissionFunction::permissionCompressorView())) {
                $admin_role_id = Auth::guard('admin')->user()->admin_role_id;
                if (!$admin_role_id) {
                    $admin_role_id = 0;
                }
                if ($admin_role_id) {
                    if (array_search($DeclaredPermission, session()->get('admin_permission'))) {
                        return 1;
                    } else {
                        return 0;
                    }
                }
            }
            return 0;
        }
    }

    public static function permissionCompressorURL() {
        $routeCollection = Route::getRoutes();
        $permission = array();
        foreach ($routeCollection as $value) {
            if (array_key_exists('permission_area_name_inroute', $value->action)) {
                if (array_key_exists('permission_area_name_prefix_inroute', $value->action)) {
                    $permission[] = self::split($value->action);
                }
            }
        }
        $permissionIndividual = array();
        foreach ($permission as $key => $permissions) {
            foreach ($permission[$key] as $keyInner => $permissionsInner) {
                $permissionIndividual[] = $permissionsInner;
            }
        }
        return $permissionIndividual;
    }

    public static function permissionCompressorURLWithBase() {
        $routeCollection = Route::getRoutes();
        $permission = array();
        foreach ($routeCollection as $value) {
            if (array_key_exists('permission_area_name_inroute', $value->action)) {
                if (array_key_exists('permission_area_name_prefix_inroute', $value->action)) {
                    $permission[$value->action['permission_area_name_prefix_inroute']] = self::split($value->action);
                }
            }
        }
        return $permission;
    }

    public static function checkDeclaredPermissionURL() {
        if (array_key_exists('permission_area_name_prefix_inroute', \Route::current()->action) || array_key_exists('permission_area_name_inroute', \Route::current()->action)) {
            $permissionIndividual = self::split(\Route::current()->action);
            $admin_role_id = Auth::guard('admin')->user()->admin_role_id;
            if (!$admin_role_id) {
                $admin_role_id = 0;
            }
            if ($admin_role_id) {
                foreach ($permissionIndividual as $permissionIndividuals) {
                    if (!array_search($permissionIndividuals, session()->get('admin_permission'))) {
                        abort(403, 'Access denied for current permission ' . $permissionIndividuals);
                    }
                }
            }
        }
    }

    public static function split($DeclaredPermission) {
        if (strpos($DeclaredPermission['permission_area_name_inroute'], '|') != '') {
            foreach (explode('|', $DeclaredPermission['permission_area_name_inroute']) as $permission_area_name_inroute) {
                $permissionIndividual[] = $DeclaredPermission['permission_area_name_prefix_inroute'] . '_' . $permission_area_name_inroute;
            }
        } else {
            $permissionIndividual[] = $DeclaredPermission['permission_area_name_inroute'] . '_' . $permission_area_name_inroute;
        }
        return $permissionIndividual;
    }

}
