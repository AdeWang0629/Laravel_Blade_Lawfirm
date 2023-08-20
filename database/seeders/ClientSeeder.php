<?php

namespace Database\Seeders;

use App\Models\Client;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Client::truncate();

        $faker = Factory::create('ar_SA');
        $client = Client::query();
        $clients = [];

        for ($i=0; $i < 50; $i++) { 
            $days = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28'];
            $months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
            $date = '2021-'.Arr::random($months).'-'.Arr::random($days).' 01:00:01';

            $clients[] = [
                'name'              => $faker->name(),
                'user_name'         => $faker->unique()->userName,
                'id_number'         => $faker->numberBetween(1,999999999),
                'cr_number'         => $faker->numberBetween(1,999999999),
                'nationality'       => $faker->randomElement(['مصرى','سعودى','عراقى','فلسطينى']),
                'po_box'            => 'BO'.$faker->numberBetween(1,999),
                'mobile'            => '01118525'.$faker->unique()->numberBetween(24, 1100),
                'phone'             => '00218'.$faker->unique()->numberBetween(24, 98768),
                'email'             => $faker->unique()->safeEmail,
                'city'              => $faker->randomElement(['الشمالية','الجنوبية','الغربية','الشرقية']),
                'address'           => $faker->address,
                'password'          => bcrypt('00000000'),
                'status'            => rand(0,1),
                'notes'             => $faker->paragraph(3),
                'remember_token'    => Str::random(10),
                'created_at'        => $date,
                'updated_at'        => $date,
            ];
        }

        $chunksClients = array_chunk($clients, 10);
        foreach ($chunksClients as $chunksClient) {
            $client->insert($chunksClient);
        }
        
        Schema::enableForeignKeyConstraints();
    }
}
