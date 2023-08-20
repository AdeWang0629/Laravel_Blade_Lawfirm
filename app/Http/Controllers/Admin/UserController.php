<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repository\UserRepositoryInterface;

class UserController extends Controller
{
    public $userRep;
    public function __construct(UserRepositoryInterface $userRep) {
        $this->userRep = $userRep;
        $this->middleware('permission:users_list|users_create|users_edit|users_delete', ['only' => ['index']]);
        $this->middleware('permission:users_show', ['only' => ['show']]);
        $this->middleware('permission:users_create', ['only' => ['create','store']]);
        $this->middleware('permission:users_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:users_delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        return $this->userRep->index();
    }

    public function create()
    {
        return $this->userRep->create();
    }

    public function store(UserRequest $request)
    {
        return $this->userRep->store($request);
    }

    public function show(User $user)
    {
        return $this->userRep->show($user);
    }

    public function edit(User $user)
    {
        return $this->userRep->edit($user);
    }

    public function update(UserRequest $request, User $user)
    {
        return $this->userRep->update($request, $user);
    }

    public function destroy(User $user)
    {
        return $this->userRep->destroy($user);
    }
}
