<?php

namespace Database\Seeders;

use App\Models\CaseSession;
use App\Models\Court;
use App\Models\Lawsuite;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class CaseSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        CaseSession::truncate();

        $faker = Factory::create();

        $courtIds = collect(Court::all()->pluck('id'));

        $caseSession = CaseSession::query();
        $caseSessions = [];

        for ($i=0; $i < 100; $i++) { 
            $days = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28'];
            $months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
            $date = '2021-'.Arr::random($months).'-'.Arr::random($days).' 01:00:01';
            $start = $faker->numberBetween(2020, 2022).'-'.Arr::random($months).'-'.Arr::random($days);
            $courtId = $courtIds->random();
            $lawsuiteId = Lawsuite::where('court_id', $courtId)->first();

            $caseSessions[] = [
                'title'                     => $faker->title,
                'start'                     => $start,
                'all_day'                   => rand(0,1),
                'bg_color'                  => $faker->hexColor,
                'session_details'           => $faker->paragraph(3),
                'court_id'                  => $courtId,
                'lawsuite_id'               => $lawsuiteId->id,
                'created_at'                => $date,
                'updated_at'                => $date,
            ];
        }

        $chunksCaseSessions = array_chunk($caseSessions, 10);
        foreach ($chunksCaseSessions as $chunksCaseSession) {
            $caseSession->insert($chunksCaseSession);
        }
        Schema::enableForeignKeyConstraints();
    }
}
