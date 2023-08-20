<?php

namespace Database\Seeders;

use App\Models\ClientType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        ClientType::truncate();

        ClientType::create(['name' => 'مدعى']);
        ClientType::create(['name' => 'مدعى عليه']);
        ClientType::create(['name' => 'جانى']);
        ClientType::create(['name' => 'مجنى عليه']);
        
        Schema::enableForeignKeyConstraints();
    }
}
