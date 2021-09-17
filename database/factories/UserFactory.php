<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imie = $this->faker->firstName();
        $nazwisko = $this->faker->lastName();
        return [
            'imie' => $imie,
            'nazwisko' => $nazwisko,
            'user_name' => $imie . ' ' . $nazwisko,
            'email' => $this->faker->unique()->safeEmail(),
            'zdjecie' => $this->losujZdjecie(),
            'password' => Hash::make('1qazxsw2'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    private function losujZdjecie()
    {
        return Collection::make([
            'feelsbirthdayman.jpg',
            'FKsErDb0ZFYhZ26T1KiYXjNHcjHEnd1GcFJVZv03.jpg',
            'haha.jpg',
            'martigitara.JPG',
            'nTS44RB34OWlbtLEUAMfn3fjJiC2pBdsKgK3pLGr.jpg',
            'peeposhy.png'
        ])->random();
    }
}
