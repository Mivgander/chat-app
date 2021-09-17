<?php

namespace Database\Seeders;

use App\Models\Wiadomosc;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WiadomosciSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->generateWiadomosci(1, [1, 2]);
        $this->generateWiadomosci(2, [3, 4]);
        $this->generateWiadomosci(3, [5, 6]);
        $this->generateWiadomosci(5, [9, 10]);
        $this->generateWiadomosci(7, [7, 2]);
    }

    private function generateWiadomosci($id_rozmowy, $id_uczestnikow = [])
    {
        for($i=0; $i<rand(5, 10); $i++)
        {
            $random_key = array_rand($id_uczestnikow, 1);
            Wiadomosc::create([
                'rozmowa_id' => $id_rozmowy,
                'nadawca_id' => $id_uczestnikow[$random_key],
                'wiadomosc' => Str::random(12)
            ]);
        }
    }
}
