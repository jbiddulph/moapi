<?php

namespace Database\Seeders;
use App\Models\Header;
use Illuminate\Database\Seeder;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $headers = Header::factory()->count(6)->create();
    }
}
