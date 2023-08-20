<?php

namespace App\Repository;

use App\Models\CaseSession;
use App\Repository\CalendarRepositoryInterface;

class CalendarRepository implements CalendarRepositoryInterface {
    public function index()
    {
        $caseSessions = CaseSession::all()->map(function($caseSession){
            return [
                'start' => $caseSession->start,
                'title' => $caseSession->title,
                'backgroundColor' => $caseSession->bg_color,
                'url' => auth()->user()->can('caseSession_show') ? route('admin.case-sessions.show', $caseSession) : 'javascript:;',
                'allDay' => true,
            ];
        })->toArray();
        return view('admin.calendar.calendar', compact('caseSessions'));
    }
}