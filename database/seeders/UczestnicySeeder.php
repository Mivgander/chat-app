<?php

namespace Database\Seeders;

use App\Models\Uczestnik;
use Illuminate\Database\Seeder;

class UczestnicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Uczestnik::create([
            'rozmowa_id' => 1,
            'user_id' => 1
        ]);

        Uczestnik::create([
            'rozmowa_id' => 1,
            'user_id' => 2
        ]);

        Uczestnik::create([
            'rozmowa_id' => 2,
            'user_id' => 3
        ]);

        Uczestnik::create([
            'rozmowa_id' => 2,
            'user_id' => 4
        ]);

        Uczestnik::create([
            'rozmowa_id' => 3,
            'user_id' => 5
        ]);

        Uczestnik::create([
            'rozmowa_id' => 3,
            'user_id' => 6
        ]);

        Uczestnik::create([
            'rozmowa_id' => 4,
            'user_id' => 7
        ]);

        Uczestnik::create([
            'rozmowa_id' => 4,
            'user_id' => 8
        ]);

        Uczestnik::create([
            'rozmowa_id' => 5,
            'user_id' => 9
        ]);

        Uczestnik::create([
            'rozmowa_id' => 5,
            'user_id' => 10
        ]);

        Uczestnik::create([
            'rozmowa_id' => 6,
            'user_id' => 10
        ]);

        Uczestnik::create([
            'rozmowa_id' => 6,
            'user_id' => 4
        ]);

        Uczestnik::create([
            'rozmowa_id' => 7,
            'user_id' => 7
        ]);

        Uczestnik::create([
            'rozmowa_id' => 7,
            'user_id' => 2
        ]);
    }
}
