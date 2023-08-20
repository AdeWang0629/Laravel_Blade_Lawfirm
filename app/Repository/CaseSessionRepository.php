<?php

namespace App\Repository;

use App\Models\CaseSession;
use App\Repository\CaseSessionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;

class CaseSessionRepository implements CaseSessionRepositoryInterface {
    public function index()
    {
        $caseSessions = CaseSession::withCount('court', 'lawsuite')->get();
        return view('admin.case-sessions.index', compact('caseSessions'));
    }

    public function store($request)
    {
        try {
            CaseSession::create([
                'title'             => Purify::clean($request->title),
                'start'             => Purify::clean($request->start),
                'bg_color'          => Purify::clean($request->bg_color),
                'session_details'   => Purify::clean($request->session_details),
                'court_id'          => Purify::clean($request->court_id),
                'lawsuite_id'       => Purify::clean($request->lawsuite_id),
            ]);

            toast(trans('site.created successfully', ['attr' => trans_choice('site.sessions', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($caseSession)
    {
        return view('admin.case-sessions.show', compact('caseSession'));
    }


    public function edit($caseSession)
    {
        return view('admin.case-sessions.edit', compact('caseSession'));
    }

    public function update($request, $caseSession)
    {
        try {
            $caseSession->update([
                'title'             => Purify::clean($request->title),
                'start'             => Purify::clean($request->start),
                'bg_color'          => Purify::clean($request->bg_color),
                'session_details'   => Purify::clean($request->session_details),
            ]);

            toast(trans('site.updated successfully', ['attr' => trans_choice('site.sessions', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($caseSession)
    {
        $caseSession->delete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.sessions', 0)]),'success');
        return redirect()->back();
    }
}
