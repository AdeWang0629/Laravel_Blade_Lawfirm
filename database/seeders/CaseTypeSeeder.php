<?php

namespace Database\Seeders;

use App\Models\CaseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CaseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        CaseType::truncate();

        CaseType::create(['name' => 'مدنى']);
        CaseType::create(['name' => 'شرعى(اسرة)']);
        CaseType::create(['name' => 'جنائى']);
        CaseType::create(['name' => 'جنح']);
        CaseType::create(['name' => 'تجاري']);
        CaseType::create(['name' => 'عمال']);

        Schema::enableForeignKeyConstraints();
    }
}
