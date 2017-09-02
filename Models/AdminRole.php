<?php

namespace Rakshitbharat\PermissionBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Yajra\Datatables\Datatables;
use Validator;
use Rakshitbharat\PermissionBuilder\Models\AdminPermission;

class AdminRole extends Model {

    protected $table = 'admin_role';
    protected $guarded = ['id'];

    public static function dataOperation($request) {
        if ($request->method() == 'GET') {
            if ($request->datatable == 'yes') {
                return Datatables::of(self::select('*'))
                                ->addColumn('action', function ($data) {
                                    $tableName = with(new static)->getTable();
                                    $string = "<a href='javascript:;' onclick=edit('$data->id','$tableName') class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-edit'></i> Edit</a> &nbsp"
                                            . "<a href='javascript:;' onclick=destroyFinally('$data->id','$tableName') class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-remove-circle'></i> Delete</a>";
                                    return $string;
                                })
                                ->make(true);
            }
            if ($request->delete == 'yes' && $request->id) {
                self::find($request->id)->delete();
                return 'done';
            }
            if ($request->id) {
                $self = self::find($request->id);
                $self->admin_permission = AdminPermission::where('admin_role_id', '=', $self->id)->get();
                return $self;
            } else {
                return self::all();
            }
        }
        if ($request->method() == 'POST') {
            self::validator($request->all())->validate();
            if ($request->id) {
                $self = self::find($request->id);
            } else {
                $self = new self;
            }

            $self->admin_role_description = $request->admin_role_description;
            $self->admin_role_slug = $request->admin_role_slug;
            $self->created_at = \Carbon\Carbon::now()->toDateTimeString();
            $self->updated_at = \Carbon\Carbon::now()->toDateTimeString();
            $self->save();

            if ($request->admin_permission_slug) {
                foreach ($request->admin_permission_slug as $admin_permission_slugs) {
                    $AdminPermission = AdminPermission::where('admin_permission_slug', '=', $admin_permission_slugs)->where('admin_role_id', '=', $self->id)->first();
                    if (!$AdminPermission) {
                        $AdminPermission = new AdminPermission();
                    }
                    $AdminPermission->admin_permission_slug = $admin_permission_slugs;
                    $AdminPermission->admin_role_id = $self->id;
                    $AdminPermission->status = 1;
                    $AdminPermission->save();
                }
                if ($request->admin_permission_slug_deleted) {
                    foreach ($request->admin_permission_slug_deleted as $admin_permission_slug_deleteds) {
                        AdminPermission::where('admin_permission_slug', '=', $admin_permission_slug_deleteds)->where('admin_role_id', '=', $self->id)->delete();
                    }
                }
            }
            return $self;
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $request
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected static function validator($request) {
        return Validator::make(
                        $request, [
        ]);
    }

}
