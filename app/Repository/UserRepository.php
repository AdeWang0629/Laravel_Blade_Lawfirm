<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Spatie\Permission\Models\Role;
use Stevebauman\Purify\Facades\Purify;

class UserRepository implements UserRepositoryInterface {
    public function index()
    {
        $users = User::with('roles')->whereHas('roles', function($q) {
            if (auth()->user()->hasRole('Admin')) {
                return $q;
            }else {
                return $q->where('name','!=','Admin');
            }
        })->where('id', '!=', auth()->id())->orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (auth()->user()->hasRole('Admin')) {
            $roles = Role::pluck('name','id')->toArray();
        }else {
            $roles = Role::where('name','!=','Admin')->pluck('name','id')->toArray();
        }
        return view('admin.users.create', compact('roles'));
    }

    public function store($request)
    {
        try {
            $data['first_name'] = Purify::clean($request->first_name);
            $data['last_name'] = Purify::clean($request->last_name);
            $data['user_name'] = Purify::clean($request->user_name);
            $data['email'] = $request->email;
            $data['status'] = $request->status;
            if ($request->password && $request->password != null) {
                $data['password'] = bcrypt($request->password);
            }

            $user = User::create($data);
            $user->syncRoles($request->roles_id);

            toast(trans('site.created successfully', ['attr' => trans_choice('site.users', 0)]), 'success');
            return to_route('admin.users.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show($user)
    {
        $user->with('roles');

        return view('admin.users.show', compact('user'));
    }

    public function edit($user)
    {
        if (auth()->user()->hasRole('Admin')) {
            $roles = Role::pluck('name','id')->toArray();
        }else {
            $roles = Role::where('name','!=','Admin')->pluck('name','id')->toArray();
        }
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update($request, $user)
    {
        try {
            $data = $request->only('first_name','last_name','user_name','email','status');
            if ($request->password && $request->password != null) {
                $data['password'] = bcrypt($request->password);
            }

            $user->update($data);
            $user->syncRoles($request->roles_id);

            toast(trans('site.updated successfully', ['attr' => trans_choice('site.users', 0)]), 'success');
            return to_route('admin.users.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($user)
    {
        $user->delete();

        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.users', 0)]), 'success');
        return to_route('admin.users.index');
    }
}
