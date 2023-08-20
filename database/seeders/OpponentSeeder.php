<?php

namespace Database\Seeders;

use App\Models\Lawsuite;
use App\Models\Opponent;
use Illuminate\Support\Arr;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OpponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Opponent::truncate();

        $faker = Factory::create('ar_SA');
        $opponent = Opponent::query();
        $lawsuites = collect(Lawsuite::all()->modelKeys());
        $opponents = [];
        for ($i=1; $i <= 200; $i++) { 
            $lawsuiteId = $lawsuites->random();
            $thisLawsuite = Lawsuite::where('id', $lawsuiteId)->first();

            $opponents[] = [
                'opponent_name'         => $faker->name(),
                'opponent_phone'        => '01238523'.$faker->unique()->numberBetween(24, 1100),
                'opponent_address'      => $faker->address,
                'opponent_section'      => $faker->randomElement(['المرج','السلام','التجمع الخامس','مدينة نصر اول','مدينة نصر ثانى']),
                'opponent_city'         => $faker->randomElement(['الشمالية','الجنوبية','الغربية','الشرقية']),
                'opponent_lawyer'       => 'أ-'. $faker->name(),
                'opponent_lawyer_phone' => '01238523'.$faker->unique()->numberBetween(1100, 2100),
                'lawsuite_id'           => $lawsuiteId,
                'created_at'            => $thisLawsuite->created_at,
                'updated_at'            => $thisLawsuite->created_at,
            ];
        }

        $chunksOpponents = array_chunk($opponents, 30);
        foreach ($chunksOpponents as $chunksOpponent) {
            $opponent->insert($chunksOpponent);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}
