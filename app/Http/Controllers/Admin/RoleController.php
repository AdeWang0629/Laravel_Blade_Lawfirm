<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Repository\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public $roles;
    
    public function __construct(RoleRepositoryInterface $roles) {
        $this->roles = $roles;
        $this->middleware('permission:roles_list|roles_create|roles_edit|roles_delete', ['only' => ['index']]);
        $this->middleware('permission:roles_create', ['only' => ['create','store']]);
        $this->middleware('permission:roles_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:roles_delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        return $this->roles->index();
    }

    public function create()
    {
        return $this->roles->create();
    }

    public function store(RoleRequest $request)
    {
        return $this->roles->store($request);
    }

    public function edit(Role $role)
    {
        return $this->roles->edit($role);
    }

    public function update(RoleRequest $request, Role $role)
    {
        return $this->roles->update($request, $role);
    }

    public function destroy(Role $role)
    {
        return $this->roles->destroy($role);
    }
}
