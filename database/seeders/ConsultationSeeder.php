<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Consultation;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Consultation::truncate();

        $faker = Factory::create();

        $clientIds = collect(Client::all()->modelKeys());

        $consultation = Consultation::query();
        $consultations = [];
        $clientAccount = ClientAccount::query();
        $clientAccounts = [];

        for ($i=1; $i <= 100; $i++) { 
            $days = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28'];
            $months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
            $date = '2021-'.Arr::random($months).'-'.Arr::random($days).' 01:00:01';
            $contract_amount = $faker->numberBetween(1000, 3000);
            $vatRand = rand(0, 20);
            $clientId = $clientIds->random();

            $consultations[] = [
                'client_id'                 => $clientId,
                'consultation_subject'      => 'موضوع الاستشارة '.$i,
                'contract_amount'           => $contract_amount, //1,107
                'consultation_number'       => 'CON00'.$i,
                'base_encode'               => base64_encode(consultationNumber().\Illuminate\Support\Str::random(40)),
                'vat'                       => $vatRand, //4   44.28
                'total_amount'              => (($vatRand / 100) * $contract_amount) + $contract_amount, //1,151.28
                'contract_date'             => now(),
                'created_at'                => $date,
                'updated_at'                => $date,
            ];

            $clientAccounts[] = [
                'type'          => 'consultation_payment',
                'client_id'     => $clientId,
                'lawsuite_id'   => $i,
                'credit'        => 0.00,
                'debit'         =>(($vatRand / 100) * $contract_amount) + $contract_amount,
            ];
        }

        $chunksConsultations = array_chunk($consultations, 10);
        $chunksClientAccounts = array_chunk($clientAccounts, 10);
        foreach ($chunksConsultations as $chunksConsultation) {
            $consultation->insert($chunksConsultation);
        }
        foreach ($chunksClientAccounts as $chunksClientAccount) {
            $clientAccount->insert($chunksClientAccount);
        }


        Schema::enableForeignKeyConstraints();
    }
}
