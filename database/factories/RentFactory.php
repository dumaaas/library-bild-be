<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'librarian_id' => User::all()->where('userType_id', '=', 2)->random()->id,
            'student_id' => User::all()->where('userType_id', '=', 3)->random()->id,
            'book_id' => Book::all()->random()->id,
            'rent_date' => $this->faker->randomElement([now(), now()->subDays(50)]),
            'return_date' => $this->faker->randomElement([now()->addDays(30), null]),
        ];
    }
}
