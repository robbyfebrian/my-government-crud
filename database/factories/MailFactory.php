<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Mail;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailFactory extends Factory
{
    protected $model = Mail::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(1),
            'description' => $this->faker->paragraph(1),
            'received_at' => $this->faker->dateTimeBetween('-3 month', '1 year'),
            'reference_number' => $this->faker->numerify('REF-#####'),
            'phone_number' => substr($this->faker->numerify('###########'), 0, 12),
            'letter_date' => $this->faker->date(),
            'completed' => $this->faker->boolean(),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}