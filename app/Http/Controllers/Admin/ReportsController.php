<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseSession;
use App\Repository\ReportsRepositoryInterface;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public $reports;
    public function __construct(ReportsRepositoryInterface $reports) {
        $this->reports = $reports;
        $this->middleware('permission:reports_pages');
    }

    public function sessionsReports()
    {
        return $this->reports->sessionsReports();
    }

    public function lawsuitesReports()
    {
        return $this->reports->lawsuitesReports();
    }

    public function clientsReports()
    {
        return $this->reports->clientsReports();
    }

    public function lawsuitesPaymentsReports()
    {
        return $this->reports->lawsuitesPaymentsReports();
    }

    public function consultationsPaymentsReports()
    {
        return $this->reports->consultationsPaymentsReports();
    }

    public function paymentsReports()
    {
        return $this->reports->paymentsReports();
    }
}
