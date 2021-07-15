<?php

namespace Database\Seeders;
use App\Models\Logo;
use Illuminate\Database\Seeder;

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logos = Logo::factory()->count(20)->create();
    }
}
