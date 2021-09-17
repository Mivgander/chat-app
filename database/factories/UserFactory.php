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
            'depositphotos_6151014-stock-photo-african-american-man-portrait.jpg',
            'distressed-businessman-stretch-out-hands-to-strangle-annoying-person-standing-annoyed-frustrated-against-white-background-210563946.jpg',
            'istockphoto-1151469300-1024x1024.jpg',
            'person-stock-2.png',
            'stock-photo-thinking-young-person-person-thinking-think-176937.jpg',
            'what-your-favorite-stock-photo-spaghetti-person-s-2-7471-1432142821-2_dblbig.jpg'
        ])->random();
    }
}
