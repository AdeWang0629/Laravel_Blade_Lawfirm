<?php
namespace App\Repository;

interface UserRepositoryInterface {
    // all users
    public function index();

    // create user
    public function create();

    // store user
    public function store($request);

    // show user
    public function show($user);

    // edit user
    public function edit($user);

    // update user
    public function update($request, $user);

    // delete user
    public function destroy($user);
}
