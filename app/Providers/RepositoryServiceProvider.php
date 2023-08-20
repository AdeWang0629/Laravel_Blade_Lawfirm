<?php

namespace App\Providers;

use App\Repository\BranchRepository;
use App\Repository\BranchRepositoryInterface;
use App\Repository\CalendarRepository;
use App\Repository\CalendarRepositoryInterface;
use App\Repository\LawsuitCaseRepository;
use App\Repository\LawsuitCaseRepositoryInterface;
use App\Repository\CaseSessionRepository;
use App\Repository\CaseSessionRepositoryInterface;
use App\Repository\CaseStageRepository;
use App\Repository\CaseStageRepositoryInterface;
use App\Repository\CaseTypeRepository;
use App\Repository\CaseTypeRepositoryInterface;
use App\Repository\ClientRepository;
use App\Repository\ClientRepositoryInterface;
use App\Repository\ClientTypeRepository;
use App\Repository\ClientTypeRepositoryInterface;
use App\Repository\ConsultationRepository;
use App\Repository\ConsultationRepositoryInterface;
use App\Repository\CourtRepository;
use App\Repository\CourtRepositoryInterface;
use App\Repository\DocumentRepository;
use App\Repository\DocumentRepositoryInterface;
use App\Repository\ExpenseSectionRepository;
use App\Repository\ExpenseSectionRepositoryInterface;
use App\Repository\LawsuiteNumberRepository;
use App\Repository\LawsuiteNumberRepositoryInterface;
use App\Repository\LawsuitePaperRepository;
use App\Repository\LawsuitePaperRepositoryInterface;
use App\Repository\LawsuiteRepository;
use App\Repository\LawsuiteRepositoryInterface;
use App\Repository\PaymentRepository;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\ReceiptRepository;
use App\Repository\ReceiptRepositoryInterface;
use App\Repository\ReportsRepository;
use App\Repository\ReportsRepositoryInterface;
use App\Repository\RoleRepository;
use App\Repository\RoleRepositoryInterface;
use App\Repository\SettingRepository;
use App\Repository\SettingRepositoryInterface;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ClientTypeRepositoryInterface::class, ClientTypeRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(CaseTypeRepositoryInterface::class, CaseTypeRepository::class);
        $this->app->bind(LawsuitCaseRepositoryInterface::class, LawsuitCaseRepository::class);
        $this->app->bind(CaseStageRepositoryInterface::class, CaseStageRepository::class);
        $this->app->bind(LawsuiteRepositoryInterface::class, LawsuiteRepository::class);
        $this->app->bind(CourtRepositoryInterface::class, CourtRepository::class);
        $this->app->bind(CaseSessionRepositoryInterface::class, CaseSessionRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);
        $this->app->bind(ReportsRepositoryInterface::class, ReportsRepository::class);
        $this->app->bind(CalendarRepositoryInterface::class, CalendarRepository::class);
        $this->app->bind(DocumentRepositoryInterface::class, DocumentRepository::class);
        $this->app->bind(LawsuiteNumberRepositoryInterface::class, LawsuiteNumberRepository::class);
        $this->app->bind(ConsultationRepositoryInterface::class, ConsultationRepository::class);
        $this->app->bind(BranchRepositoryInterface::class, BranchRepository::class);
        $this->app->bind(ExpenseSectionRepositoryInterface::class, ExpenseSectionRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(LawsuitePaperRepositoryInterface::class, LawsuitePaperRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
