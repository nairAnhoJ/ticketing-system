<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketCategory::create(['name' => 'HARDWARE']);
        TicketCategory::create(['name' => 'SOFTWARE']);
        TicketCategory::create(['name' => 'NETWORK / INTERNET']);
        TicketCategory::create(['name' => 'TECHNICAL ASSISTANCE']);
        TicketCategory::create(['name' => 'SAP']);
        TicketCategory::create(['name' => 'OTHERS']);
    }
}
