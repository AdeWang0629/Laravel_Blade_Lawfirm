<?php

namespace App\Repository;

use App\Models\Branch;
use App\Models\CaseSession;
use App\Models\Client;
use App\Models\ExpenseSection;
use App\Models\Lawsuite;
use App\Models\Payment;
use App\Models\Receipt;
use App\Repository\ReportsRepositoryInterface;

class ReportsRepository implements ReportsRepositoryInterface {
    public function sessionsReports()
    {
        if (request()->has('start_date') || request()->has('end_date')) {
            request()->validate([
                'start_date' => 'required|date|date_format:Y-m-d',
                'end_date' => 'required|date|date_format:Y-m-d'
            ]);
        }

        $startDate = request()->start_date;
        $endDate = request()->end_date;
        $caseSessions = CaseSession::with('court','lawsuite')->when(($startDate || $endDate) != null, function($q) use($startDate, $endDate){
            return $q->whereBetween('start', [$startDate, $endDate]);
        })->get();
        return view('admin.reports.sessions_reports', compact('caseSessions'));
    }

    public function lawsuitesReports()
    {
        if (request()->has('start_date') || request()->has('end_date')) {
            request()->validate([
                'start_date' => 'required|date|date_format:Y-m-d',
                'end_date' => 'required|date|date_format:Y-m-d'
            ]);
        }

        $startDate = request()->start_date;
        $endDate = request()->end_date;
        $lawsuites = Lawsuite::withCount('caseSessions')->with('client','clientType','caseType','caseStage','lawsuitCase','court','clientAccounts')->when(($startDate || $endDate) != null, function($q) use($startDate, $endDate){
            return $q->whereBetween('contract_date', [$startDate, $endDate]);
        })->get();
        return view('admin.reports.lawsuites_reports', compact('lawsuites'));
    }

    public function clientsReports()
    {
        if (request()->has('start_date') || request()->has('end_date')) {
            request()->validate([
                'start_date' => 'required|date|date_format:Y-m-d',
                'end_date' => 'required|date|date_format:Y-m-d'
            ]);
        }

        $startDate = request()->start_date;
        $endDate = request()->end_date;
        $clients = Client::withCount('lawsuites')->with('lawsuites' ,'clientAccounts' ,'receipts')->when(($startDate || $endDate) != null, function($q) use($startDate, $endDate){
            return $q->whereBetween('created_at', [$startDate, $endDate]);
        })->get();
        return view('admin.reports.clients_reports', compact('clients'));
    }

    public function lawsuitesPaymentsReports()
    {
        if (request()->has('start_date') || request()->has('end_date')) {
            request()->validate([
                'start_date' => 'required|date|date_format:Y-m-d',
                'end_date' => 'required|date|date_format:Y-m-d'
            ]);
        }

        $startDate = request()->start_date ?? now()->format('Y-m-d');
        $endDate = request()->end_date ?? now()->format('Y-m-d');
        $receipts = Receipt::whereNull('consultation_id')
        ->when(($startDate || $endDate) != null, function($q) use($startDate, $endDate){
            return $q->whereBetween('date', [$startDate, $endDate]);
        })->get();
        return view('admin.reports.lawsuites_payments_reports', compact('receipts'));
    }

    public function consultationsPaymentsReports()
    {
        if (request()->has('start_date') || request()->has('end_date')) {
            request()->validate([
                'start_date' => 'required|date|date_format:Y-m-d',
                'end_date' => 'required|date|date_format:Y-m-d'
            ]);
        }

        $startDate = request()->start_date ?? now()->format('Y-m-d');
        $endDate = request()->end_date ?? now()->format('Y-m-d');
        $receipts = Receipt::whereNull('lawsuite_id')
        ->when(($startDate || $endDate) != null, function($q) use($startDate, $endDate){
            return $q->whereBetween('date', [$startDate, $endDate]);
        })->get();
        return view('admin.reports.consultations_payments_reports', compact('receipts'));
    }

    public function paymentsReports()
    {
        if (request()->has('start_date') || request()->has('end_date')) {
            request()->validate([
                'start_date' => 'required|date|date_format:Y-m-d',
                'end_date' => 'required|date|date_format:Y-m-d'
            ]);
        }

        $startDate = request()->start_date ?? now()->format('Y-m-d');
        $endDate = request()->end_date ?? now()->format('Y-m-d');
        $expenseSections = ExpenseSection::get();
        $branches = Branch::get();
        $payments = Payment::when(($startDate || $endDate) != null, function($q) use($startDate, $endDate){
            return $q->whereBetween('date', [$startDate, $endDate]);
        })->get();
        return view('admin.reports.payments_reports', compact('payments','expenseSections', 'branches'));
    }
}
