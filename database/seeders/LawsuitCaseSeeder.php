<?php

namespace Database\Seeders;

use App\Models\LawsuitCase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class LawsuitCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        LawsuitCase::truncate();

        LawsuitCase::create(['name' => 'منتهية', 'color' => '#007bff']);
        LawsuitCase::create(['name' => 'معلقة', 'color' => '#ffc107']);
        LawsuitCase::create(['name' => 'تحت الدراسة', 'color' => '#17a2b8']);
        LawsuitCase::create(['name' => 'مرفوضة', 'color' => '#dc3545']);

        Schema::enableForeignKeyConstraints();
    }
}
