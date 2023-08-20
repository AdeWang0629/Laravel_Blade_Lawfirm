<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Court::truncate();

        Court::create(['name' => 'محكمة مصر الجديد']);
        Court::create(['name' => 'محكمة مدينة نصر']);
        Court::create(['name' => 'محكمة التجمع الخامس']);
        Court::create(['name' => 'محكمة زنانيري']);
        Court::create(['name' => 'محكمة اسكندرية']);
        Court::create(['name' => 'محكمة الخانكة']);

        Schema::enableForeignKeyConstraints();
    }
}
