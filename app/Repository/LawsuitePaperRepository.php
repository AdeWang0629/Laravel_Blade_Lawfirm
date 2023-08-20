<?php

namespace App\Repository;

use App\Models\LawsuiteNumber;
use App\Models\LawsuitePaper;
use App\Repository\LawsuitePaperRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;

class LawsuitePaperRepository implements LawsuitePaperRepositoryInterface {

    public function index()
    {
        $lawsuitePapers = LawsuitePaper::with('lawsuite')->get();
        return view('admin.lawsuite-paper.index', compact('lawsuitePapers'));
    }

    public function show($lawsuites_paper)
    {
        return view('layouts.admin.lawsuite_paper', compact('lawsuites_paper'));
    }

    public function store($request)
    {
        try {
            LawsuitePaper::create([
                'lawsuite_id'   => $request->lawsuite_id,
                'title'         => Purify::clean($request->title),
                'subject'       => Purify::clean($request->subject),
                'date'          => Purify::clean($request->date),
                'based_on_it'   => Purify::clean($request->based_on_it),
            ]);
            toast(trans('site.created successfully', ['attr' => removebeginninLetters(trans_choice('site.newspapers', 0), 2).' '.trans_choice('site.cases', 0)]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $lawsuites_paper)
    {
        try {
            $lawsuites_paper->update([
                'title'         => Purify::clean($request->title),
                'subject'       => Purify::clean($request->subject),
                'date'          => Purify::clean($request->date),
                'based_on_it'   => Purify::clean($request->based_on_it),
            ]);
            toast(trans('site.updated successfully', ['attr' => removebeginninLetters(trans_choice('site.newspapers', 0), 2).' '.trans_choice('site.cases', 0)]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($lawsuites_paper)
    {
        $lawsuites_paper->delete();
        toast(trans('site.deleted successfully', ['attr' => removebeginninLetters(trans_choice('site.newspapers', 0), 2).' '.trans_choice('site.cases', 0)]),'error');
        return redirect()->back();
    }
}
