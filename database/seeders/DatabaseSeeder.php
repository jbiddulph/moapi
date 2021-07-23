<?php

namespace Database\Seeders;

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
        $this->call([
            PageSeeder::class,
            LogoSeeder::class,
            HeaderSeeder::class,
            CategorySeeder::class,
            SettingSeeder::class,
            VenueSeeder::class,
            EventSeeder::class,
        ]);
    }
}
