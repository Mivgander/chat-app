<?php

namespace Database\Seeders;

use App\Models\Rozmowa;
use Illuminate\Database\Seeder;

class RozmowySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<7; $i++)
        {
            Rozmowa::create([]);
        }
    }
}
