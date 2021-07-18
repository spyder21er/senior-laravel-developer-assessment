<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

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
        $selected_gender = Arr::random([0, 1, 2]);
        $gender = [null, 'male', 'female'];
        $prefix = [null, 'Mr', 'Ms', 'Mrs'];
        $suffix = [null, 'Jr', 'Sr'];
        $selected_prefix = $selected_gender + ($selected_gender == 2 ? mt_rand(0, 1) : 0);

        return [
            'prefixname' => $prefix[$selected_prefix],
            'firstname' => $this->faker->firstName($gender[$selected_gender]),
            'middlename' => $this->faker->lastname(),
            'lastname' => $this->faker->lastname(),
            'suffixname' => $selected_gender == 1 ? Arr::random($suffix) : null,
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'photo' => null,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
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
}
