<?php

namespace Database\Factories;

use App\Models\Contractor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contractor>
 */
class ContractorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Contractor::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inn' => strval($this->faker->numberBetween(1111111111, 9999999999)),
            'name' => $this->faker->company, // Генерация названия компании
            'ogrn' => strval($this->faker->numberBetween(1111111111111, 9999999999999)),
            'address' => $this->faker->address, // Генерация адреса
        ];
    }
}
