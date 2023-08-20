<?php

namespace App\Repository;

use App\Repository\RoleRepositoryInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Stevebauman\Purify\Facades\Purify;

class RoleRepository implements RoleRepositoryInterface {
    public function index()
    {
        $roles = Role::query()->where('name', '!=', 'Admin')->orderBy('id', 'desc')->paginate('10');
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::pluck('name','id');
        return view('admin.roles.create', compact('permissions'));
    }

    public function store($request)
    {
        try {
            $role = Role::create(['name' => Purify::clean($request->name)]);
            $role->syncPermissions($request->permissions_id);
            toast(trans('site.created successfully', ['attr' => trans_choice('site.roles', 0)]), 'success');
            return to_route('admin.roles.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($role)
    {
        $permissions = Permission::pluck('name','id');
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update($request, $role)
    {
        try {
            $role->update(['name' => Purify::clean($request->name)]);
            $role->syncPermissions($request->permissions_id);

            toast(trans('site.updated successfully', ['attr' => trans_choice('site.roles', 0)]), 'success');
            return to_route('admin.roles.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($role)
    {
        try {
            $role->delete();
            toast(trans('site.deleted successfully', ['attr' => trans_choice('site.roles', 0)]), 'error');
            return to_route('admin.roles.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
