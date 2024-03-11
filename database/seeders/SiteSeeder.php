<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site = [
            'name' => 'PARAÑAQUE(HQ)',
        ];
        Site::create($site);

        $site = [
            'name' => 'BATAAN',
        ];
        Site::create($site);

        $site = [
            'name' => 'MEYCAUAYAN BULACAN',
        ];
        Site::create($site);

        $site = [
            'name' => 'STA. MARIA BULACAN',
        ];
        Site::create($site);

        $site = [
            'name' => 'ISABELA',
        ];
        Site::create($site);

        $site = [
            'name' => 'LA UNION',
        ];
        Site::create($site);

        $site = [
            'name' => 'NUEVA ECIJA',
        ];
        Site::create($site);

        $site = [
            'name' => 'PAMPANGA',
        ];
        Site::create($site);

        $site = [
            'name' => 'PANGASINAN',
        ];
        Site::create($site);

        $site = [
            'name' => 'TARLAC',
        ];
        Site::create($site);

        $site = [
            'name' => 'PASIG',
        ];
        Site::create($site);

        $site = [
            'name' => 'QUEZON CITY',
        ];
        Site::create($site);

        $site = [
            'name' => 'QUEZON CITY UNILEVER',
        ];
        Site::create($site);

        $site = [
            'name' => 'BACOLOD',
        ];
        Site::create($site);

        $site = [
            'name' => 'BOHOL',
        ];
        Site::create($site);

        $site = [
            'name' => 'CEBU',
        ];
        Site::create($site);

        $site = [
            'name' => 'ILO-ILO',
        ];
        Site::create($site);

        $site = [
            'name' => 'TACLOBAN',
        ];
        Site::create($site);

        $site = [
            'name' => 'CABUYAO',
        ];
        Site::create($site);

        $site = [
            'name' => 'CANLUBANG',
        ];
        Site::create($site);

        $site = [
            'name' => 'STA. ROSA',
        ];
        Site::create($site);

        $site = [
            'name' => 'GEN. TRI.',
        ];
        Site::create($site);

        $site = [
            'name' => 'CARMONA',
        ];
        Site::create($site);

        $site = [
            'name' => 'TANAUAN',
        ];
        Site::create($site);

        $site = [
            'name' => 'STO. TOMAS',
        ];
        Site::create($site);

        $site = [
            'name' => 'BICOL',
        ];
        Site::create($site);

        $site = [
            'name' => 'GENSAN',
        ];
        Site::create($site);

        $site = [
            'name' => 'CDO',
        ];
        Site::create($site);

        $site = [
            'name' => 'ZAMBOANGA',
        ];
        Site::create($site);

        $site = [
            'name' => 'DAVAO',
        ];
        Site::create($site);
    }
}
