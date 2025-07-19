<?php

namespace App\Modules\Contact\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\Contact\Domain\Entities\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'subject' => $this->faker->sentence(6),
            'message' => $this->faker->paragraph(3),
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => null,
        ];
    }
}
