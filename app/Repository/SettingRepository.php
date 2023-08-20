<?php

namespace App\Repository;

use App\Models\Setting;
use App\Repository\SettingRepositoryInterface;
use Illuminate\Support\Facades\File;
use Spatie\Valuestore\Valuestore;
use Illuminate\Support\Str;
use Stevebauman\Purify\Facades\Purify;

class SettingRepository implements SettingRepositoryInterface {
    public function index()
    {
        $sectionQuery = isset(request()->section) && request()->section != null ? request()->section : 'general';
        $sectionsArray = Setting::select('section')->distinct()->pluck('section');
        $sectionSettings = Setting::whereSection($sectionQuery)->get();
        return view('admin.settings.index', compact('sectionQuery','sectionsArray','sectionSettings'));
    }

    public function update($request)
    {
        // return $request;
        for ($i=0; $i < count($request->id); $i++) {
            if ($request->key[$i] == 'logo' || $request->key[$i] == 'receipt_header' || $request->key[$i] == 'favicon') {
                if (getSettingOf($request->key[$i]) != null && array_key_exists($i, $request->value)) {
                    if (File::exists(public_path('images/settings/'.$request->key[$i].'/'.getSettingOf($request->key[$i])))) {
                        unlink(public_path('images/settings/'.$request->key[$i].'/'.getSettingOf($request->key[$i])));
                    }
                }

                if ($request->key[$i] && array_key_exists($i, $request->value)) {
                    $fileName = $request->value[$i]->getClientOriginalName();
                    $request->value[$i]->storeAs('settings/'.Str::slug($request->key[$i]), $fileName, 'file_attachments');

                    $input['value'] = $fileName;
                }else {
                    $input['value'] = getSettingOf($request->key[$i]);
                }
            }elseif ($request->key[$i] == 'gmailPassword') {
                if ($request->value[$i] != null) {
                    $input['value'] = $request->value[$i];
                }else {
                    $input['value'] = getSettingOf($request->key[$i]);
                }
            } else {
                $input['value'] = isset($request->value[$i]) ? $request->value[$i] : null;
            }
            Setting::whereId($request->id[$i])->first()->update(Purify::clean($input));
        }
        $this->saveCache();

        toast(trans('site.updated successfully', ['attr' => trans('site.settings')]), 'success');
        return redirect()->back();
    }

    private function saveCache()
    {
        $valuestore = Valuestore::make(config_path('seeting.json'));
        Setting::all()->each(function($item) use($valuestore){
            return $valuestore->put($item->key, $item->value);
        });
    }
}
