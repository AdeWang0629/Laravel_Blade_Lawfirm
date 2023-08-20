<?php

namespace Database\Seeders;

use App\Models\CaseStage;
use App\Models\CaseType;
use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\ClientType;
use App\Models\Court;
use App\Models\LawsuitCase;
use App\Models\Lawsuite;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class LawsuiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Lawsuite::truncate();

        $faker = Factory::create();

        $clientIds = collect(Client::all()->modelKeys());
        $clientTypeIds = collect(ClientType::all()->modelKeys());
        $caseTypeIds = collect(CaseType::all()->modelKeys());
        $caseStageIds = collect(CaseStage::all()->modelKeys());
        $lawsuiteCaseIds = collect(LawsuitCase::all()->modelKeys());
        $courtIds = collect(Court::all()->modelKeys());

        $lawsuite = Lawsuite::query();
        $clientAccount = ClientAccount::query();
        $lawsuites = [];
        $clientAccounts = [];

        for ($i=1; $i <= 100; $i++) {
            $days = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28'];
            $months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
            $date = '2021-'.Arr::random($months).'-'.Arr::random($days).' 01:00:01';
            $contract_amount = $faker->numberBetween(1000, 3000);
            $vatRand = rand(0, 20);
            $clientId = $clientIds->random();

            $lawsuites[] = [
                'client_id'                 => $clientId,
                'client_type_id'            => $clientTypeIds->random(),
                'case_type_id'              => $caseTypeIds->random(),
                'lawsuite_lawyer'           => 'أ: '.$faker->name(),
                'lawsuite_subject'          => 'موضوع الدعوى '.$i,
                'case_stage_id'             => $caseStageIds->random(),
                'lawsuit_case_id'           => $lawsuiteCaseIds->random(),
                'court_id'                  => $courtIds->random(),
                'case_number'               => 'LAW00'.$i,
                'base_encode'               => base64_encode(lawsuiteCaseNumber().\Illuminate\Support\Str::random(40)),
                'court_case_number'         => $faker->unique()->numberBetween(11111, 99999).'/'.$faker->numberBetween(1999, 2022),
                'contract_title'            => 'عنوان العقد LAW00'.$i,
                'contract_date'             => now(),
                'contract_amount'           => $contract_amount, //1,107
                'vat'                       => $vatRand, //4   44.28
                'total_amount'              => (($vatRand / 100) * $contract_amount) + $contract_amount, //1,151.28
                'notes'                     => $faker->paragraph(3),
                'created_at'                => $date,
                'updated_at'                => $date,
            ];

            $clientAccounts[] = [
                'type'          => 'lawsuite_payment',
                'client_id'     => $clientId,
                'lawsuite_id'   => $i,
                'credit'        => 0.00,
                'debit'         =>(($vatRand / 100) * $contract_amount) + $contract_amount,
            ];
        }


        $chunksPosts = array_chunk($lawsuites, 10);
        $chunksClientAccounts = array_chunk($clientAccounts, 10);
        foreach ($chunksPosts as $chunksPost) {
            $lawsuite->insert($chunksPost);
        }
        foreach ($chunksClientAccounts as $chunksClientAccount) {
            $clientAccount->insert($chunksClientAccount);
        }
        Schema::enableForeignKeyConstraints();
    }
}
