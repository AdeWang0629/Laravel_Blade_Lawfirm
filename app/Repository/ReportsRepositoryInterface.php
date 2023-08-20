<?php
namespace App\Repository;


interface ReportsRepositoryInterface {
    // sessionsReports
    public function sessionsReports();

    // lawsuitesReports
    public function lawsuitesReports();

    // clientsReports
    public function clientsReports();

    // lawsuitesPaymentsReports
    public function lawsuitesPaymentsReports();

    // consultationsPaymentsReports
    public function consultationsPaymentsReports();

    // paymentsReports
    public function paymentsReports();
}