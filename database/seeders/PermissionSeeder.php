<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $permissions = [
            'home',
            'lawsuite_list',
            'lawsuite_show',
            'lawsuite_showContract',
            'lawsuite_create',
            'lawsuite_edit',
            'lawsuite_delete',
            'lawsuite_judgmentShow',
            'lawsuite_judgmentUpdate',
            'caseSession_show',
            'caseSession_create',
            'caseSession_edit',
            'caseSession_delete',
            'receipt_list',
            'receipt_create',
            'receipt_showReceipt',
            'receipt_edit',
            'receipt_delete',
            'lawsuitePaper_list',
            'lawsuitePaper_show',
            'lawsuitePaper_create',
            'lawsuitePaper_edit',
            'lawsuitePaper_delete',
            'lawsuiteNumber_create',
            'lawsuiteNumber_edit',
            'lawsuiteNumber_delete',
            'document_list',
            'document_show',
            'document_create',
            'document_delete',
            'document_downloadDocument',
            'consultation_list',
            'consultation_show',
            'consultation_create',
            'consultation_edit',
            'consultation_showContract',
            'consultation_delete',
            'lawsuitCase_list',
            'lawsuitCase_create',
            'lawsuitCase_edit',
            'lawsuitCase_delete',
            'lawsuitCase_restore',
            'caseType_list',
            'caseType_create',
            'caseType_edit',
            'caseType_delete',
            'caseType_restore',
            'court_list',
            'court_create',
            'court_edit',
            'court_delete',
            'court_restore',
            'caseStage_list',
            'caseStage_create',
            'caseStage_edit',
            'caseStage_delete',
            'caseStage_restore',
            'client_list',
            'client_show',
            'client_create',
            'client_edit',
            'client_delete',
            'clientType_list',
            'clientType_create',
            'clientType_edit',
            'clientType_delete',
            'clientType_restore',
            'reports_pages',
            'branche_list',
            'branche_create',
            'branche_edit',
            'branche_delete',
            'branche_restore',
            'expenseSection_list',
            'expenseSection_create',
            'expenseSection_edit',
            'expenseSection_delete',
            'expenseSection_restore',
            'payment_list',
            'payment_showReceipt',
            'payment_create',
            'payment_edit',
            'payment_delete',
            'settings_edit',
            'roles_list',
            'roles_create',
            'roles_edit',
            'roles_delete',
            'users_list',
            'users_show',
            'users_create',
            'users_edit',
            'users_delete',
            'backups_list',
            'backups_create',
            'backups_delete',
            'backups_download',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
