<?php
namespace App\Repository;


interface SettingRepositoryInterface {
    // all settings
    public function index();

    // update settings
    public function update($request);
}