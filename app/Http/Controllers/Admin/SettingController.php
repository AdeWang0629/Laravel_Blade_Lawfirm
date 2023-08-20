<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Repository\SettingRepositoryInterface;

class SettingController extends Controller
{
    public $settings;
    public function __construct(SettingRepositoryInterface $settings) {
        $this->settings = $settings;
        $this->middleware('permission:settings_edit', ['only' => ['index','saveCache','update']]);
    }

    public function index()
    {
        return $this->settings->index();
    }

    public function update(SettingRequest $request)
    {
        return $this->settings->update($request);
    }
}
