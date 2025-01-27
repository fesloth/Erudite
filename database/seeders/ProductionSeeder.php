<?php

namespace Database\Seeders;

use Database\Seeders\Productions\PermissionSeeder;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(SiteSeeder::class);
    }
}
