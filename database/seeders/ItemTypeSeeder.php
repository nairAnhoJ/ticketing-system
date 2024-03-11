<?php

namespace Database\Seeders;

use App\Models\ItemType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemType::create(['name' => 'MOTHERBOARD']);
        ItemType::create(['name' => 'PROCESSOR']);
        ItemType::create(['name' => 'RAM']);
        ItemType::create(['name' => 'STORAGE']);
        ItemType::create(['name' => 'GRAPHICS CARD']);
        ItemType::create(['name' => 'POWER SUPPLY']);
        ItemType::create(['name' => 'MONITOR']);
        ItemType::create(['name' => 'MOUSE']);
        ItemType::create(['name' => 'KEYBOARD']);
        ItemType::create(['name' => 'LAN CARD']);
        ItemType::create(['name' => 'OTHERS']);
        ItemType::create(['name' => 'PRINTER']);
        ItemType::create(['name' => 'LAPTOP']);
        ItemType::create(['name' => 'OPERATING SYSTEM']);
        ItemType::create(['name' => 'AVR/UPS']);
    }
}
