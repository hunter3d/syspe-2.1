<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VisitorSeeder::class,
            RolesSeeder::class,
            PermissionSeeder::class,
            RolesHasPermissionsSeeder::class,
            ModelHasPermissionSeeder::class,
            ModelHasRolesSeeder::class,
            MessagesSeeder::class,
            ExhibitionsSeeder::class,
            TextsSeeder::class,
            SearchSeeder::class,
            EventsSeeder::class,
            ActivityLogSeeder::class,
            CountriesSeeder::class,
        ]);
    }
}
