<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            'smtp_is_activated' => 0,
            'smtp_server' => 'smtp.example.com',
            'smtp_name' => 'Mailer',
            'smtp_username' => 'user@example.com',
            'smtp_password' => 'secret',
            'smtp_port' => '465',
        ];
        Setting::create($setting);
    }
}

