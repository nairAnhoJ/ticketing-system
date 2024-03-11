<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(DeptInChargeSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(ComputerSeeder::class);
        $this->call(SiteSeeder::class);
        $this->call(ItemTypeSeeder::class);
        $this->call(TicketCategorySeeder::class);
    }
}
