# Permission Builder - By Rakshit Patel | Tested by - Afaz Khatri
# Most easiest Permission Builder which will auto detect permissions for you
# 



| Autoloaded Service Providers
|--------------------------------------------------------------------------
|
| The service providers listed here will be automatically loaded on the
| request to your application. Feel free to add your own services to
| this array to grant expanded functionality to your applications.
|
``` php
'providers' => [
Rakshitbharat\PermissionBuilder\Providers\PermissionBuilderServiceProvider::class,
```


| Class Aliases
|--------------------------------------------------------------------------
|
| This array of class aliases will be registered when this application
| is started. However, feel free to register as many as you wish as
| the aliases are "lazy" loaded so they don't hinder performance.
|
``` php
'aliases' => [
'PermissionFunction' => Rakshitbharat\PermissionBuilder\ViewPermission\PermissionFunction::class,
```


| URL Permission on Routes, Example
|--------------------------------------------------------------------------
``` php
Route::get('home', [
    'as' => 'home',
    'uses' => 'HomeController@index',
    'permission_area_name_prefix_inroute' => 'adminHome_',
    'permission_area_name_inroute' => 'create|read|update|delete',
]);
```



| View Permission on Code or In View, Example
|--------------------------------------------------------------------------
``` php
if (PermissionFunction::checkDeclaredPermissionView('userView_update')) {
    $string .= "<a href='javascript:;' onclick=edit('$data->id','$tableName') class='btn btn-xs btn-primary'><i class='glyphicon glyphicon-edit'></i> Edit</a> &nbsp";
}
if (PermissionFunction::checkDeclaredPermissionView('userView_delete')) {
    $string .= "<a href='javascript:;' onclick=destroyFinally('$data->id','$tableName') class='btn btn-xs btn-danger'><i class='glyphicon glyphicon-remove-circle'></i> Delete</a>";
}
```

| Check Route declaration for this module
|--------------------------------------------------------------------------
| Auth not found error
| now it can be solved by adding middleware to code
``` php
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin_auth']
```
| URL for this module
|--------------------------------------------------------------------------
``` php
$masterMenus[] = [
    'menu_text' => 'Role Maker',
    'url' => route("admin_roleMaker"),
    'childs' => []
];
$masterMenus[] = [
    'menu_text' => 'Permission Maker',
    'url' => route("admin_permissionMaker"),
    'childs' => []
];
```

| @extends('admin.layouts.app')
|--------------------------------------------------------------------------
| Last set to add middleware check code
``` php
PermissionFunction::checkDeclaredPermissionURL();
```
