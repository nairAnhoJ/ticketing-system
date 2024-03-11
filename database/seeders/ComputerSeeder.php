<?php

namespace Database\Seeders;

use App\Models\Computer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComputerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $computer = [
            'code' => 'N/A',
            'user' => 'N/A',
            'site' => '1',
            'ip_add' => 'N/A',
            'type' => 'N/A',
            'status' => 'N/A',
            'conducted_by' => 'N/A',
            'date_conducted' => '01-01-1990'
        ];
        Computer::create($computer);
    }
}
