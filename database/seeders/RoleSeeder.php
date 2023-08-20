<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::query();
        $adminRole = $role->create(['name' => 'Admin']);
        $userRole = $role->create(['name' => 'User']);

        $userModel = User::query();
        $adminUser = $userModel->create(['first_name' => 'admin', 'last_name' => 'last_name','user_name' => 'admin','email' => 'admin@admin.com','email_verified_at' => now(),'password' => bcrypt('00000000'),'remember_token' => Str::random(10), 'status' => 1]);
        $adminUser->assignRole($adminRole->name);

        $userUser = $userModel->create(['first_name' => 'admin', 'last_name' => 'last_name','user_name' => 'user','email' => 'user@user.com','email_verified_at' => now(),'password' => bcrypt('00000000'),'remember_token' => Str::random(10), 'status' => 1]);
        $userUser->assignRole($userRole->name);

        User::factory()->count(20)->create();
    }
}
