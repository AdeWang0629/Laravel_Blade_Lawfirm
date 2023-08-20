<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('settings')->truncate();
        Schema::enableForeignKeyConstraints();

        $seetings = Setting::query();
        $seetings->create([ 'display_name' => 'logo', 'details' => null, 'key' => 'logo', 'value' => null, 'section' => 'general', 'type'  => 'file', 'ordering' => 1]);
        $seetings->create([ 'display_name' => 'favicon', 'details' => null, 'key' => 'favicon', 'value' => null, 'section' => 'general', 'type'  => 'file', 'ordering' => 2]);
        $seetings->create([ 'display_name' => 'site_title', 'details' => null, 'key' => 'site_title', 'value' => '', 'section' => 'general', 'type'  => 'text', 'ordering' => 3]);
        $seetings->create([ 'display_name' => 'office_name', 'details' => null, 'key' => 'office_name', 'value' => '', 'section' => 'general', 'type'  => 'text', 'ordering' => 4]);
        $seetings->create([ 'display_name' => 'city', 'details' => null, 'key' => 'city', 'value' => 'القاهرة', 'section' => 'general', 'type'  => 'text', 'ordering' => 5]);
        $seetings->create([ 'display_name' => 'office_address', 'details' => null, 'key' => 'office_address', 'value' => '', 'section' => 'general', 'type'  => 'text', 'ordering' => 6]);
        $seetings->create([ 'display_name' => 'office_owner', 'details' => null, 'key' => 'office_owner', 'value' => '', 'section' => 'general', 'type'  => 'text', 'ordering' => 7]);
        $seetings->create([ 'display_name' => 'email', 'details' => null, 'key' => 'email', 'value' => 'email@email.com', 'section' => 'general', 'type'  => 'text', 'ordering' => 8]);
        $seetings->create([ 'display_name' => 'mobile', 'details' => null, 'key' => 'mobile', 'value' => '01111111111', 'section' => 'general', 'type'  => 'text', 'ordering' => 9]);
        $seetings->create([ 'display_name' => 'currency', 'details' => null, 'key' => 'currency', 'value' => 'جنية مصرى', 'section' => 'general', 'type'  => 'text', 'ordering' => 10]);
        $seetings->create([ 'display_name' => 'currency_direction', 'details' => trans("site.right").'|'.trans("site.left"), 'key' => 'currency_direction', 'value' => '0', 'section' => 'general', 'type'  => 'select', 'ordering' => 11]);
        $seetings->create([ 'display_name' => 'vat', 'details' => '', 'key' => 'vat', 'value' => '0', 'section' => 'general', 'type'  => 'number', 'ordering' => 12]);

        $seetings->create([ 'display_name' => 'receipt_header', 'details' => null, 'key' => 'receipt_header', 'value' => null, 'section' => 'printing', 'type'  => 'file', 'ordering' => 13]);
        $seetings->create([ 'display_name' => 'vat_registration_number', 'details' => null, 'key' => 'vat_registration_number', 'value' => '123456789101212', 'section' => 'printing', 'type'  => 'text', 'ordering' => 14]);
        $seetings->create([ 'display_name' => 'contract_title', 'details' => null, 'key' => 'contract_title', 'value' => 'عقد اتفاق اتعاب وخدمات قانونية', 'section' => 'printing', 'type'  => 'text', 'ordering' => 15]);
        $seetings->create([ 'display_name' => 'consultation_title', 'details' => null, 'key' => 'consultation_title', 'value' => 'عقد اتفاق اتعاب واستشارات قانونية', 'section' => 'printing', 'type'  => 'text', 'ordering' => 16]);

        $seetings->create([ 'display_name' => 'gmail_email', 'details' => null, 'key' => 'gmail_email', 'value' => 'mrrmohamedfawzy@gmail.com', 'section' => 'gmail', 'type'  => 'email', 'ordering' => 17]);
        $seetings->create([ 'display_name' => 'gmailPassword', 'details' => null, 'key' => 'gmailPassword', 'value' => '01118525023Copy!', 'section' => 'gmail', 'type'  => 'password', 'ordering' => 18]);
    }
}
