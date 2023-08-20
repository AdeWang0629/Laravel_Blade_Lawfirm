<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseSession;
use App\Repository\CalendarRepositoryInterface;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public $calendar;
    public function __construct(CalendarRepositoryInterface $calendar) {
        $this->calendar = $calendar;
    }

    public function index()
    {
        return $this->calendar->index();
    }
}
