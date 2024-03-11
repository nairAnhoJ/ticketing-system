<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'id_no' => 'HII-admin',
            'name' => 'Administrator',
            'dept_id' => '1',
            'email' => 'admin@admin.com',
            'phone' => 'n/a',
            'password' => '$2y$10$nrm1iIbhHzqwo4V6/KvCcuSCUuvIzlD3h1TtnKUU1bVPLuiFUUhCi',
            'role' => 'admin'
        ];
        User::create($user);
    }
}
