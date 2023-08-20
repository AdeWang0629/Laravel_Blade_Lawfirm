<?php

namespace App\Repository;

use App\Models\LawsuiteNumber;
use App\Repository\LawsuiteNumberRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;

class LawsuiteNumberRepository implements LawsuiteNumberRepositoryInterface {
    public function store($request)
    {
        try {
            LawsuiteNumber::create([
                'description'   => Purify::clean($request->description),
                'number'        => Purify::clean($request->number),
                'notes'         => Purify::clean($request->notes),
                'lawsuite_id'   => $request->lawsuite_id,
            ]);
            toast(trans('site.created successfully', ['attr' => trans_choice('site.lawsuites_new_number', 0)]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $lawsuites_number)
    {
        try {
            $lawsuites_number->whereLawsuiteId($request->lawsuite_id)->update([
                'description'   => Purify::clean($request->description),
                'number'        => Purify::clean($request->number),
                'notes'         => Purify::clean($request->notes),
            ]);
            toast(trans('site.updated successfully', ['attr' => trans_choice('site.lawsuites_new_number', 0)]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($lawsuites_number)
    {
        $lawsuites_number->delete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.lawsuites_new_number', 0)]),'error');
        return redirect()->back();
    }
}
