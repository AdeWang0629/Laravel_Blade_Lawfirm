<?php

namespace Database\Seeders;

use App\Models\CaseStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CaseStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        CaseStage::truncate();

        CaseStage::create(['name' => 'ابتدائى']);
        CaseStage::create(['name' => 'جزئى']);
        CaseStage::create(['name' => 'استئناف']);
        CaseStage::create(['name' => 'نقض']);

        Schema::enableForeignKeyConstraints();
    }
}
