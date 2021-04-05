<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManageAdminController extends ModelController
{
    protected function getModelClass() : string
    {
        return Admin::class;
    }

    public function index()
    {
        $authUser = \Auth::user();
        if ($authUser->hasRole('super-admin')) {
            $admins = Admin::select(['id', 'name', 'email'])->get();
        } else {
            $super_admin = Admin::role('super-admin')->get()->first(); 
            $admins = Admin::select(['id', 'name', 'email'])->where('id', '!=', $super_admin->id)->get();
        }

        return view('admin.admins.index', \compact('admins'));
    }

    public function show(Admin $admin)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.admins.show', \compact('admin', 'roles', 'permissions'));
    }
}