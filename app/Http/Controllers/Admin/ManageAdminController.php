<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use Storage;

class ManageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:admin-list', ['only' => ['index']]);
        $this->middleware('permission:admin-create|admin-delete|admin-edit', ['only' => ['create', 'store', 'show', 'edit']]);
    }

    public function index()
    {
        $admins = Admin::with('roles')->get();

        return view('admin.admins.index', compact('admins'));
    }

    public function show(Admin $admin)
    {
        $admin = Admin::with('photos')->where('id', $admin->id)->limit(1)->first();

        return view('admin.admins.show', compact('admin'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();

        return view('admin.admins.create', compact('roles'));
    }

    public function store(StoreAdminRequest $request)
    {
        $admin = Admin::create($request->validated());
        $role = Role::find($request->input('role'));
        $admin->assignRole($role);

        return redirect()->route('admin.admins.index');
    }

    public function edit(Admin $admin)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        $permissions = Permission::where('guard_name', 'admin')->get();

        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $role = Role::find($request->input('role'));
        $admin->updateWithRole($request->validated(), $role);

        return redirect()->route('admin.admins.index');
    }
}